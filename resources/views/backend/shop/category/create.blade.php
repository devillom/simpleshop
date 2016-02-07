@extends('backend.layouts.main')

@section('content')
    <h1>Новая категория</h1>

    {!! Form::open(['route' => ['manager.shop.categories.store'] ,'method'=>'post','class' => 'uk-form'])!!}
    <div class="uk-form-row ">
        {!! Form::text('name',null,['class'=>'uk-form-width-large','placeholder'=>'Введите название']) !!}
    </div>
    <div class="uk-form-row">
        {!! Form::textarea('content',null,['class'=>'uk-form-width-large','placeholder'=>'Введите описание']) !!}
    </div>
    <div class="uk-form-row">
        <label >Категория</label>
        {!! Form::select('parent_id',array_merge([''=>'Родительская категория'],$categories),null) !!}
    </div>

    <div class="uk-form-row">
        <button type="submit" class="uk-button uk-button-success">Создать</button>
    </div>
    {!! Form::close() !!}
@endsection