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
    <div class="uk-alert uk-alert-success">
        {{Session::get('message')}}
    </div>
@endif

@if(Session::has('error'))
    <div class="uk-alert uk-alert-warning">
        {{Session::get('error')}}
    </div>
@endif