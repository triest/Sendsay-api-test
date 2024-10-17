<?php

namespace App\Http\Controllers;

use App\Services\SandayService\SendsayService;

class SundSayTestController extends Controller
{
    public SendsayService $sandsayService;

    /**
     * @param SendsayService $sandsayService
     */
    public function __construct(SendsayService $sandsayService)
    {
        $this->sandsayService = $sandsayService;
    }


    public function test()
    {
        $this->sandsayService->login();
    }
}
