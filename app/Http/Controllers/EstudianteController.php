<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Documentos;
use App\Models\Recursos;
use App\Models\Universidades;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;



class EstudianteController extends Controller
{
    protected string $routeName;
    protected string $source;
    protected string $module = 'estudiantes';
    protected User $model;

    public function __construct()
    {
        $this->middleware('auth');
        $this->routeName = "estudiantes.";
        $this->source    = "Estudiantes/";
        $this->model     = new User();
        $this->modelU     = new Universidades();
        $this->modelR     = new Recursos();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): Response
    {
        $request->status = $request->status === null ? true : $request->status;
        $records = $request->status == '0' ? $this->model->onlyTrashed() : $this->model;
        $records = $records->when($request->search, function ($query, $search) {
            if ($search != '') {
                $query->where('nombre', 'LIKE', '%' . $search . '%')
                    ->orWhere('descripcion', 'LIKE', '%' . $search . '%');
            }
        });

        return Inertia::render("{$this->source}Index", [
            'usuarios'  =>  $this->model::paginate(100),
            'titulo'          => 'Consulta estudiantes',
            'routeName'      => $this->routeName,
            
            'loadingResults' => false,
            'search'         => $request->search ?? '',
            'status'         => (bool) $request->status,
        ]);
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
        //
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
        $universidad = Universidades::find($estudiante->id_universidad);

        $documento = Documentos::where('id_estudiante', $estudiante->id)->paginate(100);
        $asignacion = Asignacion::where('id_estudiante', $estudiante->id)->paginate(100);
        
        
        return Inertia::render("{$this->source}Consulta", [
            'titulo'          => 'Consulta estudiante',
            'routeName'      => $this->routeName,
            'estudiantes' => $estudiante,
            'uni'  =>  $universidad,
            'doc' => $documento,
            'asig' => $asignacion,
            'recursos' => $this->modelR->paginate(100),

            
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
        $documento = Documentos::find($id);  
        return Inertia::render("{$this->source}Edit", [
            'titulo'          => 'Consulta estudiante',
            'routeName'      => $this->routeName,
            'doc' => $documento,
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
        $documento = Documentos::find($id);  
        $documento->update($request->all());
        
        return redirect()->route('estudiantes.show',$documento->id_estudiante);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
