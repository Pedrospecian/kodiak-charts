@extends('layouts.admin')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div>
        <div class="top-section">
            <h1>Novo gênero</h1>
        </div>
        <form action="/admin/generos/insert" method="post" class="form-standard">
            @csrf
            <div class="form-group">
                <div class="field-wrapper w-30">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name">
                </div>
            </div>            
            <div class="form-bottom text-right">
                <div class="field-wrapper">
                    <button class="btn btn-primary">Criar</button>
                </div>
            </div>
        </form>
    </div>
@endsection