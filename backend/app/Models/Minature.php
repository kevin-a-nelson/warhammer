<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minature extends Model
{
    use HasFactory;

    protected $fillable = [
        'newRecruitId',
        'name',
        'from',
        'cost',
        'movement',
        'toughness',
        'armor_save',
        'wounds',
        'leadership',
        'objective_control'
    ];
}
