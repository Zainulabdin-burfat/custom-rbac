<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {


            $user = auth()->user();

            // dd(Passport::hasScope('place-orders'));

            $permissions = [];
            foreach ($user->roles as $role) {
                $permissions[] = $role->permissions->pluck('name')->toArray();
            }

            // converts multi-dimention array into single array
            $permissions = call_user_func_array('array_merge', $permissions);

            $token = $user->createToken('My Token', array_unique($permissions))->accessToken;

            // $response = Http::post('http://custom-rbac.test/oauth/token',
            //     [
            //         'email' => $request->email,
            //         'password' => $request->password,
            //         'grant_type' => 'password',
            //         'client_id' => '3',
            //         'client_secret' => 'elqUDHOkvAympC1jDHByNkuKPlQPURO1gkqWnoS4',
            //         'scope' => ''
            //     ]
            // );

            // dd($response);

            $data = [
                "name" => $user->name,
                "email" => $user->email,
                // "roles" => $user->roles,
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
}
