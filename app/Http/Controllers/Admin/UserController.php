<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('gender', 'like', '%' . $request->search . '%');
        })
        ->latest()
        ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

 public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'age' => 'nullable|integer',
        'gender' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'location' => 'nullable|string|max:255',
        'height' => 'nullable|string|max:50',
        'weight' => 'nullable|string|max:50',
        'vibe_id' => 'nullable|string|max:100',
        'instagram_url' => 'nullable|url|max:255',
        'is_active' => 'required|boolean',
        'profile_photo' => 'nullable|image|max:2048',
    ]);

    // Update main fields
    $user->update($request->only([
        'name','age','gender','email','location','height','weight','vibe_id','instagram_url','is_active'
    ]));

    // Handle profile photo
    if ($request->remove_photo && $user->profile_photo) {
        Storage::delete($user->profile_photo);
        $user->profile_photo = null;
    }

    if ($request->hasFile('profile_photo')) {
        if ($user->profile_photo) {
            Storage::delete($user->profile_photo);
        }
        $user->profile_photo = $request->file('profile_photo')->store('users');
    }

    $user->save();

    return redirect()->route('users.index', $user->id)
                     ->with('success', 'User updated successfully!');
}

   public function destroy(User $user)
{
    if ($user->profile_photo) {
        Storage::disk('public')->delete($user->profile_photo);
    }

    $user->delete();

    return redirect()->route('users.index')
        ->with('success', 'User deleted successfully.');
}
}