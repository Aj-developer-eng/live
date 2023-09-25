<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table ='psx_items';
    public $timestamps = false;
    protected $fillable=[
        'title',
        'price',
        'original_price',
        'description',
        'phone',
        'category_id',
        'subcategory_id',
        'currency_id',
        'status',
        'ordering',
        'lat',
        'lng',
        'location_city_id',
    ];
}
