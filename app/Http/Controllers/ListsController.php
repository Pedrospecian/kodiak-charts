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

class ListsController extends Controller
{
    public function insert(Request $request) {
        try {
            DB::table('lists')->insertOrIgnore([
                'name' => $request->name,
                'positions' => $request->positions,
                'list_type_id' => $request->type
            ]);
            return redirect()->route('listas-all')->with(['message' => 'Lista criada com sucesso!', 'status' => 'success']);
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('listas-all')->with(['message' => 'Ocorreu um erro ao cadastrar a lista!', 'status' => 'danger']);
        }
    }

    public function insertEntry(Request $request) {
        try {
            $id = DB::table('list_entries')->insertGetId([
                'name' => $request->name,
                'description' => $request->description,
                'date' => $request->date,
                'list_id' => $request->listid
            ]);
            //dd($request->songname_new);

            for($i = 0; $i < $request->listpositions; $i++) {
                $j = $i + 1;
                if(isset($request->songname[$i])) {
                    DB::table('list_positions')->insertGetId([
                        'list_id' => $id,
                        'song_id' => $request->songname[$i],
                        'position' => $j
                    ]);
                } else {
                    $idSong = DB::table('songs')->insertGetId([
                        'name' => $request->songname_new[$i],
                        'main_artist_id' => $request->songartist_main[$i]
                    ]);

                    DB::table('list_positions')->insertGetId([
                        'list_id' => $id,
                        'song_id' => $idSong,
                        'position' => $j
                    ]);
                }
            }
            
            return redirect()->route('list-single', ["id" => $request->listid])->with(['message' => 'Lista criada com sucesso!', 'status' => 'success']);
        } catch(\Illuminate\Database\QueryException $e){
            dd($e);
            return redirect()->route('list-single', ["id" => $request->listid])->with(['message' => 'Ocorreu um erro ao cadastrar a lista!', 'status' => 'danger']);
        }
    }

    public function select(){
        $lists = DB::table('lists')
                   ->join('list_types', 'lists.list_type_id', '=', 'list_types.list_type_id')
                   ->select('lists.name as name', 'lists.positions as positions', 'lists.list_id as list_id', 'list_types.name as type_name')
                   ->get();

        return view('admin.lists.index', ['lists' => $lists]);
    }

    public function newForm() {        
        $types = DB::table('list_types')->get();
        return view('admin.lists.new', ['types' => $types]);
    }

    public function newEntryForm($id) {
        $artists = DB::table('artists')->get();
        $songs = DB::table('songs')
                   ->join('artists','artists.artist_id','=','songs.main_artist_id')
                   ->select('songs.song_id as song_id', 'artists.name as artistname', 'songs.name as songname')
                   ->get();
        $list = DB::table('lists')->where('list_id','=',$id)->first();
        return view('admin.lists.newentry', ['list'=>$list, 'artists' => $artists, 'songs' => $songs]);
    }

    public function single($id) {
        $list = DB::table('lists')->where('list_id',$id)->first();
        $entries = DB::table('list_entries')->where('list_id',$id)->get();
        return view('admin.lists.single', ['list' =>$list, 'entries'=>$entries]);
    }
}
