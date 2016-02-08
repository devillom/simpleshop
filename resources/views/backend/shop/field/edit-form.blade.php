<div class="uk-modal-dialog">
    <a class="uk-modal-close uk-close"></a>
    <div class="uk-modal-header">Изменить поле</div>
    {!! Form::open(['route' => ['field.update',$field->id] ,'method'=>'post','class' => 'uk-form uk-form-stacked'])!!}
    <div class="uk-form-row">
        <label class="uk-form-label">Название</label>
        {!! Form::text('name',$field->name,['class'=>'uk-width-1-1']) !!}
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label">Тип ввода</label>
        {!! Form::select('type',[
        'value_str' => 'Строка',
        'value_int' => 'Число',
        'value_text' => 'Текст',
        'value_dt' => 'Выбор даты',
        ],$field->type,['class'=>'uk-width-1-1'])  !!}
    </div>
    <div class="uk-form-row">
        <label class="uk-form-label">Описание</label>
        {!! Form::textarea('content',$field->content,['class'=>'uk-width-1-1']) !!}
    </div>
    <div class="uk-modal-footer">
        <button class="uk-button uk-button-primary">Сохранить</button>
    </div>
    {!! Form::close() !!}
</div>

@section('scripts')
<script>
    var modal = new UIkit.modal("#addFieldModal");

    $('#editFieldModal form').on('submit',function(event){
        event.preventDefault();
        $.post('{{route('field.update',$field->id)}}', $(this).serialize(),function(data) {

            if(data.status == 'ok') {
                toastr.success('Характеристика изменена','Сообщение системы');
                $('select[name="fields[]"]').append('<option value="'+data.field.id+'">'+data.field.name+'</option>');
                modal.hide();
            }
        }).fail(function(data){
            var errors = data.responseJSON;

            var errorsHtml = '<ul>';

            $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
            });
            errorsHtml += '</ul>';

            toastr.error(errorsHtml,'Сообщение системы');
        })
    })
</script>
@endsection