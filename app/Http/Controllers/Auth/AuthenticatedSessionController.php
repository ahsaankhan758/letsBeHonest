<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Validator;


class AuthenticatedSessionController extends Controller
{
    public function storeLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|',
            'password' => 'required',
        ],
        [
            'email.required' => 'Email is Required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is Required.',
        ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials.'
        ], 401);
    }
    $user = Auth::user();

    $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'You have been Logged In Successfully.',
            'token' => $token,
            'user' => $user
        ]);
    }
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|',
            'password' => 'required',
        ],
        [
            'email.required' => 'Email is Required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is Required.',
        ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $request->authenticate();

        $request->session()->regenerate();

        // return redirect()->intended(route('dashboard', absolute: false));
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        return response()->json([
            'success' => true,
            'message' => 'You have been Logged In Successfully.'
            ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        // Auth::guard('web')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // Auth::logout();
        $request->user()->currentAccessToken()->delete();
        // return redirect('/');
        return response()->json([
            'success' => true,
            'message' => 'You have been Logged Out Successfully.'
            ]);
    }
}
