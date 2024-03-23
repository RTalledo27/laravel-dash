<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $fillable = ['codigo', 'nombre', 'precio_compra', 'precio_venta', 'stock', 'cantidad', 'unidad','idCategoria', 'imagen','activo'];
    protected $useTimestamps = true;
    protected $createdAtField = 'fecha_creacion';
    protected $updatedAtField = 'fecha_modificacion';
    protected $deletedAtField = '';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
