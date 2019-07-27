<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\User;
use GuzzleHttp;

class RegisterController extends Controller
{


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();


        $client = new GuzzleHttp\Client;
        $response = $client->post(url('oauth/token'), [
            'form_params' => [
                'grant_type' => env('API_GRANT_TYPE'),
                'client_id' => env('API_CLIENT_ID'),
                'client_secret' => env('API_CLIENT_SECRET'),
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);
        return Response::json([
            'status' => 'success',
            'message' => 'Your account has been created successfully!',
            'data' => json_decode((string) $response->getBody(), true)
        ], 201);
    }
}