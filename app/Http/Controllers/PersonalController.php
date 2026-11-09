<?php

namespace App\Http\Controllers;




use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PersonalController extends Controller
{
    // ==========================================
    // 1. LISTAR ESTUDIANTES
    // ==========================================

    public function index()
    {
        $personales = Personal::orderBy('nombre', 'asc')->get();

        $programas = Personal::select('programa')
            ->whereNotNull('programa')
            ->where('programa', '<>', '')
            ->distinct()
            ->orderBy('programa', 'asc')
            ->pluck('programa');

        return view('personal.index', compact(
            'personales',
            'programas'
        ));
    }


    // ==========================================
    // 2. MOSTRAR FORMULARIO DE REGISTRO
    // ==========================================

    public function create()
    {
        return view('personal.create');
    }


    // ==========================================
    // 3. REGISTRAR ESTUDIANTE
    // ==========================================

    public function store(Request $request)
    {
        $datos = $request->validate([

            'documento' => [
                'required',
                'integer',
                'min:1',
                'max:2147483647',
                'unique:personal,ID'
            ],

            'apellido' => 'required|string|max:20',

            'nombre' => 'required|string|max:20',

            'fecha_nacimiento' => 'required|date',

            'codigo_estudiantil' =>
                'required|integer|min:1|max:2147483647',

            'programa' => 'required|string|max:25',

            'semestre' => 'required|integer|between:1,10',

            'correo' => [
                'required',
                'email',
                'max:40',
                'unique:personal,correo'
            ],

            'telefono' => 'required|string|max:20',

            'direccion' => 'required|string|max:30'
        ]);

        // El formulario envía "documento",
        // pero MySQL almacena ese dato en "ID".

        $datos['ID'] = $datos['documento'];

        unset($datos['documento']);

        Personal::create($datos);

        return redirect()
            ->route('personal.index')
            ->with('success', 'Estudiante registrado correctamente.');
    }


    // ==========================================
    // 4. CONSULTAR UN ESTUDIANTE
    // ==========================================

    public function show(string $id)
    {
        $personal = Personal::findOrFail($id);

        return view('personal.show', compact('personal'));
    }


    // ==========================================
    // 5. MOSTRAR FORMULARIO DE EDICIÓN
    // ==========================================

    public function edit(string $id)
    {
        $personal = Personal::findOrFail($id);

        return view('personal.edit', compact('personal'));
    }


    // ==========================================
    // 6. ACTUALIZAR ESTUDIANTE
    // ==========================================

    public function update(Request $request, string $id)
    {
        $personal = Personal::findOrFail($id);

        $datos = $request->validate([

            'apellido' => 'required|string|max:20',

            'nombre' => 'required|string|max:20',

            'fecha_nacimiento' => 'required|date',

            'codigo_estudiantil' =>
                'required|integer|min:1|max:2147483647',

            'programa' => 'required|string|max:25',

            'semestre' => 'required|integer|between:1,10',

            'correo' => [
                'required',
                'email',
                'max:40',
                Rule::unique('personal', 'correo')
                    ->ignore($personal->ID, 'ID')
            ],

            'telefono' => 'required|string|max:20',

            'direccion' => 'required|string|max:30'
        ]);

        $personal->update($datos);

        return redirect()
            ->route('personal.index')
            ->with('success', 'Estudiante actualizado correctamente.');
    }


    // ==========================================
    // 7. ELIMINAR ESTUDIANTE
    // ==========================================

    public function destroy(string $id)
    {
        $personal = Personal::findOrFail($id);

        $personal->delete();

        return redirect()
            ->route('personal.index')
            ->with('success', 'Estudiante eliminado correctamente.');
    }


    // ==========================================
    // 8. OBTENER ESTUDIANTES MEDIANTE JSON
    // ==========================================

    public function obtenerEstudiantes(Request $request)
    {
        $buscar = trim($request->input('buscar', ''));

        $programa = trim($request->input('programa', ''));

        $orden = $request->input('orden', 'asc');

        // Evitar que se envíen órdenes no permitidos.

        if (!in_array($orden, ['asc', 'desc'], true)) {
            $orden = 'asc';
        }

        $consulta = Personal::query();

        // Buscar por nombre o correo.

        if ($buscar !== '') {

            $consulta->where(function ($query) use ($buscar) {

                $query->where('nombre', 'LIKE', "%{$buscar}%")
                    ->orWhere('correo', 'LIKE', "%{$buscar}%");

            });

        }

        // Filtrar por programa académico.

        if ($programa !== '') {

            $consulta->where('programa', $programa);

        }

        // Ordenar los resultados.

        $estudiantes = $consulta
            ->orderBy('nombre', $orden)
            ->get([
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
            ]);

        return response()->json($estudiantes);
    }
}
