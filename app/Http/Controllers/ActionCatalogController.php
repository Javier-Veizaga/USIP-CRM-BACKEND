<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActionCatalogRequest;
use App\Http\Requests\UpdateActionCatalogRequest;
use App\Http\Resources\ActionCatalogResource;
use App\Models\ActionCatalog;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class ActionCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = ActionCatalog::orderBy('name')->get();
        return ActionCatalogResource::collection($rows);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActionCatalogRequest $request)
    {

        $row = ActionCatalog::create($request->validated());

        return (new ActionCatalogResource($row))
            ->additional(['message' => 'Action type created'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(ActionCatalog $actionCatalog)
    {
        return new ActionCatalogResource($actionCatalog);
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
    public function update(UpdateActionCatalogRequest $request, ActionCatalog $actionCatalog)
    {
        $actionCatalog->update($request->validated());

        return (new ActionCatalogResource($actionCatalog))
            ->additional(['message' => 'Action type updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActionCatalog $actionCatalog)
    {
        try {
            $actionCatalog->delete();
            return response()->noContent();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') { // FK en uso por acciones
                return response()->json([
                    'message' => 'Cannot delete: this action type is referenced by actions.'
                ], Response::HTTP_CONFLICT);
            }
            throw $e;
        }
    }
}
