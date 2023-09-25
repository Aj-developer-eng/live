<?php

namespace App\Http\Controllers;

use App\Models\fee;
use Illuminate\Http\Request;
use App\Repository\Interface\FeeInterface;


class FeeController extends Controller
{
    private $FeeRepository;

    public function __construct(FeeInterface $FeeRepository)
    {
$this->FeeRepository = $FeeRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => $this->FeeRepository->getAllFee(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // dd($id);
        return response()->json([
            'data' => $this->FeeRepository->updateFee($id, $request->all()),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
