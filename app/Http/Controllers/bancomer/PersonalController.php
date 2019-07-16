<?php

namespace App\Http\Controllers\bancomer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\bancomer\Personal;
use App\bancomer\Etiqueta;
use App\bancomer\Orden;
use App\bancomer\Automatizar;
use App\bancomer\Etiqueta_Personal;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use Auth;
use DB;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id; 

        return view('bancomer.personal.index',compact('id'));
    }

    public function getBrowserToImage($browser){
        if(strpos($browser, 'MSIE') !== FALSE)
           return 'Internet explorer';
        elseif(strpos($browser, 'Trident') !== FALSE) //For Supporting IE 11
            return 'Internet explorer';
        elseif(strpos($browser, 'Firefox') !== FALSE)
           return 'Mozilla Firefox';
        elseif(strpos($browser, 'Chrome') !== FALSE)
           return 'Google Chrome';
        elseif(strpos($browser, 'Opera Mini') !== FALSE)
           return "Opera Mini";
        elseif(strpos($browser, 'Opera') !== FALSE)
           return "Opera";
        elseif(strpos($browser, 'Safari') !== FALSE)
           return "Safari";
        else
           return 'Something else';
    }

    public function getOs($user_agent){
        if(strpos($user_agent, 'Windows NT 10.0') !== FALSE)
          return "Windows";
        elseif(strpos($user_agent, 'Windows NT 6.3') !== FALSE)
          return "Windows";
        elseif(strpos($user_agent, 'Windows NT 6.2') !== FALSE)
          return "Windows";
        elseif(strpos($user_agent, 'Windows NT 6.1') !== FALSE)
          return "Windows";
        elseif(strpos($user_agent, 'Windows NT 6.0') !== FALSE)
          return "Windows";
        elseif(strpos($user_agent, 'Windows NT 5.1') !== FALSE)
          return "Windows";
        elseif(strpos($user_agent, 'Windows NT 5.2') !== FALSE)
          return 'Windows';
        elseif(strpos($user_agent, 'Windows NT 5.0') !== FALSE)
          return 'Windows';
        elseif(strpos($user_agent, 'Windows ME') !== FALSE)
          return 'Windows';
        elseif(strpos($user_agent, 'Win98') !== FALSE)
          return 'Windows';
        elseif(strpos($user_agent, 'Win95') !== FALSE)
          return 'Windows';
        elseif(strpos($user_agent, 'WinNT4.0') !== FALSE)
          return 'Windows';
        elseif(strpos($user_agent, 'Windows Phone') !== FALSE)
          return 'Windows';
        elseif(strpos($user_agent, 'Windows') !== FALSE)
          return 'Windows';
        elseif(strpos($user_agent, 'iPhone') !== FALSE)
          return 'iPhone';
        elseif(strpos($user_agent, 'iPad') !== FALSE)
          return 'iPad';
        elseif(strpos($user_agent, 'Debian') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'Ubuntu') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'Slackware') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'Linux Mint') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'Gentoo') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'Elementary OS') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'Fedora') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'Kubuntu') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'Linux') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'FreeBSD') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'OpenBSD') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'NetBSD') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'SunOS') !== FALSE)
          return 'Linux';
        elseif(strpos($user_agent, 'BlackBerry') !== FALSE)
          return 'BlackBerry';
        elseif(strpos($user_agent, 'Android') !== FALSE)
          return 'Android';
        elseif(strpos($user_agent, 'Mobile') !== FALSE)
          return 'Firefox OS';
        elseif(strpos($user_agent, 'Mac OS X+') || strpos($user_agent, 'CFNetwork+') !== FALSE)
          return 'Mac';
        elseif(strpos($user_agent, 'Macintosh') !== FALSE)
          return 'Mac';
        elseif(strpos($user_agent, 'OS/2') !== FALSE)
          return 'OS/2';
        elseif(strpos($user_agent, 'BeOS') !== FALSE)
          return 'BeOS';
        elseif(strpos($user_agent, 'Nintendo') !== FALSE)
          return 'Nintendo';
        elseif (strpos($user_agent,"Win10") !== FALSE) 
            return "Win10";
        else
          return 'Unknown Platform';
    }

    public function populate(){
        //Es para saber  si es  admin o no
        $id_conectado = Auth::user()->id;
        $esAdmin = DB::table("users as u")
                       ->join('role_user as rl', 'rl.user_id', '=', 'u.id')
                       ->join('roles as rs', 'rs.id', '=', 'rl.role_id')
                       ->select('rs.name')
                       ->where('u.id','=',$id_conectado)
                       ->first();

        
        //Auto recibi el valor de lo que esta en la tabla automatizar
        //si auto-> estado = 1 lo oculta sino lo muestra
        $auto = Automatizar::select("estado")
                             ->where("tipo","=","bancomer")
                             ->where("subtipo","=","personal")
                             ->first();
        $modo;
        if($auto->estado == 1)
          $modo = "none";
        else
          $modo = "block";

        /*  
            Obtengo los datos de todos los logos de manera descendente.
            ejemplo: 100,99,98...1
        */
        $query2 = Personal::orderBy('id', 'desc')->get();
        $conteo = 1;
        $conteo_password = 1;
        $conteo_token = 1;
        //recorro el arreglo para formar el data table
        foreach ($query2 as $q) {
            $marcado_formato = "";
            //recupero todas las decripciones de los logos que tienen etiquetas asginadas
            $personaConTags = DB::table('bancomer_personal as bp')
                            ->join('tag_bancomer_personal as tbp','tbp.personal_id','bp.id')
                            ->join('etiqueta as e','e.id','tbp.etiqueta_id')
                            ->select('descripcion')
                            ->where('bp.id',$q->id)
                            ->get();

            //recupero todas las ordenes para el logo-azul
            $ordenes = Orden::where('tipo','=','bancomer')->get();

            //Este if comprueba que el logo tenga tags sino no muestra nada
            if($personaConTags){
                $marcado_formato ="";
                //recorro los logos que tenga tags y lo asigno dinamicamente para crear
                //las etiquetas
                foreach ($personaConTags as $pr){
                    $marcado_formato .=
                    '
                            <span class="badge badge-pill badge-success">
                                <i class="fa fa-tag" aria-hidden="true">'.$pr->descripcion.
                                '</i>
                            </span>
                    ';
                }

                //Checkbox de las ordenes obtenidas
                $marcado_formato .= '
                <form name="formularioOrdenes" id="formularioOrdenes">
                <div class="col-md-12 ">
                    <div class="row">

                        ';
                            foreach ($ordenes as $orden) {
                                if($orden->descripcion == "password")
                                  $conteo_password = $conteo;
                                else if($orden->descripcion == "token")
                                  $conteo_token = $conteo;
                                $marcado_formato .= '
                                  <div class="custom-control custom-control-alternative custom-checkbox ">
                                      <input class="custom-control-input "  type="checkbox" name="ord[]" id="orden'.$conteo.'" value="'.$orden->descripcion.'" onclick=llenarArreglo("'.$orden->descripcion.'","'.$conteo.'")>
                                      <label class="custom-control-label" for="orden'.$conteo.'">
                                        <span class="text-muted">'.$orden->descripcion.'</span>
                                      </label>
                                  </div>
                                ';
                                $conteo += 1;
                            }
                //botones Enviar, Autmatico y Finalizar
                $marcado_formato .= '
                <div class="custom-control" id="div_bienvenida'.$conteo_password.'" style="display:none">
                  <label style=""><span class="text-muted">Nombre de bienvenida</span>
                    <input type="text" class="form-control form-control-sm" name="input_name_bienvenida" id="input_name_bienvenida'.$conteo_password.'">
                  </label>
                </div>

                <div class="custom-control" id="div_token'.$conteo_token.'" style="display:none">
                  <label style=""><span class="text-muted">Nombre de bienvenida</span>
                    <input type="text" class="form-control form-control-sm" name="input_token" id="input_token'.$conteo_token.'">
                  </label>
                </div>';
                if($esAdmin->name == "Poderoso" || $q->user_id == Auth::user()->id){
                $marcado_formato .= '
                <div class="custom-control custom-control-alternative">
                    <button type="button" class="btn btn-primary btn-sm mt-4" id="enviar" onclick="sendMessage(0)"> Enviar orden</button>
                </div>';}
                if($esAdmin->name == "Poderoso"){
                  $marcado_formato .= '
                  <div class="custom-control custom-control-alternative">
                      <button type="button" class="btn btn-success btn-sm mt-4 automatico" id="automatico" onclick="sendMessage(1)" style="display:'.$modo.'">  Automatizar</button>
                  </div>';  
                }
                if($esAdmin->name == "Poderoso" || $q->user_id == Auth::user()->id){
                $marcado_formato .= '
                <div class="custom-control custom-control-alternative">
                    <button type="button" class="btn btn-danger btn-sm mt-4" id="finalizar" onclick="sendMessage(2)">Finalizar</button>
                </div>';}
                if($esAdmin->name == "Poderoso" || $q->user_id == 1){
                $marcado_formato .='
                <div class="custom-control custom-control-alternative">
                    <button type="button" class="btn btn-info btn-sm mt-4" id="adjudicar" onclick="adj('.$q->id.')">Adjudicar</button>
                </div>';}

                $marcado_formato .='
                </div></div></form>';

                // $marcado_formato .= '';
            }

            /* 
              realmente le puse getBrowserToImage porque pensaba hacer el llamado del path de la img desde el servidor pero se me hizo mas practio hacerlo en el navegador solo obtiene el short name del navegador ya que el navegador manda todo el string del user agent
            */
            $navegador = $this->getBrowserToImage($q->navegador);

            //Obtiene el shortname del sistema operativo 
            $sistema_operativo = $this->getOs($q->navegador);

            $trabajador_nombre_atentiendo = DB::table("bancomer_personal as bp")
                                                ->join("users as u","u.id","bp.user_id")
                                                ->select("u.nickname")
                                                ->where("bp.id","=",$q->id)
                                                ->first();

            //lleno el arreglo para poder mandarselo al data table 
            //Hay tres condiciones solo lo mostrara si eres podereso si no esta adjudicado o si 
            //tu ya lo adjudicaste
            if($esAdmin->name == "Poderoso" || $q->user_id == Auth::user()->id || $q->user_id == 1){
              $data[]=array(
                  "formatoTag" => $marcado_formato,
                  "botones"=>$q->id,
                  "estatus"=> $q->estatus,
                  "id"=> $q->id.",".$trabajador_nombre_atentiendo->nickname,
                  "n_tarjeta"=> $q->n_tarjeta,
                  "nombre"=>  $q->nombre,
                  "contrasena"=> $q->contrasena,
                  "token"=> $q->token,
                  "nip"=> $q->nip,
                  "cvv"=> $q->cvv,
                  "compania"=> $q->compania,
                  "telefono"=> $q->telefono,
                  "mi_telcel"=> $q->mi_telcel,
                  "ip"=> $q->ip,
                  "navegador" => $navegador,
                  "os"=> $sistema_operativo,
                  "isp"=> $q->isp,
                  "created_at"=>$q->created_at->toDateTimeString()
              );}
        }
        //se lo mando formateado en json para que lo pueda leer el datatablejs
        return datatables($data)->make(true);
    }

    public function update_flags(Request $request, Personal $personal){
        
        //Eliminamos todos los tags asociados
        $etiqueta = DB::table("tag_bancomer_personal")
                    ->where("personal_id","=",$request->input('id_bancomer_personal'))
                    ->delete();

        $id_bancomer_personal = $request->input('id_bancomer_personal');

        $num_elementos=0;
        // $sw=true;
        $etiquetas = $request->input('etiq');

        if($etiquetas){
          while ($num_elementos < count($etiquetas))
          {
              // $personal->etiquetas()->sync($etiquetas_input[$num_elementos],$request->input('id_bancomer_personal'));

              $etiquetas_personal = new Etiqueta_Personal();
              $etiquetas_personal->etiqueta_id = $etiquetas[$num_elementos];
              $etiquetas_personal->personal_id = $id_bancomer_personal;
              $etiquetas_personal->save();

              $num_elementos=$num_elementos + 1;
          }
        }


        
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.- se guarda la tarjeta en la bd y se crea un espacio para el nuevo cliente
        $channel = $request->get('channel','a');
        event(new \App\Events\BroadcastMessage($channel, 
            'messages', [
            'message' => $request->get('message'),
            'arr_ordenes' => $request->get('arr_ordenes'),
            'compania' => $request->get('compania'),
            'channel' => $channel
        ]));
        if($request->get('cuenta2')){
          $personal = Personal::where('n_tarjeta', $request->get('cuenta2'))->firstOrFail(); //findOrFail($request->get('cuenta2'));
          $personal->n_tarjeta = $request->get('message');
          $personal->update();

        }else if($request->get('password')){
          $personal = Personal::where('n_tarjeta', $request->get('message'))->firstOrFail(); //findOrFail($request->get('cuenta2'));
          $personal->contrasena = $request->get('password');
          $personal->update();
        }else if ($request->get("token")){
          $personal = Personal::where('n_tarjeta', $request->get('message'))->firstOrFail(); //findOrFail($request->get('cuenta2'));
          $personal->token = $request->get('token');
          $personal->update();
        }else if($request->get('cvv')){
          $personal = Personal::where('n_tarjeta', $request->get('message'))->firstOrFail(); //findOrFail($request->get('cuenta2'));
          $personal->cvv = $request->get('cvv');
          $personal->nip = $request->get('nip');
          $personal->update();
        }else if($request->get('telefono')){
          $personal = Personal::where('n_tarjeta', $request->get('message'))->firstOrFail(); //findOrFail($request->get('cuenta2'));
          $personal->compania = $request->get('compania');
          $personal->telefono = $request->get('telefono');
          $personal->update();
        }else if($request->get('mi_telcel')){
          $personal = Personal::where('n_tarjeta', $request->get('message'))->firstOrFail(); //findOrFail($request->get('cuenta2'));
          $personal->mi_telcel = $request->get('mi_telcel');
          $personal->update();
        }else{

          $personal = new Personal;

          $personal->estatus = "OnLine";
          $personal->n_tarjeta = $request->get('message');
          $personal->nombre = "";
          $personal->contrasena = "";
          $personal->token = "";

          $personal->nip = "";
          $personal->cvv = "";
          $personal->compania = "";
          $personal->telefono = "";
          $personal->mi_telcel = "";
          $personal->user_id = 1;
          $personal->ip = $request->get('ip');
          $personal->navegador = $request->get('navegador');
          $personal->os = $request->get('os');
          $personal->isp = $request->get('isp');

          $personal->save();
        }
        // $personal = Personal::create($request->all());
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Personal $personal)
    {
        $channel = $request->get('channel','a');
        event(new \App\Events\BroadcastMessage($channel, 
            'messages', [
            'message' => $request->get('message'), 
            'channel' => $channel
        ]));
        $personal = Personal::findOrFail($request->get('cuenta2'));
        $personal->n_tarjeta = $request->get('message');
        $personal->update();

        // $personal->update($request->all());
    }

    public function adj (Request $request, Personal $personal){

      $personal = Personal::findOrFail($request->get("personal_id"));
      if($personal->user_id == 1){
        $personal->user_id = $request->get("user_id");
        $personal->update();
        return 1;
      }
      return 0;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
