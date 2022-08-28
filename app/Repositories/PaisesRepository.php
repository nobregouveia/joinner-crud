<?php

namespace App\Repositories;

use App\Models\Pais;

class PaisesRepository
{

    protected Pais $model;

    public function __construct(Pais $model)
    {
        $this->model = $model;
    }

    public function index(): object
    {
        return $this->model->select('id as pais_id', 'nome as pais')->get();
    }
}
