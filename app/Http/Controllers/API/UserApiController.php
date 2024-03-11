<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UserApiController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($dni)
    {
        $user = User::where('dni', $dni)->first();

        if (!$user) {
            return response()->json(['message' => 'Asistente no encontrado'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($user);
    }
}
