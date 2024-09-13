<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $rules = [
            'mobile' => 'required|exists:users,mobile',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('mobile', $request->mobile)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => trans('api.credentials_error')], 401);
        }

        if (!$user->isVerified()) {
            return response()->json(['error' => trans('api.unverified_account')], 403);
        }

        if (!$user->isActive()) {
            return response()->json(['error' => trans('api.block_account')], 403);
        }

        $token = $user->createToken('user_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => trans('api.login_success')
        ], 200);
    }

    public function signup(Request $request)
    {
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required|unique:users,mobile',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);
        $user->generateVerificationCode();

        return response()->json([
            'user' => $user,
            'message' => trans('api.success')
        ], 201);
    }

    public function verification(Request $request)
    {
        $rules = [
            'mobile' => 'required|exists:users,mobile',
            'verification code' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('mobile', $request->mobile)->firstOrFail();

        if ($user->verification_code == $request->verification_code) {
            $user->email_verified_at = now();
            $user->save();
            return response()->json(['message' => trans('api.verification success')], 200);
        }

        return response()->json(['error' => trans('api.verification faild')], 400);
    }

    public function resend(Request $request)
    {
        $rules = [
            'mobile' => 'required|exists:users,mobile',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('mobile', $request->mobile)->firstOrFail();

        if ($user->isVerified()) {
            return response()->json(['error' => trans('api.verified account')], 409);
        }

        $user->generateVerificationCode();

        return response()->json(['message' => trans('api.send otp success')], 200);
    }

    public function forgotPassword(Request $request)
    {
        $rules = [
            'mobile' => 'required|exists:users,mobile',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('mobile', $request->mobile)->firstOrFail();
        $user->reset_password_code = User::generateResetPasswordCode();
        $user->save();

        return response()->json(['message' => trans('api.send reset password code success')], 200);
    }

    public function resetPasswordCode(Request $request)
    {
        $rules = [
            'mobile' => 'required|exists:users,mobile',
            'code' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('mobile', $request->mobile)->firstOrFail();

        if ($user->reset_password_code == $request->code) {
            return response()->json(['message' => trans('api.valid code to reset password')], 200);
        }

        return response()->json( ['msg'=>'wrong code to reset password'], 400);
    }

    public function resetPassword(Request $request)
    {
        $rules = [
            'mobile' => 'required|exists:users,mobile',
            'code' => 'required',
            'password' => 'required|confirmed|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('mobile', $request->mobile)->firstOrFail();

        if ($user->reset_password_code != $request->code) {
            return response()->json(['msg'=>'wrong code to reset password'], 400);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' =>'password reset success'], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'logout success'], 200);
    }

    public function profile(Request $request)
    {
        $user = $request->user();

        return response()->json(['user' => $user], 200);
    }

    public function updateProfile(Request $request)
    {
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required',
            'photo' => 'image|mimes:jpg,jpeg,png'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $request->user();
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $path = $request->photo->store('users');
            $data['photo'] = $path;
        }

        $user->update($data);

        return response()->json(['message' => trans('api.profile_update_success')], 200);
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'password' => 'required|confirmed|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $request->user();
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => trans('api.password_update_success')], 200);
    }

}