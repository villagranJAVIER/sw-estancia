<?php

namespace App\Http\Controllers;

use App\Models\Recursos;
use App\Http\Requests\StoreRecursosRequest;
use App\Http\Requests\UpdateRecursosRequest;
use App\Models\User;
use Illuminate\Http\Request;
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
        $nombre = $request->input('nombre_documento') . $id . "." . $file->guessExtension();
        if (!Storage::disk($this->disk)->exists('DocumentosEstudiantes/'.$nombre)){
            //return 'existe';
            Documentos::create([
                'nombre_documento' => $request->input('nombre_documento'),
                'URL_documento' => $nombre,
                'estatus' => $request->input('estatus'),
                'comentarios' => $request->input('comentarios'),
                'id_estudiante' => $id,
                $file->storeAs('public/DocumentosEstudiantes', $nombre)
            ]);
        }else{
            return 'Este documento ya fue subido';
        }

        return redirect()->route("documentos.index");
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
    public function edit(Recursos $recursos)
    {
        //
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
    public function destroy(Recursos $recursos)
    {
        
    }

    public function subir($name)
    {
        return Inertia::render("{$this->source}Create", [
            'titulo'          => 'Agregar documento',
            'routeName'      => $this->routeName,
            'estudiante' => $name,
        ]);
    }
}
