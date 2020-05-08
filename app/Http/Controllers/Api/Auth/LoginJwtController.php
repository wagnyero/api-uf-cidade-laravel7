<?php

namespace App\Http\Controllers\Api\Auth;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginJwtRequest;

class LoginJwtController extends Controller
{
    public function login(LoginJwtRequest $request)
    {
        $credentials = $request->all(["email", "password"]);

        if(!$token = auth("api")->attempt($credentials)) {
            $message = new ApiMessages("Unauthorized");
            return response()->json($message->getMessage(), 401);
        }

        return response()->json([
            "token" => $token
        ]);
    }
}
