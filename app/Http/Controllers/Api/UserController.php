<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function index() : JsonResponse
    {
        $data = [
            "status" => 200,
            "message" => "record fetched successfully",
            "data" => User::all()
        ];

        return response()->json($data);
    }

    public function request_one()
    {
        // $response = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Authorization' => 'Bearer ' . $accessToken,
        // ])->get('https://passport-app.test/api/user');

        // return $response->json();
    }
}
