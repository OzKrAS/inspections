<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Persona;

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
        
            $array = array(
            'res' => false,
            "id" => $usuario[0]->id,
            "api_token" => $update->api_token,
            'message' => 'bienvenido al json'
            );
            return response()->json($array,201);
        
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
            ->select('personas.id','personas.nombreFull','personas.nombres','personas.apellidos','personas.tp_doc','personas.num_doc','personas.direccion','personas.telefono','personas.email','users.usuario','users.password','users.condicion','users.idrol','roles.nombre as rol')
            ->orderBy('personas.id', 'desc')->paginate(15);
        }
        else{
            $personas = User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('personas.id','personas.nombre','personas.tp_doc','personas.num_doc','personas.direccion','personas.telefono','personas.email','users.usuario','users.password','users.condicion','users.idrol','roles.nombre as rol')
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
            $persona->nombres = $request->nombre;
            $persona->apellidos = $request->apeliido;
            $persona->tp_doc = $request->tp_doc;
            $persona->num_doc = $request->num_doc;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();

            $user = new User();
            $user->id = $persona->num_doc;
            $user->idrol = $request->idrol;
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
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
                $persona->nombres = $request->nombre;
                $persona->apellidos = $request->apellido;
                $persona->tp_doc = $request->tipo_doc;
                $persona->num_doc = $request->num_documento;
                $persona->direccion = $request->direccion;
                $persona->telefono = $request->telefono;
                $persona->email = $request->email;
                $persona->save();

                $user->usuario = $request->usuario;
                $user->password = bcrypt( $request->password);
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
        $user->condicion = '0';
        $user->save();
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
}
