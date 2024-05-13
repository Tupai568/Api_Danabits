<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Saldo;
use App\Models\Referral;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    //api login
    public function login(Request $request) 
    {

        $rules = [
            "username" => "required",
            "password" => "required",
            "recaptcha" => "required|captcha"
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            return response()->json([
                "status" => false,
                "messages" => "Error",
                "data" => $validation->errors()
            ], 422);
        }

        //mengecek apakah ada email yang sama didatabase
        $user = User::where('name', $request->username)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'messages' => 'Not Found'
            ], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        $user->update(['api_token' => $token]);


        // Mengembalikan token dalam respons dengan status yang benar.
        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token
        ], 200);

    }

    public function store(Request $request)
    {

        //validasi untuk recaptcha
        $captcha = Validator::make($request->all(), ["recaptcha" => "required|captcha"]);
       
        if($captcha->fails()){
            return response()->json([
                "status" => false,
                "messages" => "validation.captcha",
                "errors" => $captcha->errors()
            ], 422);
        }

        //validasi untuk form register
        $rules = [
            "name" => "required|min:5|max:255|unique:users",
            "email" => "required|email|unique:users",
            "password" => "required|min:5|max:255",
        ];
        
        // Tambahkan aturan validasi untuk referral_code
        $rules['referral_code'] = 'nullable|string|min:8|max:255|unique:users';
        
        $validation = Validator::make($request->all(), $rules);
        
        if ($validation->fails()) {
            return response()->json([
                "status" => false,
                "messages" => "Error",
                "errors" => $validation->errors()
            ], 422);
        }
        
        // Tambahkan referral_code ke dalam data yang akan di-create
        $data = $validation->validate();
        
        // Generate referral_code jika tidak ada yang disediakan
        if (!isset($data['referral_code'])) {
            $data['referral_code'] = Str::random(8);
        
            // Pastikan referral_code unik
            while (User::where('referral_code', $data['referral_code'])->exists()) {
                $data['referral_code'] = Str::random(8);
            }
        }
        
        // Buat user dengan data yang sudah disiapkan
        $user = User::create($data);

        // Buat saldo dengan id dari user
        Saldo::create(["user_id" => $user->id, "saldo" => 0]);

        // Buat total_referrals dengan id dari user
        Referral::create(["user_id" => $user->id, "total_referral" => 0]);

        // Buat total_referrals dengan id dari user
        Claim::create(["user_id" => $user->id, "total_claim" => 0]);

        //buat token api
        $token = $user->createToken('api-token')->plainTextToken;

        $user->update(['api_token' => $token]);

        return response()->json([
            "status" => true,
            "messages" => "Register successful",
            "token" => $token
        ]);

    }

    //melakukan logout
    public function logout(Request $request) //logout
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['success' => 'true']);
    }


}
