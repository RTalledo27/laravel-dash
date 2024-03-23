<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $useSoftDeletes = false;

    protected $fillable  = ['rol', 'activo'];

    protected $useTimestamps = true;

    protected $createdField = 'fecha_creacion';

    protected $updatedField = 'fecha_modificacion';

    protected $deletedField = '';

    protected $validationRules = [];

    protected $validationMessages = [];

    protected $skipValidation = false;
}
