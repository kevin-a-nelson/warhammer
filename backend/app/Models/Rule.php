<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'newRecruitId',
        'name',
        'page',
    ];

    public function minatures()
    {
        return $this->belongsToMany(Minature::class, 'minature_rule');
    }
}
