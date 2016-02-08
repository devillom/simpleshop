@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Товары</h3>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-xs-3">
                        <div class="inner">
                            @if(count($product->photos))
                                <img src="{{ Image::url($product->photos->first()->path,213,213) }}" alt="">
                            @else
                                <img src="uploads/default-image(213x213).png" alt="">
                            @endif
                            <h4>{{$product->name}}</h4>
                            <div class="price">{{$product->price}}</div>
                            <ul class="">
                                @foreach($product->fields as $field)
                                   <li>{{$field->name}}: {{$field->getValue($product->id)->{$field->type} }}</li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
