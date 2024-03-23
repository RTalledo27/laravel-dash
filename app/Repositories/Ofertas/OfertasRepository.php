<?php

namespace App\Repositories\Ofertas;

use App\Repositories\BaseRepository;
use App\Models\Oferta;

class OfertasRepository extends BaseRepository
{
    

    public function getModel(){
        return new Oferta;
    }

    public function findByState($activo){
        return $this->getModel()->where('activo',$activo)->get();
    }

}