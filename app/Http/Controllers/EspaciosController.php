<?php

namespace App\Http\Controllers;

use App\Models\Espacios;
use App\Http\Requests\StoreEspaciosRequest;
use App\Http\Requests\UpdateEspaciosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Inertia\Inertia;
use Inertia\Response;

class EspaciosController extends Controller
{
    protected Espacios $model;
    protected string $source;
    protected string $routeName;
    protected string $module = 'espacios';
    private $disk = 'public';

    //Para proteger nuestras rutas
    public function __construct()
    {
        $this->middleware('auth');
        $this->source = 'Espacios/';
        $this->model = new Espacios();
        $this->routeName = 'espacios.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("{$this->source}Index", [
            'espacios'        =>  $this->model::paginate(100),
            'titulo'          => 'Gestion de espacios de documentos',
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
            'titulo'          => 'Agregar Espacios',
            'routeName'      => $this->routeName
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEspaciosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEspaciosRequest $request)
    {
        if($request->hasFile("URL_plantilla")){
            $file = $request->file('URL_plantilla');
            $nombre = $request->input('nombre_plantilla').'.'.$file->guessExtension();
            Espacios::create([
                'nombre_documento' => $request->input('nombre_documento'),
                'nombre_plantilla' => $request->input('nombre_plantilla'), 
                'URL_plantilla' => $nombre,                
                $file->storeAs('public/Formatos', $nombre)
            ]);
        }else{
            Espacios::create($request->validated());
        }
        return redirect()->route("espacios.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Espacios  $espacios
     * @return \Illuminate\Http\Response
     */
    public function show(Espacios $espacios)
    {
        abort(405);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Espacios  $espacios
     * @return \Illuminate\Http\Response
     */
    public function edit(Espacios $espacios)
    {
        return Inertia::render("{$this->source}Edit", [
            'titulo'          => 'Editar Espacios',
            'routeName'      => $this->routeName,
            'espacios' => $espacios
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEspaciosRequest  $request
     * @param  \App\Models\Espacios  $espacios
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEspaciosRequest $request, Espacios $espacios)
    {
        $espacios->update($request->validated());
        return redirect()->route('espacios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Espacios  $espacios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Espacios $espacios)
    {
        $espacios->delete();
        return redirect()->route('espacios.index');
    }

    public function uploadFile(Request $request){
        $file = $request->file('URL_plantilla');
        if($request->hasFile("URL_plantilla")){
            $nombre = $request->input('nombre_plantilla').'.'.$file->guessExtension();
            $file->storeAs('public/Formatos', $nombre);
        }
    }

    public function downloadFile($name){
        if (Storage::disk($this->disk)->exists('Formatos/'.$name)){
            $path = 'storage/Formatos/'.$name;
            return response()->download($path);
        }elseif(Storage::disk($this->disk)->exists('Formatos/'.$name.'.pdf')){
            $path = 'storage/Formatos/'.$name.'.pdf';
            return response()->download($path);
        }
        elseif(Storage::disk($this->disk)->exists('Formatos/'.$name.'.docx')){
            $path = 'storage/Formatos/'.$name.'.docx';
            return response()->download($path);
        }
        elseif(Storage::disk($this->disk)->exists('Formatos/'.$name.'.xlsx')){
            $path = 'storage/Formatos/'.$name.'.xlsx';
            return response()->download($path);
        }
        elseif(Storage::disk($this->disk)->exists('Formatos/'.$name.'.jpg')){
            $path = 'storage/Formatos/'.$name.'.jpg';
            return response()->download($path);
        }
        elseif(Storage::disk($this->disk)->exists('Formatos/'.$name.'.png')){
            $path = 'storage/Formatos/'.$name.'.png';
            return response()->download($path);
        }
        elseif(Storage::disk($this->disk)->exists('Formatos/'.$name.'.pptx')){
            $path = 'storage/Formatos/'.$name.'.pptx';
            return response()->download($path);
        }
        return 'documento no encontrado';
    }


}
