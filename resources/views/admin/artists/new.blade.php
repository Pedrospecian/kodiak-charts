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
            <h1>
                @if (isset($artist))
                    Editar artista
                @else
                    Novo artista
                @endif
            </h1>
        </div>
        <form action="
            @if(isset($artist))
                /admin/artistas/{{$artist->artist_id}}/update
            @else
                /admin/artistas/insert
            @endif" method="post" class="form-standard" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                @if (isset($artist))
                    <input type="hidden" name="id" value="{{$artist->artist_id}}">
                @endif
                <div class="field-wrapper w-30">
                    <label for="name">Nome*</label>
                    <input type="text" name="name" id="name" required @if(isset($artist)) value="{{$artist->name}}" @endif>
                </div>
                <div class="field-wrapper w-30">
                    <label for="country">País*</label>
                    <select name="country" id="country" required>
                        <option value="">Selecione</option>
                        @foreach($countries as $country)
                            <option value="{{$country->country_id}}" @if(isset($artist) && $artist->country_id == $country->country_id) selected="selected" @endif>{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group row">
                <div class="field-wrapper w-30">
                    <label for="genre">Gênero*</label>
                    <select name="genre" id="genre" required>
                        <option value="">Selecione</option>
                        @foreach($genres as $genre)
                            <option value="{{$genre->genre_id}}" @if(isset($artist) && $artist->genre_id == $genre->genre_id) selected="selected" @endif>{{$genre->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group row">
                <div class="field-wrapper w-30">
                    <label>Subgêneros</label>
                    <select name="subgenre1" id="subgenre1">
                        <option value="">Selecione</option>
                        @foreach($subgenres as $subgenre)
                            <option value="{{$subgenre->subgenre_id}}" @if(isset($artist) && $artist->subgenre_id_1 == $subgenre->subgenre_id) selected="selected" @endif>{{$subgenre->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-wrapper w-30">
                    <label>.</label>
                    <select name="subgenre2" id="subgenre2">
                        <option value="">Selecione</option>
                        @foreach($subgenres as $subgenre)
                            <option value="{{$subgenre->subgenre_id}}" @if(isset($artist) && $artist->subgenre_id_2 == $subgenre->subgenre_id) selected="selected" @endif>{{$subgenre->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field-wrapper w-30">
                    <label>.</label>
                    <select name="subgenre3" id="subgenre3">
                        <option value="">Selecione</option>
                        @foreach($subgenres as $subgenre)
                            <option value="{{$subgenre->subgenre_id}}" @if(isset($artist) && $artist->subgenre_id_3 == $subgenre->subgenre_id) selected="selected" @endif>{{$subgenre->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group row">
                <div class="field-wrapper w-90">
                    <label for="name">@if(isset($artist) && $artist->image !== '') Alterar imagem @else Imagem @endif</label>
                    @if(isset($artist) && $artist->image !== '')
                    <div class="row js-current-img-wrapper">
                        <input type="hidden" name="imageUrl" value="{{$artist->image}}" />
                        <div class="w-30"><img src="{{url($artist->image)}}" alt="{{$artist->name}}" class="image-full"></div>
                        <div class="w-70"><a href="" class="js-delete-image btn btn-danger">Excluir imagem</a></div>
                        <div class="clearfix"></div>
                    </div>
                    @endif
                    <input type="file" name="image" id="image" class="js-image-field" @if(isset($artist) && $artist->image !== '') style="display: none;" @endif>
                    @if(isset($artist))
                        <input type="hidden" name="oldImage" value="{{$artist->image}}">
                    @endif
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-bottom text-right">
                <div class="field-wrapper">
                    <button class="btn btn-primary">
                        @if (isset($artist))
                            Alterar
                        @else
                            Criar
                        @endif
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.getElementsByClassName('js-delete-image')[0].addEventListener('click', function(e) {
            e.preventDefault();
            var r = confirm('Deseja excluir a imagem atual?');
            if (r) {
                var el = document.getElementsByClassName('js-current-img-wrapper')[0];
                el.parentNode.removeChild(el);
                document.getElementsByClassName('js-image-field')[0].style.display = 'block';
                document.querySelector('input[name="artist-image"}')[0].value = '';
            }
        });
    </script>
@endsection