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
                ['name' => $request->name]
            ]);
            return redirect()->route('listas-all')->with(['message' => 'Lista criada com sucesso!', 'status' => 'success']);
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('listas-all')->with(['message' => 'Ocorreu um erro ao cadastrar a lista!', 'status' => 'danger']);
        }
    }

    public function select(){
        $lists = DB::table('lists')->get();

        return view('admin.lists.index', ['lists' => $lists]);
    }
}
