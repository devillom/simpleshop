<div id="editFieldModal" class="uk-modal">

</div>

@section('scripts')
    @parent
    <script>
        $(document).on('click','.edit-field', function () {
            $.get($(this).data('edit'), null, function (data) {
                $('#editFieldModal').html(data);
            });

        });

        var editModal = new UIkit.modal("#editFieldModal");

        $(document).on('submit', '#editFieldModal form', function (event) {
            event.preventDefault();
            $.post($(this).attr('action'), $(this).serialize(), function (data) {

                if (data.status == 'ok') {
                    toastr.success('Характеристика изменена', 'Сообщение системы');
                    if ($('select[name="fields[]"]').length > 0) {
                        $('select[name="fields[]"]').append('<option value="' + data.field.id + '">' + data.field.name + '</option>');
                    }
                    if ($('[data-id="' + data.field.id + '"]').length > 0) {
                        $('[data-id="' + data.field.id + '"]').find('.name').text(data.field.name);
                    }

                    editModal.hide();
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