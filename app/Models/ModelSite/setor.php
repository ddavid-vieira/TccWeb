<?php

namespace App\Models\ModelSite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setor extends Model
{
    protected $table = 'setor';
    protected $fillable  = ['CodSetor', 'nome'];
    protected $primaryKey = 'CodSetor';
    use HasFactory;

    public  function relSalas()
    {
        return $this->hasMany(sala::class, 'CodSetor');
    }
}
