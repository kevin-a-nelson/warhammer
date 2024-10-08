<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Board extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'board_user', 'board_id', 'user_id');
    }

    public function minatures(): BelongsToMany
    {
        return $this->belongsToMany(Minature::class, 'board_minature', 'board_id', 'minature_id');
    }
}
