<?php  

namespace App\Repositories\Categorias;

use App\Models\Categorias;
use App\Repositories\BaseRepository;

class CategoriasRepository extends BaseRepository
{
    public function getModel(){
        return new Categorias();
    }

    public function findByState($activo){
        return $this->getModel()->where('activo',$activo)->get();
    }
}




?>