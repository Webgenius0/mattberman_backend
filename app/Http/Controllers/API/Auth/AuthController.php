<?php

namespace App\Http\Controllers\API\Auth;

// use mail;
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

        // Create the user but set is_verified to false
        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            // 'otp'         => $otp,
            // 'is_verified' => false,
        ]);

        // For testing purposes, return the OTP in the response
        return response()->json([
            'status'    => true,
            'message'   => 'OTP generated. Please verify to complete registration.',
            'data'      => [
                'user_id' => $user->id,
                // 'otp'     => $otp  // Include OTP in the response for testing
            ],
            'code'      => '201',
        ], 201);
    }
 
    // public function verifyOtp(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'otp'   => 'required|digits:4',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'Validation errors',
    //             'errors'  => $validator->errors(),
    //             'code'    => '422',
    //         ], 422);
    //     }

    //     // Find the user by email and check the OTP
    //     $user = User::where('email', $request->email)->first();

    //     if ($user && $user->otp == $request->otp) {
    //         // Verify the user
    //         $user->is_verified = true;
    //         $user->otp = null; // Clear the OTP after verification
    //         $user->otp_verified_at = now(); // Set the current time for OTP verification
    //         $user->save();

    //         return response()->json([
    //             'status'  => true,
    //             'message' => 'OTP verified. Registration complete.',
    //             'code'    => '200',
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'Invalid OTP. Please try again.',
    //             'code'    => '403',
    //         ], 403);
    //     }
    // }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:8',
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

        // Attempt to authenticate
        $token = auth()->guard('api')->attempt($request->all());
        if (!$token) {
            return response()->json([
                'status' => false,
                'message' => 'Incorrect credentials, please try again.',
                'code' => '403',
            ], 403);
        }

        if($user && Hash::check($request->password , $user->password)) {
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
        
    }

    
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'code' => '403',
            ], 403);
        }

        $user = User::where('email', $request->email)->first();
        if($user){
            $otp =  rand(1000,9999);

            Mail::to($user->email)->send(new SendOTPResetPassword($otp));

            $user->otp = $otp;
            $user->is_verified = false;
            $user->save();

            return response()->json([
                'status'    => true,
                'message'   => 'OTP generated. Please verify to Reset Password.',
                'data'      => [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'otp'     => $otp  // Include OTP in the response for testing
                ],
                'code'      => '201',
            ], 201);
        }
    }


    public function verifyOtpResetPassword(Request $request)
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
            // $user->otp = null; 
            $user->otp_verified_at = now(); 
            $user->save();

            return response()->json([
                'status'  => true,
                'message' => 'OTP verified.',
                'code'    => '200',
            ], 200);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid OTP.',
                'code'    => '403',
            ], 403);
        }
    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp'   => 'required|digits:4',
            'password' => 'required|min:8|confirmed',
            ]);



        if ($validator->fails()) {
            return response()->json([
                'status'=> false,
                'message'=> 'Validation error',
                'errors'=> $validator->errors(),
                'code'=> '422',
                ], 422);
            }

            $user = User::where('otp', $request->otp)->where('email', $request->email)
            ->first();


                if (!$user) {
                    return response()->json([
                        'status'=> false,
                        'message'=> 'Invalid OTP. Please try again.',
                        'code'=> '422',
                        ], 422);
                }

                $user->password = bcrypt($request->password);
                $user->otp = null;
                $user->save();
                // $user->update([
                //     'password' => Hash::make($request->password),
                //     'otp' => null,
                //     'otp_created_at' => null,
                // ]);

                return response()->json([
                    'status'=> false,
                    'message'=> 'successfully reset password',
                    'code'=> '200',
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
