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
            <h1>Listas de Artistas</h1>
            <a href="/admin/listas-artistas/new" class="btn">Nova</a>
        </div>
        @if (count($lists) <= 0)
            <div class="not-found">Nenhum registro encontrado</div>
        @else        
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Posições</th>
                        <th>Período</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lists as $list)
                        <tr>
                            <td>{{$list->name}}</td>
                            <td>{{$list->positions}}</td>
                            <td>{{$list->type_name}}</td>
                            <td><a href="/admin/listas-artistas/{{ $list->list_id }}" class="btn btn-primary">Entries</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection