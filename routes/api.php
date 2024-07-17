<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\ProyectoController;
use App\Http\Controllers\Api\V1\EmpleadoController;
use App\Http\Controllers\Api\V1\ClienteController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\V1\CotizacionController;
use App\Http\Controllers\Api\V1\ElementoController;
use App\Http\Controllers\Api\V1\Elemento_cotizacionController;
use App\Http\Controllers\Api\V1\RolController;
use App\Http\Controllers\Api\V1\EstadoController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\mailController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/v1/dashboard', [DashboardController::class, 'dashboard'])
->middleware(['api','cors']);





Route::apiResource('v1/empleados', EmpleadoController::class)->only(['show', 'index','store','update'])
//->middleware('auth:sanctum')
;



Route::middleware('cors','auth:api')->group(function () {
    Route::apiResource('v1/clientes', ClienteController::class)->only(['show', 'index', 'store', 'update']);

    Route::apiResource('v1/cotizaciones', CotizacionController::class)->only(['index', 'show', 'store']);
    
    Route::apiResource('v1/elementos', ElementoController::class)->only(['index', 'show', 'store', 'update']);
    
    Route::apiResource('v1/elementos-cotizaciones', Elemento_cotizacionController::class)->only(['index', 'store']);

    Route::apiResource('v1/roles', RolController::class)->only(['index']);

    Route::apiResource('v1/proyectos', ProyectoController::class)->only(['index', 'store', 'update', 'show']);
    
    
    Route::apiResource('v1/estados', EstadoController::class)->only(['index', 'store']);
    
});



//LOGIN

/*Route::post('login',[
    App\Http\Controllers\Api\LoginController::class,
    'login'
]);*/


// routes/web.php or routes/api.php (depending on your API setup)

Route::post('/detalles/{idCotizacion}', [MailController::class, 'sendMail']);


Route::group([
    'middleware' => ['cors','api'],
    'prefix' => 'auth'], function ($router) {

    Route::post('login', [ LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('refresh', [LoginController::class, 'refresh']);
    Route::get('me', [ LoginController::class, 'me']);
});

