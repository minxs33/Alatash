<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $table = "cars";

    protected $fillable = [
        'category_id',
        'created_by',
        'name',
        'description',
        'price',
        'discount',
        'total_price',
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = "id";

    function categories(){
		return $this->belongsTo('App\Models\Categories');
	}

    function users(){
        return $this->belongsTo("App\Models\Users");
    }

    function car_images(){
        return $this->hasMany("App\Models\Car_images");
    }

}
