@extends('backend.layouts.main')
@section('content')
    <div class="uk-grid">
        <div class="uk-width-1-3">
            <div class="uk-panel uk-panel-box">
                <div class="uk-panel-badge uk-badge">{{$userCount}}</div>
                <h3 class="uk-panel-title"><i class="uk-icon-users"></i> Пользователи </h3>
                <ul class="uk-list">
                    @foreach($lastUsers as $user)
                        <li>{{$user->created_at->format('d.m.Y H:i:s')}} - {{$user->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-panel uk-panel-box">
                <div class="uk-panel-badge uk-badge">{{$productCount}}</div>
                <h3 class="uk-panel-title"><i class="uk-icon-shopping-cart"></i> Товары</h3>
                <ul class="uk-list">
                    @foreach($lastProducts as $product)
                        <li>{{$product->created_at->format('d.m.Y H:i:s')}} - {{$product->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-panel uk-panel-box">
                <div class="uk-panel-badge uk-badge">{{$fieldCount}}</div>
                <h3 class="uk-panel-title"><i class="uk-icon-shopping-cart"></i> Дополнительные поля</h3>
                <ul class="uk-list">
                    @foreach($lastFields as $field)
                        <li>{{$field->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection