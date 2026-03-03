<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vibe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VibeController extends Controller
{
    public function index()
    {
        $vibes = Vibe::latest()->paginate(10);

        return view('admin.vibes.index', compact('vibes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        Vibe::create([
            'name' => $request->name,
            'status' => $request->status,
            'user_id' => Auth::guard('admin')->id(),
        ]);

        return redirect()->route('vibes.index')->with('success', 'Vibe added successfully');
    }

    public function edit(Vibe $vibe)
    {
        return view('admin.vibes.edit', compact('vibe'));
    }

    public function update(Request $request, Vibe $vibe)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $vibe->update($request->all());

        return redirect()->route('vibes.index')->with('success', 'Vibe updated successfully');
    }

    public function destroy(Vibe $vibe)
    {
        $vibe->delete();

        return redirect()->route('vibes.index')->with('success', 'Vibe deleted successfully');
    }
}
