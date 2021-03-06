<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/*use App\Http\Controllers\Painel\DashboardProdutosController;
use App\Model\MmPagamentoCartaoCliente;
use App\Model\MmPagamentoHistorico;
use App\Model\MmCliente;
use App\Model\MmDepartamento;
use App\Services\ClientVindiServices;*/

class PagesController extends Controller
{
    /*protected $clientVindiServices;

    public function __construct(ClientVindiServices $clientVindiServices) {        
        $this->clientVindiServices = $clientVindiServices;
        $this->middleware('auth');
    }
    private $id_cliente;*/
   
    /*public function produtos()
    {

        return view('produtos');
    }
    public function busca()
    {
        return view('busca');
    }

    public function pagamentos(){
        $cliente = session('CLIENTE');
        $id_cliente = $cliente->id_cliente;
        $departamentosUsuario = session('DEPARTAMENTOS');
        $faturas = MmPagamentoHistorico::getPagamentosCliente($id_cliente);
        $cartoes = MmPagamentoCartaoCliente::getCartaoCliente($id_cliente);        
        
        $departamentos = MmDepartamento::getDepartamentosByClientes($departamentosUsuario);
        
        // $bandeiras = $this->clientVindiServices->listarBandeirasCartao()['body']->payment_methods[0]->payment_companies;
        
        return view('pagamento',compact('faturas','cartoes','cliente','departamentos'));
        
    }


    public function faturaInterna($hashFatura){
        
        $departamentosUsuario = session('DEPARTAMENTOS');
        $fatura = MmPagamentoHistorico::where('tx_gateway_transaction',$hashFatura)->first();
        $departamentos = MmDepartamento::getDepartamentosByClientes($departamentosUsuario);
        $email = session('CLIENTE')->ds_email;
        
        return view('faturaInterna',compact('fatura','departamentos','email'));

    }

    public function buscaproduto()
    {
        return view('buscaproduto');
    }
    public function politicasPrivacidade()
    {
        return view('politicasprivacidade');
    }*/


    public function chartIndex() {
        return view('chart/index');
    }

    public function chartSingle($id) {
        $entry = DB::table('list_entries')
                   ->where('list_id', $id)
                   ->orderBy('list_entry_id', 'desc')
                   ->first();
        // dd($entry);

        $list = DB::table('lists')
                   ->where('list_id', $id)
                   ->first();

        if(is_null($entry)) {
            return view('chart/single', ['emptyMessage' => 'This chart currently has no entries', 'list' => $list]);
        } else {

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
                       ->where('list_positions.list_entry_id', $entry->list_entry_id)
                       ->orderBy('list_positions.position')
                       ->get();
            /*$entry = DB::table('list_entries')
                       ->where('list_entries.list_entry_id', $entry->list_entry_id)
                       ->first();*/
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

            return view('chart/single', ['entry' => $entry, 'positions' => $positions, 'stats' => $stats, 'emptyMessage' => null, 'list' => $list]);
        }
    }

    public function chartSingleArtists($id) {   
        $entry = DB::table('list_artist_entries')
                   ->where('list_id', $id)
                   ->orderBy('list_entry_id', 'desc')
                   ->first();
        // dd($entry);

        $list = DB::table('lists')
                   ->where('list_id', $id)
                   ->first();

        if(is_null($entry)) {
            return view('chart/single', ['emptyMessage' => 'This chart currently has no entries', 'list' => $list]);
        } else {

            $positions = DB::table('list_positions_artists')
                       //->join('list_positions', 'list_entries.list_entry_id', '=', 'list_positions.list_id')
                       ->join('artists', 'artists.artist_id', '=', 'list_positions_artists.artist_id')
                       // ->join('artists as artista_principal', 'artista_principal.artist_id', '=', 'songs.main_artist_id')
                       ->select(
                        'list_positions_artists.position as position',
                        // 'songs.name as song_name',
                        'artists.artist_id as artist_id',
                        'list_positions_artists.list_entry_id as list_entry_id',
                        'artists.name as artist_name',
                        'artists.image as artist_image',
                        /*DB::raw('(SELECT GROUP_CONCAT(af.name)
                         FROM artists_made_song a 
                         INNER JOIN artists af ON a.artist_id = af.artist_id
                        WHERE a.song_id = songs.song_id) AS feat')*/
                       )
                       ->where('list_positions_artists.list_entry_id', $entry->list_entry_id)
                       ->orderBy('list_positions_artists.position')
                       ->get();
            /*$entry = DB::table('list_entries')
                       ->where('list_entries.list_entry_id', $entry->list_entry_id)
                       ->first();*/
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
                array_push($arr_maiorPosicaoLista, ListsArtistsController::maiorPosicaoLista($position->artist_id, $entry->list_id));
                array_push($arr_positionLastWeek, ListsArtistsController::positionLastWeek($position->artist_id, $entry->list_id, $position->list_entry_id));
                //array_push($arr_positionLastWeek, $position->artist_id. '/' .$position->list_entry_id. '/' .$entry->list_id);
                array_push($arr_noSemanasNoChart, ListsArtistsController::noSemanasNoChart($position->artist_id, $entry->list_id));
            }


            $stats = [$arr_maiorPosicaoLista, $arr_positionLastWeek, $arr_noSemanasNoChart];

            return view('chart/singleArtist', ['entry' => $entry, 'positions' => $positions, 'stats' => $stats, 'emptyMessage' => null, 'list' => $list]);
        }     
        // return view('chart/singleArtist');
    }

    public function archiveIndex($sort = '') {
        switch ($sort) {
            case "az":
                $artists = DB::table('artists')->orderBy('name')->get();
                break;
            case "za":
                $artists = DB::table('artists')->orderBy('name', 'desc')->get();
                break;
            case "newartists":
                $artists = DB::table('artists')->orderBy('created_at', 'desc')->get();
                break;
            default:
                $artists = DB::table('artists')->get();
        }
        
        return view('archive/index', ['artists' => $artists]);
    }

    public function search(Request $request, $sort = '') {
        switch ($sort) {
            case "az":
                $artists = DB::table('artists')->where('name','LIKE','%'.$request->get('search').'%')->orderBy('name')->get();
                break;
            case "za":
                $artists = DB::table('artists')->where('name','LIKE','%'.$request->get('search').'%')->orderBy('name', 'desc')->get();
                break;
            case "newartists":
                $artists = DB::table('artists')->where('name','LIKE','%'.$request->get('search').'%')->orderBy('created_at', 'desc')->get();
                break;
            default:
                $artists = DB::table('artists')->where('name','LIKE','%'.$request->get('search').'%')->get();
        }
        
        return view('archive/search', [ 'artists' => $artists, 'term' => $request->get('search') ]);
    }

    public function archiveSingle($id) {
        $artist = DB::table('artists')
                  ->select(
                    'artists.name as artist_name', 
                    'artists.image as artist_image', 
                    'countries.name as country_name', 
                    'genres.name as genre_name', 
                    'sub1.name as sub1_name', 
                    'sub2.name as sub2_name',
                    'sub3.name as sub3_name'
                  )
                  ->join('countries', 'artists.country_id', '=', 'countries.country_id')
                  ->join('genres', 'artists.genre_id', '=', 'genres.genre_id')
                  ->join('subgenres as sub1', 'artists.subgenre_id_1', '=', 'sub1.genre_id')
                  ->join('subgenres as sub2', 'artists.subgenre_id_2', '=', 'sub2.genre_id')
                  ->join('subgenres as sub3', 'artists.subgenre_id_3', '=', 'sub3.genre_id')
                  ->where('artists.artist_id', $id)
                  ->first();

        $songs = DB::table('songs')
                 ->select('songs.name', 'songs.song_id')
                 ->where('songs.main_artist_id', $id)
                 ->get();

        $lists = DB::table('lists')
                 ->select('lists.list_id', 'lists.name')
                 ->join('list_entries', 'list_entries.list_id', '=', 'lists.list_id')
                 ->join('list_positions', 'list_positions.list_entry_id', '=', 'list_entries.list_entry_id')
                 ->join('songs', 'songs.song_id', '=', 'list_positions.song_id')
                 ->where('songs.main_artist_id', $id)
                 ->groupby('lists.list_id','lists.name')
                 ->get();

        $numberLists = count($lists);
        $songsStatsLists = [];

        for($i = 0; $i < $numberLists; $i++) {
            /*$entry = DB::table('list_artist_entries')
                   ->where('list_id', $lists[$i]->list_id)
                   ->orderBy('list_entry_id', 'desc')
                   ->first();*/

            $positions = DB::table('list_positions')
                       //->join('list_positions', 'list_entries.list_entry_id', '=', 'list_positions.list_id')
                       ->join('songs', 'songs.song_id', '=', 'list_positions.song_id')
                       ->join('list_entries', 'list_entries.list_entry_id', '=', 'list_positions.list_entry_id')
                       ->join('lists', 'list_entries.list_id', '=', 'list_entries.list_id')
                       ->select(
                        'songs.song_id as song_id'
                       )
                       ->where('lists.list_id', $lists[$i]->list_id)
                       ->where('songs.main_artist_id', $id)
                       ->orderBy('list_positions.position')
                       ->groupby('song_id')
                       ->get();


            $songi = [];

            foreach($positions as $position) {
                array_push($songi, [
                    'song_id' => $position->song_id,
                    'maiorPosicao' => ListsController::maiorPosicaoLista($position->song_id, $lists[$i]->list_id),
                    'maiorPosicaoData' => ListsController::dataDaMaiorPosicaoLista($position->song_id, $lists[$i]->list_id),
                    'noSemanasNoChart' => ListsController::noSemanasNoChart($position->song_id, $lists[$i]->list_id),
                    'ultimaEntry' => ListsController::ultimaEntry($position->song_id, $lists[$i]->list_id),
                    'list_id' => $lists[$i]->list_id
                ]);
            }

            array_push($songsStatsLists, $songi);
        }  

        //falta implementar rankings gerais


        return view('archive/single', [ 'artist' => $artist, 'songs' => $songs, 'lists' => $lists, 'songsStatsLists' => $songsStatsLists]);
    }
}
