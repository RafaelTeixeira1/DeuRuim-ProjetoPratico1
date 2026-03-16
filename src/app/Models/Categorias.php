<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $fillable = ['nome', 'sla_horas'];

    public function chamados()
    {
        return $this->hasMany(Chamados::class, 'categoria_id');
    }
}
