<div class="uk-modal-dialog">
    <a class="uk-modal-close uk-close"></a>
    <div class="uk-modal-header">Изменить опцию</div>
    {!! Form::open(['route' => ['manager.shop.category.field.option.update',$option->id] ,'method'=>'patch','class' => 'uk-form uk-form-stacked'])!!}
    <div class="uk-form-row">
        <label class="uk-form-label">Название</label>
        {!! Form::text('name',$option->name,['class'=>'uk-width-1-1']) !!}
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label">Описание</label>
        {!! Form::textarea('content',$option->content,['class'=>'uk-width-1-1']) !!}
    </div>
    <div class="uk-modal-footer">
        <button class="uk-button uk-button-primary">Сохранить</button>
    </div>
    {!! Form::close() !!}
</div>