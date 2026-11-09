
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 15px;
            color: #222;
            background-color: #fff;
        }

        h2 {
            font-size: 25px;
            margin: 10px 0 20px;
        }

        .busqueda {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .busqueda input,
        .busqueda select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .busqueda input {
            flex: 1;
            min-width: 220px;
        }

        .busqueda select {
            min-width: 180px;
        }

        .btn-buscar, .btn-limpiar, .volver {
            display: inline-block;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-buscar { background-color: #2563eb; }
        .btn-limpiar { background-color: #6b7280; }
        .volver { background-color: #17275c; margin-top: 18px; }

        .contenedor-tabla {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 1100px;
            table-layout: fixed;
            border-collapse: collapse;
            font-size: 13px;
        }

        th {
            background-color: #52ab03;
            color: white;
            padding: 12px 6px;
            text-align: left;
            overflow-wrap: anywhere;
        }

        td {
            padding: 12px 6px;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
            overflow-wrap: anywhere;
        }

        tr:hover { background-color: #f5f5f5; }

        .acciones {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 7px;
        }

        .editar { color: #2563eb; }
        .consultar { color: #15803d; }
        .eliminar { color: #dc2626; }

        .acciones a, .acciones button {
            text-decoration: none;
            font-weight: bold;
            font-size: 12px;
            border: none;
            background: none;
            cursor: pointer;
        }

        .sin-resultados {
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fff3cd;
            border: 1px solid #ffe69c;
            border-radius: 6px;
            color: #664d03;
        }

        .mensaje-exito {
            padding: 12px;
            margin-bottom: 15px;
            background: #d1e7dd;
            color: #0f5132;
            border-radius: 6px;
        }
    </style>
</head>

<body>

    <h2>Listado de Estudiantes</h2>

    @if(session('success'))
        <div class="mensaje-exito">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="sin-resultados">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="GET" action="#" class="busqueda" id="formBusqueda">

        <input
            type="text"
            name="buscar"
            id="buscar"
            placeholder="Buscar por nombre o correo..."
        >

        <select name="programa" id="programa">
            <option value="">Todos los programas</option>

            @foreach($programas as $programa)
                <option value="{{ $programa }}">
                    {{ $programa }}
                </option>
            @endforeach
        </select>

        <select name="orden" id="orden">
            <option value="asc">Nombre A-Z</option>
            <option value="desc">Nombre Z-A</option>
        </select>

        <button type="submit" class="btn-buscar">
            Buscar
        </button>

        <button type="reset" class="btn-limpiar">
            Limpiar
        </button>

    </form>

    <div id="mensajeCarga">
        Cargando estudiantes...
    </div>

    <div id="mensajeResultados" class="sin-resultados" hidden>
        No se encontraron estudiantes con los criterios seleccionados.
    </div>

    <div id="mensajeErrorLista" class="sin-resultados" hidden>
        No fue posible cargar los estudiantes. Intenta nuevamente.
    </div>

    <div class="contenedor-tabla">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de nacimiento</th>
                    <th>Código estudiantil</th>
                    <th>Programa</th>
                    <th>Semestre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody id="tabla-estudiantes"></tbody>

        </table>

    </div>

    <a class="volver" href="{{ route('personal.create') }}">
        Volver al formulario
    </a>

    <script>
        const urlJson = @json(route('personal.json'));
        const urlEditar = @json(route('personal.edit', ['personal' => '__ID__']));
        const urlConsultar = @json(route('personal.show', ['personal' => '__ID__']));
        const urlEliminar = @json(route('personal.destroy', ['personal' => '__ID__']));
        const csrfToken = @json(csrf_token());

        const formulario = document.getElementById('formBusqueda');
        const tabla = document.getElementById('tabla-estudiantes');

        function crearCelda(valor) {
            const celda = document.createElement('td');
            celda.textContent = valor ?? '';
            return celda;
        }

        async function cargarEstudiantes() {
            const carga = document.getElementById('mensajeCarga');
            const resultados = document.getElementById('mensajeResultados');
            const error = document.getElementById('mensajeErrorLista');

            tabla.replaceChildren();
            carga.hidden = false;
            resultados.hidden = true;
            error.hidden = true;

            const parametros = new URLSearchParams(
                new FormData(formulario)
            );

            try {
                const respuesta = await fetch(
                    urlJson + '?' + parametros.toString(),
                    {
                        headers: {
                            'Accept': 'application/json'
                        }
                    }
                );

                if (!respuesta.ok) {
                    throw new Error('Error al consultar estudiantes');
                }

                const estudiantes = await respuesta.json();

                estudiantes.forEach(estudiante => {
                    const fila = document.createElement('tr');

                    const campos = [
                        'ID',
                        'nombre',
                        'apellido',
                        'fecha_nacimiento',
                        'codigo_estudiantil',
                        'programa',
                        'semestre',
                        'correo',
                        'telefono',
                        'direccion'
                    ];

                    campos.forEach(campo => {
                        fila.appendChild(crearCelda(estudiante[campo]));
                    });

                    const celdaAcciones = document.createElement('td');
                    const acciones = document.createElement('div');
                    acciones.className = 'acciones';

                    const editar = document.createElement('a');
                    editar.className = 'editar';
                    editar.href = urlEditar.replace(
                        '__ID__',
                        encodeURIComponent(estudiante.ID)
                    );
                    editar.textContent = 'Editar';

                    const consultar = document.createElement('a');
                    consultar.className = 'consultar';
                    consultar.href = urlConsultar.replace(
                        '__ID__',
                        encodeURIComponent(estudiante.ID)
                    );
                    consultar.textContent = 'Consultar';

                    const eliminar = document.createElement('button');
                    eliminar.className = 'eliminar';
                    eliminar.textContent = 'Eliminar';

                    eliminar.addEventListener('click', async () => {
                        if (!confirm('¿Está seguro de eliminar este estudiante?')) {
                            return;
                        }

                        const formularioEliminar = document.createElement('form');
                        formularioEliminar.method = 'POST';
                        formularioEliminar.action = urlEliminar.replace(
                            '__ID__',
                            encodeURIComponent(estudiante.ID)
                        );

                        const token = document.createElement('input');
                        token.type = 'hidden';
                        token.name = '_token';
                        token.value = csrfToken;

                        const metodo = document.createElement('input');
                        metodo.type = 'hidden';
                        metodo.name = '_method';
                        metodo.value = 'DELETE';

                        formularioEliminar.append(token, metodo);
                        document.body.appendChild(formularioEliminar);
                        formularioEliminar.submit();
                    });

                    acciones.append(editar, consultar, eliminar);
                    celdaAcciones.appendChild(acciones);
                    fila.appendChild(celdaAcciones);

                    tabla.appendChild(fila);
                });

                if (estudiantes.length === 0) {
                    resultados.hidden = false;
                }

            } catch (errorCarga) {
                error.hidden = false;
                console.error(errorCarga);

            } finally {
                carga.hidden = true;
            }
        }

        formulario.addEventListener('submit', evento => {
            evento.preventDefault();
            cargarEstudiantes();
        });

        formulario.addEventListener('reset', () => {
            setTimeout(cargarEstudiantes, 0);
        });

        cargarEstudiantes();
    </script>

</body>
</html>
