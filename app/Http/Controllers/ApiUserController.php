<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Saldo;
use App\Models\Referral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ApiUserController extends Controller
{
    //mengambil data user
    public function me()
    {

        $saldo = Saldo::with('user')->where('user_id', auth()->user()->id)->get();
        $refferal = Referral::where('user_id', auth()->user()->id)->first();
        $total = Claim::where('user_id', auth()->user()->id)->first();

        if(empty($saldo)) {
            return response()->json([
                'status' => true,
                'message' => 'Autenticate Failed'
            ], 422);
        }

        return response()->json([
            'status' => true,
            'message' => 'Request successfull',
            'data' => [
                    'saldo' => $saldo,
                    'refferal' => $refferal,
                    'total' => $total
            ]
        ], 200);
    
    }

    public function claimFaucet(Request $request)
    {

        //function untuk mengacak angka
        function acakNumber($random){
            if($random <= 89999) {
                $reward = 20;
            }elseif($random > 89999 && $random <= 94999){
                $reward = 30;
            }elseif($random > 94999 && $random <= 99499){
                $reward = 40;
            }elseif($random > 99499 && $random <= 99996){
                $reward = 50;
            }elseif($random > 99996 && $random <= 99998){
                $reward = 60;
            }else{
                $reward = 1000;
            }

            return $reward;
        }

        $captcha = Validator::make($request->all(), ["recaptcha" => "required|captcha"]);
       
        if($captcha->fails()){
            return response()->json([
                "status" => false,
                "messages" => "validation.captcha",
                "errors" => $captcha->errors()
            ]);
        }
        
        $saldo = Saldo::where('user_id', auth()->user()->id)->first();
        $claim = Claim::where('user_id', auth()->user()->id)->first();
        $time = $claim->captcha_validation_time;

        if ($time && now()->diffInMinutes($time) < 5) {
            // Jika belum 5 menit, berikan pesan error
            return response()->json([
                "status" => false,
                "messages" => "Anda harus menunggu 5 menit sebelum claim lagi."
            ], 422);
        }

        //updata waktu & total claim yang berada di database 
        $total = $claim->total_claim + 1;
        $claim->update(['captcha_validation_time' => now()]);
        $claim->update(['total_claim' => $total]);

        //mengacak angka
        $random = mt_rand(1, 99999);
        
        //memanggil function acakNumber
        $reward = acakNumber($random);

        $convert = number_format($random, 0, '.', ',');
        $hasil = $saldo->saldo + $reward;

        //update saldo
        $saldo->update(['saldo' => $hasil]);

        return response()->json([
            'success' => true,
            'messages' => 'Congratulations, your lucky number was '.$convert.' and you won '.$reward.' idr'
        ], 200);
    }
}
