<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'clientName', 'street', 'codePostal', 'city', 'state', 'moreDetails', 'addressType', 'user_id'];

	public function user()
	{

		return $this->belongsTo(\App\Models\User::class);

	}

    public function getAddress(){
        return  $this->name ." ".
                $this->clientName ." ".
                $this->street ." ".
                $this->city ." ".
                $this->state ." ";
    }

}
