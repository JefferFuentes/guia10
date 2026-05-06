<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'nombre',
        'duracion',
    ];

    public function aulas()
    {
        return $this->belongsToMany(Aula::class);
    }
}
