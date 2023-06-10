<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return response()->json( User::all(5));
        return view('admin.usuario.index');
    }

    public function all(){
        // dd('holamundo');
        return response()->json( User::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // user::pluck('name','name')->all();
        // return view('usuarios.create',compact('user'));
        return view('admin.usuarios.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nmae'=>'required',
            'email'=>'required|email|unique|:users,email',
            'password'=>'required|same:confirm-password',
            'roles'=>'required'
        ]);

        $input = $request->all();
        $input['password']=Hash::make($input['password']);

        $user = User::create('$input');
        $user->assingRole($request->input('roles'));

        return redirect()->route('admin.usuario.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole  = $user->roles->pluck('name','name')->all();

        return view('admin.Usuarios.editar',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'nmae'=>'required',
            'email'=>'required|email|unique|:users,email'.$id,
            'password'=>'required|same:confirm-password',
            'roles'=>'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])){
            $input['password']= hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('passwors'));
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assingRole($request->input('roles'));
        return redirect()->route('admin.usuarios.index');
    }

    public function updateStatus (int $id,Request $request){
        user::where('id',$id)->update([
            'status'=> $request->get('status')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.usuarios.destroy');
    }
}
