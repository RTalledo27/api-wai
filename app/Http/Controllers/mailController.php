<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\DashboardController;
use App\Mail\CotizacionDetails;
use App\Models\Clientes;
use App\Models\Cotizaciones;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log; // Add this line to import the Log class
use Illuminate\Support\Facades\Mail;

class mailController extends Controller
{
    //

    public function sendMail($idProyecto)
    
    {
        // Obtener la cotización
        $cotizacion = Cotizaciones::with('proyecto', 'elementos_cotizacion.elemento')
        ->where('idProyecto', $idProyecto)
        ->get();

        $cliente = Clientes::find($cotizacion[0]->proyecto->idCliente);
        try {
            // Verificar que la cotización exista
            if (!$cotizacion) {
                return response()->json([
                    'message' => 'Cotización no encontrada.'
                ], Response::HTTP_NOT_FOUND);
            }

            // Verificar relaciones
            if (!$cotizacion[0]->proyecto || !$cotizacion[0]->proyecto->cliente) {
                return response()->json([
                    'message' => 'Datos de proyecto o cliente no encontrados.'
                ], Response::HTTP_NOT_FOUND);
            }

            // Enviar el correo
            Mail::to($cliente->correo_cliente)->send(new CotizacionDetails($cotizacion[0]->idCotizacion, $cliente->idCliente));

            return response()->json([
                'message' => 'Correo electrónico enviado exitosamente.'
            ], Response::HTTP_OK);

        }  catch (\Exception $e) {
            Log::error("Error al enviar correo: " . $e->getMessage());
            // ...// Use Log class without backslash
            return response()->json([
                'message' => 'Error al enviar correo electrónico.',
                'error'=>$e->getMessage(),
                'cotizacion'=>$cotizacion[0]->idCotizacion ,
                'cliente'=>$cliente->correo_cliente
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}