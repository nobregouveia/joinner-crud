<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Services\PaisesService;

class PaisesController extends BaseController
{
    /**
     * @var PaisesService
     */
    protected $service;

    public function __construct(PaisesService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

}
