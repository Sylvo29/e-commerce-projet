@foreach ($products as $product)
    <div class="col-md-4 col-6">
        <div class="product">
            <div class="product_img"> 
                <a href="{{route('product',['slug'=>$product->slug])}}">
                    <img src="{{Storage::url($product->imageUrls()[0])}}" alt="product_img1">
                </a>
            </div>
            <div class="row product_info">
                <div class="d-flex">
                    <span class="badge rounded-pill bg-primary">
                        {{-- @dump($product->stock) --}}
                        @if ($product->stock != 0)
                            {{ __('messages.available')}}
                        @else
                            {{ __('messages.unavailable')}}
                        @endif
                    </span>
                </div>
                <h6 class="product_title"><a href="{{route('product',['slug'=>$product->slug])}}">{{$product->name}}</a></h6>
                <div class="product_price">
                    <span class="price">{{ $format_price($product->soldePrice) }}</span>
                    <del>{{ $format_price($product->regularPrice) }}</del>
                    <div class="on_sale">
                        <span>{{$calculateReduction($product)}}% Off</span>
                    </div>
                </div>
                <div class="rating_wrap">
                    <div class="rating">
                        <div class="product_rate" style="width:80%"></div>
                    </div>
                    <span class="rating_num">(100%)</span>
                </div>
                <div class="pr_desc mb-0">
                    <p>{{ $product->description }}</p>
                </div>
                
                <div class="product_action_box">
                    <ul class="list_none pr_action_btn">
                        @if ($product->stock != 0)
                            <li class="add-to-cart">
                                <a href="{{ route('cart.add', ['productId' => $product->id]) }}">
                                    <i class="icon-basket-loaded"></i> {{ __('messages.AddToCart') }}
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('compare.add', ['productId' => $product->id]) }}">
                                <i class="icon-shuffle"></i></a>
                        </li>
                        <li>
                            <a href="{{ route('wishlist.add', ['productId' => $product->id]) }}">
                                <i class="icon-heart"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="list_product_action_box">
                    <div class="product_sort_info">
                        <ul>
                            <li><i class="linearicons-shield-check"></i> {{ __('messages.garantie') }}</li>
                            <li><i class="linearicons-sync"></i>  {{ __('messages.politiqueRetour') }}</li>
                            <li><i class="linearicons-bag-dollar"></i>{{ __('messages.paiementLivraison') }}</li>
                        </ul>
                    </div>
                    <ul class="list_none pr_action_btn">
                        @if ($product->stock != 0)
                            <li class="add-to-cart">
                                <a href="{{ route('cart.add', ['productId' => $product->id]) }}">
                                    <i class="icon-basket-loaded"></i> {{ __('messages.AddToCart') }}
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('compare.add', ['productId' => $product->id]) }}">
                                <i class="icon-shuffle"></i></a>
                        </li>
                        <li>
                            <a href="{{ route('wishlist.add', ['productId' => $product->id]) }}">
                                <i class="icon-heart"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach