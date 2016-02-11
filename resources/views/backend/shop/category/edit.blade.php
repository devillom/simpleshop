@extends('backend.layouts.main')
@section('title', 'Редактировать: '.$category->name )
@section('content')
    <h1>{{$category->name}}</h1>

    {!! Form::open(['route' => ['manager.shop.category.update',$category->id] ,'method'=>'patch','class' => 'uk-form uk-form-stacked'])!!}
    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <button type="submit" class="uk-button uk-button-success">Обнавить</button>
        <a href="{{route('manager.shop.category.index')}}" class="uk-button uk-button-danger">Закрыть</a>
    </div>
    <div class="uk-grid">
        <div class="uk-width-1-2">

            <div class="uk-form-row ">
                <label class="uk-form-label">Название</label>
                {!! Form::text('name',$category->name,['class'=>'uk-form-width-large','placeholder'=>'Введите название']) !!}
            </div>

            <div class="uk-form-row">
                <label  class="uk-form-label" >Категория</label>
                {!! Form::select('parent_id',$categories,$category->parent_id) !!}
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">Описание</label>
                {!! Form::textarea('content',$category->content,['class'=>'uk-form-width-large','placeholder'=>'Введите описание']) !!}
            </div>
        </div>

        <div class="uk-width-1-2">
            @include('backend.shop.widgets.photo-upload',['photos'=>$category->photos])
        </div>
    </div>


    {!! Form::hidden('id', $category->id) !!}

    {!! Form::close() !!}


@endsection