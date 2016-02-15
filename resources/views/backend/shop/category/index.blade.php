@extends('backend.layouts.main')
@section('title', 'Список категории' )
@section('content')
    <h1>Категории</h1>

    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <a href="{{route('manager.shop.category.create')}}" class="uk-button uk-button-success">Создать</a>
    </div>

    <!-- This is the nav containing the toggling elements -->
    <ul class="uk-tab">
        <li class="uk-active"><a href="{{route('manager.shop.category.index')}}">Список</a></li>
        <li><a href="{{route('manager.shop.category.reorder')}}">Сортировка</a></li>
    </ul>
    <br>

    <table class="uk-table uk-table-hover uk-table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Родитель</th>
            <th class="uk-text-center">Кол. товаров</th>
            <th class="uk-text-right">Действие</th>
        </tr>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->parent['name']}}</td>
                <td class="uk-text-center">{{$category->products()->count()}}</td>
                <td class="uk-text-right">
                    {!! Form::open(['route' => ['manager.shop.category.destroy',$category->id] ,'method'=>'delete','class'=>'confirm'])!!}
                    <a href="{{ route('manager.shop.category.edit', ['category' => $category->id])}}"
                       class="uk-button uk-button-primary">
                        <i class="uk-icon uk-icon-edit"></i> </a>
                    <button type="submit" class="uk-button uk-button-danger"><i class="uk-icon uk-icon-trash"></i>
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
        </thead>
    </table>

    {{--{!! str_replace('pagination','uk-pagination',$categories->render()) !!}--}}
@endsection

@section('scripts')
    @parent
    <script>

    </script>
@endsection