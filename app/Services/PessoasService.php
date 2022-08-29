<?php

namespace App\Services;

use App\Repositories\PessoasRepository;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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

    public function store(array $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            unset($request[0]->id);
            $request[0]->nascimento = $request[0]->nascimento_br;
            $dados = $this->repository->store((array)$request[0]);

            DB::commit();

            return response()->json([
                'dados' => $dados,
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

    public function update(array $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            unset($request[0]->created_at);
            unset($request[0]->updated_at);

            $request[0]->nascimento = $request[0]->nascimento_br;

            if (!intval($request[0]->pais)) unset($request[0]->pais);

            unset($request[0]->pais_id);
            unset($request[0]->País_input);
            unset($request[0]->nascimento_br);

            $this->repository->update((array)$request[0]);

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

    public function destroy(Request $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $pessoa = json_decode($request['models']);
            $this->repository->destroy((array)$pessoa[0]);

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
