@extends('backend.layouts.main')
@section('title', 'Новый товар')

@section('content')
    <h1>Новый товар</h1>

    {!! Form::open(['route' => ['manager.shop.product.store'] ,'method'=>'post','class' => 'uk-form uk-form-stacked'])!!}
    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <button type="submit" class="uk-button uk-button-success">Добавить</button>
        <a href="{{route('manager.shop.product.index')}}" class="uk-button uk-button-danger">Закрыть</a>
    </div>

    <ul class="uk-tab" data-uk-tab="{connect:'#my-tab'}">
        <li><a href="">Основная информация</a></li>
        <li><a href="">Параметры категорий</a></li>
    </ul>
    <ul id="my-tab" class="uk-switcher uk-margin">
        <li>
            <div class="uk-grid">
                <div class="uk-width-1-2">
                    <div class="uk-form-row ">
                        <label class="uk-form-label">Название</label>
                        {!! Form::text('name',null,['class'=>'uk-form-width-large','placeholder'=>'Введите название']) !!}
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label">Категория</label>
                        {!! Form::select('category_id',$categories,null,['id'=>'category']) !!}
                    </div>
                    <div class="uk-form-row">
                        <label>
                            {!! Form::checkbox('active','1',true) !!}
                            Опубликовать</label>
                    </div>
                    <div class="uk-form-row ">
                        <label class="uk-form-label">Цена</label>
                        {!! Form::text('price',null,['class'=>'uk-form-width-large','placeholder'=>'Введите цену']) !!}
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label">Описание</label>
                        {!! Form::textarea('content',null,['class'=>'uk-form-width-large','placeholder'=>'Введите описание']) !!}
                    </div>


                </div>

                <div class="uk-width-1-2">
                    @include('backend.shop.widgets.photo-upload')
                </div>
            </div>
        </li>
        <li>
            <div class="uk-form-row" id="fields">
            </div>
            {{--<div class="uk-form-row">--}}
                {{--<label class="uk-form-label">Выбрать поле</label>--}}
                {{--@if(isset($fields))--}}
                    {{--{!! Form::select('fields[]', $fields, null, ['multiple'=>'multiple','class'=>'chosen-select'] ) !!}--}}
                {{--@endif--}}
            {{--</div>--}}

        </li>
        {!! Form::close() !!}

        @endsection

@section('scripts')
            @parent
            <script>
                $('#category').on('change', function () {
                    $.get('{{route('manager.shop.category.fields')}}', {category_id: $(this).val()}, function (data) {
                        $('#fields').html(data);
                    });
                });

                $(document).on('change','.select-list', function(){
                    var f_id = $(this).data('id');
                    var select = $(this);
                    $.get('{{route('manager.shop.category.option.fields')}}', {
                        'option_id' : select.val()
                    }, function (data) {
                        $('#fields-'+f_id).html(data);
                    });
                });
            </script>
@endsection

