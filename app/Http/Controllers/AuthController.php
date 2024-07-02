<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    public function getUser(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            return response()->json([
                'status' => true,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated',
            ], 401);
        }
    }



    public function index(): JsonResponse
    {
        $user = Auth::user();
        // $user = User::get();
        if ($user) {
            return response()->json([
                'success' => true,
                'users' => $user,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated',
            ], 401);
        }
    }
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials, $request->remember)) {
    //         return response()->json(['success' => true]);
    //     }
    //     return response()->json(['success' => false], 401);
    // }
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $credentials = $request->only('email', 'password');
        $loginUser = User::where("email", $request->email)->first();
        if (Auth::attempt($credentials)) {
            $token = $loginUser->createToken("authToken")->plainTextToken;
            $user = Auth::user();

            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $token,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid email or password',
        ], 401);
    }
    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $loginUser = User::where('email', $request->email)->first();
        if ($loginUser && Hash::check($request->password, $loginUser->password)) {
            $token = $loginUser->createToken('authToken')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'User logged in',
                'token' => $token,
                'user' => $loginUser,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Email or Password do not match',
            ], 401);
        }
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'status' => 'inactive',
        ]);
        $token =  $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => true,
            "message" => "User logged out",
            "data" => []
        ]);
    }
}
