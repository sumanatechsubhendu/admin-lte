<?php

namespace App\Repo;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;

class UserService extends CommonService
{

    public function getAjaxUserList($input)
    {
        $draw = $input['draw'] ?? null;
        $row = $input['start'] ?? null;
        $rowperpage = $input['length'] ?? 10; // Rows display per page
        $columnIndex = $input['order'][0]['column'] ?? 'id'; // Column index
        //$columnName = $input['columns'][$columnIndex]['data']; // Column name
        $columnName = $input['columns'][0]['data'] ?? 'id'; // Column name
        $columnSortOrder = $input['order'][0]['dir'] ?? 'asc'; // asc or desc
        $searchValue = $input['search']['value'] ?? null; // Search value
        $user_status = [
            0 => 'deleted',
            1 => 'unverified',
            2 => 'verified',
            3 => 'Login Blocked'
        ];
        ## Search
        if ($columnName != 'full_name') {
            $columnName = 'full_name';
        }
        $role_id = $input['role_id'] ?? null;

        $adminQuery = User::query();
        $adminQuery
            ->Join('roles', 'users.role_id', 'roles.id')
            ->select(
                'users.id',
                'users.first_name',
                'users.last_name',
                'users.email',
                'roles.name as role',
                'users.status',
                'users.created_at'
            )
            ->where(function ($query) use ($searchValue) {
                if (!empty($searchValue)) {
                    $query->where('users.first_name', 'LIKE', $searchValue . '%')
                        ->orWhere('users.email', 'LIKE', $searchValue . '%')
                        ->orWhere('roles.name', $searchValue);
                }
            })
            ->when($role_id != "0" && $role_id != "", function ($statusQuery) use ($role_id) {
                return $statusQuery->where('users.role_id', $role_id);
            });

        $query = $adminQuery
            ->orderByRaw('status = 1 desc')
            ->orderBy('id', 'desc');
        $count = $query->count();
        $results = $query
            ->limit($rowperpage)
            ->offset($row)
            ->get();
        $data = array();

        foreach ($results as $key => $user) {

            if ($user->status == "0") {
                $status = "<i class=\"fas fa-check-circle color-green\"></i>";
            } else if ($user->status == '1') {
                $status = "<i class=\"fas fa-times-circle color-green\"></i>";
            }


            $full_name = $user->first_name . ' ' . $user->last_name;
            // $link = route('viewMyBsTeamDeatails', Helpers::encrypt_decrypt($user->id));
            //$full_name = "<a class=\"text-blue-500 hover:text-blue-300\" href=\"$link\" target=\"_blank\"> $full_name</a>";
            //$editUrl = route('users.edit', ['id' => $user->id]);
            $editUrl = '';
            $editButton = '<a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                <i class="fas fa-pencil" title="Edit"></i>
            </a>&nbsp;';
            // Delete button
            $deleteButton = '<button @click="destroy(' . $user->id . ')" class="btn btn-danger btn-sm">
                <i class="fas fa-trash" title="Delete"></i>
            </button>';

            // Output
            $action = $editButton . $deleteButton;
            $data[] = [
                "id" => $user->id,
                "role_id" => $user->role_id,
                "full_name" => $full_name,
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
