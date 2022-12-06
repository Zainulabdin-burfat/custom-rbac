<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {


            $user = auth()->user();

            // $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            // dd(Passport::hasScope('place-orders'));

            $permissions = [];
            foreach ($user->roles as $role) {
                $permissions[] = $role->permissions->pluck('name')->toArray();
            }

            // converts multi-dimention array into single array
            $permissions = call_user_func_array('array_merge', $permissions);

            $token = $user->createToken('My Token', array_unique($permissions))->accessToken;

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
