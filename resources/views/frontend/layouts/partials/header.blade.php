<div class="header">
    <div class="top ">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-6 hidden-xs ">
                    <ul>
                        @if(Auth::guard()->guest())
                        <li class="signin"><a href="{{url('/register')}}">Зарегистрироваться</a></li>
                        <li class="login"><a href="{{url('/login')}}">Войти</a></li>
                        @else
                          <li>Добро пожаловать {{Auth::user()->name}}</li>
                          <li><a href="{{url('/logout')}}"> | Выход</a></li>
                        @endif
                        <li class="add"><a href="#">Подать объявление</a></li>
                    </ul>
                </div>
                <div class="col-xs-5 text-right hidden-xs hidden-sm">
                    <ul>
                        <li class="wishlist"><a href="">Избранное (0)</a></li>
                        <li class="compare"><a href="">Сравнить (0)</a></li>
                        <li class="cart"><a href="">Корзина (0)</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-1 text-right">
                    <!-- Module change language -->
                    <div class="lang"><a href="#" class="active">RU</a> / <a href="#">EN</a></div>
                </div>
            </div>
            <!-- row -->
        </div>
    </div>
    <!-- top -->
    <div class="middle ">
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-md-2">
                    <a href="{{url('/')}}" class="logo  hidden-xs hidden-sm"><img src="images/logo.png" alt=""></a>
                    <a href="{{url('/')}}" class="logo visible-xs visible-sm"><img src="images/logo_mobile.png" alt=""></a>
                </div>
                <div class="col-xs-8 col-md-10 text-right ">
                    <div class="input-group hidden-xs hidden-sm">
                        <input type="text" class="form-control" placeholder="Поиск по объявлениям">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Во всех разделах <span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                               @foreach($categories as $category)
                                  <li><a href="#">{{$category->name}}</a></li>
                               @endforeach
                            </ul>
                            <button type="button" class="btn btn-default btn-gray"><i class="glyphicon glyphicon-search"></i></button>
                            <button type="button" class="btn btn-default btn-gray"><i class="glyphicon glyphicon-map-marker"></i></button>
                        </div>
                        <!-- /btn-group -->
                    </div>
                    <!-- /input-group -->
                    <div class="text-right visible-sm visible-xs hamburger">
                        <a href="#"><i class="glyphicon glyphicon-menu-hamburger"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- middle -->
    <div class="bot ">
        <div class="container">
            <div class="search visible-xs visible-sm">
                <div class="input-group ">
                    <input type="text" class="form-control" placeholder="Поиск по объявлениям">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                      </span>
                </div>
            </div>
                <ul class="category-menu  hidden-xs hidden-sm" >
                    @foreach($categories as $node)
                        {!!  renderMenu($node) !!}
                    @endforeach
                </ul>
        </div>
    </div>
    <!-- bot -->
</div>