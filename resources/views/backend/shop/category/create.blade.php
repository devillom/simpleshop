@extends('backend.layouts.main')
@section('title', 'Новая категория' )
@section('content')
    <h1>Новая категория</h1>

    {!! Form::open(['route' => ['manager.shop.category.store'] ,'method'=>'post','class' => 'uk-form uk-form-stacked', 'ajax-request'=>'1'])!!}
    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <button type="submit" class="uk-button uk-button-success">Добавить</button>
        <a href="{{route('manager.shop.category.index')}}" class="uk-button uk-button-danger">Закрыть</a>
    </div>
<div class="uk-grid">
    <div class="uk-width-1-2">
        <div class="uk-form-row ">
            <label class="uk-form-label">Название</label>
            {!! Form::text('name',null,['class'=>'uk-form-width-large','placeholder'=>'Введите название']) !!}
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label">Категория</label>
            {!! Form::select('parent_id',$categories,null) !!}
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label">Описание</label>
            {!! Form::textarea('content',null,['class'=>'uk-form-width-large','placeholder'=>'Введите описание']) !!}
        </div>


    </div>
    <div class="uk-width-1-2">
        <div class="uk-form-row">
                @include('backend.shop.widgets.photo-upload')
        </div>

    </div>
</div>



    {!! Form::close() !!}


@endsection