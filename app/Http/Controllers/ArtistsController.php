<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Painel\DashboardProdutosController;
use App\Model\MmPagamentoCartaoCliente;
use App\Model\MmPagamentoHistorico;
use App\Model\MmCliente;
use App\Model\MmDepartamento;
use App\Services\ClientVindiServices;

class ArtistsController extends Controller
{
    public function insert(Request $request) {
        try {
            $imgURL = '';
            $sub1 = '';
            $sub2 = '';
            $sub3 = '';

            if($request->has('subgenre1')) $sub1 = $request->subgenre1;
            if($request->has('subgenre2')) $sub2 = $request->subgenre2;
            if($request->has('subgenre3')) $sub3 = $request->subgenre3;

            if($request->has('image')) {
                $file = $request->file('image');
                $imgName = time() . $file->getClientOriginalName();
                $file->move(public_path('images/upload'), $imgName);
                $imgURL = 'images/upload/' . $imgName;
            }

            DB::table('artists')->insertOrIgnore([
                ['name' => $request->name,
                'country_id' => $request->country,
                'genre_id' => $request->genre,
                'subgenre_id_1' => $sub1,
                'subgenre_id_2' => $sub2,
                'subgenre_id_3' => $sub3,
                'image' => $imgURL]
            ]);

            return redirect()->route('artistas-all')->with(['message' => 'Artista criado com sucesso!', 'status' => 'success']);
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('artistas-all')->with(['message' => 'Ocorreu um erro ao cadastrar o artista!', 'status' => 'danger']);
        }
    }

    public function update(Request $request) {
        try {
            $whatWillChange = [
                'name' => $request->name,
                'country_id' => $request->country,
                'genre_id' => $request->genre
            ];

            if($request->has('subgenre1')) $whatWillChange['subgenre_id_1'] = $request->subgenre1;
            if($request->has('subgenre2')) $whatWillChange['subgenre_id_2'] = $request->subgenre2;
            if($request->has('subgenre3')) $whatWillChange['subgenre_id_3'] = $request->subgenre3;

            if($request->has('image')) {
                if(isset($request->oldImage) && $request->oldImage !== '') {
                    unlink(public_path().'/'.$request->oldImage);
                }
                $file = $request->file('image');
                $imgName = time() . $file->getClientOriginalName();
                $file->move(public_path('images/upload'), $imgName);
                $whatWillChange['image'] = 'images/upload/' . $imgName;
            }

            $affected = DB::table('artists')
              ->where('artist_id', $request->id)
              ->update($whatWillChange);
            
            return redirect()->route('artist-single', ['id' => $request->id])->with(['message' => 'Dados do artista atualizados com sucesso.', 'status' => 'success']);
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('artist-edit', ['id' => $request->id])->with(['message' => 'Ocorreu um erro ao editar o artista!', 'status' => 'danger']);
        }
    }

    public function select(){
        $artists = DB::table('artists')
                     ->select('artists.artist_id', 'artists.name', 'artists.image', 'countries.name as country_name', 'genres.name as genre_name', 'sg1.name as subgenre_name_1', 'sg2.name as subgenre_name_2', 'sg3.name as subgenre_name_3')
                     ->join('countries', 'artists.country_id', '=', 'countries.country_id')
                     ->join('genres', 'artists.genre_id', '=', 'genres.genre_id')
                     ->leftJoin('subgenres as sg1', 'artists.subgenre_id_1', '=', 'sg1.subgenre_id')
                     ->leftJoin('subgenres as sg2', 'artists.subgenre_id_2', '=', 'sg2.subgenre_id')
                     ->leftJoin('subgenres as sg3', 'artists.subgenre_id_3', '=', 'sg3.subgenre_id')
                     ->get();

        return view('admin.artists.index', ['artists' => $artists]);
    }

    public function insertScreen(){
        $countries = DB::table('countries')->get();
        $genres = DB::table('genres')->get();
        $subgenres = DB::table('subgenres')->get();

        return view('admin.artists.new', ['countries' => $countries, 'genres' => $genres, 'subgenres' => $subgenres]);
    }

    public function single($id){
        $artist = DB::table('artists')
                    ->select('artists.artist_id', 'artists.name', 'artists.image', 'countries.name as country_name', 'genres.name as genre_name', 'sg1.name as subgenre_name_1', 'sg2.name as subgenre_name_2', 'sg3.name as subgenre_name_3')
                    ->join('countries', 'artists.country_id', '=', 'countries.country_id')
                    ->join('genres', 'artists.genre_id', '=', 'genres.genre_id')
                    ->leftJoin('subgenres as sg1', 'artists.subgenre_id_1', '=', 'sg1.subgenre_id')
                    ->leftJoin('subgenres as sg2', 'artists.subgenre_id_2', '=', 'sg2.subgenre_id')
                    ->leftJoin('subgenres as sg3', 'artists.subgenre_id_3', '=', 'sg3.subgenre_id')
                    ->where('artists.artist_id', '=', $id)->first();
                    
        $songs = DB::table('songs')
                   ->join('artists_made_song', 'artists_made_song.song_id', '=', 'songs.song_id')
                   ->where('artists_made_song.artist_id', '=', $id)->get();
        return view('admin.artists.single', ['artist' => $artist, 'songs' => $songs]);
    }

    public function edit($id){
        $artist = DB::table('artists')->where('artist_id', '=', $id)->first();
        $countries = DB::table('countries')->get();
        $genres = DB::table('genres')->get();
        $subgenres = DB::table('subgenres')->get();
        return view('admin.artists.new', ['artist' => $artist, 'countries' => $countries, 'genres' => $genres, 'subgenres' => $subgenres]);
    }
}
