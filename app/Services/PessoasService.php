<?php

namespace App\Services;

use App\Repositories\PessoasRepository;
use Illuminate\Http\Request;

class PessoasService
{
    protected PessoasRepository $repository;

    public function __construct(PessoasRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(Request $request)
    {
        $pessoa = json_decode($request['models']);
        unset($pessoa[0]->id);
        $pessoa[0]->nascimento = implode('-', array_reverse(explode('/', $pessoa[0]->nascimento_br)));
        return $this->repository->store((array)$pessoa[0]);
    }

    public function update(Request $request)
    {
        $pessoa = json_decode($request['models']);

        unset($pessoa[0]->created_at);
        unset($pessoa[0]->updated_at);

        $pessoa[0]->nascimento = $pessoa[0]->nascimento_br;

        if (!intval($pessoa[0]->pais)) unset($pessoa[0]->pais);

        unset($pessoa[0]->pais_id);
        unset($pessoa[0]->País_input);
        unset($pessoa[0]->nascimento_br);

        return $this->repository->update((array)$pessoa[0]);
    }

    public function destroy(Request $request)
    {
        $pessoa = json_decode($request['models']);
        return $this->repository->destroy((array)$pessoa[0]);
    }
}
