<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataSourceRequest;
use App\Http\Requests\UpdateDataSourceRequest;
use App\Http\Resources\DataSourceResource;
use App\Models\DataSource;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class DataSourceController extends Controller
{
    public function index()
    {
        return DataSourceResource::collection(
            DataSource::orderBy('name')->get()
        );
    }

    public function store(StoreDataSourceRequest $request)
    {
        $row = DataSource::create($request->validated());

        return (new DataSourceResource($row))
            ->additional(['message' => 'Data source created'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataSource $dataSource)
    {
        return new DataSourceResource($dataSource);
    }

    public function update(UpdateDataSourceRequest $request, DataSource $dataSource)
    {
        $dataSource->update($request->validated());

        return (new DataSourceResource($dataSource))
            ->additional(['message' => 'Data source updated']);
    }

    public function destroy(DataSource $dataSource)
    {
        try {
            $dataSource->delete();
            return response()->noContent();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                return response()->json([
                    'message' => 'Cannot delete: this data source is referenced by prospects.'
                ], Response::HTTP_CONFLICT);
            }
            throw $e;
        }
    }
}
