<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'description', 'moreDescription', 'imageUrl', 'test_public_key', 'test_private_key', 'prod_public_key', 'prod_private_key', 'isAvailable'];

  
}
