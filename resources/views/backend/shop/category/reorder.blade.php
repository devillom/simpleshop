@extends('backend.layouts.main')
@section('title', 'Сортировка категории' )
@section('content')
<h1>Сортировка категории</h1>

<div class="uk-text-left uk-panel uk-panel-box toolbar">
    <a href="{{route('manager.shop.category.create')}}" class="uk-button uk-button-success">Создать</a>
    <a href="{{route('manager.shop.category.index')}}" class="uk-button uk-button-danger">Закрыть</a>
</div>

<!-- This is the nav containing the toggling elements -->
    <ul class="uk-tab">
        <li><a href="{{route('manager.shop.category.index')}}">Список</a></li>
        <li  class="uk-active"><a href="{{route('manager.shop.category.reorder')}}">Сортировка</a></li>
    </ul>
<br>
<div class="nestable-list">
    <ul class="uk-nestable" data-uk-nestable="">
        @foreach($tree as $node)
            {!!  renderSortableNode($node) !!}
        @endforeach
    </ul>
</div>

@endsection

@section('scripts')

<script>
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });

    var nestable = UIkit.nestable('.nestable-list ul[data-uk-nestable]');
    nestable.on('stop.uk.nestable',function(event, nestable){
        $.post('{{route('manager.shop.category.reorder.action')}}',{data:JSON.stringify(nestable.serialize())});
    });

</script>
@endsection