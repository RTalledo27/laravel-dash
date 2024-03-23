<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    protected $table = 'ofertas';
    protected $primeryKey = 'id';
    protected $autoIncrement = true;
    protected $fillable = ['nombre', 'imgOferta','activo'];
    protected $createdAt = 'fecha_creacion';

protected $updatedAt = 'fecha_modificacion';

}
