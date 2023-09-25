<?php

namespace App\Models;

use App\Models\Fee;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable =[
'id',
'name',
'age',
'email'
    ];
    public function profile(){
        return $this->hasOne(Profile::class, 'user_id');
    }
    public function subjects(){
        return $this->hasOne(Subject::class, 'user_id');
    }
    public function fee(){
        return $this->hasMany(Fee::class, 'user_id');
    }
}
