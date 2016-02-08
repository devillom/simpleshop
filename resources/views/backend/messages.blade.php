@if (count($errors) > 0)
    <div class="uk-alert uk-alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('message'))
    @section('scripts')
        <script>
            toastr.success('{{Session::get('message')}}','Сообщение системы');
        </script>
    @endsection
@endif


@if(Session::has('error'))
    @section('scripts')
        <script>
            toastr.error('{{Session::get('error')}}','Сообщение системы');
        </script>
    @endsection
@endif