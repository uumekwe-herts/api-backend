<?php

namespace App\Models;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class RegularUser extends Authenticatable implements JWTSubject
{

    use HasFactory, Notifiable;
    protected $collection = 'regular_users';
    public $timestamps = true;
    protected $fillable = ['first_name', 'last_name', 'email', 'password',
        'phone', 'date_of_birth', 'state', 'gender'
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
