<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\User;
use App\File;
use App\Persona;
use Datatables;

class UserController extends Controller
{
    private $apiToken;
    public function __construct()
    {
        $this->apiToken = uniqid(base64_encode(str_random(60)));
    }

    public function login(Request $request){
        $data = $request->json()->all();
        $usuario = User::where('usuario', '=', $data['usuario'])->get();
        if (count($usuario) == 0) {
            $user->api_token = Str::random(100);
            $user->save();
            return response()->json([
                'res' => true,
                'token'=> $user->api_token, 
                'message' => 'bienvenido al sistema'
            ],200);
        }

        if( password_verify( $data['password'],$usuario[0]->password)){
            $update = User::find($usuario[0]->id);
            $update->api_token = $this->apiToken;
            $update->save();
            
            $headers=array('Access-Control-Allow-Origin'=>'*', 'Access-Control-Allow-Methods'=>'GET, POST, PUT, DELETE', 'Access-Control-Allow-Headers'=>'X-Requested-With, Content-Type, X-Token-Auth, Authorization');


            $array = array(
            'res' => false,
            "id" => $usuario[0]->id,
            "api_token" => $update->api_token,
            'message' => 'bienvenido al json'
            );
            return response()->json($array,201, $headers);
        
        }
        
        else {
        return response()->json(['error' => 'Unauthorized'], 401, []); }
    }

    public function logout (){
        $user = auth()->user();
        $user->api_token = null;
        $user->save();

        return response()->json([
            'res' => true,
            'message' => 'sesión cerrada'
        ],200);
    }

    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $personas = User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            // ->select('personas.id','personas.nombreFull','personas.nombres','personas.apellidos','personas.tp_doc','personas.num_doc','personas.direccion','personas.telefono','personas.email','users.usuario','users.password','users.condicion','users.idrol','roles.nombre as rol')
            ->select('personas.id','personas.nombre','personas.num_documento', 'personas.tipo_documento', 'personas.direccion','personas.telefono','personas.email','users.usuario','users.password','users.condicion','users.idrol','roles.nombre as rol')
            ->orderBy('personas.id', 'desc')->paginate(15);
        }
        else{
            $personas = User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            // ->select('personas.id','personas.nombre','personas.tp_doc','personas.num_doc','personas.direccion','personas.telefono','personas.email','users.usuario','users.password','users.condicion','users.idrol','roles.nombre as rol')
            ->select('personas.id','personas.nombre','personas.num_documento', 'personas.tipo_documento','personas.direccion','personas.telefono','personas.email','users.usuario','users.password','users.condicion','users.idrol','roles.nombre as rol')
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(15);
        }
        
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $persona = new Persona();
            $persona->id = $request->id;
            $persona->nombre = $request->nombre;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();

            $user = new User();
            $user->id = $persona->num_documento;
            $user->idrol = $request->idrol;
            $user->usuario = $request->usuario;
            $user->nom = $persona->nombre;
            $user->id_usuario = $persona->num_documento;
            $user->password = bcrypt( $persona->num_documento);
            $user->condicion = '1';            
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function store1 (Request $request) {
       $input = $request -> all();
       $input['password'] = Hash::make($request -> password);

       User::create($input);
       return response()->json([
           'res' => true,
           'message' => 'Usuario creado correctamente',
       ],200);
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{

                DB::beginTransaction();

                $user = User::findOrFail($request->id);
                $persona = Persona::findOrFail($user->id);
                $persona->nombre = $request->nombre;
                // $persona->apellidos = $request->apellido;
                $persona->tipo_documento = $request->tipo_documento;
                $persona->num_documento = $request->num_documento;
                $persona->direccion = $request->direccion;
                $persona->telefono = $request->telefono;
                $persona->email = $request->email;
                $persona->save();

                $user->usuario = $request->usuario;
                // $user->password = bcrypt( $request->password);
                $user->condicion = '1';
                $user->idrol = $request->idrol;
                $user->save();

                DB::commit();
            // }
        } catch (Exception $e){
            DB::rollBack();
        }
        
    }

    public function updatePw(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{

                DB::beginTransaction();

                $user = User::findOrFail($request->id);


                $user->password = bcrypt( $request->password);
                $user->save();

                DB::commit();
            // }
        } catch (Exception $e){
            DB::rollBack();
        }
        
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        
        $persona = Persona::findOrFail($request->id);
        // $user->condicion = '0';
        // $user->save();
        $user->delete();
        $persona->delete();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    // METODOS USUARIOS SISTEMA WEB REQUEST
    public function listarusuarios(){
        $usuarios = User::join('personas', 'personas.id', '=', 'users.id_usuario')
        // ->select('users.id', 'personas.nombre', 'users.idrol', 'users.')
        ->get();

        // dd($usuarios);

        // return Datatables::of($usuarios)
        //     ->make(true);
        // dd($usuarios);

        return view('contenido.usuarios', compact('usuarios'));
    }

    public function buscarUsuario(Request $request)
    {
        
        $personas = User::join('personas','users.id','=','personas.id')
        ->select('users.id', 'personas.id','personas.nombre','personas.tipo_documento','personas.num_documento','personas.direccion','personas.telefono','personas.email','users.usuario','users.password','users.condicion')
        ->where('users.id','=', auth()->user()->id)
        ->get();
        
        return [
            'personas' => $personas[0]
        ];
    }

    public function actualizarPerfil(Request $request){
        if (!$request->ajax()) return redirect('/');

        DB::beginTransaction();

        $user = User::findOrFail( auth()->user()->id );
        $persona = Persona::findOrFail($user->id);
        $persona->nombre = $request->nombre;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento = $request->num_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->save();

        $user->usuario = $request->email;
        $user->nom = $request->nombre;
        $user->save();

        DB::commit();
    }

    public function checkPassword( Request $request){
        if (!$request->ajax()) return redirect('/');
        $pass = $request->password;

        $user = User::findOrFail( auth()->user()->id );

        if (Hash::check($request->password, $user->password)) {
            return json_encode(true);
        }
        else {
            return json_encode(false);
        }
    }

    public function actualizarPw(Request $request){
        if (!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        $user = User::findOrFail( auth()->user()->id );
        $user->password = Hash::make($request->password);
        $user->save();
        DB::commit();
    }

    public function getImg( Request $request ){
        if (!$request->ajax()) return redirect('/');
        
        $file = File::where('fileable_id', '=', auth()->user()->id)->get();
        return storage_path('app/file/'.$file[0]->name);
    }
}
