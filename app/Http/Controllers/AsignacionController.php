<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AsignacionController extends Controller
{
    protected User $model;
    protected string $source;
    protected string $routeName;
    protected string $module = 'asignaciones';
    private $disk = 'public';

    //Para proteger nuestras rutas
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->source = 'Asignaciones/';
        $this->model = new User();
        $this->routeName = 'asignaciones.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Asignacion::create($request->all());
        return redirect()->route('estudiantes.show', $request->id_estudiante);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudiante = User::find($id);
        $maestros = User::where('tipo', 3)->paginate(100);
        return Inertia::render("{$this->source}Create", [
            'usuarios'        =>  $maestros,
            'estudiante' => $estudiante,
            'titulo'          => 'Gestion de asignaciones',
            'routeName'      => $this->routeName
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asignacion = Asignacion::find($id);

        $maestros = User::where('tipo', 3)->paginate(100);
        return Inertia::render("{$this->source}Edit", [
            'titulo'          => 'Editar asignacion',
            'asignacion' => $asignacion,
            'maestros'  =>  $maestros,
            'routeName'      => $this->routeName
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $asignacion = Asignacion::find($id);  
        $asignacion->update($request->all());
        
        return redirect()->route('estudiantes.show',$asignacion->id_estudiante);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asignacion = Asignacion::find($id);
        $ruta = $asignacion->id_estudiante;
        $asignacion->delete();
        return redirect()->route('estudiantes.show',$ruta);
    }
}
