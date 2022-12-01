<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {


            $user = auth()->user();

            // $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            // dd(Passport::hasScope('place-orders'));

            $permissions = [];
            foreach ($user->roles as $role) {
                $permissions[0] = $role->permissions->pluck('name')->toArray();
            }

            $token = $user->createToken('My Token', $permissions[0])->accessToken;

            $data = [
                "name" => $user->name,
                "email" => $user->email,
                "roles" => $user->roles,
                "accessToken" => $token
            ];

            return response()->json([
                'status' => 200,
                'success' => true,
                'data' => $data,
                'message' => 'logged in successfully',
            ], 200);
        }

        return false;
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
