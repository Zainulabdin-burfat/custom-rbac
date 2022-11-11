<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('list-users')) {
            $users = User::get(['id', 'name', 'email'])->map->formatIndex()->toArray();
            return view('user.index', ['users' => $users]);
        }


        return abort(401, "Access Denied");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('create-users')) {
            return view('user.create');
        }

        return abort(401, "Access Denied");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        if (Auth::user()->can('create-users')) {
            User::create([
                "name" => $request->name,
                "email" => $request->eRoleUsermail,
                "password" => bcrypt($request->password)
            ]);

            return $this->index();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (Auth::user()->can('list-users')) {
            return view('user.show', ['user' => $user->formatIndex()]);
        }

        return abort(401, "Access Denied");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->can('edit-users')) {
            $roles = Role::all();
            return view('user.edit', compact(['user', 'roles']));
        }

        return abort(401, "Access Denied");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (Auth::user()->can('edit-users')) {
            $user->name  = $request->name;
            $user->email = $request->email;

            if (isset($request->roles) && !empty($request->roles)) {
                UserRole::where('user_id', $user->id)->delete();

                foreach ($request->roles as $roleId)
                    if ($roleId > 0)
                        UserRole::create(['user_id' => $user->id, 'role_id' => $roleId]);
            }

            $user->save();

            return $this->index();
        }

        return abort(401, "Access Denied");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->can('edit-users')) {
            if ($user->can('delete-tasks')) {
                $user->delete();

                return $this->index();
            }
        }

        return abort(401, "Access Denied");
    }
}
