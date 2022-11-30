<?php

namespace App\Http\Controllers;

use App\Models\Recursos;
use App\Http\Requests\StoreRecursosRequest;
use App\Http\Requests\UpdateRecursosRequest;
use App\Models\Asignacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RecursosController extends Controller
{

    protected string $routeName;
    protected string $source;
    protected string $module = 'recursos';
    protected User $model;

    public function __construct()
    {
        $this->middleware('auth');
        $this->routeName = "recursos.";
        $this->source    = "Recursos/";
        $this->model     = new User();
        //$this->modelU     = new Universidades();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreRecursosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecursosRequest $request)
    {
        $file = $request->file('URL_documento');
        $id = $request->input('id_estudiante');
        $nombre = $request->input('nombre_documento') . $id . "." . $file->guessExtension();
        Recursos::create([
            'nombre_documento' => $request->input('nombre_documento'),
            'URL_documento' => $nombre,
            'id_estudiante' => $id,
            $file->storeAs('public/Recursos', $nombre)
        ]);

        return redirect()->route("estudiantes.show",$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recursos  $recursos
     * @return \Illuminate\Http\Response
     */
    public function show(Recursos $recursos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recursos  $recursos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recurso = Recursos::find($id);  
        return Inertia::render("{$this->source}Edit", [
            'titulo'          => 'Consulta estudiante',
            'routeName'      => $this->routeName,
            'recursos' => $recurso,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecursosRequest  $request
     * @param  \App\Models\Recursos  $recursos
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecursosRequest $request, Recursos $recursos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recursos  $recursos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recurso = Recursos::find($id); 
        $id = $recurso->id_estudiante;
        $recurso->delete();
        return redirect()->route("estudiantes.show",$id);
    }

    public function subir($id)
    {
        return Inertia::render("{$this->source}Create", [
            'titulo'          => 'Agregar documento',
            'routeName'      => $this->routeName,
            'estudiante' => $id,
        ]);
    }
    //downloadRecurso
    public function downloadFile($name){
        $path = 'storage/Recursos/'.$name;
        return response()->download($path);
    }
}
