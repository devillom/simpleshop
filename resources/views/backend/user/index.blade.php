@extends('backend.layouts.main')

@section('content')
    <h1>Пользователи</h1>

    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <a class="uk-button uk-button-success" href="{{route('manager.user.create')}}">Создать</a>
    </div>

    {{--{{$users}}--}}
    <table class="uk-table uk-table-hover uk-table-striped">
      <thead>
          <tr>
              <th>ID</th>
              <th>Имя</th>
              <th>Email</th>
              <th>Роли</th>
              <th>Дата регистрации</th>
              <th class="uk-text-right">Действие</th>
              <th class="uk-text-right">Заблокировать</th>

          </tr>
      </thead>
        <tbody>
        @foreach( $users as $user )
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @foreach($user->roles as $role)
                        <span class="uk-badge uk-badge-success">{{$role->name}}</span>
                    @endforeach
                </td>
                <td>{{$user->created_at}}</td>
                <td class="uk-text-right">

                    {!! Form::open(['route' => ['manager.user.destroy',$user->id] ,'method'=>'delete'])!!}
                    <a href="{{ route('manager.user.edit', ['user' => $user->id])}}" class="uk-button uk-button-primary">
                        <i class="uk-icon uk-icon-edit"></i> </a>
                    <button type="submit" class="uk-button uk-button-danger"><i class="uk-icon uk-icon-trash"></i> </button>
                    {!! Form::close() !!}

                </td>
                <td class="uk-text-right">
                    @if (!$user->is_banned)
                        {!! Form::open(['route' => ['manager.user.ban',$user->id] ,'method'=>'post'])!!}
                        <button type="submit" class="uk-button uk-button-danger"><i class="uk-icon uk-icon-ban"></i> Забанить</button>
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['manager.user.unban',$user->id] ,'method'=>'post'])!!}
                        <button type="submit" class="uk-button uk-button-primary"><i class="uk-icon uk-icon-ban"></i> Разбанить</button>
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection