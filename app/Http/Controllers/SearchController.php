<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function index()
    {
        $apiURL = 'https://accounts.spotify.com/api/token';

        // POST Data
        $postInput = [
            'grant_type' => 'client_credentials',
        ];

        // Headers
        $headers = [
            "Authorization" => 'Basic ' . base64_encode(env("SPOTIFY_CLIENT_ID") . ":" . env("SPOTIFY_CLIENT_SECRET")),
            "Content-Type" => "application/x-www-form-urlencoded"
        ];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $apiURL, [
            'headers' => $headers,
            'form_params' => $postInput
        ]);

        $code =  $response->getStatusCode(); // 200
        $body = json_decode($response->getBody());
        $token = '';
        if ($code == 200) {
            session(['ACCESS_TOKEN' => $body->access_token]);
        }

        return view('index', compact('token'));
    }

    public function search(Request $request)
    {

        $headers = [
            "Authorization" => 'Bearer ' . session('ACCESS_TOKEN'),
            "Content-Type" => "application/json"
        ];
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.spotify.com/v1/search?q=' . urlencode($request->q) . '&type=track,artist,album&limit=5',[
            'headers' => $headers
        ]); 
        $code =  $response->getStatusCode(); // 200
        $body = json_decode($response->getBody(), true);
        $data = $body;
        $q = $request->q;
        // dd($data);
        return view('index', compact('data','q'));
    }

    public function detail(Request $request)
    {
       
        $href = base64_decode($request->d);
        $headers = [
            "Authorization" => 'Bearer ' . session('ACCESS_TOKEN'),
            "Content-Type" => "application/json"
        ];
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $href,[
            'headers' => $headers
        ]); 
        $code =  $response->getStatusCode(); // 200
        $body = json_decode($response->getBody(), true);
        $data = $body;
        // dd($data);
        return view('detail', compact('data'));
    }

}
