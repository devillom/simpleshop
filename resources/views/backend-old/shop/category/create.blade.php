@extends('backend.layouts.main')
@section('title', 'Новая категория' )
@section('content')
    <h1>Новая категория</h1>

    {!! Form::open(['route' => ['manager.shop.category.store'] ,'method'=>'post','class' => 'uk-form uk-form-stacked', 'ajax-request'=>'1'])!!}
    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <button type="submit" class="uk-button uk-button-success">Добавить</button>
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
           <label class="uk-form-label">Характеристики</label>
           {!! Form::select('fields[]',$fields,null,['multiple'=>'multiple','class'=>'uk-width-1-1 chosen-select']) !!}

        </div>
        <div class="uk-form-row">
            <button type="button" class="uk-button uk-button-primary" data-uk-modal="{target:'#addFieldModal'}">Добавить новое поле</button>
        </div>
    </div>
</div>



    {!! Form::close() !!}

    @include('backend.shop.field.create')
@endsection