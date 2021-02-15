<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Jabatan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class PegawaiController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:pegawai-list|pegawai-create|pegawai-edit|pegawai-delete', ['only' => ['index','store']]);
         $this->middleware('permission:pegawai-create', ['only' => ['create','store']]);
         $this->middleware('permission:pegawai-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pegawai-delete', ['only' => ['destroy']]);
    }
     
    public function index(Request $request)
    {
        $pegawai = Pegawai::orderBy('id','DESC')->paginate(10);
        return view('kepegawaian.pegawai.index',compact('pegawai','jabatan'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
     
    public function create()
    {
        $jabatan = Jabatan::get();
        return view('kepegawaian.pegawai.create',compact('jabatan'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email|unique:pegawai,email',
            'alamat' => 'required',
            'tanggal_masuk' => 'required',
            'rekening' => 'required',
            'type_pegawai' => 'required',
            'bank_id' => 'required',
            'jabatan_id' => 'required',
            // 'bonus_loyalitas' => 'required',
        ]);

        $input = $request->all();
        $pegawai = Pegawai::create($input);
    
        return redirect()->route('pegawai.index')
                        ->with('success','Pegawai created successfully');
    }

 
     
    // public function show($id)
    // {
    //     $role = Role::find($id);
    //     $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
    //         ->where("role_has_permissions.role_id",$id)
    //         ->get();
    
    //     return view('kepegawaian.pegawai.show',compact('role','rolePermissions'));
    // }
    
    // public function edit($id)
    // {
    //     $role = Role::find($id);
    //     $permission = Permission::get();
    //     $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
    //         ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
    //         ->all();
    
    //     return view('kepegawaian.pegawai.edit',compact('role','permission','rolePermissions'));
    // }
    
    
    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'permission' => 'required',
    //     ]);
    
    //     $role = Role::find($id);
    //     $role->name = $request->input('name');
    //     $role->save();
    
    //     $role->syncPermissions($request->input('permission'));
    
    //     return redirect()->route('pegawai.index')
    //                     ->with('success','Role updated successfully');
    // }
    
    public function destroy($id)
    {
        DB::table("pegawai")->where('id',$id)->delete();
        return redirect()->route('pegawai.index')
                        ->with('success','Role deleted successfully');
    }
}
