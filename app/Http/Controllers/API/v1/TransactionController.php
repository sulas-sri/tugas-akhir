<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionEditResource;
use App\Http\Resources\TransactionShowResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller implements APIInterface
{
    public function show(int $id): JsonResponse
    {
        $transaction = new TransactionShowResource(Transaction::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $transaction
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $transaction = new TransactionEditResource(Transaction::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $transaction
        ]);
    }
}
