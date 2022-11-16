<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resources';
    public $timestamps = true;
    protected $dates  = [ 'created_at' , 'updated_at'];
    protected $fillable = ['title','content' ];
}
