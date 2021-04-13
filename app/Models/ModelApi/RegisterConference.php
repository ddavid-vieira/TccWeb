<?php

namespace App\Models\ModelApi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterConference extends Model
{
    protected $table ='registerconference';
    protected $primaryKey = 'IdRegisterConference';
    public $timestamps = false;
    use HasFactory;
}
