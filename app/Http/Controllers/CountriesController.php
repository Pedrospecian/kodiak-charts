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

class CountriesController extends Controller
{
    public function insert(Request $request) {
        try {
            DB::table('countries')->insertOrIgnore([
                ['name' => $request->name]
            ]);
            return redirect()->route('paises-all')->with(['message' => 'País criado com sucesso!', 'status' => 'success']);
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('paises-all')->with(['message' => 'Ocorreu um erro ao cadastrar o país!', 'status' => 'danger']);
        }
    }

    public function select(){
        $countries = DB::table('countries')->get();

        return view('admin.countries.index', ['countries' => $countries]);
    }
}
