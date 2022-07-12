<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use RespondsWithHttpStatus;

     /** Handle signup request */
     public function signup(Request $request){ 
        
        //Check if user with the same username already exists
        if(User::where('username', $request->user['username'])->first()){
            $username = $request->user['username'];
            return $this->failure("Signup user gagal", "Username $username telah digunakan", Response::HTTP_BAD_REQUEST);
        }

        //Check if user with the same email already exists
        if(User::where('email', $request->user['email'])->first()){
            $email = $request->user['email'];
            return $this->failure("Signup user gagal", "Email : $email telah digunakan", Response::HTTP_CONFLICT);
        }

        $user = User::create([
            "username" => $request->user['username'],
            "email" => $request->user['email'],
            "password" => Hash::make($request->user['encrypted_password']),
            "phone" => $request->user['phone'],
            "address" => $request->user['address'],
            "city" => $request->user['city'],
            "country" => $request->user['country'],
            "name" => $request->user['name'],
            "postcode" => $request->user['postcode'],
        ]);

        return response([
            "email" => $user->email,
            "token" => $user->createToken('MyApp')->accessToken,
            "username" => $user->username,
        ],Response::HTTP_CREATED);
    }

    /** Handle sign Request */
    public function sign(Request $request){
        $credential = $request->only('username', 'password');
        
        if(!auth()->attempt($credential)){
            return $this->failure("Login gagal", "Username atau password salah", Response::HTTP_UNAUTHORIZED);
        }
        
        //Login success (attempt is true)
        return response([
            "email" => auth()->user()->email,
            "token" => auth()->user()->createToken('MyApp')->accessToken,
            "username" => auth()->user()->username,
        ],Response::HTTP_CREATED);

    }
}
