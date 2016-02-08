@extends('backend.layouts.main')

@section('content')

    <h1>{{$user->name}}</h1>
    {!! Form::open(['route' => ['manager.user.update', $user->id] ,'method'=>'patch','class' => 'uk-form'])!!}

    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <button type="submit" class="uk-button uk-button-success">Сохранить</button>
    </div>
    <div class="uk-form-row ">
        {!! Form::text('username',$user->name,['class'=>'uk-form-width-large','placeholder'=>'Введите имя']) !!}
    </div>
    <div class="uk-form-row">
        {!! Form::email('email',$user->email,['class'=>'uk-form-width-large','placeholder'=>'Введите email']) !!}
    </div>
    <div class="uk-form-row">
        {!! Form::select('roles[]',$roles,$user->roles->lists('id')->toArray(),['multiple'=>'multiple']) !!}
    </div>
    <div class="uk-form-row">
        {!! Form::password('password',['class'=>'uk-form-width-large','placeholder'=>'Введите новый пароль']) !!}
    </div>
    {!! Form::hidden('id', $user->id) !!}

    {!! Form::close() !!}

@endsection