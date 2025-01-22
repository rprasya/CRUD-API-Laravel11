<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $person = Person::all();

        return response()->json([
            'status' => true,
            'message' => 'data berhasil ditemukan',
            'data' => $person
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi error!',
                'errors' => $validator->errors()
            ],422);
        }

        $person = Person::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dimasukkan',
            'data' => $person
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $person = Person::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditemukan',
            'data' => $person
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validasi error!',
                'errors' => $validator->errors()
            ],422);
        }

        $person = Person::findOrFail($id);
        $person->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbaiki',
            'data' => $person
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $person = Person::findOrFail($id);
        $person->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ], 204);
    }
}
