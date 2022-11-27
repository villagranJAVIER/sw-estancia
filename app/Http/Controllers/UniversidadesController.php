<?php

namespace App\Http\Controllers;

use App\Models\Universidades;
use App\Http\Requests\StoreUniversidadesRequest;
use App\Http\Requests\UpdateUniversidadesRequest;
use Inertia\Response;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UniversidadesController extends Controller
{
    protected Universidades $model;
    protected string $source;
    protected string $routeName;
    protected string $module = 'universidades';

    //Para proteger nuestras rutas
    public function __construct()
    {
        $this->middleware('auth');
        $this->source = 'Universidades/';
        $this->model = new Universidades();
        $this->routeName = 'universidades.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return Inertia::render("{$this->source}Index", [
            'universidades'  =>  $this->model::paginate(100),
            'titulo'          => 'Gestion de universidades',
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
            'titulo'          => 'Agregar Universidad',
            'routeName'      => $this->routeName
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUniversidadesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUniversidadesRequest $request)
    {
        Universidades::create($request->validated());
        return redirect()->route('universidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Universidades  $universidades
     * @return \Illuminate\Http\Response
     */
    public function show(Universidades $universidades)
    {
        abort(405);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Universidades  $universidades
     * @return \Illuminate\Http\Response
     */
    public function edit(Universidades $universidades)
    {
        return Inertia::render("{$this->source}Edit", [
            'titulo'          => 'Editar Universidades',
            'routeName'      => $this->routeName,
            'universidades' => $universidades
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUniversidadesRequest  $request
     * @param  \App\Models\Universidades  $universidades
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUniversidadesRequest $request, Universidades $universidades)
    {
        $universidades->update($request->validated());
        return redirect()->route('universidades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Universidades  $universidades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Universidades $universidades)
    {
        $universidades->delete();
        return redirect()->route('universidades.index');
    }
}
