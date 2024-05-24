@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div >
        <h3>Show Orderdetails</h3>

        <a href="{{ route('admin.orderdetails.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                    <tr>
        <th>Product_name</th> 
        <td>{{ $orderdetails->product_name }}</td>
</tr>
    <tr>
        <th>Product_description</th> 
        <td>{{ $orderdetails->product_description }}</td>
</tr>
    <tr>
        <th>SoldePrice</th> 
        <td>{{ $orderdetails->soldePrice }}</td>
</tr>
    <tr>
        <th>RegularPrice</th> 
        <td>{{ $orderdetails->regularPrice }}</td>
</tr>
    <tr>
        <th>Quantity</th> 
        <td>{{ $orderdetails->quantity }}</td>
</tr>
    <tr>
        <th>Taxe</th> 
        <td>{{ $orderdetails->taxe }}</td>
</tr>
    <tr>
        <th>Sub_total_ht</th> 
        <td>{{ $orderdetails->sub_total_ht }}</td>
</tr>
    <tr>
        <th>Sub_total_ttc</th> 
        <td>{{ $orderdetails->sub_total_ttc }}</td>
</tr>
	
            </tbody>
        </table>

        <div>
            <a href="{{ route('admin.orderdetails.edit', ['id' => $orderdetails->id]) }}" class="btn btn-primary my-1">
                <i class="fa-solid fa-pen-to-square"></i>  Edit
            </a>
        </div>
    </div>
@endsection