@extends('base')

@section('title')
    {{ $product->name }} {{ $site_title() }}
@endsection

@section('content')
    @include('jstore/components/top-page', ['title' => $product->name])
 
    <div class="main_content">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                        <div class="product-image">
                            <div class="product_img_box">
                                <img id="product_img" alt="product_img1" src="{{ Storage::url($product->imageUrls()[0]) }}"
                                    data-zoom-image="{{ Storage::url($product->imageUrls()[0]) }}">
                                <a title="Zoom" class="product_img_zoom"><span class="linearicons-zoom-in"></span>
                                </a>
                            </div>
                            <div id="pr_item_gallery" data-slides-to-show="4" data-slides-to-scroll="1"
                                data-infinite="false"
                                class="product_gallery_item slick_slider slick-initialized slick-slider">
                                <div aria-live="polite" class="slick-list draggable">
                                    <div class="slick-track" role="listbox" style="opacity: 1; width: 556px; left: 0px;">
                                        @foreach ($product->imageUrls() as $imageUrl)
                                            <div class="item slick-slide slick-current slick-active" data-slick-index="0"
                                                aria-hidden="false" tabindex="-1" role="option"
                                                aria-describedby="slick-slide20" style="width: 129px;"><a href="#"
                                                    class="product_gallery_item active"
                                                    data-image="{{ Storage::url($imageUrl) }}"
                                                    data-zoom-image="{{ Storage::url($imageUrl) }}" tabindex="0"><img
                                                        alt="product_small_img1" src="{{ Storage::url($imageUrl) }}"></a>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="pr_detail">
                            <div class="row product_description">
                                <div class="d-flex">
                                    <span class="rounded-pill badge bg-primary position-relative">
                                        @if ($stock =='Available')
                                            {{ __('messages.available')}}
                                        @else
                                            {{ __('messages.unavailable')}}
                                        @endif
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                          {{ $product->stock}}
                                        </span>
                                    </span>
                                </div>
                                <h4 class="product_title"><a href="#">{{ $product->name }}</a></h4>
                                <div class="product_price">
                                    <span class="price">{{ $format_price($product->soldePrice) }}</span>
                                    <del>{{ $format_price($product->regularPrice) }}</del>
                                    <div class="on_sale"><span>{{ $calculateReduction($product) }}% Off</span></div>
                                </div>
                                <div class="rating_wrap">
                                    <div class="rating">
                                        <div class="product_rate" style="width:80%;">
                                        </div>
                                    </div><span class="rating_num">(100%)</span>
                                </div>
                                <div class="pr_desc">
                                    <p>{{ $product->description }} </p>
                                </div>
                                <div class="product_sort_info">
                                    <ul>
                                        <li><i class="linearicons-shield-check"></i> {{ __('messages.garantie') }}</li>
                                        <li><i class="linearicons-sync"></i>  {{ __('messages.politiqueRetour') }}</li>
                                        <li><i class="linearicons-bag-dollar"></i>{{ __('messages.paiementLivraison') }}</li>
                                    </ul>
                                </div>

                            </div>
                            <hr>
                            <div class="cart_extra">
                                <div class="cart-product-quantity">
                                    <div class="quantity"><input type="button" value="-" class="minus"><input
                                            type="text" name="quantity" value="1" title="Qty" size="4"
                                            class="qty"><input type="button" value="+" class="plus"></div>
                                </div>
                               
                                @if ($stock =='Available')
                                    <div class="cart_btn">
                                        <a href="{{ route('cart.add', ['productId' => $product->id]) }}"
                                            class="btn btn-fill-out btn-addtocart"><i class="icon-basket-loaded"></i> {{ __('messages.AddToCart') }}
                                        </a>
                                    </div>
                                @endif
                                <div class="cart_btn">
                                    <a href="{{route('compare.add',['productId'=> $product->id])}}" class="add_compare">
                                        <i class="icon-shuffle"></i>
                                    </a>
                                    <a href="{{route('wishlist.add',['productId'=> $product->id])}}" class="add_wishlist"><i class="icon-heart"></i>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <ul class="product-meta">
                                @if ($product->categories->count())
                                    <li>Categories:
                                        @foreach ($product->categories as $category)
                                            <a href="#">{{ $category->name }} </a>
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </li>
                                @endif
                                @if ($product->tags->count())
                                    <li>Tags:
                                        @foreach ($product->tags as $tag)
                                            <a href="#">{{ $tag->name }} </a>
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </li>
                                @endif
                            </ul>
                            <div class="product_share"><span>Share:</span>
                                <ul class="social_icons">
                                    @foreach (session()->get('socials') as $social)
                                        <li>
                                            <a target="_blank"
                                                href="{{ $social->link }}">
                                                <i class="{{ $social->icon}}"></i>
                                            </a>
                                        </li>
    
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="large_divider clearfix"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tab-style3">
                            <ul role="tablist" class="nav nav-tabs">
                                <li class="nav-item"><a id="Description-tab" data-bs-toggle="tab" href="#Description"
                                        role="tab" aria-controls="Description" aria-selected="true"
                                        class="nav-link active">Description</a></li>
                                <li class="nav-item"><a id="Additional-info-tab" data-bs-toggle="tab"
                                        href="#Additional-info" role="tab" aria-controls="Additional-info"
                                        aria-selected="false" class="nav-link">Additional info</a></li>
                            </ul>
                            <div class="tab-content shop_info_tab">
                                <div id="Description" role="tabpanel" aria-labelledby="Description-tab"
                                    class="tab-pane fade show active">
                                    {!! $product->moreDescription !!}
                                </div>
                                <div id="Additional-info" role="tabpanel" aria-labelledby="Additional-info-tab"
                                    class="tab-pane fade">
                                    {!! $product->additionalInfos !!}
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="small_divider"></div>
                        <div class="divider"></div>
                        <div class="medium_divider"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
