<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenServico extends Model
{
    protected $fillable = [
        "codigo","titulo", "equipamento_id",
        "tipo", "prioridade", "status", "tecnico",
        "data_abertura", "prazo_limite"
    ];
}
