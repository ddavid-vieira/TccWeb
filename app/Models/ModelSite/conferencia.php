<?php

namespace App\Models\ModelSite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conferencia extends Model
{
    protected $table = 'conferencia';
    protected $fillable = ['Idconferencia','CodSetor','NomeSetor', 'CodSala','Sala','Data'];
    protected $primaryKey ='Idconferencia';
    public $timestamps= false;
    use HasFactory;
}
