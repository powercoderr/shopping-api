<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    /**Handle request to get all users */
    public function index(Request $request)
    {
        $data = [];
        foreach (User::all() as $user) {
            $data[] = [
                "name" => $user->name,
                "username" => $user->username,
                "email" => $user->email,
                "phone" => $user->phone,
                "country" => $user->country,
                "city" => $user->city,
                "postcode" => $user->postcode,
                "address" => $user->address,
                "created_at" => Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d M Y H:i')

            ];
        }
        return response([
            "data" => $data
        ], Response::HTTP_OK);
    }
}
