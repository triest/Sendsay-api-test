<?php

namespace App\Http\Controllers;

use App\DTO\PetDto;
use App\Http\Requests\StorePetRequest;
use App\Services\Pet\PetCategoryService;
use App\Services\Pet\PetService;

class PetController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('pet.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PetCategoryService $petService)
    {
        $categories = $petService->index();

        return view('pet.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(StorePetRequest $request, PetService $petService): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $ip = $request->ip();

        if($petService->store(new PetDto(...$request->validated()),$ip)){
            return view('pet.create-success');
        }

        return view('pet.create-error'); ;
    }


    public function confirmation(string $token, PetService $service)
    {
        $result = $service->confirmation($token);

        if ($result) {
            return view('pet.success');
        } else {
            return view('pet.error');
        }
    }
}
