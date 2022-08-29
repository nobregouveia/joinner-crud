<?php

namespace App\Repositories;

use App\Models\Pessoa;
use Illuminate\Database\Eloquent\Collection;

class PessoasRepository
{
    protected Pessoa $model;

    public function __construct(Pessoa $model)
    {
        $this->model = $model;
    }

    public function index(): Collection
    {
        $fields = [
            'pessoas.id',
            'pessoas.nome',
            'pessoas.nascimento as nascimento_br',
            'pessoas.genero',
            'pais.nome as pais',
            'pais.id as pais_id'
        ];

        $result = $this->model->select($fields)
            ->from('pessoas')
            ->join('pais', 'pais.id', 'pessoas.pais')
            ->get();

        return $result;
    }

    public function store(array $dados): Pessoa
    {
        return $this->model->create($dados);
    }

    public function update(array $dados): int
    {
        return $this->model->where('id', $dados['id'])->update($dados);
    }

    public function destroy(array $dados): int
    {
        return $this->model->where('id', $dados['id'])->delete();
    }
}
