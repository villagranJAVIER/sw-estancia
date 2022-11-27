<?php

namespace App\Http\Controllers;

use App\Models\Recursos;
use App\Http\Requests\StoreRecursosRequest;
use App\Http\Requests\UpdateRecursosRequest;

class RecursosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
        //
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
        //
    }
}
