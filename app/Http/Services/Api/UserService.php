<?php

namespace App\Http\Services\Api;

use Illuminate\Support\Facades\DB;

class UserService
{
    public function getAllUsers($perPage, $page)
    {
        $offset = ($page - 1) * $perPage;
        return DB::select('CALL get_all_users(?, ?)', [$perPage, $offset]);
    }

    public function createUser(array $data)
    {
        return DB::statement('CALL create_user(?, ?, ?)', [
            $data['first_name'],
            $data['last_name'],
            $data['email']
        ]);
    }

    public function getUserById($id)
    {
        return DB::select('CALL get_user_by_id(?)', [$id]);
    }

    public function updateUser($id, array $data)
    {
        return DB::statement('CALL update_user(?, ?, ?, ?)', [
            $id,
            $data['first_name'],
            $data['last_name'],
            $data['email']
        ]);
    }

    public function deleteUser($id)
    {
        return DB::statement('CALL delete_user(?)', [$id]);
    }
}