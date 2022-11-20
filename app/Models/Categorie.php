<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'organisation_id'
    ];

    public function ressources()
    {
        return $this->hasMany(Ressource::class);
    }
}
