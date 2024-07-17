<?php

namespace App\Mail;

use App\Models\Clientes;
use App\Models\Cotizaciones;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CotizacionDetails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $cotizacion; // Propiedad pública para acceder a los datos en la vista
    public $cliente; // Propiedad pública para acceder a los datos en la vista
    public $proyecto;
    public function __construct($idCotizacion, $idCliente)
    {
        $this->cotizacion = Cotizaciones::with('proyecto','elementos_cotizacion.elemento')->find($idCotizacion);
        $this->cliente = Clientes::find($idCliente);
        $this->proyecto = $this->cotizacion->proyecto;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

       
        return new Envelope(
            subject: 'Detalles de cotizacion N°' . $this->cotizacion->idCotizacion,
            to: $this->cliente->correo_cliente,
            

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.detallesCotizacion',
            with: [
                'cotizacion' => $this->cotizacion,
                'cliente'=>$this->cliente,
                'proyecto'=>$this->proyecto,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
