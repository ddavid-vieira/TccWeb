<?php

namespace App\Models\ModelSite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servidor extends Model
{   
    protected $table = "servidor";
    protected $fillable = ['Matricula', 'Nome', 'Telefone', 'Cpf', 'Senha',];
    protected $primaryKey = 'Matricula';
    use HasFactory;
}
