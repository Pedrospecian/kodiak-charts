@extends('layouts.front')

@section('content')
    
<div class="container">
    <div class="content archives-all">
        <h1>Artist Archives Search</h1>
        <p class="text-center">Showing {{ $artists->count() }} results for "{{ $term }}"</p>
        <h2>Sort By</h2>
        <ul class="flex-center">
            <li><a href="/search/az/?search={{ $term }}">Alphabetical (A-Z)</a> / </li>
            <li><a href="/search/za/?search={{ $term }}">Alphabetical (Z-A)</a> / </li>
            <li><a href="/search/grand50/?search={{ $term }}">Songs Quantity (Grand 50)</a> / </li>
            <li><a href="/search/hot50week/?search={{ $term }}">Songs Quantity (Hot 50 Week)</a> / </li>
            <li><a href="/search/newartists/?search={{ $term }}">New Artists</a></li>
        </ul>
    </div>
    <div class="artists-wrapper">
        @foreach($artists as $artist)
            <div class="artist-single">
                <a href="/archive/single/{{ $artist->artist_id }}">
                    <div class="artist-image" style="background-image: url({{ $artist->image }});"></div>
                    <span class="artist-name">{{ $artist->name }}</span>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
