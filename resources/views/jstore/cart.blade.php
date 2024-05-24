@extends('base')

@section('title')
    Cart {{ $site_title() }}
@endsection

@section('content')
    @include('jstore/components/top-page', ['title' => 'Cart'])

    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="main_content">
            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive shop_cart_table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">{{ __("messages.product") }}</th>
                                            <th class="product-price">{{ __("messages.price") }}</th>
                                            <th class="product-quantity">{{ __("messages.quantity") }}</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">{{ __("messages.remove") }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($cart['items'] as $item)       
                                            {{-- @dump($item)   --}}
                                            <tr>
                                                <td class="product-thumbnail"><a><img width="50" alt="product1"
                                                            src="{{ $get_image($item['product']) }}"></a>
                                                </td>
                                                <td data-title="Product" class="product-name">
                                                    <a>{{ $item['product']['name'] }}</a>
                                                </td>
                                                <td data-title="Price" class="product-price">
                                                    {{ $format_price($item['product']['soldePrice']) }}
                                                </td>
                                                <td data-title="Quantity" class="product-quantity">
                                                    <div class="quantity">
                                                        {{-- <input type="button" value="-" class="minus"> --}}
                                                        <a href="{{ route('cart.remove', ['productId' => $item['product']['id'], 'quantity' => 1]) }}"
                                                            class="minus">-</a>
                                                        <input value="{{ $item['quantity'] }}" type="text"
                                                            name="quantity" title="Qty" size="4" class="qty">
                                                            @if ($item['quantity'] > $stock-1)
                                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                                    <strong>{{ __('messages.desole') }}</strong> {{ __('messages.textQuanPro') }} <strong>{{ $item['product']['name'] }}</strong> {{ __('messages.textStock') }}{{ $stock }}
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                </div>                                                                
                                                            @else
                                                            <a href="{{ route('cart.add', ['productId' => $item['product']['id']]) }}"
                                                                class="plus">+</a>
                                                            @endif
                                                        
                                                            
                                                        {{-- <input type="button" value="+" class="plus"> --}}
                                                    </div>
                                                </td>
                                                <td data-title="Total" class="product-subtotal">
                                                    {{ $format_price($item['sub_total']) }} </td>
                                                <td data-title="Remove" class="product-remove">
                                                    <a
                                                        href="{{ route('cart.remove', [
                                                            'productId' => $item['product']['id'],
                                                            'quantity' => $item['quantity'],
                                                        ]) }}"><i
                                                            class="ti-close"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="medium_divider"></div>
                            <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                            <div class="medium_divider"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border p-3 p-md-4">
                                <div class="heading_s1 mb-3">
                                    <h6>{{ __("messages.carrier") }}</h6>
                                </div>
                                <div class="">
                                    <form action="">
                                        <select  class="form-control" name="carrier_id" id="carrier_id">
                                            @foreach ($carriers as $carrier)
                                                <option {{ request()->get('carrier_id') == $carrier->id ? 'selected' : '' }} value="{{$carrier->id}}">{{ $carrier->name  }} ({{$format_price($carrier->price)}})</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="border p-3 p-md-4">
                                <div class="heading_s1 mb-3">
                                    <h6>{{ __('messages.cartTotals') }}</h6>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="cart_total_label">{{ __("messages.subtotal") }}</td>
                                                <td class="cart_total_amount">{{ $format_price($cart['sub_total']) }}</td>
                                            </tr>
                                            @if ($selectedCarrier)
                                            <tr>
                                                <td class="cart_total_label">{{ __("messages.shipping") }} ({{ $selectedCarrier->name }})</td>
                                                <td class="cart_total_amount">
                                                        {{ $format_price($selectedCarrier->price) }}
                                                    </td>
                                                </tr>
                                                @endif
                                            <tr>
                                                <td class="cart_total_label">Total</td>
                                                <td class="cart_total_amount">
                                                    <strong>{{ $format_price($cart['sub_total'] + $selectedCarrier->price) }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                               
                                    @if (empty($selectedCarrier && ($quantity > $stock)))
                                    <a routerlink="/checkout" class="btn btn-fill-out"
                                        href="/checkout">
                                        {{ __("messages.proceedToCheckout") }}
                                    </a>
                                    @endif
        
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
<script>
    const carrierSelect = document.querySelector('select#carrier_id')
    carrierSelect.onchange = (event) => {
                const {
                    name,
                    value
                } = event.target
                const urlParams = new URLSearchParams(window.location.search)
                urlParams.set(name, value)
                const newLink = window.location.origin + window.location.pathname + '?' + urlParams.toString()

                console.log(newLink);
                window.location.href = newLink
    }
    
</script>
@endsection
