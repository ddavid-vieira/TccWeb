<?php

namespace App\Models\ModelSite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conferencia extends Model
{
    protected $table = 'conferencia';
    protected $fillable = ['Idconferencia', 'CodSala','Sala','Matricula','Servidor','Data'];
    protected $primaryKey ='Idconferencia';
    public $timestamps= false;
    use HasFactory;
}
