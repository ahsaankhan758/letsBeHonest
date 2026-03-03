<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vibe;


class GetVibesController extends Controller
{
    public function getVibes()
    {
        $vibes = Vibe::select('name')->get();

        return response()->json([
            'success' => true,
            'data' => $vibes
        ]);
    }
}
