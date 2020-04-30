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

class GenresController extends Controller
{
    public function insert(Request $request) {
        try {
            DB::table('genres')->insert([
                ['name' => $request->name]
            ]);
            return redirect()->route('generos-all')->with(['message' => 'Gênero criado com sucesso!', 'status' => 'success']);
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('generos-all')->with(['message' => 'Ocorreu um erro ao cadastrar o gênero!', 'status' => 'danger']);
        }
    }

    public function select(){
        $genres = DB::table('genres')->orderBy('name')->get();

        return view('admin.genres.index', ['genres' => $genres]);
    }

    public function single($id){
        $genre = DB::table('genres')->where('genre_id', '=', $id)->first();
        $subgenres = DB::table('subgenres')->where('genre_id', '=', $id)->orderBy('name')->get();
        return view('admin.genres.single', ['genre' => $genre, 'subgenres' => $subgenres]);
    }

    public function new_subgenre($id){
        $genre = DB::table('genres')->where('genre_id', '=', $id)->first();
        return view('admin.genres.newSubGenre', ['genre' => $genre]);
    }

    public function new_subgenre_insert(Request $request, $id) {
        try {
            DB::table('subgenres')->insertOrIgnore([
                ['name' => $request->name, 'genre_id' => $id]
            ]);
            return redirect()->route('genre-single', ['id' => $id])->with(['message' => 'Subgênero criado com sucesso!', 'status' => 'success']);
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('genre-single', ['id' => $id])->with(['message' => 'Ocorreu um erro ao cadastrar o subgênero!', 'status' => 'danger']);
        }
    }
}
