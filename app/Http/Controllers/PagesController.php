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

        return view('chart/single');
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
