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
                            @if($product->photos()->count())
                                <img src="{{ Image::url($product->photos->first()->path,213,213) }}" alt="">
                            @else
                                <img src="uploads/default-image(213x213).png" alt="">
                            @endif
                            <h4>{{$product->name}}</h4>
                            <div class="price">{{$product->price}}</div>
                            @if(!is_null($product->fields))
                            {{--<ul class="">--}}
                                {{--@foreach($product->fields as $field)--}}
                                    {{--<li>{{$field->name}}: {{$field->getValue($product->id)->{$field->type} }}</li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
