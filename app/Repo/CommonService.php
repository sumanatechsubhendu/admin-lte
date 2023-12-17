<?php

/**
 * AUTHOR - rajesh@banksathi.com
 * Purpose - Providing the common functions
 * Owner - Banksathi
 */

namespace App\Repo;

use App\Models\Role;

class CommonService extends BaseService
{

    public $errorMsg = "Something went wrong please try again.";
    public $msg = "success";
    //Return The User Permission For the Modules

    /**
     * Get a list of roles.
     *
     * @return array
     */
    public function getRolesList()
    {
        // Assuming your roles are stored in the "roles" table
        // Adjust the query accordingly based on your database structure
        $roles = Role::pluck('name', 'id')->toArray();

        return $roles;
    }

}
