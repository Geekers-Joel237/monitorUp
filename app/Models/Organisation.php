<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomOraganisation'
    ];

    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function ressources()
    {
        return $this->hasMany(Ressource::class);
    }
}
