@extends('admin')

@section('content')
    <div >
        <h3>Edit Orderdetails</h3>
        <a href="{{ route('admin.orderdetails.index') }}" class="btn btn-success my-1">
                Home
        </a>
        @include('orderdetails/orderdetailsForm', ['orderdetails' => $orderdetails])
    </div>
@endsection