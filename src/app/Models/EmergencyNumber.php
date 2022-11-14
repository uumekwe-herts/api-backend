<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EmergencyNumber extends Model
{
    protected $table = 'emergency_numbers';
    public $timestamps = true;
    protected $dates  = [ 'created_at' , 'updated_at'];
    protected $fillable = ['agency','phone_numbers' ];

}
