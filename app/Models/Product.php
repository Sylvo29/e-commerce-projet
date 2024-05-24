<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'moreDescription', 'additionalInfos', 'stock', 'soldePrice', 'regularPrice', 'imageUrls', 'brand', 'isAvailable', 'isBestSeller', 'isNewArrival', 'isFeatured', 'isSpecialOffer'];

	public function categories()
	{

		return $this->belongsToMany(\App\Models\Category::class);

	}
	
	public function imageUrls()
	{

		return json_decode($this->imageUrls);

	}


	public function tags()
	{
		
		return $this->belongsToMany(\App\Models\Tag::class);
	
	}

}
