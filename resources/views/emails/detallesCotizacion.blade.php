<!DOCTYPE html>
<html>
<head>
    <title>Detalles de Cotización #{{ $cotizacion->idCotizacion }}</title>
    <style>
      body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .cabecera {
            background-color: #004080;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }
        .cabecera img {
            width: 100px;
            display: block;
            margin: 0 auto 10px;
        }
        .cabecera h1 {
            margin: 0;
            font-size: 28px;
        }
        h1 {
            color: #004080;
            font-size: 28px;
            margin-bottom: 10px;
        }
        p {
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .proyecto, .desarrollador {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .proyecto div, .desarrollador div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .proyecto h3, .desarrollador h3 {
            color: #004080;
            font-size: 20px;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border: 1px solid #ddd;
        }
        th {
            background-color: #004080;
            color: #ffffff;
            padding: 10px;
            text-align: left;
        }
        th:last-child {
            text-align: right;
        }
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        td:last-child {
            text-align: right;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tfoot th {
            background-color: #f4f4f4;
            font-size: 16px;
            color: #333;
        }
        tfoot th:last-child {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="cabecera">
        <img src="./public/waiLogo.png" alt="waiLogo">
        <h1>Wai Technology</h1>
    </div>
    <h1>Detalles de Cotización #{{ $cotizacion->idCotizacion }}</h1>
    <p>Estimado(a) {{ $cliente->nombre_cliente }},</p>

    <p>Adjuntamos los detalles de su cotización y Proyecto:</p>
    <div class="proyecto">
        <div>
            <h3>Titulo de proyecto</h3>
            <span>{{ $proyecto->nombre_proyecto }}</span>
        </div>
        <div>
            <h3>Descripcion de proyecto</h3>
            <span>{{ $proyecto->descripcion }}</span>
        </div>
        <div>
            <h3>Fecha de inicio</h3>
            <span>{{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d-m-Y') }}</span>
        </div>
        <div>
            <h3>Fecha de fin</h3>
            <span>{{ \Carbon\Carbon::parse($proyecto->fecha_fin)->format('d-m-Y') }}</span>
        </div>
        <div>
            <h3>Nombre del desarrollador</h3>
            <span>{{$empleado->nombre_empleado}}</span>
        </div>
        <div>
            <h3>Correo del desarrollador</h3>
            <span>{{$empleado->correo_empleado}}</span>
        </div>
        <div>
            <h3>DNI del desarrollador</h3>
            <span>{{$empleado->dni_empleado}}</span>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Nombre Servicio</th>
                <th>Descripcion</th>
                <th>Costo</th>
                <th>Descuento </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cotizacion->elementos_cotizacion as $item) 
                <tr>
                    <td>{{ $item->elemento->nombre_elemento }}</td>
                    <td>{{ $item->elemento->descripcion }}</td>
                    <td>{{ $item->elemento->costo }}</td>
                    <td>{{ $item->cotizacion->descuento }}</td>
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
