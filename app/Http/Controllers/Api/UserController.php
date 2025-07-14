<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Services\Api\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $perPage = (int) request()->query('per_page', 10);
        $page = (int) request()->query('page', 1);

        $users = $this->userService->getAllUsers($perPage, $page);

        return response()->json($users, 200);
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $this->userService->createUser($request->validated());

            return response()->json(['message' => 'User created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $user = $this->userService->getUserById($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $user = $this->userService->getUserById($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $this->userService->updateUser($id, $request->validated());

            return response()->json(['message' => 'User updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $user = $this->userService->getUserById($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $this->userService->deleteUser($id);

            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
