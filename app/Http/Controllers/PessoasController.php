<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoasStoreRequest;
use App\Http\Requests\PessoasUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Services\PessoasService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PessoasController extends BaseController
{
    protected PessoasService $service;

    public function __construct(PessoasService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $result =  $this->service->index();
        return response()->json($result);
    }

    public function store(Request $request): JsonResponse
    {
        $dados = json_decode($request['models']);

        $validator = Validator::make((array) $dados[0], (new PessoasStoreRequest())->rules());

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $erro) {
                $errors[] = $erro;
            }

            return response()->json([
                'dados' => null,
                'erro' => $errors,
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $result =  $this->service->store($dados);
        return response()->json($result);
    }

    public function update(Request $request): JsonResponse
    {
        $dados = json_decode($request['models']);

        $validator = Validator::make((array) $dados[0], (new PessoasUpdateRequest())->rules());

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $erro) {
                $errors[] = $erro;
            }

            return response()->json([
                'dados' => null,
                'erro' => $errors,
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $result =  $this->service->update($dados);
        return response()->json($result);
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->service->destroy($request);
        return response()->json($result);
    }
}
