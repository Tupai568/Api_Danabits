<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    
    public function claim(Request $request)
    {
        $captcha = [
            'recaptcha' => $request->input('g-recaptcha-response')
        ];

        $client = new Client();
        $url = env('MY_API_URL');
        $path = "claimFaucet";
        $fullURL = $url.$path;
        $user = auth()->user();
        
        try {
            $request = $client->post($fullURL, [
                'headers' => [
                    'Content-type' => 'application/json',
                    'Authorization' => 'Bearer '.$user->api_token
                ],
                'json' => $captcha
            ]);

            $respond = $request->getBody()->getContents();
            $json = json_decode($respond, true);

            if (empty($json['errors'])) {
                return back()->with('success', $json['messages']);
            }else{
                return back()->with('error', 'invalid recaptcha');
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->hasResponse()) {
                return back()->with('error', 'Anda harus menunggu 5 menit sebelum claim lagi');
            }
        }
        
    }

    public function time()
    {
        $time = Claim::where('user_id', auth()->user()->id)->first();

        return $time->captcha_validation_time;
    }


}
