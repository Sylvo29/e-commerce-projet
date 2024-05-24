@extends('admin')

@section('content')
<div >
    <h3>Create Order</h3>
    <a href="{{ route('admin.order.index') }}" class="btn btn-success my-1">
            Home
    </a>
    @include('orders/orderForm')
        </div>
@endsection
