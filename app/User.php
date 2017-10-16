<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'gender', 'nametitle', 'state', 'city',
        'postcode', 'street', 'dob', 'phone', 'cell', 'picture', 'nat',
        'email', 'username', 'pass', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'passwordmd5', 'passwordsha1', 'passwordsha256', 'remember_token',
    ];

    public function generateToken() {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }

    public static function getNametitles() {
        return ['Miss', 'Ms', 'Mr', 'Mx', 'Sir', 'Mrs', 'Dr', 'Lady', 'Lord'];
    }

    public static function getGenders() {
        return ['Male', 'Female'];
    }

    public function mapUserData ($user) {
        return $user;
    }
}
