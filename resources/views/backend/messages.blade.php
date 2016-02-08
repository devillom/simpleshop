@if (count($errors) > 0)

    @section('scripts')
        @parent
        <div class="uk-hidden" id="alert-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            var messages = $('#alert-message').html();
            toastr.error(messages,'Сообщение системы');

        </script>
    @endsection
@endif

@if(Session::has('message'))
    @section('scripts')
        @parent
        <script>
            toastr.success('{{Session::get('message')}}','Сообщение системы');
        </script>
    @endsection
@endif


@if(Session::has('error'))
    @section('scripts')
        @parent
        <script>
            toastr.error('{{Session::get('error')}}','Сообщение системы');
        </script>
    @endsection
@endif