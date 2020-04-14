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
            <h1>Gêneros</h1>
            <a href="/admin/generos/new" class="btn">Novo</a>
        </div>
        @if (count($genres) <= 0)
            <div class="not-found">Nenhum registro encontrado</div>
        @else        
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="125">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <td>{{$genre->name}}</td>
                            <td><a href="/admin/generos/{{$genre->genre_id}}" class="btn btn-primary">Subgêneros</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection