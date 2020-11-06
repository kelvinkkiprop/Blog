<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//Add
use App\Other\UserType;
use App\Other\UserStatus;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'type', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * Get User Type
    */
    public function UserType() {
        return $this->hasOne(UserType::class, 'id', 'type');
    }  
    
    /**
    * Get User Status
    */
    public function UserStatus() {
        return $this->hasOne(UserStatus::class, 'id', 'status');
    } 


}
