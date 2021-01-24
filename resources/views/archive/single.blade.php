@extends('layouts.front')

@section('content')
<?php $meses = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']; ?>
<?php $suffix = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'] ?>
<div class="artist-interna">
    <div class="artist-top d-flex">
        <div class="artist-image"><img src="{{ asset($artist->artist_image) }}" class="artist-image"></div>
        <div class="artist-name"><strong>{{ $artist->artist_name }}</strong></div>
        <div class="artist-ranking-info">
            <div class="artist-ranking-block">
                <div class="number"><strong>#2</strong></div>
                Kodiak's all time artists ranking
            </div>
            <div class="artist-ranking-block">
                <div class="number"><strong>#7</strong></div>
                Kodiak Charts artist ranking
            </div>
        </div>
    </div>
    <div class="after-top d-flex">
        <div class="artist-box-single">
            Most successful track in charts
            <strong class="artist-box-name">
                a
            </strong>
        </div>

        <div class="artist-box-single">
            Kodiak's favorite song
            <strong class="artist-box-name">
                a
            </strong>
        </div>

        <div class="artist-box-single">
            Kodiak's favorite album
            <strong class="artist-box-name">
                a
            </strong>
        </div>
    </div>

    <div class="tabs-wrapper d-flex">
        @foreach($lists as $list)
        <a class="tab-single" href="#" data-list-id="{{ $list->list_id}}">{{ $list->name }}</a>
        @endforeach
    </div>
    <div class="tabs-bottom d-flex">
        <div class="tabs-content-wrapper">
            <div class="d-flex tabs-top-info">
                <div><b>0</b> no.1 songs</div>
                <div><b>2</b> top 10 hits</div>
                <div><b>6</b> charting songs</div>
            </div>
            <div>
                <?php $counter = 1; ?>
                @foreach($songs as $song)
                <div class="song-single">
                    <div class="song-top">
                        <div class="song-name"><strong>{{ $song->name }}</strong></div>
                        <div class="song-number"><strong>{{ $counter }}</strong></div>
                    </div>
                    <div class="song-info">
                        <div class="info-left">
                            <strong>
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
                            </strong>
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
                            <strong>
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
                            </strong>
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
            <div class="title-main">{{ $artist->artist_name }}</div>
            <div><strong>Origin:</strong> {{ $artist->country_name }}</div>
            <div><strong>Main Genre:</strong> {{ $artist->genre_name }}</div>
            <div>
                <strong>Subgenre(s):</strong> {{ $artist->sub1_name }}
                @if(!is_null($artist->sub2_name))
                    , {{ $artist->sub2_name }}
                @endif
                @if(!is_null($artist->sub3_name))
                    , {{ $artist->sub3_name }}
                @endif
            </div>
            <div>
                <div class="title-sub">Rankings</div>
                <strong>All Time Ranking:</strong> #1
                <br>
                <strong>Charts Ranking:</strong> #2
                <br>
                <strong>{{ $artist->country_name }} Ranking:</strong> #1
                <br>
                <strong>{{ $artist->genre_name }} Ranking:</strong> #2
                <br>
                @if(!is_null( $artist->sub1_name ))
                    <strong>{{ $artist->sub1_name }} Ranking:</strong> #3
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
</div>
@endsection