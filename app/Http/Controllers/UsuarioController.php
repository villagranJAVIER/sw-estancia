<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Requests\StoreusuarioRequest;
use App\Http\Requests\UpdateusuarioRequest;
use App\Models\Universidades;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UsuarioController extends Controller
{
    protected string $routeName;
    protected string $source;
    protected string $module = 'usuarios';
    protected User $model;

    public function __construct()
    {
        $this->middleware('auth');
        $this->routeName = "usuarios.";
        $this->source    = "Usuarios/";
        $this->model     = new User();
        $this->modelU     = new Universidades();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("{$this->source}Index", [
            'usuarios'  =>  $this->model::paginate(100),
            'titulo'          => 'Gestion de usuarios',
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
            'titulo'          => 'Agregar Usuario',
            'universidades'  =>  $this->modelU::paginate(100),
            'routeName'      => $this->routeName
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreusuarioRequest $request)
    {
        $fields = $request->validated();
        $fields['password'] = Hash::make($fields['password']);
        User::create($fields);
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(405);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return Inertia::render("{$this->source}Edit", [
            'titulo'          => 'Editar usuario',
            'routeName'      => $this->routeName,
            'usuarios' => $user,
            'universidades'  =>  $this->modelU::paginate(100),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateusuarioRequest $request, $id)
    {
        $user = User::find($id);
        //dd($request);
        $user->update($request->all());
        
        return redirect()->route('usuarios.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('usuarios.index');
    }
}
