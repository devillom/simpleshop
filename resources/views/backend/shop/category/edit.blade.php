@extends('backend.layouts.main')

@section('content')
    <h1>{{$category->name}}</h1>

    {!! Form::open(['route' => ['manager.shop.categories.update',$category->id] ,'method'=>'patch','class' => 'uk-form'])!!}
    <div class="uk-form-row ">
        {!! Form::text('name',$category->name,['class'=>'uk-form-width-large','placeholder'=>'Введите название']) !!}
    </div>
    <div class="uk-form-row">
        {!! Form::textarea('content',$category->content,['class'=>'uk-form-width-large','placeholder'=>'Введите описание']) !!}
    </div>
    <div class="uk-form-row">
        <label >Категория</label>
        {!! Form::select('parent_id',array_merge([''=>'Родительская категория'],$categories),$category->parent_id) !!}
    </div>

    <div class="uk-form-row">
        {!! Form::hidden('id', $category->id) !!}
        <button type="submit" class="uk-button uk-button-success">Обнавить</button>
    </div>
    {!! Form::close() !!}
@endsection