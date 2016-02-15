<div id="addFieldModal" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <div class="uk-modal-header">Добавить новое поле</div>
        {!! Form::open(['route' => ['manager.shop.field.store'] ,'method'=>'post','class' => 'uk-form uk-form-stacked'])!!}
        <div class="uk-form-row">
            <label class="uk-form-label">Название</label>
            {!! Form::text('name',null,['class'=>'uk-width-1-1']) !!}
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label">Категория</label>
            {!! Form::select('category_id',$categories,$categoryId,['class'=>'uk-width-1-1'])  !!}
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label">Тип ввода</label>

            {!! Form::select('type',[
                'value_str' => 'Строка',
                'value_int' => 'Число',
                'value_text' => 'Текст',
                'value_dt' => 'Выбор даты',
                'value_select' => 'Список',
            ],null,['class'=>'uk-width-1-1'])  !!}
        </div>
        <div class="uk-form-row">
            <label class="uk-form-label">Описание</label>
            {!! Form::textarea('content',null,['class'=>'uk-width-1-1']) !!}
        </div>
        <div class="uk-modal-footer">
            <button class="uk-button uk-button-primary">Сохранить</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@section('scripts')
    @parent
    <script>
        var modal = new UIkit.modal("#addFieldModal");

        $('#addFieldModal form').on('submit', function (event) {
            event.preventDefault();
            $.post('{{route('manager.shop.field.store')}}', $(this).serialize(), function (data) {

                if (data.status == 'ok') {
                    toastr.success('Характеристика добавлена', 'Сообщение системы');
                    if ($('select[name="fields[]"]').length > 0) {
                        $('select[name="fields[]"]').append('<option value="' + data.field.id + '">' + data.field.name + '</option>');
                        $(".chosen-select").trigger("chosen:updated");
                    }
                    modal.hide();
                    @if(Route::currentRouteName() == 'manager.shop.field.index')
                        $.get('{{route('manager.shop.field.index')}}?category_id={{$categoryId}}', null, function (data) {
                        $('.uk-table').html($(data).find('.uk-table').html())
                    });
                    @endif


                }
            }).fail(function (data) {
                var errors = data.responseJSON;

                var errorsHtml = '<ul>';

                $.each(errors, function (key, value) {
                    errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                });
                errorsHtml += '</ul>';

                toastr.error(errorsHtml, 'Сообщение системы');
            })
        })
    </script>
@endsection