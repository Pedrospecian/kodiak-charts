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

class ListsArtistsController extends Controller
{
    public function insert(Request $request) {
        try {
            DB::table('lists_artists')->insertOrIgnore([
                'name' => $request->name,
                'positions' => $request->positions,
                'list_type_id' => $request->type
            ]);
            return redirect()->route('listas-artistas-all')->with(['message' => 'Lista de artista criada com sucesso!', 'status' => 'success']);
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('listas-artistas-all')->with(['message' => 'Ocorreu um erro ao cadastrar a lista de artista!', 'status' => 'danger']);
        }
    }

    public function seeEntry($id, $registroid) {
        $positions = DB::table('list_positions_artists')
                   //->join('list_positions', 'list_entries.list_entry_id', '=', 'list_positions.list_id')
                   ->join('artists', 'artists.artist_id', '=', 'list_positions_artists.artist_id')
                   ->select(
                    'list_positions_artists.position as position',
                    'list_positions_artists.list_entry_id as list_entry_id',
                    'artists.name as artist_name',
                    'artists.image as artist_image'
                   )
                   ->where('list_positions_artists.list_entry_id', $registroid)
                   /*->leftJoin('artists_made_song', 'artists_made_song.song_id', '=', 'songs.song_id')
                   ->leftJoin('artists as artistas_feat', 'artistas_feat.artist_id', '=', 'artists_made_song.artist_id')*/
                   /*->groupBy('position')
                   ->groupBy('song_name')
                   ->groupBy('artist_name')
                   ->groupBy('artist_image')
                   ->groupBy('id_do_feat')*/
                   ->get();
        $entry = DB::table('list_artist_entries')
                   ->where('list_artist_entries.list_entry_id', $registroid)
                   ->first();
        //echo '<pre>';
        //dd([$positions, $entry]);

        if (preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/',$entry->date)) {
            $dateFormatted = explode('-',$entry->date);
            $entry->date = implode('/', [$dateFormatted[2], $dateFormatted[1], $dateFormatted[0]]);
        }

        /*

        $arr_maiorPosicaoLista = [];//maiorPosicaoLista($idMusica, $idLista);
        $arr_positionLastWeek = [];//positionLastWeek($idMusica, $idLista, $idEntryAtual);
        $arr_noSemanasNoChart = [];//noSemanasNoChart($idMusica, $idLista);

        foreach($positions as $position) {
            //dd($position);
            array_push($arr_maiorPosicaoLista, ListsController::maiorPosicaoLista($position->song_id, $entry->list_id));
            array_push($arr_positionLastWeek, ListsController::positionLastWeek($position->song_id, $entry->list_id, $position->list_entry_id));
            //array_push($arr_positionLastWeek, $position->song_id. '/' .$position->list_entry_id. '/' .$entry->list_id);
            array_push($arr_noSemanasNoChart, ListsController::noSemanasNoChart($position->song_id, $entry->list_id));
        }*/


        $stats = [];//$arr_maiorPosicaoLista, $arr_positionLastWeek, $arr_noSemanasNoChart];

        return view('admin.lists_artists.singleentry', ['entry' => $entry, 'positions' => $positions, 'stats' => $stats]);
    }

    public function insertEntry(Request $request) {
        //dd($request['songartist_feat_0']);
        try {
            $id = DB::table('list_artist_entries')->insertGetId([
                'name' => $request->name,
                'description' => $request->description,
                'date' => $request->date,
                'list_id' => $request->listid
            ]);
            //dd($request->songname_new);


            //dd($request['songartist_feat_1']);

            for($i = 0; $i < $request->listpositions; $i++) {
                $j = $i + 1;
                //if(isset($request->songname[$i])) {
                    DB::table('list_positions_artists')->insertGetId([
                        'list_entry_id' => $id,
                        'list_id' => $id,
                        'artist_id' => $request->songartist_main[$i],
                        'position' => $j
                    ]);
                /*} else {
                    $idSong = DB::table('songs')->insertGetId([
                        'name' => $request->songname_new[$i],
                        'main_artist_id' => $request->songartist_main[$i]
                    ]);

                                    

                    DB::table('list_positions')->insertGetId([
                        'list_entry_id' => $id,
                        'song_id' => $idSong,
                        'position' => $j
                    ]);
                }*/
            }
            
            return redirect()->route('list-artist-single', ["id" => $request->listid])->with(['message' => 'Lista criada com sucesso!', 'status' => 'success']);
        } catch(\Illuminate\Database\QueryException $e){
            dd($e);
            return redirect()->route('list-artist-single', ["id" => $request->listid])->with(['message' => 'Ocorreu um erro ao cadastrar a lista!', 'status' => 'danger']);
        }
    }

    public function select(){
        $lists = DB::table('lists_artists')
                   ->join('list_types', 'lists_artists.list_type_id', '=', 'list_types.list_type_id')
                   ->select('lists_artists.name as name', 'lists_artists.positions as positions', 'lists_artists.list_id as list_id', 'list_types.name as type_name')
                   ->get();

        return view('admin.lists_artists.index', ['lists' => $lists]);
    }

    public function newForm() {        
        $types = DB::table('list_types')->get();
        return view('admin.lists_artists.new', ['types' => $types]);
    }

    public function newEntryForm($id) {
        $artists = DB::table('artists')->get();
        /*$songs = DB::table('songs')
                   ->join('artists','artists.artist_id','=','songs.main_artist_id')
                   ->select('songs.song_id as song_id', 'artists.name as artistname', 'songs.name as songname')
                   ->get();*/
        $list = DB::table('lists_artists')->where('list_id','=',$id)->first();
        return view('admin.lists_artists.newentry', ['list'=>$list, 'artists' => $artists]);
    }

    public function single($id) {
        $list = DB::table('lists_artists')->where('list_id',$id)->first();
        $entries = DB::table('list_artist_entries')->where('list_id',$id)->get();
        return view('admin.lists_artists.single', ['list' =>$list, 'entries'=>$entries]);
    }

    public static function maiorPosicaoLista($idMusica, $idLista) {
        $number = DB::table('list_artists')
                    ->selectRaw('min(position) as maiorPosicao')
                    ->join('list_artist_entries', 'lists.list_id', '=', 'list_artist_entries.list_id')
                    ->join('list_positions_artists', 'list_positions_artists.list_entry_id', '=', 'list_artist_entries.list_entry_id')
                    ->where('lists_artists.list_id', '=', $idLista)
                    ->where('list_positions_artists.song_id', '=', $idMusica)
                    ->get();
        return $number;
    }

    public static function positionLastWeek($idMusica, $idLista, $idEntryAtual) {
        $number = DB::table('lists_artists')
                    ->select('list_positions_artists.position', 'list_positions_artists.list_position_id')
                    ->join('list_artist_entries', 'lists.list_id', '=', 'list_artist_entries.list_id')
                    ->join('list_positions_artists', 'list_positions_artists.list_entry_id', '=', 'list_artist_entries.list_entry_id')
                    ->where('list_positions_artists.list_entry_id', '<=', $idEntryAtual)
                    ->where('lists_artists.list_id', '=', $idLista)
                    ->where('list_positions_artists.song_id', '=', $idMusica)
                    ->orderby('list_position_id', 'desc')
                    ->limit(2)
                    ->get();
        return $number;
    }

    public static function noSemanasNoChart($idMusica, $idLista) {
        $number = DB::table('lists_artists')
                    ->selectRaw('count(*) as numeroSemanas')
                    ->join('list_artist_entries', 'lists_artists.list_id', '=', 'list_artist_entries.list_id')
                    ->join('list_positions_artists', 'list_positions_artists.list_entry_id', '=', 'list_artist_entries.list_entry_id')
                    ->where('lists_artists.list_id', '=', $idLista)
                    ->where('list_positions_artists.song_id', '=', $idMusica)
                    ->get();
        return $number;
    }
}
