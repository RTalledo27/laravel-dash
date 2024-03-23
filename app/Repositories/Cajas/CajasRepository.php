<?php

namespace App\Repositories\Cajas;

use App\Models\Cajas;
use App\Repositories\BaseRepository;

class CajasRepository extends BaseRepository
{
     public function getModel()
     {
        return new Cajas();
     }

     public function findByState($activo){
        return $this->getModel()->where('activo',$activo)->get();
     }
}