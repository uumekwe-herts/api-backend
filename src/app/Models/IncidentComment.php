<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class IncidentComment extends Model
{
    protected $table = 'case_comments';
    public $timestamps = true;
    protected $dates  = [ 'created_at' , 'updated_at'];
    protected $fillable = ['case_id','comments' ];

}
