<?php

namespace App\Http\Controllers\bancomer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\bancomer\Orden;

class OrdenesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes = Orden::paginate();

        return view('bancomer.ordenes.index',compact('ordenes'));
    }

    public function listar(){
        $ordenes = Orden::select("descripcion")->where("tipo","=","bancomer")->get();

        return $ordenes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bancomer.ordenes.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orden = Orden::create($request->all());

        if($orden){
            toastr()->success('Orden guardada con éxito');
            return redirect()->route('bancomer.ordenes.index',$orden->id);
        }else{
            toastr()->error('Orden no se guardó');
            return redirect()->route('bancomer.ordenes.edit',$orden->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Orden $orden)
    {
        return view('bancomer.ordenes.show',compact('orden'));        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden $orden)
    {
        return view('bancomer.ordenes.edit', compact('orden'));       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden $orden)
    {
        $orden->update($request->all());

        if($orden){
            toastr()->success('Orden guardada con éxito');
            return redirect()->route('bancomer.ordenes.index',$orden->id);
        }else{
            toastr()->error('Orden no se guardó');
            return redirect()->route('bancomer.ordenes.edit',$orden->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orden = Orden::find($id)->delete();

        if($orden){
            toastr()->success('Etiqueta Eliminado correctamente');
            return redirect()->route('bancomer.ordenes.index');
        }else{
            toastr()->error('Etiqueta no eliminado');
            return redirect()->route('bancomer.ordenes.index');
        }
    }
}
