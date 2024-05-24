@extends('base')

@section('styles')
    <style>
        li.active {
        }
        li.active a{
            color: red;
        }
    </style>
@endsection
@section('title')
    Search {{ $site_title() }}
@endsection

@section('content')
    @include('jstore/components/top-page', ['title' => 'search'])

    
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row align-items-center mb-4 pb-1">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="product_header_left">
                                    <div class="custom_select">
                                        <select name="sort" id="sortByPrice" class="form-control form-control-sm">
                                            <option value="price"
                                                {{ request()->get('sort') === 'price' ? 'selected' : '' }}>
                                                {{ __('messages.sortPriceAsc') }}</option>
                                            <option value="price-desc"
                                                {{ request()->get('sort') === 'price-desc' ? 'selected' : '' }}>{{ __('messages.sortPriceDesc') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="product_header_right">
                                    <div class="products_view">
                                        <a href="javascript:Void(0);" class="shorting_icon grid"><i
                                                class="ti-view-grid"></i></a>
                                        <a href="javascript:Void(0);" class="shorting_icon list active"><i
                                                class="ti-layout-list-thumb"></i></a>
                                    </div>
                                    <div class="custom_select">

                                        <select id="showing" class="form-control form-control-sm" name='showing'>
                                            <option value=""{{ request()->get('showing') === '' ? 'selected' : '' }}>
                                                {{ __('messages.showing') }}</option>
                                            <option value="3"{{ request()->get('showing') === '3' ? 'selected' : '' }}>
                                                3</option>
                                            <option value="8"{{ request()->get('showing') === '8' ? 'selected' : '' }}>
                                                8</option>
                                            <option
                                                value="12"{{ request()->get('showing') === '12' ? 'selected' : '' }}>12
                                            </option>
                                            <option
                                                value="18"{{ request()->get('showing') === '18' ? 'selected' : '' }}>18
                                            </option>
                                            <option
                                                value="50"{{ request()->get('showing') === '50' ? 'selected' : '' }}>50
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row shop_container list">
                        
                        @foreach ($search as $product)
                            <div class="col-md-4 col-6">
                                <div class="product">
                                    <div class="product_img"> 
                                        <a href="{{route('product',['slug'=>$product->slug])}}">
                                            <img src="{{Storage::url($product->imageUrls()[0])}}" alt="product_img1">
                                        </a>
                                    </div>
                                    <div class="row product_info">
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
                                                <li class="add-to-cart">
                                                    <a href="{{ route('cart.add', ['productId' => $product->id]) }}">
                                                        <i class="icon-basket-loaded"></i> {{ __('messages.AddToCart') }}
                                                    </a>
                                                </li>
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
                                                <li class="add-to-cart">
                                                    <a href="{{ route('cart.add', ['productId' => $product->id]) }}">
                                                        <i class="icon-basket-loaded"></i> {{ __('messages.AddToCart') }}
                                                    </a>
                                                </li>
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
                        
                    </div>
                    
                </div>
                
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="pagination mt-3 justify-content-center align-items-center pagination_style1">
                        {{ $search->links('pagination::bootstrap-5') }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const showing = document.querySelector('#showing')
        const categoryItems = document.querySelectorAll('.category-item')
        const sortByPrice = document.querySelector('#sortByPrice')
        const datas = [showing, sortByPrice]
        datas.forEach(data => {
            data.onchange = (event) => {
                const {
                    name,
                    value
                } = event.target
                const urlParams = new URLSearchParams(window.location.search)
                urlParams.set(name, value)
                const newLink = window.location.origin + window.location.pathname + '?' + urlParams.toString()
                window.location.href = newLink
            }
        });
        categoryItems.forEach(category => {
            category.onclick = (event) => {
                event.preventDefault();
                let { id } = event.target.dataset
                if(!id){
                      id  = event.target.parentNode.dataset.id
                }

                const urlParams = new URLSearchParams(window.location.search)
                urlParams.set('category_id', id)
                const newLink = window.location.origin + window.location.pathname + '?' + urlParams.toString()
                window.location.href = newLink
            }
        });
    </script>
@endsection
