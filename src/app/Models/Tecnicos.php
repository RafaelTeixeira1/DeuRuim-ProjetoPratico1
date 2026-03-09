<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tecnicos extends Model
{
    protected $fillable = ['nome', 'email', 'especialidade'];

    public function chamados()
    {
        return $this->hasMany(Chamados::class, 'tecnico_id');
    }   
}
