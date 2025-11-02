<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    // GET /users
    public function index()
    {
        $users = User::with('role')->orderByDesc('id')->get();
        return UserResource::collection($users);
    }


    // POST /users
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->load('role');

        return (new UserResource($user))
            ->additional(['message' => 'User created'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED); // 201
    }

    // GET /users/{user}
    public function show(User $user)
    {
        $user->load('role');
        return new UserResource($user);
    }

    // PUT/PATCH /users/{user}
    public function update(UpdateUserRequest $request, User $user)
        {
            $user->update($request->validated());
            $user->load('role');
            return (new UserResource($user))->additional(['message' => 'User updated']);
        }

    // DELETE /users/{user}
    public function destroy(User $user)
    {
        // Si luego usas SoftDeletes, aquí iría $user->delete() lógico.
        $user->delete();

        return response()->json(['message' => 'User deleted'], Response::HTTP_NO_CONTENT);
    }
}
