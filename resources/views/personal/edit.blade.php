
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Estudiante</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 15px;
            font-family: Arial, sans-serif;
            background: #172033;
            color: #333;
        }

        .contenedor {
            max-width: 750px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.25);
        }

        h1 {
            text-align: center;
            color: #17275c;
            margin-top: 0;
        }

        .seccion {
            margin-bottom: 25px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .seccion h3 {
            margin-top: 0;
            color: #2563eb;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 10px;
        }

        .campo {
            margin-bottom: 17px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
        }

        input[readonly] {
            background: #eee;
            cursor: not-allowed;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .alerta {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .botones {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .boton {
            padding: 12px 22px;
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .actualizar {
            background: #2563eb;
        }

        .cancelar {
            background: #6b7280;
        }

        .boton:hover {
            opacity: 0.85;
        }

        @media (max-width: 600px) {
            .contenedor {
                padding: 18px;
            }

            .seccion {
                padding: 14px;
            }
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h1>Editar Estudiante</h1>

    @if($errors->any())
        <div class="alerta">
            <strong>Corrige los siguientes errores:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('personal.update', $personal->ID) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <!-- INFORMACIÓN PERSONAL -->

        <div class="seccion">

            <h3>Información Personal</h3>

            <div class="campo">
                <label>Documento de identidad:</label>

                <input
                    type="text"
                    value="{{ $personal->ID }}"
                    readonly
                >
            </div>

            <div class="campo">
                <label for="nombre">Nombre:</label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    maxlength="20"
                    value="{{ old('nombre', $personal->nombre) }}"
                    required
                >

                @error('nombre')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="apellido">Apellido:</label>

                <input
                    type="text"
                    id="apellido"
                    name="apellido"
                    maxlength="20"
                    value="{{ old('apellido', $personal->apellido) }}"
                    required
                >

                @error('apellido')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="fecha_nacimiento">
                    Fecha de nacimiento:
                </label>

                <input
                    type="date"
                    id="fecha_nacimiento"
                    name="fecha_nacimiento"
                    value="{{ old('fecha_nacimiento', $personal->fecha_nacimiento) }}"
                    required
                >

                @error('fecha_nacimiento')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

        </div>


        <!-- INFORMACIÓN ACADÉMICA -->

        <div class="seccion">

            <h3>Información Académica</h3>

            <div class="campo">
                <label for="codigo_estudiantil">
                    Código estudiantil:
                </label>

                <input
                    type="number"
                    id="codigo_estudiantil"
                    name="codigo_estudiantil"
                    min="1"
                    max="2147483647"
                    value="{{ old('codigo_estudiantil', $personal->codigo_estudiantil) }}"
                    required
                >

                @error('codigo_estudiantil')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="programa">Programa académico:</label>

                <input
                    type="text"
                    id="programa"
                    name="programa"
                    maxlength="25"
                    value="{{ old('programa', $personal->programa) }}"
                    required
                >

                @error('programa')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="semestre">Semestre:</label>

                <input
                    type="number"
                    id="semestre"
                    name="semestre"
                    min="1"
                    max="10"
                    value="{{ old('semestre', $personal->semestre) }}"
                    required
                >

                @error('semestre')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

        </div>


        <!-- INFORMACIÓN DE CONTACTO -->

        <div class="seccion">

            <h3>Información de Contacto</h3>

            <div class="campo">
                <label for="correo">Correo electrónico:</label>

                <input
                    type="email"
                    id="correo"
                    name="correo"
                    maxlength="40"
                    value="{{ old('correo', $personal->correo) }}"
                    required
                >

                @error('correo')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="telefono">Teléfono:</label>

                <input
                    type="tel"
                    id="telefono"
                    name="telefono"
                    maxlength="20"
                    value="{{ old('telefono', $personal->telefono) }}"
                    required
                >

                @error('telefono')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="campo">
                <label for="direccion">Dirección:</label>

                <input
                    type="text"
                    id="direccion"
                    name="direccion"
                    maxlength="30"
                    value="{{ old('direccion', $personal->direccion) }}"
                    required
                >

                @error('direccion')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

        </div>


        <!-- BOTONES -->

        <div class="botones">

            <button type="submit" class="boton actualizar">
                Actualizar estudiante
            </button>

            <a
                href="{{ route('personal.index') }}"
                class="boton cancelar"
            >
                Cancelar
            </a>

        </div>

    </form>

</div>

</body>
</html>
