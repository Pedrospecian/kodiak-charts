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
            <h1>{{ $genre->name }} e seus subgêneros </h1>
            <a href="/admin/generos/{{ $genre->genre_id }}/subgenero" class="btn btn-primary">Novo subgênero</a>
        </div>
        @if (count($subgenres) <= 0)
            <div class="not-found">Nenhum registro encontrado</div>
        @else        
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subgenres as $subgenre)
                        <tr><td>{{$subgenre->name}}</td></tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection