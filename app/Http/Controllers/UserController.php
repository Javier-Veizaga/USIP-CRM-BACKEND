<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // GET /users
    public function index(Request $request)
    {
        $q = User::query()->with('role');

        // filtros opcionales: ?search=...&role=executive&active=1
        if ($search = $request->input('search')) {
            $like = '%'.$search.'%';
            $q->where(function ($qq) use ($like) {
                $qq->where('first_name','like',$like)
                   ->orWhere('last_name','like',$like)
                   ->orWhere('maternal_last_name','like',$like)
                   ->orWhere('email','like',$like)
                   ->orWhere('phone','like',$like);
            });
        }

        if ($roleCode = $request->input('role')) {
            $q->withRole($roleCode);
        }

        if (!is_null($request->input('active'))) {
            $q->where('is_active', (bool) $request->boolean('active'));
        }

        $users = $q->orderBy('id','desc')->paginate($request->integer('per_page', 15));

        return UserResource::collection($users);
    }

    // POST /users
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data); // password se hashea por el mutator
        $user->load('role');

        return (new UserResource($user))->additional(['message' => 'User created'])->response()->setStatusCode(201);
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
        $data = $request->validated();
        $user->update($data); // si viene password, se hashea por el mutator
        $user->load('role');

        return (new UserResource($user))->additional(['message' => 'User updated']);
    }

    // DELETE /users/{user}
    public function destroy(User $user)
    {
        // Si luego usas SoftDeletes, aquí iría $user->delete() lógico.
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }
}
