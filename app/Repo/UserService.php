<?php

namespace App\Repo;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Hash;

class UserService extends CommonService
{

    public function store(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'status' => isset($data['status']) ? $data['status'] : true,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ])->assignRole($data['role_id']);
    }

    public function update(User $user, array $data)
    {
        $user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'status' => $data['status'],
        ]);
        // Revoke the current role (replace 'old_role' with the actual role name)
        //$user->removeRole($user->role);
        $user->roles()->detach();
        $user->assignRole($data['role_id']);
       // $user->roles()->sync($data['role_id']);
        //$user->syncRoles([$user->role, $data['role_id']]);
        return $user;
    }

    public function getAjaxUserList($input)
    {
        $draw = $input['draw'];
        $row = $input['start'];
        $rowperpage = $input['length']; // Rows display per page
        $columnIndex = $input['order'][0]['column']; // Column index
        $columnName = $input['columns'][$columnIndex]['data']; // Column name
       // $columnName = $input['columns'][0]['data']; // Column name
        $columnSortOrder = $input['order'][0]['dir']; // asc or desc
        $searchValue = $input['search']['value']; // Search value
        $user_status = [
            0 => 'deleted',
            1 => 'unverified',
            2 => 'verified',
            3 => 'Login Blocked'
        ];
        ## Search
        // if ($columnName != 'id') {
        //     $columnName = 'id';
        // }

        $role_id = $input['role_id'] ?? null;

        $adminQuery = User::query();
        $adminQuery
            ->select(
                'users.id',
                DB::raw('CONCAT(users.first_name, " ", users.last_name) as full_name'),
                'users.email',
                'users.status',
                DB::raw('DATE_FORMAT(users.created_at, "%Y-%m-%d") as formated_created_at')
            )
            ->where(function ($query) use ($searchValue) {
                if (!empty($searchValue)) {
                    $query->where('users.first_name', 'LIKE', $searchValue . '%')
                        ->orWhere('users.email', 'LIKE', $searchValue . '%');
                }
            })
            ->when($role_id != "0" && $role_id != "", function ($statusQuery) use ($role_id) {
                return $statusQuery->where('users.role_id', $role_id);
            });
        //->orderByRaw('status = 1 desc')
        $query = $adminQuery
            ->orderBy($columnName, $columnSortOrder);
        $count = $query->count();
        $results = $query
            ->limit($rowperpage)
            ->offset($row)
            ->get();
        $data = array();

        foreach ($results as $key => $user) {
            $data[] = [
                "id" => $user->id,
                "first_name" => $user->full_name,
                "email" => $user->email,
                "status" => $user->status,
                "role" => $user->role,
                "created_at" => $user->formated_created_at,
            ];
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $count,
            "iTotalDisplayRecords" => $count,
            "aaData" => $data
        );
        return $response;
    }
}
