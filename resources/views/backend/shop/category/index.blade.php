@extends('backend.layouts.main')

@section('content')
    <h1>Категории</h1>

    <div class="uk-text-right">
        <a href="{{route('manager.shop.categories.create')}}" class="uk-button uk-button-success">Создать</a>
    </div>

    <table class="uk-table uk-table-hover uk-table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Родитель</th>
            <th class="uk-text-right">Действие</th>
        </tr>
        <tbody>
           @foreach($categories as $category)
               <tr>
                   <td>{{$category->id}}</td>
                   <td>{{$category->name}}</td>
                   <td>{{$category->parent['name']}}</td>
                   <td class="uk-text-right">

                       {!! Form::open(['route' => ['manager.shop.categories.destroy',$category->id] ,'method'=>'delete'])!!}
                       <a href="{{ route('manager.shop.categories.edit', ['categories' => $category->id])}}" class="uk-button uk-button-primary">
                           <i class="uk-icon uk-icon-edit"></i> </a>
                       <button type="submit" class="uk-button uk-button-danger"><i class="uk-icon uk-icon-trash"></i> </button>
                       {!! Form::close() !!}
                   </td>
               </tr>
           @endforeach
        </tbody>
        </thead>
    </table>


    {{--<ul class="uk-nestable" data-uk-nestable="">--}}
        {{--<li class="uk-nestable-item uk-parent">--}}
            {{--<div class="uk-nestable-panel">--}}
                {{--<div class="uk-nestable-toggle" data-nestable-action="toggle"></div>--}}
                {{--Item 1--}}
            {{--</div>--}}

            {{--<ul class="uk-nestable-list">--}}
                {{--<li class="uk-nestable-item">--}}
                    {{--<div class="uk-nestable-panel">--}}
                        {{--<div class="uk-nestable-toggle" data-nestable-action="toggle"></div>--}}
                        {{--Item 2--}}
                    {{--</div>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</li>--}}

        {{--<li class="uk-nestable-item">--}}
            {{--<div class="uk-nestable-panel">--}}
                {{--<div class="uk-nestable-toggle" data-nestable-action="toggle"></div>--}}
                {{--Item 3--}}
            {{--</div>--}}

        {{--</li>--}}

    {{--</ul>--}}


@endsection