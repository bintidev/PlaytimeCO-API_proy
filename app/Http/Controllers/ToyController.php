<?php

namespace App\Http\Controllers;

use App\Models\Toy;
use Illuminate\Http\Request;

class ToyController extends Controller
{
    /**
     * Display a listing of the toys existing at the moment.
     */
    public function index()
    {
        $toys = Toy::all();
        return response()->json([
            'status' => true,
            'toys' => $toys
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function setup()
    {
        //
    }

    /**
     * Store a newly experiment monitoring in storage
     */
    public function monitor(Request $request)
    {
        $toy = Toy::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Toy in monitoring phase.",
            'toy' => $toy
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function analize(Toy $toy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function process(Toy $toy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function transition(Request $request, Toy $toy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function fail(Toy $toy)
    {
        //
    }
}
