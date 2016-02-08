@extends('backend.layouts.main')
@section('title', 'Редактировать: '.$product->name )

@section('content')
    <h1>Редактировать: {{$product->name}}</h1>

    {!! Form::open(['route' => ['manager.shop.product.update',$product->id] ,'method'=>'patch','class' => 'uk-form uk-form-stacked'])!!}
    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <button type="submit" class="uk-button uk-button-success">Сохранить</button>
    </div>
    <ul class="uk-tab" data-uk-tab="{connect:'#my-tab'}">
        <li><a href="">Основная информация</a></li>
        <li><a href="">Дополнительные поля</a></li>
    </ul>
    <ul id="my-tab" class="uk-switcher uk-margin">
        <li>
            <div class="uk-grid">
                <div class="uk-width-1-2">
                    <div class="uk-form-row ">
                        <label class="uk-form-label">Название</label>
                        {!! Form::text('name',$product->name,['class'=>'uk-form-width-large','placeholder'=>'Введите название']) !!}
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label">Категория</label>
                        {!! Form::select('category_id',$categories,$product->categories()->lists('id')->toArray(),['id'=>'category']) !!}
                    </div>
                    <div class="uk-form-row">
                        {!! Form::hidden('active',0) !!}
                        <label> {!! Form::checkbox('active',1, $product->active) !!} Опубликовать</label>
                    </div>
                    <div class="uk-form-row ">
                        <label class="uk-form-label">Цена</label>
                        {!! Form::text('price',$product->price,['class'=>'uk-form-width-large','placeholder'=>'Введите цену']) !!}
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label">Описание</label>
                        {!! Form::textarea('content',$product->content,['class'=>'uk-form-width-large','placeholder'=>'Введите описание']) !!}
                    </div>

                </div>
                <div class="uk-width-1-2">
                    @include('backend.shop.widgets.photo-upload')
                </div>
            </div>
        </li>
        <li>
            <div class="uk-form-row" id="fields">
                @include('backend.shop.field.types',['fields'=>$product->fields,'productId'=>$product->id])
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">Выбрать поле</label>
                @if(isset($fields))
                    {!! Form::select('fields[]', $fields, null, ['multiple'=>'multiple','class'=>'chosen-select'] ) !!}
                @endif
            </div>

            <div class="uk-form-row">
                <button type="button" class="uk-button uk-button-primary" data-uk-modal="{target:'#addFieldModal'}">
                    Добавить новое поле
                </button>
            </div>

        </li>
    </ul>

    {!! Form::close() !!}
    @include('backend.shop.field.create')
@endsection

@section('scripts')
    @parent
    <script>
        $('#category').on('change', function () {
            $.get('{{route('category.fields')}}', {
                category_id: $(this).val(),
                product_id:{{$product->id}} }, function (data) {
                $('#fields').html(data);
            });
        });
    </script>
@endsection