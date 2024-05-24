<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'imageUrl', 'products'];

	public function products()
	{

		return $this->belongsToMany(\App\Models\Product::class);

	}


}
