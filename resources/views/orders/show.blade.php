@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div >
        <h3>Show Order</h3>

        <a href="{{ route('admin.order.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                    <tr>
        <th>ClientName</th> 
        <td>{{ $order->clientName }}</td>
</tr>
    <tr>
        <th>Billing_address</th> 
        <td>{{ $order->billing_address }}</td>
</tr>
    <tr>
        <th>Shipping_address</th> 
        <td>{{ $order->shipping_address }}</td>
</tr>
    <tr>
        <th>Quantity</th> 
        <td>{{ $order->quantity }}</td>
</tr>
    <tr>
        <th>Taxe</th> 
        <td>{{ $order->taxe }}</td>
</tr>
    <tr>
        <th>Order_cost</th> 
        <td>{{ $order->order_cost }}</td>
</tr>
    <tr>
        <th>Order_cost_ttc</th> 
        <td>{{ $order->order_cost_ttc }}</td>
</tr>
    <tr>
        <th>IsPaid</th> 
        <td>
            <div class="form-check form-switch">
                <input name="isPaid" disabled id="isPaid" value="true" data-bs-toggle="toggle"  {{ $order->isPaid == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
            </div>
        </td>
    </tr>
    <tr>
        <th>Carrier_name</th> 
        <td>{{ $order->carrier_name }}</td>
</tr>
    <tr>
        <th>Carrier_price</th> 
        <td>{{ $order->carrier_price }}</td>
</tr>
    <tr>
        <th>Paymeny_method</th> 
        <td>{{ $order->paymeny_method }}</td>
</tr>
    <tr>
        <th>Stripe_payment_intent</th> 
        <td>{{ $order->stripe_payment_intent }}</td>
</tr>
	
            </tbody>
        </table>

        <div>
            <a href="{{ route('admin.order.edit', ['id' => $order->id]) }}" class="btn btn-primary my-1">
                <i class="fa-solid fa-pen-to-square"></i>  Edit
            </a>
        </div>
    </div>
@endsection