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
            <h1>Bem vindo</h1>
        </div>       
        <div class="container">
            <p>Bem-vindo ao Kodiak Charts. Aqui você pode gerenciar as listas, artistas e informações adicionais.</p>            
        </div>
    </div>
@endsection