<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Services\PessoasService;

class PessoasController extends BaseController
{
    protected PessoasService $service;

    public function __construct(PessoasService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function update(Request $request)
    {
        return $this->service->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->service->destroy($request);
    }
}
