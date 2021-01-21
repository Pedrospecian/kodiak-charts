@extends('layouts.front')

@section('content')
    <div class="title">{{$list->name}}</div>
    <p>{{$list->description}}</p>
    @if(!is_null($emptyMessage))
    	{{ $emptyMessage }}
    @else
        <div class="list-wrapper">
            <?php $index = 0; ?>
            @foreach ($positions as $position)
                <div class="list-element">
                    <div class="list-number">{{ $position->position }}</div>
                    <div class="list-image"><img src="{{ url($position->artist_image) }}" class="artist-image" alt="{{ $position->artist_name }}"></div>
                    <div class="list-text">
                    	<div>
	                    	<div class="song-name">
	                    		<a href="/archive/single/{{ $position->artist_id }}">{{ $position->artist_name }}</a>
	                    	</div>
	                    </div>
                    	<div class="song-stats">
                    		<strong>{{ $stats[1][$index][1]->position }}</strong> last week / 
                    		<strong>{{ $stats[2][$index][0]->numeroSemanas }}</strong> weeks on chart /
                    		<strong>{{ $stats[0][$index][0]->maiorPosicao }}</strong> peak
                    	</div>
                    </div>
                    <div class="list-icon">
                    	@if (count($stats[1][$index]) < 2 )
                            Novo
                        @else
                            @if ($stats[1][$index][0]->position > $stats[1][$index][1]->position)
                                <img src="{{ asset('/images/icon-desceu.png') }}">
                            @else
                                @if ($stats[1][$index][0]->position < $stats[1][$index][1]->position)
                                    <img src="{{ asset('/images/icon-subiu.png') }}">
                                @else
                                    Inalterado
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
                <?php $index++; ?>
            @endforeach

            <div class="list-date">
            	Week of December 22nd, 1993
            </div>
        </div>
    @endif
@endsection
