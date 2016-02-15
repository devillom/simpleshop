@if(isset($_GET['category_id']))
    <div id="addOptionFieldModal" class="uk-modal">
        <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close"></a>
            <div class="uk-modal-header">Добавить зависимое поле</div>
            {!! Form::open(['route' => ['manager.shop.field.store.option.field'] ,'method'=>'post','class' => 'uk-form uk-form-stacked'])!!}
            <div class="uk-form-row">
                <label class="uk-form-label">Название</label>
                {!! Form::text('name',null,['class'=>'uk-width-1-1']) !!}
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
                {!! Form::hidden('category_id',$_GET['category_id']) !!}
                {!! Form::hidden('is_sub',true) !!}
                <button class="uk-button uk-button-primary">Сохранить</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@section('scripts')
    @parent
    <script>
        var addOptionFieldModal = new UIkit.modal("#addOptionFieldModal");

        $('#addOptionFieldModal form').on('submit', function (event) {
            event.preventDefault();
            $.post('{{route('manager.shop.field.store.option.field')}}', $(this).serialize(), function (data) {

                if (data.status == 'ok') {
                    toastr.success('Зависимыое поле добавлена', 'Сообщение системы');
                    addOptionFieldModal.hide();

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
@endif