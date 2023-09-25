<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill_payments extends Model
{
    use HasFactory;
    protected $table='bill_user';



    protected $fillable = [
        'user_id',
        'bill_id',
        'payment_id',
    ];
}
