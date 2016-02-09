<div class="uk-form-row">
    <div id="upload-drop" class="uk-placeholder">
        Загрузить фото <a class="uk-form-file"> <i class="uk-icon-cloud-upload"></i> Выбрать фото<input
                    id="upload-select" multiple type="file"></a>.
    </div>

    <div id="progressbar" class="uk-progress uk-hidden">
        <div class="uk-progress-bar" style="width: 0%;">...</div>
    </div>
</div>
<div id="photos">
    @if(isset($product))
        @foreach($product->photos as $photo)
            <div class="uk-thumbnail">
                <i class="uk-icon-close" data-filename="{{$photo->disk_name}}"></i>
                <img src="{{ Image::url($photo->path,154,154) }}">
                <input type="hidden" name="photos[]" value="{{$photo->id}}">
                <div class="uk-thumbnail-caption">
                    {{$photo->file_name}}
                </div>
            </div>
        @endforeach
    @endif
</div>
@section('scripts')
    @parent
    <script>
        $(function () {
            var token = $('meta[name=_token]').attr('content');
            //Delete Image
            $(document).on('click', '.uk-thumbnail .uk-icon-close', function (e) {
                e.preventDefault();
                var button = $(this);
                $.post('{{route('photo.delete')}}', {
                    filename: $(this).data('filename'),
                    _token: token
                }, function (data, textStatus, xhr) {
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
                            $('#photos').append('<div class="uk-thumbnail"><i class="uk-icon-close" data-filename="' + photo.disk_name + '"></i><img src="uploads/' + photo.disk_name.replace('.', '-image(154x154).') + '"><input type="hidden" name="photos[]" value="' + photo.id + '"><div class="uk-thumbnail-caption">' + photo.file_name + '</div></div>');
                        }
                    };

            var select = UIkit.uploadSelect($("#upload-select"), settings),
                    drop = UIkit.uploadDrop($("#upload-drop"), settings);
        });

    </script>
@endsection