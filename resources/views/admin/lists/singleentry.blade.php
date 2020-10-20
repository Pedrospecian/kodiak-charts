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
            <h1>{{ $entry->name }} - {{ $entry->date }}</h1>
            <p>
                @if($entry->description != null)
                {{ $entry->description }}
                @endif
            </p>
        </div>
        @if (count($positions) <= 0)
            <div class="not-found">Essa lista não tem nenhuma posição.</div>
        @else        
            <table class="content-table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Imagem do artista principal</th>
                        <th>Artista(s)</th>
                        <th>Nome da música</th>
                        <th>Estatísticas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($positions as $position)
                        <tr>
                            <td>#{{ $position->position }}</td>
                            <td><img src="{{ url($position->artist_image) }}" class="artist-image" alt="{{ $position->artist_name }}"></td>
                            <td>
                                {{ $position->artist_name }}
                                @if(null != $position->feat)
                                ft. {{ $position->feat }}
                                @endif
                            </td>
                            <td>{{ $position->song_name }}</td>
                            <td>maior posição na lista | status em relação à posição anterior (se subiu ou se desceu) | weeks on chart (e em quantas listas dessa categoria essa musica apareceu anteriormente)</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection