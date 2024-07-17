<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\V1\RolResource;
use Illuminate\Routing\Controller; 

class RolController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $empleado = auth()->guard('api')->user();

        if(!$empleado){
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }else{
            return  RolResource::collection(Roles::all());
        }
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roles $roles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roles $roles)
    {
        //
    }
}
