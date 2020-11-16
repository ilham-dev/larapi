<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    protected $table = "users";
    use HasApiTokens, Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'email','password'];
    protected $hidden   = ['created_at', 'updated_at', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function findForPassport($identifier) {
        return $this->orWhere('email', $identifier)->orWhere('telephone', $identifier)->first();
    }
}
