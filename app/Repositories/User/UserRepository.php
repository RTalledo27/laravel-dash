<?php

namespace App\Repositories\User ;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function getModel()
    {
        return new User();
    }

    public function findByCredentials($usuario, $password){
        return $this->getModel()->where('usuario',$usuario)->where('password',$password)->first();
    }


    public function findByState($activo){
        return $this->getModel()->where('activo',$activo)->get();
    }

}
