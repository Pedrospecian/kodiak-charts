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
                        <th>Imagem</th>
                        <th>Artista</th>
                        <th>Estatísticas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 0; ?>
                    @foreach ($positions as $position)
                        <tr>
                            <td>#{{ $position->position }}</td>
                            <td><img src="{{ url($position->artist_image) }}" class="artist-image" alt="{{ $position->artist_name }}"></td>
                            <td>
                                {{ $position->artist_name }}
                            </td>
                            <td>
                                
                            </td>
                        </tr>

                        <?php $index++; ?>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection