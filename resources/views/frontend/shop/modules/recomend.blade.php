<div class="recomended-list">
    <h3><span>Рекомендуемые товары</span></h3>
    <div class="row ">
        @foreach($products as $product)
        <div class="col-xs-6 col-sm-4 col-md-3 item-wrapper">
            <div class="item">
                <a href="#" class="thumb">
                    @if($product->photos()->count())
                        <img src="{{ Image::url($product->photos->first()->path,null ,null ,['crop']) }}" alt="">
                    @else
                        <img src="uploads/default-image(213x213).png" alt="">
                    @endif
                </a>
                <div class="info">
                    <p class="name">{{$product->name}}</p>
                    <p class="price">{{$product->price}} Руб.</p>
                </div>
                <div class="hover">
                    <a href="#" class="btn-rounded"><i class="glyphicon glyphicon-heart"></i></a>
                    <a href="#" class="btn-rounded"><i class="glyphicon glyphicon-retweet"></i></a>
                    <a href="#" class="btn-rounded"><i class="glyphicon glyphicon-shopping-cart"></i></a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>