<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Models\Pet\Pet;
use App\Services\Pet\PetCategoryService;
use App\Services\Pet\PetService;

class PetController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     */
    public function store(StorePetRequest $request,PetService $petService)
    {
        return $petService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePetRequest $request, Pet $pet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        //
    }
}
