<?php

namespace App\Http\Controllers\bancomer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\bancomer\Etiqueta;
use DB;

class EtiquetasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etiquetas = Etiqueta::paginate();

        return view('bancomer.etiqueta.index',compact('etiquetas'));
    }

    public function populate($id){
        $rspta = Etiqueta::select("id as id_etiqueta","descripcion")->get();


        //Obtener los tags asignados al usuario
        
        $marcados = DB::table("bancomer_personal as bp")
                        ->join('tag_bancomer_personal as tbp','tbp.personal_id','bp.id')
                        ->join('etiqueta as e','e.id','tbp.etiqueta_id')
                        ->select("e.id as id_etiqueta","e.descripcion as descripcion")
                        ->where('bp.id',$id)
                        ->get();
        
        
        //Declaramos el array para almacenar todos los tags marcados
        $valores=array();

        //Almacenar los tags asignados al usuario en el array
        foreach ($marcados as $m) {
            array_push($valores,$m->id_etiqueta);
        }
        $conteo = 0;
        //Mostramos la lista de tags en la vista y si están o no marcados
        foreach ($rspta as $r) {
            $conteo ++;
            $sw=in_array($r->id_etiqueta,$valores)?'checked':'';
            // echo '<li> <input type="checkbox" class="form-check-input" '.$sw.'  name="etiq[]"  value="'.$r->id_etiqueta.'">'.$r->descripcion.'</li>';
           echo '<div class="custom-control custom-control-alternative custom-checkbox">
                <input class="custom-control-input" name="etiq[]" id="etiq'.$conteo.'" type="checkbox" ' .$sw. ' value="'.$r->id_etiqueta.'">
                <label class="custom-control-label" for="etiq'.$conteo.'">
                    <span class="text-muted">'.$r->descripcion.'</span>
                </label>
            </div>';

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bancomer.etiqueta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $etiqueta = Etiqueta::create($request->all());

        if($etiqueta){
            toastr()->success('Etiqueta guardada con éxito');
            return redirect()->route('bancomer.etiqueta.index',$etiqueta->id);
        }else{
            toastr()->error('Etiqueta no se guardó');
            return redirect()->route('bancomer.etiqueta.edit',$etiqueta->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Etiqueta $etiqueta)
    {
        return view('bancomer.etiqueta.show',compact('etiqueta'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Etiqueta $etiqueta)
    {
        return view('bancomer.etiqueta.edit', compact('etiqueta'));       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etiqueta $etiqueta)
    {
        $etiqueta->update($request->all());

        if($etiqueta){
            toastr()->success('Etiqueta guardada con éxito');
            return redirect()->route('bancomer.etiqueta.index',$etiqueta->id);
        }else{
            toastr()->error('Etiqueta no se guardó');
            return redirect()->route('bancomer.etiqueta.edit',$etiqueta->id);
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
        $etiqueta = Etiqueta::find($id)->delete();

        if($etiqueta){
            toastr()->success('Etiqueta Eliminado correctamente');
            return redirect()->route('bancomer.etiqueta.index');
        }else{
            toastr()->error('Etiqueta no eliminado');
            return redirect()->route('bancomer.etiqueta.index');
        }
    }
}
