@extends('layouts.front')

@section('content')
<?php $meses = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']; ?>
<?php $suffix = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'] ?>
    <div class="artist-top d-flex">
        <div><img src="{{ asset($artist->artist_image) }}"></div>
        <div>{{ $artist->artist_name }}</div>
        <div>
            <div>
                #2
                <br>
                Kodiak's all time artists ranking
            </div>
            <div>
                #7
                <br>
                Kodiak Charts artist ranking
            </div>
        </div>
    </div>
    <div class="d-flex">
        <div class="artist-box-single">
            Most successful track in charts
            <br>
            a
        </div>

        <div class="artist-box-single">
            Kodiak's favorite song
            <br>
            a
        </div>

        <div class="artist-box-single">
            Kodiak's favorite album
            <br>
            a
        </div>
    </div>

    <div class="tabs-wrapper d-flex">
        @foreach($lists as $list)
        <a href="#" data-list-id="{{ $list->list_id}}">{{ $list->name }}</a>
        @endforeach
    </div>
    <div class="tabs-bottom d-flex">
        <div class="tabs-content-wrapper">
            <div>
                <?php $counter = 1; ?>
                @foreach($songs as $song)
                <div class="song-single">
                    <div class="song-name">{{ $song->name }}</div>
                    <div class="song-number">{{ $counter }}</div>
                    <div class="song-info">
                        <div class="info-left">
                            <span>
                                @foreach($songsStatsLists as $po)
                                    <?php $asas = 0; ?>
                                    @foreach($po as $p)
                                        @if($song->song_id == $p['song_id'])
                                        <span data-show-id="{{ $p['list_id'] }}">                                                
                                                {{ $p['noSemanasNoChart'][0]->numeroSemanas }} 
                                        </span>
                                        @else
                                            <?php $asas++; ?>

                                            @if($asas >= count($po))
                                                <span data-show-id="{{ $p['list_id'] }}">                                                
                                                    0
                                                </span>
                                            @endif
                                        @endif     
                                    @endforeach
                                @endforeach
                            </span>
                            weeks on chart /
                            Last entry:
                            <span>
                                @foreach($songsStatsLists as $po)
                                    <?php $asas = 0; ?>
                                    @foreach($po as $p)
                                        @if($song->song_id == $p['song_id'])
                                        <span data-show-id="{{ $p['list_id'] }}">
                                            {{ $meses[((int)explode('-', $p['ultimaEntry']->ultimaEntry)[1]) - 1 ] }}
                                            {{ (int)explode('-', $p['ultimaEntry']->ultimaEntry)[2] . $suffix[((int)explode('-', $p['ultimaEntry']->ultimaEntry)[2]) % 10 ] }},
                                            {{ explode('-', $p['ultimaEntry']->ultimaEntry)[0] }}
                                        </span>
                                        @else
                                            <?php $asas++; ?>

                                            @if($asas >= count($po))
                                                <span data-show-id="{{ $p['list_id'] }}">                                                
                                                    no date
                                                </span>
                                            @endif
                                        @endif     
                                    @endforeach
                                @endforeach
                            </span>
                        </div>
                        <div class="info-right">
                            Peaked at
                            <span>
                                @foreach($songsStatsLists as $po)
                                    <?php $asas = 0; ?>
                                    @foreach($po as $p)
                                        @if($song->song_id == $p['song_id'])
                                        <span data-show-id="{{ $p['list_id'] }}">                                                
                                                {{ $p['maiorPosicao'][0]->maiorPosicao }} 
                                        </span>
                                        @else
                                            <?php $asas++; ?>

                                            @if($asas >= count($po))
                                                <span data-show-id="{{ $p['list_id'] }}">                                                
                                                    0
                                                </span>
                                            @endif
                                        @endif     
                                    @endforeach
                                @endforeach
                            </span>
                            on
                            <div>
                                @foreach($songsStatsLists as $po)
                                    <?php $asas = 0; ?>
                                    @foreach($po as $p)
                                        @if($song->song_id == $p['song_id'])
                                        <span data-show-id="{{ $p['list_id'] }}">
                                            {{ $meses[((int)explode('-', $p['maiorPosicaoData'][0]->date)[1]) - 1 ] }}
                                            {{ (int)explode('-', $p['maiorPosicaoData'][0]->date)[2] . $suffix[((int)explode('-', $p['maiorPosicaoData'][0]->date)[2]) % 10 ] }},
                                            {{ explode('-', $p['maiorPosicaoData'][0]->date)[0] }}
                                        </span>
                                        @else
                                            <?php $asas++; ?>

                                            @if($asas >= count($po))
                                                <span data-show-id="{{ $p['list_id'] }}">                                                
                                                    no date
                                                </span>
                                            @endif
                                        @endif     
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <?php $counter++; ?>
                @endforeach
            </div>
        </div>
        <div class="side-info">
            {{ $artist->artist_name }}
            <div>Origin: {{ $artist->country_name }}</div>
            <div>Main Genre: {{ $artist->genre_name }}</div>
            <div>
                Subgenre(s): {{ $artist->sub1_name }}
                @if(!is_null($artist->sub2_name))
                    , {{ $artist->sub2_name }}
                @endif
                @if(!is_null($artist->sub3_name))
                    , {{ $artist->sub3_name }}
                @endif
            </div>
            <div>
                Rankings
                <br>
                All Time Ranking: #1
                <br>
                Charts Ranking: #2
                <br>
                {{ $artist->country_name }} Ranking: #1
                <br>
                {{ $artist->genre_name }} Ranking: #2
                <br>
                @if(!is_null( $artist->sub1_name ))
                    {{ $artist->sub1_name }} Ranking: #3
                @endif
            </div>
        </div>
    </div>
    <ul style="display: none">
        @foreach($songsStatsLists as $po)
            <li>
                @foreach($po as $p)
                        idListaAtual: {{ $p['list_id'] }} /
                        idMusica: {{ $p['song_id'] }} / 
                        maiorPosicao: {{ $p['maiorPosicao'][0]->maiorPosicao }} /
                        noSemanasChart: {{ $p['noSemanasNoChart'][0]->numeroSemanas }}
                        <br><br>                    
                @endforeach
            </li>
        @endforeach
    </ul>
@endsection