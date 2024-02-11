<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Events\UserSaved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,SoftDeletes;
    protected $primaryKey = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
            'prefixname',
            'firstname',
            'middlename',
            'lastname',
            'suffixname',
            'username',
            'email',
            'password',
            'photo',
            'type',  
    ];

    protected $dispatchesEvents = [
        'saved' => UserSaved::class,
    ];


    public function getAvatarAttribute()
    {
        return $this->photo;
    }

    public function getFullnameAttribute()
    {
        return $this->firstname." ".$this->middlename." ".$this->lastname ;
    }

    public function getMiddleinitialAttribute()
    {
        return substr($this->middlename, 0, 1) ;
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

}
