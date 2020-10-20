@extends('layouts.admin')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div>
        <div class="top-section">
            <h1>Novo registro de lista</h1>
        </div>
        <form action="/admin/listas/insertEntry" method="post" class="form-standard js-new-entry">
            @csrf
            <div class="form-group row">
                <div class="field-wrapper w-30">
                    <input type="hidden" name="listid" value="{{ $list->list_id }}">
                    <input type="hidden" name="listpositions" value="{{ $list->positions }}">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="field-wrapper w-40">
                    <input type="hidden" name="listid" value="{{ $list->list_id }}">
                    <label for="description">Descrição</label>
                    <input type="text" name="description" id="description">
                </div>
                <div class="field-wrapper w-30">
                    <input type="hidden" name="listid" value="{{ $list->list_id }}">
                    <label for="date">Data</label>
                    <input type="date" name="date" id="date" required>
                </div>
                <div class="field-wrapper w-100">
                    <label for="type">Posições</label>
                    <div class="positions-wrapper">
                        @for($i=0; $i<$list->positions; $i++)
                        <div class="position-single w-100">
                            <div class="position-number w-10">#{{ $i + 1}}</div>
                            <div class="w-40">                                
                                <div class="w-50">
                                    <select name="songname[]" id="songname_{{$i}}" class="js-select2 js-song-already">
                                        <option value="">Nome (Música já existente)</option>
                                        @foreach($songs as $song)
                                            <option value="{{ $song->song_id }}">{{ $song->songname }} ({{ $song->artistname }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-50">
                                    <input type="text" name="songname_new[]" placeholder="Nome (nova música)" class="input-name-song-new js-newsong" required>
                                </div>
                            </div>
                            <div class="w-30 js-newsong">
                                <select name="songartist_main[]" id="songartist_{{$i}}" class="js-select2 " required>
                                    <option value="">Artista (nova música)</option>
                                    @foreach($artists as $artist)
                                    <option value="{{ $artist->artist_id }}">{{ $artist->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-20">
                                <div class="field-wrapper">
                                    <select name="songartist_feat_{{$i}}[]" id="songartist_feat_{{$i}}" class="js-select2 input-feat-{{ $i }} js-tags" multiple="multiple">
                                        <option value="">Artista (nova música)</option>
                                        @foreach($artists as $artist)
                                        <option value="{{ $artist->artist_id }}">{{ $artist->name }}</option>
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" name="song_feat[]" class="input-feat-{{ $i }}" /><!--data-role="tagsinput" />-->
                                    <!-- <button class="btn btn-info js-btn-feat" data-index="{{ $i }}">Feat.</button> -->
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>            
            <div class="form-bottom text-right">
                <div class="field-wrapper">
                    <button class="btn btn-primary">Criar</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('customscript')
<script type="text/javascript">
    $(".js-tags").select2({
      tags: true
    });

    /*$('.js-new-entry').on('submit', function() {
        $('.js-tags').each(function(i, e) {
            $(e).val($(e).val().join());
        });
    });*/
    /*var cities = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: ''
    });
    cities.initialize();
    //$('.input-feat').css('color','turquoise');
    $('.input-feat-1').tagsinput({
      itemValue: 'value',
      itemText: 'text',
      typeaheadjs: {
        name: 'artists',
        displayKey: 'text',
        source: cities.ttAdapter()
      }
    });

    <?php //foreach($artists as $artist){

    //echo "$('.input-feat-1').tagsinput('add', { 'value': ".$artist->artist_id." , 'text': '".$artist->name."'});";

    //} ?>
    /*$('.input-feat-1').tagsinput('add', { "value": 2 , "text": "alfafa"});
    $('.input-feat-1').tagsinput('add', { "value": 3 , "text": "betta"});*/

    /*console.log($(".input-feat-1").tagsinput('items'));*/
    /*setInterval(function() {
        $('.js-tags').each(function(i, e) {
            console.log($(e).val());
        });
    }, 2000);*/
</script>
@endsection