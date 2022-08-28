<?php

namespace App\Repositories;

use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PessoasRepository
{
    protected Pessoa $model;

    public function __construct(Pessoa $model)
    {
        $this->model = $model;
    }

    public function index()
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

    public function store(array $dados): JsonResponse
    {
        DB::beginTransaction();

        try {
            $query = $this->model->create($dados);

            DB::commit();

            return response()->json([
                'dados' => $query,
                'erro' => null,
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'dados' => null,
                'erro' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(array $dados): JsonResponse
    {
        DB::beginTransaction();

        try {
            $this->model->where('id', $dados['id'])->update($dados);

            DB::commit();

            return response()->json([
                'dados' => true,
                'erro' => null,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'dados' => null,
                'erro' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(array $dados): JsonResponse
    {
        DB::beginTransaction();

        try {
            $this->model->where('id', $dados['id'])->delete();

            DB::commit();

            return response()->json([
                'dados' => true,
                'erro' => null,
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'dados' => null,
                'erro' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
