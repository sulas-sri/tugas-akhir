<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (
            !($token = auth()
                ->guard('api')
                ->attempt($request->only('email', 'password')))
        ) {
            return response()->json([
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' => 'Unauthorized',
            ]);
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has the 'admin' role
        if (!$user->hasRole('admin')) {
            return redirect()->route('siswa.riwayat_pembayaran');
        }

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $token,
        ]);
    }
}
