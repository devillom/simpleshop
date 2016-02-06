@extends('backend.layouts.main')

@section('content')

    <h1>{{$user->name}}</h1>
    {!! Form::open(['route' => ['manager.users.update', $user->id] ,'method'=>'put','class' => 'uk-form'])!!}
    <div class="uk-form-row ">
        {!! Form::text('username',$user->name,['class'=>'uk-form-width-large','placeholder'=>'Введите имя']) !!}
    </div>
    <div class="uk-form-row">
        {!! Form::email('email',$user->email,['class'=>'uk-form-width-large','placeholder'=>'Введите email']) !!}
    </div>
    <div class="uk-form-row">
        {!! Form::select('roles[]',$roles,$user->roles->lists('id')->all(),['multiple'=>'multiple']) !!}
    </div>
    <div class="uk-form-row">
        {!! Form::password('password',['class'=>'uk-form-width-large','placeholder'=>'Введите новый пароль']) !!}
    </div>
    <div class="uk-form-row">
        {!! Form::hidden('id', $user->id) !!}
        <button type="submit" class="uk-button uk-button-success">Сохранить</button>
    </div>
    {!! Form::close() !!}

@endsection