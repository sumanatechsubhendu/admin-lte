<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repo\CommonService;
use App\Repo\UserService;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $token = csrf_token();

        return Inertia::render('Admin/User/Index', [
            'token' => $token
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $useService = new CommonService();
        $roleList = $useService->getRolesList();
        return Inertia::render('Admin/User/AddUser', [
            'roleList' => $roleList
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => 'required',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'status' => isset($request->status) ? $request->status : true,
            'role_id' => isset($request->role_id) ? $request->role_id : 1,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return Redirect::route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $useService = new CommonService();
        $roleList = $useService->getRolesList();
        return Inertia::render('Admin/User/EditUser', [
            'user' => $user,
            'roleList' => $roleList
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
       // 'password' => ['sometimes', 'required', 'confirmed', Rules\Password::defaults()],
        $user->update(
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id),
                ],
                'role_id' => 'required',
                'status' => 'required',
            ])
        );


        return redirect()->route('users.index')
            ->with('success', 'user was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return Redirect::route('users.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(User $user)
    {
        $user->delete();

        return Redirect::route('users.index')->with('status', 'User deleted successfully.');
    }

    public function getUserList(Request $request)
    {
        $input = $request->all();
        $useService = new UserService();
        $response = $useService->getAjaxUserList($input);
        echo json_encode($response);

    }
}
