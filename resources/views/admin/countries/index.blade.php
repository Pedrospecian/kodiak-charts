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
            <h1>Países</h1>
            <a href="/admin/paises/new" class="btn">Novo</a>
        </div>
        @if (count($countries) <= 0)
            <div class="not-found">Nenhum registro encontrado</div>
        @else        
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                        <tr><td>{{$country->name}}</td></tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection