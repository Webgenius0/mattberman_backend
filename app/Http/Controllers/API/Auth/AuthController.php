<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Validation errors',
                'errors'    => $validator->errors(),
                'code'      => '422',
            ], 422);
        }

        // Generate a 4-digit OTP
        $otp = rand(1000, 9999);
// dd($otp);
        // Create the user but set is_verified to false
        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'otp'         => $otp,
            'is_verified' => false,
        ]);

        // For testing purposes, return the OTP in the response
        return response()->json([
            'status'    => true,
            'message'   => 'OTP generated. Please verify to complete registration.',
            'data'      => [
                'user_id' => $user->id,
                'otp'     => $otp  // Include OTP in the response for testing
            ],
            'code'      => '201',
        ], 201);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp'   => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation errors',
                'errors'  => $validator->errors(),
                'code'    => '422',
            ], 422);
        }

        // Find the user by email and check the OTP
        $user = User::where('email', $request->email)->first();

        if ($user && $user->otp == $request->otp) {
            // Verify the user
            $user->is_verified = true;
            $user->otp = null; // Clear the OTP after verification
            $user->otp_verified_at = now(); // Set the current time for OTP verification
            $user->save();

            return response()->json([
                'status'  => true,
                'message' => 'OTP verified. Registration complete.',
                'code'    => '200',
            ], 200);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid OTP. Please try again.',
                'code'    => '403',
            ], 403);
        }
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'code' => '403',
            ], 403);
        }

        // Find the user and check if verified
        $user = User::where('email', $request->email)->first();
        if ($user && !$user->is_verified) {
            return response()->json([
                'status' => false,
                'message' => 'Account not verified. Please verify OTP.',
                'code' => '403',
            ], 403);
        }

        // Attempt to authenticate
        $token = auth()->guard('api')->attempt($validator->validated());
        if (!$token) {
            return response()->json([
                'status' => false,
                'message' => 'Incorrect credentials, please try again.',
                'code' => '403',
            ], 403);
        }

        return response()->json([
            'status'     => true,
            'message'    => 'User logged in successfully.',
            'token'      => $token,
            'userData'   => $user,
            'token_type' => 'Bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
            'code'       => '200',
        ], 200);
    }


    /**
     * Log the user out (Invalidate the token).
     */
    public function logout()
    {
        try {
            // Invalidate the token
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'message' => 'Successfully logged out'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to log out, please try again.'
            ], 500);
        }
    }

}
