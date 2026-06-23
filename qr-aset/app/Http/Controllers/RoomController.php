<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::withCount('assets')->orderBy('nama_ruangan')->get();
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'kode_ruangan' => 'required|unique:rooms',
            'nama_ruangan' => 'required',
            'gedung' => 'nullable',
            'lantai' => 'nullable',
            'deskripsi' => 'nullable',
        ]);

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $room->load('assets');
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'kode_ruangan' => 'required|unique:rooms,kode_ruangan,' . $room->id,
            'nama_ruangan' => 'required',
            'gedung' => 'nullable',
            'lantai' => 'nullable',
            'deskripsi' => 'nullable',
        ]);

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil dihapus!');
    }
}
