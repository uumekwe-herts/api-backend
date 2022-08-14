<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model;

class AnonRegQuestion extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'anonymousreg_questions';
}
