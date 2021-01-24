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

    public function seeEntry($id, $registroid) {
        $positions = DB::table('list_positions')
                   //->join('list_positions', 'list_entries.list_entry_id', '=', 'list_positions.list_id')
                   ->join('songs', 'songs.song_id', '=', 'list_positions.song_id')
                   ->join('artists as artista_principal', 'artista_principal.artist_id', '=', 'songs.main_artist_id')
                   ->select(
                    'list_positions.position as position',
                    'songs.name as song_name',
                    'songs.song_id as song_id',
                    'list_positions.list_entry_id as list_entry_id',
                    'artista_principal.name as artist_name',
                    'artista_principal.artist_id as main_artist_id',
                    'artista_principal.image as artist_image',
                    DB::raw('(SELECT GROUP_CONCAT(af.name)
                     FROM artists_made_song a 
                     INNER JOIN artists af ON a.artist_id = af.artist_id
                    WHERE a.song_id = songs.song_id) AS feat')
                   )
                   ->where('list_positions.list_entry_id', $registroid)
                   ->orderBy('list_positions.position')
                   /*->leftJoin('artists_made_song', 'artists_made_song.song_id', '=', 'songs.song_id')
                   ->leftJoin('artists as artistas_feat', 'artistas_feat.artist_id', '=', 'artists_made_song.artist_id')*/
                   /*->groupBy('position')
                   ->groupBy('song_name')
                   ->groupBy('artist_name')
                   ->groupBy('artist_image')
                   ->groupBy('id_do_feat')*/
                   ->get();
        $entry = DB::table('list_entries')
                   ->where('list_entries.list_entry_id', $registroid)
                   ->first();
        //echo '<pre>';
        //dd([$positions, $entry]);

        if (preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/',$entry->date)) {
            $dateFormatted = explode('-',$entry->date);
            $entry->date = implode('/', [$dateFormatted[2], $dateFormatted[1], $dateFormatted[0]]);
        }

        $arr_maiorPosicaoLista = [];//maiorPosicaoLista($idMusica, $idLista);
        $arr_positionLastWeek = [];//positionLastWeek($idMusica, $idLista, $idEntryAtual);
        $arr_noSemanasNoChart = [];//noSemanasNoChart($idMusica, $idLista);

        foreach($positions as $position) {
            //dd($position);
            array_push($arr_maiorPosicaoLista, ListsController::maiorPosicaoLista($position->song_id, $entry->list_id));
            array_push($arr_positionLastWeek, ListsController::positionLastWeek($position->song_id, $entry->list_id, $position->list_entry_id));
            //array_push($arr_positionLastWeek, $position->song_id. '/' .$position->list_entry_id. '/' .$entry->list_id);
            array_push($arr_noSemanasNoChart, ListsController::noSemanasNoChart($position->song_id, $entry->list_id));
        }


        $stats = [$arr_maiorPosicaoLista, $arr_positionLastWeek, $arr_noSemanasNoChart];

        return view('admin.lists.singleentry', ['entry' => $entry, 'positions' => $positions, 'stats' => $stats]);
    }

    public function insertEntry(Request $request) {
        //dd($request['songartist_feat_0']);
        try {
            $id = DB::table('list_entries')->insertGetId([
                'name' => $request->name,
                'description' => $request->description,
                'date' => $request->date,
                'list_id' => $request->listid
            ]);
            //dd($request->songname_new);


            //dd($request['songartist_feat_1']);

            for($i = 0; $i < $request->listpositions; $i++) {
                $j = $i + 1;
                if(isset($request->songname[$i])) {
                    DB::table('list_positions')->insertGetId([
                        'list_entry_id' => $id,
                        'song_id' => $request->songname[$i],
                        'position' => $j
                    ]);
                } else {
                    $idSong = DB::table('songs')->insertGetId([
                        'name' => $request->songname_new[$i],
                        'main_artist_id' => $request->songartist_main[$i]
                    ]);

                    if (is_array($request['songartist_feat_'.$i])) {
                       for($k = 0; $k < count($request['songartist_feat_'.$i]); $k++) {
                            DB::table('artists_made_song')->insertGetId([
                                'song_id' => $idSong,
                                'artist_id' => $request['songartist_feat_'.$i][$k],
                            ]);
                        } 
                    } else {
                        if (is_null($request['songartist_feat_'.$i])) {
                            DB::table('artists_made_song')->insertGetId([
                                'song_id' => $idSong,
                                'artist_id' => $request['songartist_feat_'.$i],
                            ]);
                        }
                    }

                    

                    DB::table('list_positions')->insertGetId([
                        'list_entry_id' => $id,
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

    public static function maiorPosicaoLista($idMusica, $idLista) {
        $number = DB::table('lists')
                    ->selectRaw('min(position) as maiorPosicao')
                    ->join('list_entries', 'lists.list_id', '=', 'list_entries.list_id')
                    ->join('list_positions', 'list_positions.list_entry_id', '=', 'list_entries.list_entry_id')
                    ->where('lists.list_id', '=', $idLista)
                    ->where('list_positions.song_id', '=', $idMusica)
                    ->get();
        return $number;
    }

    public static function dataDaMaiorPosicaoLista($idMusica, $idLista) {
        $date = DB::table('lists')
                    ->select('list_entries.date')
                    ->join('list_entries', 'lists.list_id', '=', 'list_entries.list_id')
                    ->join('list_positions', 'list_positions.list_entry_id', '=', 'list_entries.list_entry_id')
                    ->where('lists.list_id', '=', $idLista)
                    ->where('list_positions.song_id', '=', $idMusica)
                    ->where('list_positions.position', DB::raw('(SELECT min(position) as maiorPosicao FROM list_positions WHERE song_id = ' . $idMusica . ')'))
                    ->get();
        return $date;
    }

    public static function positionLastWeek($idMusica, $idLista, $idEntryAtual) {
        $number = DB::table('lists')
                    ->select('list_positions.position', 'list_positions.list_position_id')
                    ->join('list_entries', 'lists.list_id', '=', 'list_entries.list_id')
                    ->join('list_positions', 'list_positions.list_entry_id', '=', 'list_entries.list_entry_id')
                    ->where('list_positions.list_entry_id', '<=', $idEntryAtual)
                    ->where('lists.list_id', '=', $idLista)
                    ->where('list_positions.song_id', '=', $idMusica)
                    ->orderby('list_position_id', 'desc')
                    ->limit(2)
                    ->get();
        return $number;
    }

    public static function noSemanasNoChart($idMusica, $idLista) {
        $number = DB::table('lists')
                    ->selectRaw('count(*) as numeroSemanas')
                    ->join('list_entries', 'lists.list_id', '=', 'list_entries.list_id')
                    ->join('list_positions', 'list_positions.list_entry_id', '=', 'list_entries.list_entry_id')
                    ->where('lists.list_id', '=', $idLista)
                    ->where('list_positions.song_id', '=', $idMusica)
                    ->get();
        return $number;
    }

    public static function ultimaEntry($idMusica, $idLista) {
        $number = DB::table('lists')
                    ->select('list_entries.date as ultimaEntry')
                    ->join('list_entries', 'lists.list_id', '=', 'list_entries.list_id')
                    ->join('list_positions', 'list_positions.list_entry_id', '=', 'list_entries.list_entry_id')
                    ->where('lists.list_id', '=', $idLista)
                    ->where('list_positions.song_id', '=', $idMusica)
                    ->orderby('list_position_id', 'desc')
                    ->first();
        return $number;
    }
}
