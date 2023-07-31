<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\Billing;
use App\Http\Controllers\Controller;
use App\Http\Resources\BillingEditResource;
use App\Http\Resources\BillingShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BillingController extends Controller implements APIInterface
{
    public function show(int $id): JsonResponse
    {
        $billings = new BillingShowResource(Billing::with('students:id,name', 'users:id,name')->findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $billings
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $billings = new BillingEditResource(Billing::with('students:id,name', 'users:id,name')->findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $billings
        ]);
    }
}
