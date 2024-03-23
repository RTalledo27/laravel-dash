<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $table = 'categorias';

protected $primaryKey = 'id';

protected $autoIncrement = true;

protected $fillable = ['nombre', 'activo'];

public $timestamps = true;

protected $createdAt = 'fecha_creacion';

protected $updatedAt = 'fecha_modificacion';
}

