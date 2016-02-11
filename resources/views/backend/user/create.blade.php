@extends('backend.layouts.main')

@section('content')
    <h1>Создать нового пользователя</h1>

    {!! Form::open(['route' => ['manager.user.store'] ,'method'=>'post','class' => 'uk-form'])!!}

         <div class="uk-text-left uk-panel uk-panel-box toolbar">
            <button type="submit" class="uk-button uk-button-success">Создать</button>
        </div>
        <div class="uk-form-row ">
            {!! Form::text('username',null,['class'=>'uk-form-width-large','placeholder'=>'Введите имя']) !!}
        </div>
        <div class="uk-form-row">
            {!! Form::email('email',null,['class'=>'uk-form-width-large','placeholder'=>'Введите email']) !!}
        </div>
        <div class="uk-form-row">
            {!! Form::select('roles[]',$roles,null,['multiple'=>'multiple','class'=>'chosen-select']) !!}
        </div>
        <div class="uk-form-row">
            {!! Form::password('password',['class'=>'uk-form-width-large','placeholder'=>'Введите пароль']) !!}
        </div>

    {!! Form::close() !!}



@endsection