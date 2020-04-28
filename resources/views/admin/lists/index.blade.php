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
            <h1>Listas (em construção)</h1>
            <a href="#" class="btn">Novo</a>
        </div>
        @if (count($lists) <= 0)
            <div class="not-found">Nenhum registro encontrado</div>
        @else        
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lists as $list)
                        <tr><td>{{$list->name}}</td></tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection