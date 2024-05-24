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
    Shop {{ $site_title() }}
@endsection

@section('content')
    @include('jstore/components/top-page', ['title' => 'shop'])


    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
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
                        @include('jstore/components/shop-product')
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="pagination mt-3 justify-content-center align-items-center pagination_style1">
                                {{ $products->links('pagination::bootstrap-5') }}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
                    <div class="sidebar">
                        <div class="widget">
                            <h5 class="widget_title">Categories</h5>
                            <ul class="widget_categories">
                                @foreach ($categories as $category)
                                <li class="{{ request()->get('category_id') == $category->id ? 'active' : ''}}">
                                    <a href="#"  class="category-item" data-id="{{ $category->id}}">
                                        <span class="categories_name">{{ $category->name }}</span>
                                        <span class="categories_num">({{ $category->products->count()}})</span></a>
                                </li>
                                @endforeach
                                <li class="{{ request()->get('category_id') === 'all' ? 'active' : ''}}">
                                    <a href="#" class="category-item " data-id="all">
                                        <span class="categories_name">{{ __('messages.all') }}</span>
                                        <span class="categories_num">({{ $products->total()}})</span></a>
                                </li>

                            </ul>
                        </div>
                            {{-- <div class="widget">
                                <h5 class="widget_title">Filter</h5>
                                <div class="filter_price">
                                    <div id="price_filter" data-min="0" data-max="500" data-min-value="50"
                                        data-max-value="300" data-price-sign="$"></div>
                                    <div class="price_range">
                                        <span>Price: <span id="flt_price"></span></span>
                                        <input type="hidden" id="price_first">
                                        <input type="hidden" id="price_second">
                                    </div>
                                </div>
                            </div>
                            <div class="widget">
                                <h5 class="widget_title">Brand</h5>
                                <ul class="list_brand">
                                    <li>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="Arrivals"
                                                value="">
                                            <label class="form-check-label" for="Arrivals"><span>New Arrivals</span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="Lighting"
                                                value="">
                                            <label class="form-check-label" for="Lighting"><span>Lighting</span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="Tables"
                                                value="">
                                            <label class="form-check-label" for="Tables"><span>Tables</span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="Chairs"
                                                value="">
                                            <label class="form-check-label" for="Chairs"><span>Chairs</span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="Accessories"
                                                value="">
                                            <label class="form-check-label" for="Accessories"><span>Accessories</span></label>
                                        </div>
                                    </li>
                                </ul>
                            </div> --}}

                    </div>
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
