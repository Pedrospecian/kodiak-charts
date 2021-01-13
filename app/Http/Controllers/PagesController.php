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
        return view('chart/singleArtist');
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

    public function search() {
        echo 'busca';
    }

    public function archiveSingle() {
        return view('archive/single');
    }
}
