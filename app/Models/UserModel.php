<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = ['id_level', 'username', 'nama', 'password'];
    
    public function level(): BelongsTo{
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
    }
}
