<?php

namespace App\Services;

use App\Repositories\PaisesRepository;

class PaisesService
{
    protected PaisesRepository $repository;

    public function __construct(PaisesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

}
