<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model;

class NgStates extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'ng_states';
}
