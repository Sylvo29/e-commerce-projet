@extends('base')

@section('title')
    Order Completed {{ $site_title() }}
@endsection

@section('content')
    @include('jstore/components/top-page', ['title' => 'Order Completed'])

  
    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="c
                ol-md-8">
                    <div class="text-center order_complete">
                        <i class="fas fa-check-circle"></i>
                        <div class="heading_s1">
                          <h3>{{ __('messages.title-orderCompleted') }}</h3>
                        </div>
                          <p>{{ __('messages.text-orderCompleted') }}</p>
                        <a href="{{route('shop')}}" class="btn btn-fill-out">{{ __('messages.continueShopping') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


