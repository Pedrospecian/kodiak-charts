@extends('layouts.front')

@section('content')
    
<div class="container">
    <div class="content archives-all">
        <h1>Artist Archives</h1>
        <p class="text-center">This is a detailed list featuring all the artists that entered the kodiak charts at least
        once, even if it was for a single week at number 50 as a featured artist. It still counts</p>
        <h2>Sort By</h2>
        <ul class="flex-center">
            <li><a href="/archive/az">Alphabetical (A-Z)</a> / </li>
            <li><a href="/archive/za">Alphabetical (Z-A)</a> / </li>
            <li><a href="/archive/grand50">Songs Quantity (Grand 50)</a> / </li>
            <li><a href="/archive/hot50week">Songs Quantity (Hot 50 Week)</a> / </li>
            <li><a href="/archive/newartists">New Artists</a></li>
        </ul>
    </div>
    <div class="artists-wrapper">
        @foreach($artists as $artist)
            <div class="artist-single">
                <a href="/archive/{{ $artist->artist_id }}">
                    <div class="artist-image" style="background-image: url({{ $artist->image }});"></div>
                    <span class="artist-name">{{ $artist->name }}</span>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
