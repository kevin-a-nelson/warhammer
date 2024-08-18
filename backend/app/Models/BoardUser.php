<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardUser extends Model
{
    use HasFactory;

    protected $table = 'board_user';

    protected $fillable = ['board_id', 'user_id', 'is_owner'];
}
