<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::paginate(10)->withQueryString();

        return Inertia::render('Rooms/Index', [
            'rooms' => $rooms,
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
        $validatedData = $request->validate([
            'name' => 'unique:rooms|required|string|max:255',
            'floor' => 'required|integer',
            'size' => 'required|numeric',
            'window_direction' => 'nullable|string|max:255',
        ]);

        Room::create([
            'name' => $validatedData['name'],
            'floor' => $validatedData['floor'],
            'size' => $validatedData['size'],
            'window_direction' => $validatedData['window_direction'],
        ]);

        return Redirect::route('rooms.index')->with('success', 'Patalpa pridėta sėkmingai!');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
