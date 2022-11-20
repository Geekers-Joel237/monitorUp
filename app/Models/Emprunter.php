<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunter extends Model
{
    use HasFactory;
    protected $fillable = [
        'dateDebut',
        'heureDebut',
        'duree',
        'etatEmprunt',
        'isValider',
        'ressource_id',
        'user_id'
    ];
}
