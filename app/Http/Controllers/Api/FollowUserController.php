<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class FollowUserController extends Controller
{
    public function followUser(Request $request)
{
    if (!Auth::check()) {
        return response()->json([
            'success' => false,
            'message' => 'Please Login First.'
        ], 401);
    }

    $validator = Validator::make($request->all(), [
        'followingId' => 'required|exists:users,id'
    ],
[
        'followingId.required' => 'Provide Following Id.',
        'followingId.exists' => 'Provide Valid Following Id.',
    ]
    );
    if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
    $followerId = Auth::id();
    $followingId = $request->followingId;

    if ($followerId == $followingId) {
        return response()->json([
            'success' => false,
            'message' => 'You cannot follow yourself.'
        ], 400);
    }

    $alreadyFollowing = Follow::where('follower_id', $followerId)
        ->where('following_id', $followingId)
        ->first();
    $followingUser = User::find($followingId);
    if ($alreadyFollowing) {
        return response()->json([
            'success' => false,
            'message' => 'You are already following ' . $followingUser->name,
        ]);
    }

    Follow::create([
        'follower_id' => $followerId,
        'following_id' => $followingId,
        'status' => 1 
    ]);
    
    return response()->json([
        'success' => true,
        'message' => 'You are now following '. $followingUser->name,
    ]);
}
}
