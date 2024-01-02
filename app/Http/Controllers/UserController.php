<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
        $successMessage = session('success');

        $useService = new CommonService();
        $roleList = $useService->getRolesList();
        return Inertia::render('Admin/User/Index', [
            'status' => $successMessage,
            'roleList' => $roleList
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
    public function store(CreateUserRequest $request, UserService $userService)
    {
        $data = $request->validated();

        $user = $userService->store($data);

        //return Redirect::route('users.index');
        return redirect()->route('users.index')
            ->with('success', 'User added successfully.');
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
            'role' => $user->role,
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
    public function update(UpdateUserRequest $request, User $user,  UserService $userService)
    {
       // 'password' => ['sometimes', 'required', 'confirmed', Rules\Password::defaults()],
       $data = $request->validated();
       $user = $userService->update($user, $data);

        // return redirect()->route('users.index')
        //     ->with('success', 'User updated successfully.');
        // return [
        //     'status' => 'success',
        //     'response' => $user,
        //     'msg' => 'User deleted successfully.',
        // ];
        $useService = new CommonService();
        $roleList = $useService->getRolesList();
        return Inertia::render('Admin/User/Index', [
            'status' => 'success',
            'response' => $user,
            'msg' => 'User deleted successfully.',
            'roleList' => $roleList
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user) {
            $user->delete();

            //return Redirect::route('users.index')->with('status', 'User deleted successfully.');
            return [
                'status' => 'success',
                'msg' => 'User deleted successfully.',
            ];
        } else {
            return [
                'status' => 'fail',
                'msg' => 'User not deleted..',
            ];
        }
    }

    public function getUserList(Request $request)
    {
        $input = $request->all();
        $useService = new UserService();
        $response = $useService->getAjaxUserList($input);
        echo json_encode($response);

    }
}
