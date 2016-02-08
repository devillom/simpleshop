@extends('backend.layouts.main')
@section('title', 'Список товаров' )
@section('content')
    <h1>Товары</h1>
    <div class="uk-text-left uk-panel uk-panel-box toolbar">
        <a href="{{route('manager.shop.product.create')}}" class="uk-button uk-button-success">Добавить товар</a>
    </div>
    <table class="uk-table uk-table-hover uk-table-striped">
        <thead>
        <tr>
            <th width="30">ID</th>
            <td width="100"></td>
            <th>Название</th>
            <th>Категория</th>
            <th></th>
            <th class="uk-text-right">Действие</th>
        </tr>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>
                    @if(count($product->photos))
                        <img src="{{ Image::url($product->photos->first()->path,100,100) }}" alt="">
                    @else
                        <img src="uploads/default-image(100x100).png" alt="">
                    @endif
                </td>

                <td>{{$product->name}}</td>
                <td>
                    @foreach($product->categories as $category)
                        <span class="uk-badge uk-badge-warning">{{$category->name}}</span>
                    @endforeach
                </td>
                <td> <i class="uk-icon-circle status @if($product->active) active @endif"></i>  </td>
                <td class="uk-text-right">

                    {!! Form::open(['route' => ['manager.shop.product.destroy',$product->id] ,'method'=>'delete'])!!}
                    <a href="{{ route('manager.shop.product.edit', ['categories' => $product->id])}}" class="uk-button uk-button-primary">
                        <i class="uk-icon uk-icon-edit"></i> </a>
                    <button type="submit" class="uk-button uk-button-danger"><i class="uk-icon uk-icon-trash"></i> </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
        </thead>
    </table>

    {!! str_replace('pagination','uk-pagination',$products->render()) !!}



@endsection

@section('scripts')
    <script>

    </script>
@endsection