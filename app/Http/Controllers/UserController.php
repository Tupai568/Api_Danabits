<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Stmt\TryCatch;
use Anhskohbo\NoCaptcha\NoCaptcha;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // Pengguna sudah login, alihkan ke halaman lain
            return redirect('/dashboard'); // Ganti '/home' dengan halaman yang diinginkan
        }

        return view('index');
    }

    //menangkap request dari form login & mengirim nya ke API
    public function login(Request $request)
    {

        $request->validate([
            "g-recaptcha-response" => "required"
        ]);

        $remember = $request->has('remember');
    
        $expiration = $remember ? now()->addWeeks(1) : null;

        
        $data = [
            "username" => $request->input("LoginUsername"),
            "password" => $request->input("loginPassword"),
            "recaptcha" => $request->input("g-recaptcha-response")
        ];


        //melakukan request ke API untuk login
        $client = new Client();
        $url = 'http://127.0.0.1:8001/api/login';

        try {
            $client->post($url, [
                'headers' => ['Content-type' => 'application/json'],
                'json' => $data,
            ]);

            //mengecek apakah username && password ada didalam database
            if (Auth::attempt(['name' => $request->LoginUsername, 'password' => $request->loginPassword], $remember, $expiration)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // tampilkan kesalahan jika mendapatkan error dari request ke API
            if ($e->hasResponse()) {
                return back()->with('error', 'invalid login credentials');
            }
        }
    }

    //menangkap request dari form register & mengirim nya ke API
    public function register(Request $request)
    {
        $request->validate([
            "g-recaptcha-response" => "required"
        ]);

        $data = [
            "email" => $request->input("registerEmail"),
            "name" => $request->input("registerUsername"),
            "password" => $request->input("registerPassword"),
            "recaptcha" => $request->input("g-recaptcha-response")
        ];

        $client = new Client();
        $url = 'http://127.0.0.1:8001/api/register';
       

        try {
            $client->post($url, [
                'headers' => ['Content-type' => 'application/json'],
                'json' => $data,
            ]);

            //mengecek apakah username && password ada didalam database
            if (Auth::attempt(['name' => $request->registerUsername, 'password' => $request->registerPassword])) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }
            

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->hasResponse()) {
                return back()->with('error', 'invalid Register');
            }
        }
    }
    
    //melakukan perhitungan level
    public function level($total)
    {
        if($total['total_claim'] < 1000) {
            $hasil = 1000 - $total['total_claim'];
            $level = 1;
        }

        for ($i=31; $i >= 1; $i--) { 
            if ($total['total_claim'] >= $i * 1000) {
                $hasil = $i * 1000 - $total['total_claim'];
                $level = $i + 1;
                break;
            }
        }

        return [$hasil, $level];
    }  


    //melakukan request ke API untuk mendapatkan informasi user
    public function requestsApi()
    {
        $client = new Client();

        //mengambil url dengan nama MY_API_URL yng telah disimpan difile env
        $url = env("MY_API_URL");

        //path yang dituju
        $path = "me";

        //menggabung $url dengan $path
        $fullURL = $url.$path;

        //mengambil token yang disimpan didalam session
        $user = auth()->user();

        try {
            $request = $client->get($fullURL, [
                'headers' => [
                    'Content-type' => 'application/json',
                    'Authorization' => 'Bearer '.$user->api_token
                    ]
            ]);
            $content = $request->getBody()->getContents();
            $result = json_decode($content, true);
            $saldo = $result['data']['saldo'];
            $total = $result['data']['total'];
            $referral = $result['data']['refferal'];
            //nilai tukar usd 
            $usd = 15000;
    
            //rupiah yang dimiliki
            $idr = $saldo[0]['saldo'];
            
            // Melakukan konversi
            $convert = $idr / $usd;
    
            // Format jumlah dalam bentuk Dolar
            $jumlahUSD = number_format($convert, 2, '.', ',');

            //memanggil function level
            $level = $this->level($total);

            return [
                'saldo' => $saldo,
                'jumlahUSD' => $jumlahUSD,
                'referral' => $referral,
                'total' => $total,
                'level' => $level,
            ];
            
    
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->hasResponse()) {
                return back()->with('error', 'invalid Requests');
            }
        }
    }


    public function dashboard(Request $request)
    {
        $requests = $this->requestsApi();

        if ($requests) {
            return view('dasboard', [
                'saldo' => $requests['saldo'],
                'usd' => $requests['jumlahUSD'],
                'referral' => $requests['total'],
                'total' => $requests['total'],
                'level' => $requests['level']
            ]);
        }

    }

    public function shortlink()
    {

        $requests = $this->requestsApi();

        if ($requests) {
            return view('shortlink', [
                'saldo' => $requests['saldo'],
                'usd' => $requests['jumlahUSD'],
                'referral' => $requests['total'],
                'total' => $requests['total'],
                'level' => $requests['level']
            ]);
        }
        
    }

    public function ptc()
    {

        $requests = $this->requestsApi();

        if ($requests) {
            return view('setting', [
                'saldo' => $requests['saldo'],
                'usd' => $requests['jumlahUSD'],
                'referral' => $requests['total'],
                'total' => $requests['total'],
                'level' => $requests['level']
            ]);
        }
        
    }

    


    public function setting()
    {

        $requests = $this->requestsApi();

        if ($requests) {
            return view('setting', [
                'saldo' => $requests['saldo'],
                'usd' => $requests['jumlahUSD'],
                'referral' => $requests['total'],
                'total' => $requests['total'],
                'level' => $requests['level']
            ]);
        }
        
    }


    public function destroy()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}

