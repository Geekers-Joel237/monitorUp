<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomRessource',
        'description',
        'isDisponible',
        'categorie_id',
        'organisation_id'
    ];

    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
