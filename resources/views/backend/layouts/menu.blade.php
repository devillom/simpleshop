<div class="ui fixed inverted menu">
    <div class="ui container">
        <a href="#" class="header item">
            {{--<img class="logo" src="images/logo.png">--}}
            Simple-Shop
        </a>
        <a href="{{route('manager.index')}}" class="item">Главная</a>
        <a href="{{route('manager.user.index')}}" class="item">Пользователи</a>
        <div class="ui simple dropdown item">
            Магазин <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="{{route('manager.shop.category.index')}}">Категории</a>
                <a class="item" href="{{route('manager.shop.product.index')}}">Товары</a>
                <div class="divider"></div>
                <a class="item" href="{{route('field.index')}}">Дополнительные поля</a>
            </div>
        </div>
    </div>
</div>