<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    // GET /roles
    public function index()
    {
        // Como tendrás pocos roles, sin paginar
        $roles = Role::orderBy('id')->get();
        return RoleResource::collection($roles);
    }

    // POST /roles
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());

        return (new RoleResource($role))
            ->additional(['message' => 'Role created'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    // GET /roles/{role}
    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    // PUT/PATCH /roles/{role}
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return (new RoleResource($role))
            ->additional(['message' => 'Role updated']);
    }

    // DELETE /roles/{role}
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return response()->noContent(); // 204
        } catch (QueryException $e) {
            // Postgres FK violation = 23503
            if ($e->getCode() === '23503') {
                return response()->json([
                    'message' => 'Cannot delete role: it is in use by one or more users.'
                ], Response::HTTP_CONFLICT);
            }
            throw $e;
        }
    }
}
