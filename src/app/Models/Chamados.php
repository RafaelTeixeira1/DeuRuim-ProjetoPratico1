<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamados extends Model
{
    protected $fillable = [
        'titulo', 'descricao', 'prioridade', 'status', 'data_abertura', 'tecnico_id', 'categoria_id'
    ];

    public function tecnico()
    {
        return $this->belongsTo(Tecnicos::class, 'tecnico_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }   
}
