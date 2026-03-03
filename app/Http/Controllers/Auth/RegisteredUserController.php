<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'gender' => 'required',
            'interested' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'vibe_id' => 'required|exists:vibes,id',
            'name' => 'required',
            'profile_photo' => 'required',
            'instagram_url' => 'required|url',
        ],
        [
            'gender.required' => 'Gender is Required.',
            'interested.required' => 'Interested In Required',
            'email.required' => 'Email is Required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is Required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'vibe_id.required' => 'Vide is Required.',
            'vibe_id.exists'   => 'Selected Vibe is invalid.',
            'name.required' => 'Name is Required.',
            'profile_photo.required' => 'You must upload profile picture',
            'instagram_url.required' => 'Provide Instagram URL',
            'instagram_url.url' => 'Provide Valid Instagram URL',
        ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        //Auth::login($user);
        return response()->json([
            'success' => true,
            'message' => 'Your Account has been Created and You have been Logged In.'
            ]);
    }

}
