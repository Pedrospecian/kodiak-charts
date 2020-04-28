@extends('layouts.admin')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="page__artist-single">
        @if (null != session('message'))
            <div class="message {{session('status')}}">{{session('message') ?? '' }}</div>
        @endif
        <div class="top-section top-section-artist" style="background-image: url({{url($artist->image)}});">
            <h1>{{$artist->name}}</h1>            
            <a href="/admin/artistas/{{$artist->artist_id}}/editar" class="btn">Editar informações</a>
        </div>
        <div class="container">
            <p>
                País: {{$artist->country_name}}
                <br>
                Gênero principal: {{$artist->genre_name}}
                @if($artist->subgenre_name_1 != '' || $artist->subgenre_name_2 != '' || $artist->subgenre_name_3 != '')
                <br>
                Subgêneros:
                @endif
                {{$artist->subgenre_name_1}}@if(($artist->subgenre_name_1 != '' && $artist->subgenre_name_2 != '') || ($artist->subgenre_name_1 != '' && $artist->subgenre_name_3 != '')), @endif
                                {{$artist->subgenre_name_2}}@if($artist->subgenre_name_2 != '' && $artist->subgenre_name_3 != ''), @endif
                                {{$artist->subgenre_name_3}}
            </p>
        </div>
        @if (count($songs) <= 0)
            <div class="not-found">As músicas feitas por esse artista irão aparecer aqui</div>
        @else        
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Músicas</th>
                        <th>Participações Especiais</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($songs as $song)
                        <tr>
                            <td>{{$song->name}}</td>
                            <td>ft. Pitbull</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection