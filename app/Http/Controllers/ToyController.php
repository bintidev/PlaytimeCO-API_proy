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
    /*public function create(Request $request)
    {

    }*/

    /**
     * Store a newly experiment monitoring in storage
     */
    public function store(Request $request)
    {

        $valid = $request->validate([
            'supervisor' => 'nullable|string|max:255',
            'alias' => 'required|string|max:255',
            'name' => 'required|string|max:50',
            'subject' => 'required|string|max:255',
            'status' => 'required|enum:[Alive,Deceased]',
            'creation_date' => 'required|date',
            'species' => 'required|string|max:100',
        ]);

        if ($valid) {
            $toy = Toy::create($valid);
            $msj = "Toy successfully added to monitoring.";
            $code = 200;
        } else {
            $toy = null;
            $msj = "There was an error adding the toy to monitoring.";
            $code = 500;
        }
        
        return response()->json([
            'message' => $msj,
            'toy' => $toy
        ], $code);

    }


    /**
     * Display the specified toy.
     */
    public function show(Toy $toy)
    {
        $toy->validate([
            'supervisor' => 'nullable|string',
            'alias' => 'required|string',
            'name' => 'required|string',
            'subject' => 'required|string',
            'status' => 'required|enum:[Alive,Deceased]',
            'creation_date' => 'required|date',
            'species' => 'required|string'
        ]);

        $display = Toy::find($toy->id);

        return response()->json(['toy' => $display]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /*public function edit(Toy $toy)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     */
    /*public function update(Request $request, Toy $toy)
    {
        //
    }*/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Toy $toy)
    {
        $toy->delete();

        return response()->json(['message' => 'Toy successfully removed from monitoring.']);
    }
}
