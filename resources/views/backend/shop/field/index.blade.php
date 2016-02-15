@extends('backend.layouts.main')

@section('content')
    <h1>Параметры категории</h1>

    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <a href="#" class="uk-button uk-button-success" data-uk-modal="{target:'#addFieldModal'}">Добавить</a>

    </div>
    <form action="" class="uk-form ">
        {!! Form::select('category_id',[''=>'Выберите категорию']+$categories,$categoryId,['class'=>'change-category']) !!}
    </form>


@if(!is_null($fields))
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
                    {!! Form::open(['route' => ['manager.shop.field.destroy',$field->id] ,'method'=>'delete'])!!}
                    @if($field->type == 'value_select')
                        <a href="#" class="uk-button uk-button-primary edit-options" data-edit="{{route('manager.shop.category.field.option.form',$field->id)}}" data-uk-modal="{target:'#addFieldOptionsModal'}"><i class="uk-icon-navicon"></i> </a>
                    @endif

                    <a href="#" class="uk-button uk-button-primary edit-field" data-edit="{{route('manager.shop.field.edit',$field->id)}}" data-uk-modal="{target:'#editFieldModal'}"><i class="uk-icon uk-icon-edit"></i> </a>
                    <button type="submit" class="uk-button uk-button-danger"><i class="uk-icon uk-icon-trash"></i>
                    </button>
                    {!! Form::close() !!}
                </td>

            </tr>
        @endforeach
        </tbody>

    </table>

    <div id="addFieldOptionsModal" class="uk-modal">
        <div class="uk-modal-dialog uk-modal-dialog-large">
            <a class="uk-modal-close uk-close"></a>
            <div class="uk-modal-header">Опции</div>
            <div class="inner"></div>
        </div>
    </div>

    <div id="editOptionModal" class="uk-modal">
        <div class="inner"></div>
    </div>
@else
    <h3 class="uk-text-center">Выберите категорию</h3>
@endif

    @include('backend.shop.field.create')
    @include('backend.shop.field.edit')

    @include('backend.shop.field.create-option-field')
@endsection

@section('scripts')
    @parent
    <script>
        $('.change-category').change(function(){
                $(this).parent('form').submit();
         });
            $(document).on('click','.edit-options',function(e){
                $.get($(this).data('edit'),null,function(data){
                        $('#addFieldOptionsModal .inner').html(data);
                })
            });

        $(document).on('click','.edit-option',function(e){
            $.get($(this).data('edit'),null,function(data){
                $('#editOptionModal .inner').html(data);
            })
        });
    </script>

@endsection

