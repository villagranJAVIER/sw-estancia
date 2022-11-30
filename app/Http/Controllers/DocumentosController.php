<?php

namespace App\Http\Controllers;

use App\Models\Documentos;
use App\Http\Requests\StoreDocumentosRequest;
use App\Http\Requests\UpdateDocumentosRequest;
use App\Models\Asignacion;
use App\Models\Espacios;
use App\Models\Recursos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class DocumentosController extends Controller
{
    protected Documentos $model;
    protected string $source;
    protected string $routeName;
    protected string $module = 'documentos';
    private $disk = 'public';

    //Para proteger nuestras rutas
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->source = 'Documentos/';
        $this->model = new Documentos();
        $this->modelo = new Espacios();
        $this->modelAsignacion = new Asignacion();
        $this->modelRecursos = new Recursos();
        $this->routeName = 'documentos.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("{$this->source}Index", [
            'espacios'        =>  $this->modelo::paginate(100),
            'documentos'        =>  $this->model::paginate(100),
            'asig'        =>  $this->modelAsignacion::paginate(100),
            'recursos' => $this->modelRecursos::paginate(100),
            'titulo'          => 'Gestion de documentos estudiante',
            'routeName'      => $this->routeName
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("{$this->source}Create", [
            'titulo'          => 'Agregar documento',
            'routeName'      => $this->routeName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentosRequest $request)
    {
        $id =  Auth::id();
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
     * @param  \App\Models\Documentos  $documentos
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documentos  $documentos
     * @return \Illuminate\Http\Response
     */
    public function edit(Documentos $documentos)
    {
        return Inertia::render("{$this->source}Edit", [
            'titulo'          => 'Editar documento',
            'routeName'      => $this->routeName,
            'documentos' => $documentos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentosRequest  $request
     * @param  \App\Models\Documentos  $documentos
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentosRequest $request, Documentos $documentos)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documentos  $documentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documentos $documentos)
    {
        $url = 'public/DocumentosEstudiantes/'. $documentos->getAttribute('URL_documento');
        Storage::delete($url);
        $documentos->delete();
        return redirect()->route('documentos.index');
    }

    public function subir($name)
    {
        return Inertia::render("{$this->source}Create", [
            'titulo'          => 'Agregar documento',
            'routeName'      => $this->routeName,
            'nombre_doc' => $name,
        ]);
    }

    public function downloadFile($name){
        if (Storage::disk($this->disk)->exists('DocumentosEstudiantes/'.$name)){
            $path = 'storage/DocumentosEstudiantes/'.$name;
            return response()->download($path);
        }elseif(Storage::disk($this->disk)->exists('DocumentosEstudiantes/'.$name.'.pdf')){
            $path = 'storage/DocumentosEstudiantes/'.$name.'.pdf';
            return response()->download($path);
        }
        return 'documento no encontrado';
    }
}
