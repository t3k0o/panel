<?php

namespace App\Http\Controllers\bancomer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\bancomer\Automatizar;


class AutomatizarController extends Controller
{
    public function index(){
        $auto = Automatizar::select("id","estado","tipo","subtipo")
                             ->where("tipo","=","bancomer")
                             ->where("subtipo","=","personal")
                             ->get();
        // $auto = Automatizar::select("estado")
        //                      ->where("tipo","=","bancomer")
        //                      ->where("subtipo","=","personal")
        //                      ->first();
        return $auto;
    }

    public function update(Request $request,Automatizar $auto)
    {
        $auto = Automatizar::findOrFail($request->get("id_btn"));
        $auto->estado = $request->get("estado_btn");
        $auto->update();
    }
}
