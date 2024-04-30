<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier(){
        return 'user_id';
    }

    public function getJWTCustomClaims(){
        return [];
    }

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    protected $fillable =['id_level','username','nama','password'];
}

// class UserModel extends \Illuminate\Foundation\Auth\User
// {
//     use HasFactory;

//     protected $table = 'm_user';
//     protected $primaryKey = 'user_id';

//     protected $fillable = ['id_level', 'username', 'nama', 'password'];
    
//     public function level(): BelongsTo{
//         return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
//     }
// }
