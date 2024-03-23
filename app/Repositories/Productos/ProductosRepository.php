<?php

namespace App\Repositories\Productos;

use App\Models\Productos;
use App\Repositories\BaseRepository;

class ProductosRepository extends BaseRepository
{
    public function getModel()
    {
        return new Productos;
    }

    public function findByState($activo){
        return $this->getModel()->where('activo',$activo)->get();
    }
}