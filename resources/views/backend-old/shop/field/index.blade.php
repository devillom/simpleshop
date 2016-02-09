@extends('backend.layouts.main')

@section('content')
    <h1>Дополнительные поля</h1>

    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <a href="#" class="uk-button uk-button-success" data-uk-modal="{target:'#addFieldModal'}">Добавить</a>
    </div>



    <table class="uk-table uk-table-hover uk-table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th></th>
            <th class="uk-text-right">Действие</th>
        </tr>
        <tbody>
        @foreach($fields as $field)
            <tr data-id="{{$field->id}}">
                <td>{{$field->id}}</td>
                <td class="name">{{$field->name}}</td>
                <td>
                <td class="uk-text-right">

                    {!! Form::open(['route' => ['field.destroy',$field->id] ,'method'=>'delete'])!!}
                    <a href="#" class="uk-button uk-button-primary edit-field" data-edit="{{route('field.edit',$field->id)}}" data-uk-modal="{target:'#editFieldModal'}"><i class="uk-icon uk-icon-edit"></i> </a>
                    <button type="submit" class="uk-button uk-button-danger"><i class="uk-icon uk-icon-trash"></i>
                    </button>
                    {!! Form::close() !!}
                </td>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    @include('backend.shop.field.create')
    @include('backend.shop.field.edit')
@endsection

