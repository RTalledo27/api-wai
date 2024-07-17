<!DOCTYPE html>
<html>
<head>
    <title>Detalles de Cotización #{{ $cotizacion->idCotizacion }}</title>
    <style>
        /* Estilos CSS para el correo */
    </style>
</head>
<body>
    <h1>Detalles de Cotización #{{ $cotizacion->idCotizacion }}</h1>
    <p>Estimado(a) {{ $cliente->nombre_cliente }},</p>

    <p>Adjuntamos los detalles de su cotización y Proyecto:</p>

    <h3>Titulo de proyecto</h3>
    <span>{{$proyecto['nombre_proyecto']}}</h3>
    <h3>Descripcion de proyecto</h3>
    <span>{{$proyecto['descripcion']}}</h3>


    <table>
        <thead>
            <tr>
                <th>Nombre Servicio</th>
                <th>Descripcion</th>
                <th>Costo</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cotizacion->elementos_cotizacion as $item) 
                <tr>
                    <td>{{ $item->elemento->nombre_elemento }}</td>
                    <td>{{ $item->elemento->descripcion }}</td>
                    <td>{{ $item->elemento->costo }}</td>
                    <td>{{ $item->elemento->total }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total:</th>
                <th>{{ $cotizacion->total }}</th>
            </tr>
        </tfoot>
    </table>

    <p>Si tiene alguna pregunta, no dude en contactarnos.</p>
</body>
</html>
