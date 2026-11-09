
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar estudiante</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 30px 15px;
        }

        .contenedor {
            max-width: 750px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            color: #263238;
            margin-bottom: 25px;
        }

        .campo {
            margin-bottom: 16px;
        }

        .campo label {
            display: block;
            font-weight: bold;
            color: #444;
            margin-bottom: 6px;
        }

        .campo p {
            background: #f5f5f5;
            padding: 11px;
            border-radius: 6px;
            margin: 0;
            color: #333;
            overflow-wrap: anywhere;
        }

        .botones {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .boton {
            display: inline-block;
            padding: 11px 20px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .volver {
            background: #607d8b;
        }

        .editar {
            background: #1976d2;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h1>Información del estudiante</h1>

    <div class="campo">
        <label>Documento:</label>
        <p>{{ $personal->ID }}</p>
    </div>

    <div class="campo">
        <label>Nombre:</label>
        <p>{{ $personal->nombre }}</p>
    </div>

    <div class="campo">
        <label>Apellido:</label>
        <p>{{ $personal->apellido }}</p>
    </div>

    <div class="campo">
        <label>Fecha de nacimiento:</label>
        <p>{{ $personal->fecha_nacimiento }}</p>
    </div>

    <div class="campo">
        <label>Código estudiantil:</label>
        <p>{{ $personal->codigo_estudiantil }}</p>
    </div>

    <div class="campo">
        <label>Programa:</label>
        <p>{{ $personal->programa }}</p>
    </div>

    <div class="campo">
        <label>Semestre:</label>
        <p>{{ $personal->semestre }}</p>
    </div>

    <div class="campo">
        <label>Correo electrónico:</label>
        <p>{{ $personal->correo }}</p>
    </div>

    <div class="campo">
        <label>Teléfono:</label>
        <p>{{ $personal->telefono }}</p>
    </div>

    <div class="campo">
        <label>Dirección:</label>
        <p>{{ $personal->direccion }}</p>
    </div>

    <div class="botones">

        <a href="{{ route('personal.index') }}" class="boton volver">
            Volver al listado
        </a>

        <a href="{{ route('personal.edit', $personal->ID) }}" class="boton editar">
            Editar estudiante
        </a>

    </div>

</div>

</body>
</html>
