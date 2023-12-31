<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOn extends Model
{
    use HasFactory;
    protected $table='add_ons';



    protected $fillable = [
        'icon',
        'heading',
        'sub_heading',
        'price',
        'popup_content',
        'type',
        'status',
        'description',
        'days',
    ];

}
