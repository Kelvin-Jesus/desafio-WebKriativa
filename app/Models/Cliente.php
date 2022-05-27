<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    
    use HasFactory;

    public $timestamps = false;
    public $primaryKey = 'id_cliente';

    protected $fillable  = [
        'nome_cliente'
    ];

}