<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

        protected $table = 'usuarios';
        protected $primaryKey = 'id';
        protected $useAutoIncrement = true;
        protected $returnType = 'array';
        protected $useSoftDeletes = false;

        protected $fillable = ['usuario', 'password', 'nombre', 'idCaja', 'idRol', 'activo'];

        protected $useTimestamps = true;
        protected $createdField = 'fecha_creacion';
        protected $updatedField = 'fecha_modificacion';
        protected $deletedField = '';



}
