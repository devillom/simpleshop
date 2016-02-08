@extends('backend.layouts.main')
@section('title', 'Новая категория' )
@section('content')
    <h1>Новая категория</h1>

    {!! Form::open(['route' => ['manager.shop.category.store'] ,'method'=>'post','class' => 'uk-form'])!!}
    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <button type="submit" class="uk-button uk-button-success">Добавить</button>
    </div>

    <div class="uk-form-row ">
        {!! Form::text('name',null,['class'=>'uk-form-width-large','placeholder'=>'Введите название']) !!}
    </div>

    <div class="uk-form-row">
        {!! Form::textarea('content',null,['class'=>'uk-form-width-large','placeholder'=>'Введите описание']) !!}
    </div>
    <div class="uk-form-row">
        <label >Категория</label>
        {!! Form::select('parent_id',$categories,null) !!}
    </div>

    {!! Form::close() !!}
@endsection