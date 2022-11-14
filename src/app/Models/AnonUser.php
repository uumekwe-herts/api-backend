<?php

namespace App\Models;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class AnonUser extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $table = 'anonymous_users';
    public $timestamps = true;
    protected $fillable = ['question_1', 'answer_1', 'question_2', 'answer_2',
        'question_3', 'answer_3', 'password', 'email'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
}
