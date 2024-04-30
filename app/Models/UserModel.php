<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Authenticatable implements JWTSubject
{
    // public function getJWTIdentifier(){
    //     return 'user_id';
    // }
    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    public function level(): BelongsTo{
                return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
            }

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    protected $fillable =['id_level','username','nama','password'];
}