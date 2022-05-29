<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    
    use HasFactory;

    public $timestamps = false;
    public $primaryKey = 'id_pedido';

    protected $fillable  = [
        'id_cliente',
        'id_produto',
        'status_pedido'
    ];

    public function produto() {
        return $this->hasOne(Produto::class, 'id_produto', 'id_produto');
    }

    public function cliente() {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

}