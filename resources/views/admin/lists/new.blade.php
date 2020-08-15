@extends('layouts.admin')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div>
        <div class="top-section">
            <h1>Nova lista</h1>
        </div>
        <form action="/admin/listas/insert" method="post" class="form-standard">
            @csrf
            <div class="form-group row">
                <div class="field-wrapper w-40">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="field-wrapper w-30">
                    <label for="type">Tipo</label>
                    <select name="type" id="type">
                        <option value="">Selecione</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->list_type_id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-wrapper w-30">
                    <label for="positions">Número de posições</label>
                    <select name="positions" id="positions">
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
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