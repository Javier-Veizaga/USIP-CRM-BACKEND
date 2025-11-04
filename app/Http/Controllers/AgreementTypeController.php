<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgreementTypeRequest;
use App\Http\Requests\UpdateAgreementTypeRequest;
use App\Http\Resources\AgreementTypeResource;
use App\Models\AgreementType;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class AgreementTypeController extends Controller
{
    public function index()
    {
        return AgreementTypeResource::collection(
            AgreementType::orderBy('name')->get()
        );
    }

    public function store(StoreAgreementTypeRequest $request)
    {
        $row = AgreementType::create($request->validated());

        return (new AgreementTypeResource($row))
            ->additional(['message' => 'Agreement type created'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AgreementType $agreementType)
    {
        return new AgreementTypeResource($agreementType);
    }

    public function update(UpdateAgreementTypeRequest $request, AgreementType $agreementType)
    {
        $agreementType->update($request->validated());

        return (new AgreementTypeResource($agreementType))
            ->additional(['message' => 'Agreement type updated']);
    }

    public function destroy(AgreementType $agreementType)
    {
        try {
            $agreementType->delete();
            return response()->noContent();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                return response()->json([
                    'message' => 'Cannot delete: this agreement type is referenced by schools or history.'
                ], Response::HTTP_CONFLICT);
            }
            throw $e;
        }
    }
}
