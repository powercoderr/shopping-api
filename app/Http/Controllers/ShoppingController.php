<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ShoppingController extends Controller
{
    /**Handle request to create new shopping*/
    public function create(Request $request)
    {
        $shopping = Shopping::create([
            "user_id" => Auth::user()->id,
            "createddate" => $request->shopping['createddate'],
            "name" => $request->shopping['name'],
        ]);

        $data = [
            "createddate" => $shopping->createddate,
            "id" => $shopping->id,
            "name" => $shopping->name,
        ];
        
        return response([
            "data" => $data
        ], Response::HTTP_CREATED);
    }

    /**Handle request to get all shopping */
    public function index()
    {
        $shopping = Shopping::all();

        $data = [];
        foreach ($shopping as $item) {
            $data[] = [
                "createddate" => $item->createddate,
                "id" => $item->id,
                "name" => $item->name,
            ];
        }

        return response([
            "data" => $data
        ], Response::HTTP_OK);
    }

    /**Handle request to get shopping by id */
    public function show($id)
    {
        $shopping = Shopping::find($id);

        if (!$shopping) {
            return response([
                "message" => "Shopping not found"
            ], Response::HTTP_NOT_FOUND);
        }

        $data = [
            "createddate" => $shopping->createddate,
            "id" => $shopping->id,
            "name" => $shopping->name,
        ];

        return response([
            "data" => $data
        ], Response::HTTP_OK);
    }

    /** Handle request to update shopping by id */
    public function update(Request $request, $id)
    {
        $shopping = Shopping::find($id);

        if (!$shopping) {
            return response([
                "message" => "Shopping not found"
            ], Response::HTTP_NOT_FOUND);
        }

        $shopping->name = $request->shopping['name'] == null? $shopping->name : $request->shopping['name'];
        $shopping->createddate = $request->shopping['createddate'] == null ? $shopping->createddate : $request->shopping['createddate'];
        $shopping->save();

        $data = [
            "createddate" => $shopping->createddate,
            "id" => $shopping->id,
            "name" => $shopping->name,
        ];

        return response([
            "data" => $data
        ], Response::HTTP_OK);
    }

    /** Handle requesto delete shopping by id */
    public function delete($id)
    {
        $shopping = Shopping::find($id);

        if (!$shopping) {
            return response([
                "message" => "Shopping not found"
            ], Response::HTTP_NOT_FOUND);
        }

        $shopping->delete();

        return response([
            "message" => "Shopping deleted"
        ], Response::HTTP_OK);
    }
}
