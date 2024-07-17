<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller; // Add this line
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller // Extend the Controller class
{
    //

   /*public function login(Request $request)
{
    $this->validateLogin($request);

    if (Auth::attempt($request->only('correo_empleado', 'password'))) { // Usar 'password'
        return response()->json([
            'token' =>  $request->user()->createToken($request->name)->plainTextToken,
            'message' => 'Inicio de sesión exitoso'
                ]);
    }

    return response()->json([
        'error' => 'No se ha podido iniciar sesión'
    ], 401);
}

    public function validateLogin(Request $request){


        return $request->validate([
            'correo_empleado' => 'required',
            'password' => 'required'
        ]);

    }*/

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        
        $credentials = request(['correo_empleado', 'password']);

        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json(['error' => 'Email o Contraseña incorrectos'], 401);

        }

        return $this->respondWithToken($token);
        
        

    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->guard('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }





        /**
         * Get the token array structure.
         *
         * @param  string $token
         *
         * @return \Illuminate\Http\JsonResponse
         */
        protected function respondWithToken($token)
        {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
            ]);
        }
}
