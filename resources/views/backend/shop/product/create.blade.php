@extends('backend.layouts.main')
@section('title', 'Новый товар')

@section('content')
    <h1>Новый товар</h1>

    {!! Form::open(['route' => ['manager.shop.product.store'] ,'method'=>'post','class' => 'uk-form'])!!}
    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <button type="submit" class="uk-button uk-button-success">Добавить</button>
    </div>

    <div class="uk-grid">
        <div class="uk-width-1-2">
            <div class="uk-form-row ">
                {!! Form::text('name',null,['class'=>'uk-form-width-large','placeholder'=>'Введите название']) !!}
            </div>
            <div class="uk-form-row">
                <label>
                    {!! Form::checkbox('active','1',true) !!}
                    Опубликовать</label>
            </div>
            <div class="uk-form-row ">
                {!! Form::text('price',null,['class'=>'uk-form-width-large','placeholder'=>'Введите цену']) !!}
            </div>
            <div class="uk-form-row">
                {!! Form::textarea('content',null,['class'=>'uk-form-width-large','placeholder'=>'Введите описание']) !!}
            </div>
            <div class="uk-form-row">
                <label>Категория</label>
                {!! Form::select('category_id',$categories,null) !!}
            </div>


        </div>

        <div class="uk-width-1-2">
            <div class="uk-form-row">
                <div id="upload-drop" class="uk-placeholder">
                    Загрузить фото <a class="uk-form-file"> <i class="uk-icon-cloud-upload"></i> Выбрать фото<input
                                id="upload-select" multiple type="file"></a>.
                </div>

                <div id="progressbar" class="uk-progress uk-hidden">
                    <div class="uk-progress-bar" style="width: 0%;">...</div>
                </div>
            </div>
            <div id="photos"></div>
        </div>
    </div>

    {!! Form::close() !!}
@endsection

@section('scripts')
    <script>
        $(function () {
            var token = $('meta[name=_token]').attr('content');
            //Delete Image
            $(document).on('click', '.uk-thumbnail .uk-icon-close', function (e) {
                e.preventDefault();
                var button = $(this);
                $.post('{{route('photo.delete')}}', {filename: $(this).data('filename'), _token: token}, function(data, textStatus, xhr)  {
                    button.parents('.uk-thumbnail').remove();
                });
            });

            var progressbar = $("#progressbar"),
                    bar = progressbar.find('.uk-progress-bar'),
                    settings = {

                        action: '{{route('photo.upload')}}', // upload url
                        allow: '*.(jpg|jpeg|gif|png)', // allow only images
                        beforeSend: function (xhr) {

                            xhr.setRequestHeader("X-CSRF-Token", token);
                        },
                        loadstart: function () {
                            bar.css("width", "0%").text("0%");
                            progressbar.removeClass("uk-hidden");
                        },

                        progress: function (percent) {
                            percent = Math.ceil(percent);
                            bar.css("width", percent + "%").text(percent + "%");
                        },

                        allcomplete: function (response) {

                            bar.css("width", "100%").text("100%");

                            setTimeout(function () {
                                progressbar.addClass("uk-hidden");
                            }, 250);

                        },
                        complete: function (responce) {
                            var photo = $.parseJSON(responce);
                            $('#photos').append('<div class="uk-thumbnail"><i class="uk-icon-close" data-filename="'+photo.disk_name+'"></i><img src="uploads/' + photo.disk_name.replace('.', '-image(154x154).') + '"><input type="hidden" name="photos[]" value="' + photo.id + '"><div class="uk-thumbnail-caption">' + photo.file_name + '</div></div>');
                        }
                    };

            var select = UIkit.uploadSelect($("#upload-select"), settings),
                    drop = UIkit.uploadDrop($("#upload-drop"), settings);
        });

    </script>
@endsection