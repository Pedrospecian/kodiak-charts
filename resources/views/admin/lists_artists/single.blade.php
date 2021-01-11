@extends('layouts.admin')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div>
        @if (null != session('message'))
            <div class="message {{session('status')}}">{{session('message') ?? '' }}</div>
        @endif
        <div class="top-section">
            <h1>{{ $list->name }}</h1>
            <a href="/admin/listas-artistas/{{ $list->list_id }}/novoregistro" class="btn btn-primary">Novo registro</a>
        </div>
        @if (count($entries) <= 0)
            <div class="not-found">Nenhum registro encontrado</div>
        @else        
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entries as $entry)
                        <tr>
                            <td>{{$entry->name}}</td>
                            <td><a href="/admin/listas-artistas/{{ $list->list_id }}/visualizar/{{ $entry->list_entry_id }}" class="btn btn-info">Visualizar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection