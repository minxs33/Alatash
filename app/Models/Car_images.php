<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_images extends Model
{
    use HasFactory;

    protected $table = "Car_images";

    protected $fillable = [
        "cars_id",
        "image_url",
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = "id";

    function cars(){
        return $this->belongsTo('App\Models\Cars');
    }
}
