@extends('base')

@section('title')
    Compare product {{ $site_title() }}
@endsection

@section('content')
    @include('jstore/components/top-page', ['title' => 'Compare'])
    <div class="container">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="compare_box">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                <tbody>
                                    <tr class="pr_image">
                                        <td class="row_title">{{ __('messages.product_image') }}</td>
                                        @foreach ($compare as $product)
                                            <td class="row_img">
                                                <img src="{{$get_image($product)}}" alt="compare-img">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr class="pr_title">
                                        <td class="row_title">{{ __('messages.product_name') }}</td>
                                        @foreach ($compare as $product)
                                            <td class="product_name">
                                                <a href="{{route('product',['slug'=>$product['slug']])}}">
                                                    {{$product['name']}}
                                                </a>
                                            </td>
                                        @endforeach

                                    </tr>
                                    <tr class="pr_price">
                                        <td class="row_title">{{ __('messages.price') }}</td>
                                        @foreach ($compare as $product)
                                            <td class="product_price">
                                                <span class="price">
                                                    {{$format_price($product["soldePrice"])}}
                                                </span>
                                            </td>
                                        @endforeach
                                    </tr>
                                    {{-- <tr class="pr_rating">
                                        <td class="row_title">Rating</td>
                                        <td>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:80%"></div>
                                                </div>
                                                <span class="rating_num">(21)</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:68%"></div>
                                                </div>
                                                <span class="rating_num">(15)</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:87%"></div>
                                                </div>
                                                <span class="rating_num">(25)</span>
                                            </div>
                                        </td>
                                    </tr> --}}
                                    <tr class="pr_add_to_cart">
                                        <td class="row_title">{{ __('messages.AddToCart') }}</td>
                                        @foreach ($compare as $product)
                                            <td class="row_btn">
                                                <a href="{{route('cart.add',['productId'=>$product['id']])}}" class="btn btn-fill-out">
                                                    <i class="icon-basket-loaded"></i>
                                                    {{ __('messages.AddToCart') }}
                                                </a>
                                            </td>
                                        @endforeach

                                    </tr>
                                    <tr class="description">
                                        <td class="row_title">{{ __('messages.description') }}</td>
                                        @foreach ($compare as $product)
                                            <td class="row_text">
                                                <p>
                                                    {{$product['description']}}
                                                </p>
                                            </td>
                                        @endforeach

                                    </tr>

                                    <tr class="pr_stock">
                                        <td class="row_title">{{ __('messages.item_availability') }}</td>
                                        @foreach ($compare as $product)
                                            <td class="row_stock">
                                                <p>
                                                    {{$product['stock'] > 0 ? 'In Stock' : 'Out Of Stock'}}
                                                </p>
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr class="pr_remove">
                                        <td class="row_title"></td>
                                        @foreach ($compare as $product)
                                            <td class="row_remove">
                                                <a href="{{ route('compare.remove', [
                                                    'productId' =>$product['id']
                                                ]) }}">
                                                    <span>{{ __('messages.remove') }}</span> <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        @endforeach
                                    </tr>
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
