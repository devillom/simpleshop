@extends('backend.layouts.main')
@section('title', 'Редактировать: '.$category->name )
@section('content')
    <h1>{{$category->name}}</h1>

    {!! Form::open(['route' => ['manager.shop.category.update',$category->id] ,'method'=>'patch','class' => 'uk-form'])!!}
    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <button type="submit" class="uk-button uk-button-success">Обнавить</button>
    </div>
    <div class="uk-form-row ">
        {!! Form::text('name',$category->name,['class'=>'uk-form-width-large','placeholder'=>'Введите название']) !!}
    </div>
    <div class="uk-form-row">
        {!! Form::textarea('content',$category->content,['class'=>'uk-form-width-large','placeholder'=>'Введите описание']) !!}
    </div>
    <div class="uk-form-row">
        <label >Категория</label>
        {!! Form::select('parent_id',$categories,$category->parent_id) !!}
    </div>


        {!! Form::hidden('id', $category->id) !!}

    {!! Form::close() !!}
@endsection