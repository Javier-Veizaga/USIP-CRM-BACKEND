<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::ordeBy('id')->get();
        return RoleResource::collection($roles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());
        return (new RoleResource($role))
            ->additional(['message' => 'Role created'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return (new RoleResource($role))
            ->additional(['message' => 'Role updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return response()->noContent();
        } catch (QueryException $e){
            
            if($e -> getCode() === '23503'){
                return response()->json([
                    'message' => 'No se puede eliminar el rol: está en uso por uno o más usuarios.'
                ], Response::HTTP_CONFLICT);
            }
            throw $e;
        }
    }
}
