<?php
namespace App\Repositories\Roles;

use App\Models\Roles;
use App\Repositories\BaseRepository;

class RolesRepository extends BaseRepository
{
    public function getModel()
    {
        return new Roles();
    }

    public function findByState($activo){
        return $this->getModel()->where('activo',$activo)->get();
    }
}