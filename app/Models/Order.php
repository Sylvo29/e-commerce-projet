<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

	protected $fillable = ['clientName', 'billing_address', 'shipping_address', 'quantity', 'taxe', 'order_cost', 'order_cost_ttc', 'isPaid', 'carrier_name', 'carrier_price', 'paymeny_method'];

	public function orderdetails()
	{
		
		return $this->hasMany(\App\Models\Orderdetails::class);
	
	}

	// public function user()
	// {

	// 	return $this->belongsTo(\App\Models\User::class);

	// }

}
