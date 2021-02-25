<?php

namespace App\Models\ModelSite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sala extends Model
{   
    protected $table = 'sala';
    protected $fillable = ['CodSala','CodSetor','nome'];
    protected $primaryKey = 'CodSala';
    use HasFactory;

    public  function relSetores()
    {
        return $this->hasOne(setor::class,'CodSetor');
    }
    public  function relPatrimonio()
    {
        return $this->hasMany(patrimonio::class, 'CodSala');
    }
}
