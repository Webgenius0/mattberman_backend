<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Mail\sendOTPResetPassword;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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

        $otp = rand(1000, 9999);

        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'otp'         => $otp,
            'is_verified' => false,
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'OTP generated. Please verify to complete registration.',
            'data'      => [
                'user_id' => $user->id,
                'otp'     => $otp  
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
            $user->otp = null; 
            $user->otp_verified_at = now(); 
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

        $user = User::where('email', $request->email)->first();
        // if ($user && !$user->is_verified) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Account not verified. Please verify OTP.',
        //         'code' => '403',
        //     ], 403);
        // }

        $token = auth()->guard('api')->attempt($request->all());

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


    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exist:users,email',
        ]
        );
        if ($validator->fails()) {
            return response()->json([
                'status'=> false,
                'message'=> $validator->errors(),
                'code'=> '422',
                ], 422);
        }
        $user = User::where('email', $request->email)->first();
        if($user){
            $otp = rand(1000,9999);
            Mail::to($request->email)->send(new sendOTPResetPassword($otp));
        }
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
