<?php

namespace App\Modules\Login\Models;

use Illuminate\Support\Facades\DB;

class LoginModel
{
    public function getUserAndRolesByUsername(string|null $username)
    {
        return DB::table('m_user')
            ->join('m_user_role', 'm_user.id_user', '=', 'm_user_role.id_user')
            ->where('username', $username)
            ->get();
    }

}