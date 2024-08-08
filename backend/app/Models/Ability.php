<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'newRecruitId',
        'description',
        'from'
    ];

    public function minatures()
    {
        return $this->belongsToMany(Minature::class, 'ability_minature');
    }
}
