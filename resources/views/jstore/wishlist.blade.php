@extends('base')

@section('title')
    Cart {{ $site_title() }}
@endsection

@section('content')
    @include('jstore/components/top-page', ['title' => 'Wishlist'])
    <div class="container">
        <div class="main_content">
            <div class="section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive wishlist_table">
                               
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">{{ __('messages.product') }}</th>
                                            <th class="product-price">{{ __('messages.price') }}</th>
                                            <th class="product-stock-status">Stock Status</th>
                                            <th class="product-add-to-cart"></th>
                                            <th class="product-remove">{{ __('messages.remove') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wishlist as $product)
                                            <tr>
                                                <td class="product-thumbnail"><a href="#"><img width="50"
                                                            height="50" alt="product1"
                                                            src="{{ $get_image($product) }}"></a>
                                                </td>
                                                <td data-title="Product" class="product-name">
                                                    <a href="#">{{ $product['name'] }}</a>
                                                </td>
                                                <td data-title="Price" class="product-price">
                                                    {{ $format_price($product['soldePrice']) }}
                                                </td>
                                                <td data-title="Stock Status" class="product-stock-status">
                                                    <span class="badge badge-pill badge-success">
                                                        {{ $product['stock'] > 0 ? 'In Stock' : 'Out of Stock' }}
                                                    </span>
                                                </td>
                                                <td class="product-add-to-cart">
                                                    <a href="{{route('cart.add',['productId'=>$product['id']])}}" class="btn btn-fill-out"><i
                                                            class="icon-basket-loaded"></i>
                                                            {{ __("messages.AddToCart") }}
                                                    </a>
                                                </td>
                                                <td data-title="Remove" class="product-remove">
                                                    <a href="{{ route('wishlist.remove', [
                                                        'productId' =>$product['id']
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
                </div>
            </div>
        </div>

    </div>
@endsection
