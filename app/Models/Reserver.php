<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserver extends Model
{
    use HasFactory;
    protected $fillable = [
        'dateDebut',
        'heureDebut',
        'duree',
        'etatReservation',
        'ressource_id',
        'user_id'
    ];
}
