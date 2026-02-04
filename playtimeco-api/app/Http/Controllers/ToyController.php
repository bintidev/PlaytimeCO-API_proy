<?php

namespace App\Http\Controllers;

use App\Models\Toy;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

        $toy = $request->validate([
            'supervisor' => 'nullable|integer',
            'alias' => 'required|string|max:100',
            'name' => 'required|string|max:50',
            'subject' => 'required|integer',
            'status' => 'required|string',
            'creation_date' => 'required|date',
            'species' => 'required|string|max:100',
        ]);

        if(!$toy) {

            return response()->json([
                'status' => false,
                'message' => 'Unable to store Toy.'
            ], 500);

        } else {

            $newToy = Toy::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Toy stored successfully.',
                'toys' => $newToy
            ]);

        }

    }


    /**
     * Display the specified toy.
     */
    public function show(Toy $toy)
    {

        $display = Toy::find($toy->id);

        if(!$display) {

            return response()->json([
                'status' => false,
                'message' => 'Toy not found.'
            ], 404);

        } else {

            return response()->json(['toy' => $display]);

        }
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
    public function update(Request $request, Toy $toy)
    {
        $request->validate([
            'supervisor' => 'nullable|integer',
            'alias' => 'required|string|max:100',
            'name' => 'required|string|max:50',
            'subject' => 'required|integer',
            'status' => 'required|string',
            'creation_date' => 'required|date',
            'species' => 'required|string|max:100',
        ]);

        if(!$toy->update($request->all())) {

            return response()->json([
                'status' => false,
                'message' => 'Unable to update toy.'
            ], 404);

        } else {

            return response()->json([
                'status' => true,
                'message' => 'Toy updated successfully.',
                'toy' => $toy
            ]);

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Toy $toy)
    {

        if(!$toy->delete()) {

            return response()->json([
                'status' => false,
                'message' => 'Unable to delete toy.'
            ], 404);

        } else {

            return response()->json([
                'status' => true,
                'message' => 'Toy deleted successfully',
                'toys' => $toy
            ]);

        }
    }
}
