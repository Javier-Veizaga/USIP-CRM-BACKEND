<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgreementStatusRequest;
use App\Http\Requests\UpdateAgreementStatusRequest;
use App\Http\Resources\AgreementStatusResource;
use App\Models\AgreementStatus;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class AgreementStatusController extends Controller
{
    public function index()
    {
        return AgreementStatusResource::collection(
            AgreementStatus::orderBy('name')->get()
        );
    }

    public function store(StoreAgreementStatusRequest $request)
    {
        $row = AgreementStatus::create($request->validated());

        return (new AgreementStatusResource($row))
            ->additional(['message' => 'Agreement status created'])
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AgreementStatus $agreementStatus)
    {
        return new AgreementStatusResource($agreementStatus);
    }

    public function update(UpdateAgreementStatusRequest $request, AgreementStatus $agreementStatus)
    {
        $agreementStatus->update($request->validated());

        return (new AgreementStatusResource($agreementStatus))
            ->additional(['message' => 'Agreement status updated']);
    }

    public function destroy(AgreementStatus $agreementStatus)
    {
        try {
            $agreementStatus->delete();
            return response()->noContent();
        } catch (QueryException $e) {
            if ($e->getCode() === '23503') {
                return response()->json([
                    'message' => 'Cannot delete: this agreement status is referenced by schools or history.'
                ], Response::HTTP_CONFLICT);
            }
            throw $e;
        }
    }
}
