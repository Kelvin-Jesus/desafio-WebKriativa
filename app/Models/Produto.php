<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    
    use HasFactory;

    public $timestamps = false;
    public $primaryKey = 'id_produto';

    protected $fillable  = [
        'nome_produto',
        'preco'
    ];

    public function pedido() {
        return $this->belongsTo(Pedido::class, 'id_produto');
    }

}