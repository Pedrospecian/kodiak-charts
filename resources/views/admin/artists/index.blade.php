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
            <h1>Artistas</h1>
            <a href="/admin/artistas/new" class="btn">Novo</a>
        </div>
        @if (count($artists) <= 0)
            <div class="not-found">Nenhum registro encontrado</div>
        @else        
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>País</th>
                        <th>Gênero</th>
                        <th>Subgêneros</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artists as $artist)
                        <tr>
                            <td><img src="{{url($artist->image)}}" alt="{{$artist->name}}" class="artist-image"/></td>
                            <td><a href="/admin/artistas/{{$artist->artist_id}}">{{$artist->name}}</a></td>
                            <td>{{$artist->country_name}}</td>
                            <td>{{$artist->genre_name}}</td>
                            <td>
                                {{$artist->subgenre_name_1}}@if(($artist->subgenre_name_1 != '' && $artist->subgenre_name_2 != '') || ($artist->subgenre_name_1 != '' && $artist->subgenre_name_3 != '')), @endif
                                {{$artist->subgenre_name_2}}@if($artist->subgenre_name_2 != '' && $artist->subgenre_name_3 != ''), @endif
                                {{$artist->subgenre_name_3}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection