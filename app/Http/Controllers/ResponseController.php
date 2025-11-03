<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResponseRequest;
use App\Http\Requests\UpdateResponseRequest;
use App\Http\Resources\ResponseResource;
use App\Models\Response;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response as Http;

class ResponseController extends Controller
{
    public function index()
    {
        $rows = Response::orderBy('response')->get();
        return ResponseResource::collection($rows);
    }

    public function store(StoreResponseRequest $request)
    {
        $row = Response::create($request->validated());

        return (new ResponseResource($row))
            ->additional(['message' => 'Response created'])
            ->response()
            ->setStatusCode(Http::HTTP_CREATED);
    }

    public function show(Response $response)
    {
        return new ResponseResource($response);
    }

    public function update(UpdateResponseRequest $request, Response $response)
    {
        $response->update($request->validated());

        return (new ResponseResource($response))
            ->additional(['message' => 'Response updated']);
    }

    public function destroy(Response $response)
    {
        try {
            $response->delete();
            return response()->noContent();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                return response()->json([
                    'message' => 'No se puede eliminar: esta respuesta es referenciada por acciones.'
                ], Http::HTTP_CONFLICT);
            }
            throw $e;
        }
    }
}
