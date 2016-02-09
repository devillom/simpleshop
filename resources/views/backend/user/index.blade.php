@extends('backend.layouts.main')

@section('content')
    <h2 class="ui center aligned icon header">
        <i class="circular users icon"></i>
        Пользователи
    </h2>

    <a href="{{route('manager.user.create')}}" class="ui basic button">
        <i class="icon user add"></i>
        Добавить
    </a>
    <button type="submit" class="ui red button">
        <i class="icon user remove"></i>
        Удалить
    </button>

    <div id="users">
            <div :class="{'loading': loading}" class="ui segment">
            <table  class="ui celled table" v-if="users.length">
                <thead>
                <tr>
                    <th>
                        <div class="ui checkbox">
                            <input type="checkbox" class="selectAll">
                            <label ></label>
                        </div>
                    </th>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роли</th>
                    <th>Дата регистрации</th>
                </tr>
                </thead>
                <tbody>

                    <tr v-for="user in users">
                        <td>
                            <div class="ui checkbox">
                                <input type="checkbox" name="user_id[]" value="@{{user.id}}" class="selectAll">
                                <label ></label>
                            </div>
                        </td>
                        <td>@{{user.id}}</td>
                        <td>@{{user.name}}</td>
                        <td>@{{user.email}}</td>
                        <td>
                            <span class="ui teal label" v-for="role in user.roles">
                                @{{role.name}}
                            </span>
                        </td>
                        <td>@{{user.created_at}}</td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>




@endsection