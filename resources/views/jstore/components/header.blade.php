<header class="header_wrap fixed-top header_with_topbar active">
    <div class="top-header" style="">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        <div class="me-3">
                            {{-- <div class="ddOutOfVision" id="msdrpdd20_msddHolder"
                                style="height: 0px; overflow: hidden; position: absolute;"><select name="countries"
                                    class="custome_select" id="msdrpdd20" tabindex="-1">
                                    <option value="USD" data-title="USD" ng-reflect-value="USD">USD</option>
                                    <option value="EUR" data-title="EUR" ng-reflect-value="EUR">EUR</option>
                                    <option value="GBR" data-title="GBR" ng-reflect-value="GBR">GBR</option>
                                </select>
                            </div> --}}
                            {{-- <div class="dd ddcommon borderRadius" id="msdrpdd20_msdd" tabindex="0"
                                style="width: 52px;">
                                <div class="ddTitle borderRadiusTp"><span class="divider"></span><span
                                        class="ddArrow arrowoff"></span><span class="ddTitleText "
                                        id="msdrpdd20_title"><span class="ddlabel">USD</span><span class="description"
                                            style="display: none;"></span></span></div><input id="msdrpdd20_titleText"
                                    type="text" autocomplete="off" class="text shadow borderRadius"
                                    style="display: none;">
                                <div class="ddChild ddchild_ border shadow" id="msdrpdd20_child"
                                    style="z-index: 9999; display: none; position: absolute; visibility: visible; height: 99px;">
                                    <ul>
                                        <li class="enabled _msddli_ selected" title="USD"><span
                                                class="ddlabel">USD</span>
                                            <div class="clear"></div>
                                        </li>
                                        <li class="enabled _msddli_" title="EUR"><span class="ddlabel">EUR</span>
                                            <div class="clear"></div>
                                        </li>
                                        <li class="enabled _msddli_" title="GBR"><span class="ddlabel">GBR</span>
                                            <div class="clear"></div>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                        <ul class="contact_detail text-center text-lg-start">
                            <li><i class="ti-mobile"></i><span>{{ session()->get('setting')?->phone }}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center text-md-end">
                        <ul class="header_list">
                            <li><a routerlink="/compare" ng-reflect-router-link="/compare" href="{{ route('compare') }}"><i
                                        class="ti-control-shuffle"></i><span>{{ __('messages.compare') }}</span></a></li>
                            <li>
                                <a routerlink="/wishlist" ng-reflect-router-link="/wishlist" href="{{ route('wishlist') }}"><i
                                        class="ti-heart"></i><span>{{ __('messages.wishlist') }}</span></a>
                            </li>
                            @auth
                                <li>
                                    <a href="{{ route('dashboard.index') }}"><i class="ti-user"></i><span>{{ __('messages.dashboard') }}</span></a>
                                </li>
                                @if (auth()->user()->isAdmin())
                                    <li>
                                        <a href="{{ route('admin.product.index') }}"><i class="ti-user"></i><span>{{ __('messages.admin') }}</span></a>
                                    </li>
                                    <li>
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                <li>
                                                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                        {{ $properties['native'] }}
                                                    </a>
                                                </li>
                                        @endforeach
                                       
                                    </li>
                                @endif
                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button>
                                            <i class="ti-user"></i><span>{{ __('messages.logout') }}</span>
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('signin') }}"><i class="ti-user"></i><span>{{ __('messages.signin') }}</span></a>
                                </li>
                                <li>
                                    <a href="{{ route('signup') }}"><i class="ti-user"></i><span>{{ __('messages.signup') }}</span></a>
                                </li>
                            @endauth
                            {{-- @if (auth()->user()->isAdmin()) --}}
                            {{-- <li>
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                @endforeach
                               
                            </li> --}}
                            {{-- @endif --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_header dark_skin main_menu_uppercase">
        <div class="container">
            <nav class="navbar navbar-expand-lg"><a routerlink="/" class="navbar-brand" ng-reflect-router-link="/"
                    href="/">
                    <h2>
                        {{ session()->get('setting')?->name }}
                    </h2>
                </a><button type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-expanded="false" class="navbar-toggler collapsed"><span
                        class="ion-android-menu"></span></button>
                <div id="navbarSupportedContent" class="navbar-collapse justify-content-end collapse" style="">
                    <ul class="navbar-nav">
                        <li class="dropdown"><a routerlink="/" class="nav-link" ng-reflect-router-link="/"
                                href="/">{{ __("messages.home") }}</a></li>
                        <li class="dropdown"><a href="#" data-bs-toggle="dropdown"
                                class="dropdown-toggle nav-link active" aria-expanded="false">Pages</a>
                            <div class="dropdown-menu">
                                <ul>
                                    @foreach (session()->get('pages')['headPages'] as $page)
                                        <li><a class="dropdown-item nav-link nav_item"                                          
                                                href="{{ route('page', ['page' => $page->slug]) }}">
                                                {{ $page->title }}
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </li>
                        <li class="dropdown dropdown-mega-menu"><a href="#" data-bs-toggle="dropdown"
                                class="dropdown-toggle nav-link" aria-expanded="false">{{ __("messages.products") }}</a>
                            <div class="dropdown-menu">
                                <ul class="mega-menu d-lg-flex">
                                    @foreach (session()->get('mega_menus')['categories'] as $category)
                                        <li class="mega-menu-col col-lg-3">
                                            <ul>
                                                <li class="dropdown-header">{{ $category->name }}</li>
                                                @foreach ($category->products as $product)
                                                    <li>
                                                        <a class="dropdown-item nav-link nav_item"
                                                            href="{{ route('product', ['slug' => $product->slug]) }}">
                                                            <img src="{{ Storage::url($product->imageUrls()[0]) }}"
                                                                width="25" height="25" alt="">
                                                            {{ $product->name }}
                                                        </a>

                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="d-lg-flex menu_banners row g-3 px-3">
                                    @foreach (session()->get('mega_menus')['mega_collection'] as $collection)
                                        <div class="col-sm-4">
                                            <div class="header-banner"><img alt="menu_banner1"
                                                    src="{{ Storage::url($collection->imageUrl) }}">
                                                <div class="banne_info">
                                                    <h6>{{ $collection->description }}</h6>
                                                    <h4>{{ $collection->title }}</h4>
                                                    <a
                                                        href="{{ $collection->buttonLink }}">{{ $collection->buttonText }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </li>
                        <li class="dropdown dropdown-mega-menu"><a routerlink="/shop-list" class="nav-link"
                                ng-reflect-router-link="/shop-list" href="/shop-list">{{ __("messages.shop") }}</a></li>
                        <li><a routerlink="/contact" class="nav-link nav_item" ng-reflect-router-link="/contact"
                                href="/contact">{{ __("messages.contactUs") }}
                                </a></li>
                    </ul>
                </div>
                <ul class="navbar-nav attr-nav align-items-center">
                    <li>
                        <a href="javascript:void(0);" class="nav-link search_trigger"><i
                                class="linearicons-magnifier"></i></a>
                        <div class="search_wrap"><span class="close-search"><i
                                    class="ion-ios-close-empty"></i></span>
                            @include('jstore.components.search')
                        </div>
                        <div class="search_overlay"></div>
                    </li>
                    <li class="dropdown cart_dropdown"><a href="#" data-bs-toggle="dropdown"
                            class="nav-link cart_trigger"><i class="linearicons-cart"></i><span
                                class="cart_count">{{ session()->get('cart_details')['cart_count'] }}</span></a>
                        <div class="cart_box dropdown-menu dropdown-menu-right">
                            <ul class="cart_list">
                                @if (session()->get('cart_details') && isset(session()->get('cart_details')['items']))
                                    @foreach (session()->get('cart_details')['items'] as $item)
                                        <li>
                                            <a href="{{ route('cart.remove', [
                                                'productId' => $item['product']['id'],
                                                'quantity' => $item['quantity'],
                                            ]) }}"
                                                class="item_remove">
                                                <i class="ion-close"></i>
                                            </a>
                                            <a href="{{ route('product', ['slug' => $item['product']['slug']]) }}">
                                                <img width="50" height="50" alt="cart_thumb1"
                                                    src="{{ $get_image($item['product']) }}">
                                                {{ $item['product']['name'] }}
                                            </a>
                                            <span class="cart_quantity"> {{ $item['quantity'] }} x
                                                <span class="cart_amount">
                                                    <span class="price_symbole">
                                                        {{ $format_price($item['product']['soldePrice']) }}
                                                    </span>
                                                </span>
                                            </span>
                                        </li>
                                    @endforeach

                                @endif

                            </ul>
                            <div class="cart_footer">
                                <p class="cart_total">
                                    <strong>{{ __("messages.subtotal") }}:</strong><span class="cart_price"><span
                                            class="price_symbole"></span></span>
                                    {{ $format_price(session()->get('cart_details')['sub_total']) }}
                                </p>
                                <p class="cart_buttons"><a routerlink="/cart" class="btn btn-fill-line view-cart"
                                        ng-reflect-router-link="/cart" href="/cart">{{ __("messages.viewCart") }}</a><a
                                        routerlink="{{ route('checkout') }}" class="btn btn-fill-out checkout"
                                        ng-reflect-router-link="{{ route('checkout') }}" href="{{ route('checkout') }}">{{ __("messages.checkout") }}</a>
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
