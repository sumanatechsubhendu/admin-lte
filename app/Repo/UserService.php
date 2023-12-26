<?php

namespace App\Repo;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
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
        $user->assignRole($data['role_id']);
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
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.status',
                'users.created_at'
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

            if ($user->status) {
                //$status = "<i class=\"fas fa-times-circle color-green\"></i>";
                $status = "<button type=\"button\" class=\"btn btn-block btn-success btn-sm\">
                Active</button>";
                $status = "<span class=\"badge badge-primary\">Active</span>";
            } else {
                //$status = "<i class=\"fas fa-check-circle color-green\"></i>";
                $status = "<span class=\"badge badge-warning\">In Active</span>";
            }


            $full_name = $user->first_name . ' ' . $user->last_name;


            $editUrl = route('users.edit', [$user->id]);
            $editButton = '<a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                <i class="fas fa-pencil" title="Edit"></i>
            </a>&nbsp;';
            // $editButton = '<button data-id="' . $user->id . '" class="btn btn-warning btn-sm edit-btn">
            //     <i class="fas fa-pencil" title="Edit"></i>
            // </button>&nbsp;';
            // Delete button
            $deleteButton = '<button data-id="' . $user->id . '" class="btn btn-danger btn-sm delete-btn">
                <i class="fas fa-trash" title="Delete"></i>
            </button>';
           /* $deleteUrl = route('delete-user', [$user->id]);
            $deleteButton = '<a href="' . $deleteUrl . '"><button class="btn btn-danger btn-sm">
                <i class="fas fa-trash" title="Delete"></i>
            </button></a>';*/

            // Output
            $action = $editButton . $deleteButton;
            $data[] = [
                "id" => $user->id,
                "first_name" => $full_name,
                "email" => $user->email,
                "status" => $status,
                "role" => $user->role,
                "created_at" => Carbon::parse($user->created_at)->timezone('Asia/Kolkata')->format('Y-m-d'),
                "action" => $action,
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
