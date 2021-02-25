<?php

namespace App\Models\ModelSite;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patrimonio extends Model
{
    protected $table = "patrimonio";
    protected $fillable = ['CodPatrimonio', 'CodSala', 'DataTombamento', 'DataGarantia', 'Denominacao', 'Marca', 'Estado', 'Finalidade', 'Depreciavel', 'Valor'];
    protected $primaryKey = 'CodPatrimonio';
    public $timestamps = false;
    use HasFactory;
    public  function relSalas()
    {
        return $this->hasOne(sala::class, 'CodSala');
    }
}
