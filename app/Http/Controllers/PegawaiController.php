<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
use App\Models\Jabatan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class PegawaiController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:pegawai-list|pegawai-create|pegawai-edit|pegawai-delete|pegawai-data', ['only' => ['show','store']]);
         $this->middleware('permission:pegawai-data', ['only' => ['show']]);
         $this->middleware('permission:pegawai-create', ['only' => ['create','store']]);
         $this->middleware('permission:pegawai-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pegawai-delete', ['only' => ['destroy']]);
    }
     
    public function index(Request $request)
    {
        $pegawai = Pegawai::orderBy('id','DESC')->paginate(10);
        $count = DB::table('pegawai')->where('id',Auth::user()->id)->count();
        $data = "true";
        
        return view('kepegawaian.pegawai.index',compact('pegawai','count','data'))
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
        $bonus = Jabatan::find($request->jabatan_id);
        $input['bonus_loyalitas'] = $bonus->bonus_professional; 
        $input['id'] = Auth::user()->id; 
        $pegawai = Pegawai::create($input);
        

    
        return redirect()->route('pegawai.show', $input['id'])
                        ->with('success','Pegawai registered successfully');
    }

 
    public function data()
    {
        $id = Auth::user()->id;
        $pegawai = Pegawai::find($id);
        $count = DB::table('pegawai')->where('id',$id)->count();
        
        if ($count == 0) {
            return redirect()->route('pegawai.create');
        }else {
            return view('kepegawaian.pegawai.show',compact('pegawai','count','id'));
        }
    }
     
    public function show($id)
    {
        $pegawai = Pegawai::find($id);
        $count = DB::table('pegawai')->where('id',$id)->count();
        
        if ($count == 0) {
            return redirect()->route('pegawai.create');
        }else {
            return view('kepegawaian.pegawai.show',compact('pegawai','count','id'));
        }
    }
    
    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        $jabatan = Jabatan::get();
        return view('kepegawaian.pegawai.edit',compact('pegawai','jabatan'));
        // if (Auth::user()->id == $pegawai->id) {
        //     return view('kepegawaian.pegawai.edit',compact('pegawai','jabatan'));
        // }
        // else{
        //     return redirect()->route('pegawai.index')
        //         ->with('errors','Anda tidak dapat mengedit profile orang lain');
        // } 
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
        ]);
    
        $pegawai = Pegawai::find($id);
        $input = $request->all();
        $bonus = Jabatan::find($request->jabatan_id);
        $input['bonus_loyalitas'] = $bonus->bonus_professional; 
        $pegawai->update($input);
    
        // $pegawai->syncPermissions($request->input('permission'));
    
        return redirect()->route('pegawai.index')
                        ->with('success','Pegawai updated successfully');
    }
    
    public function destroy($id)
    {
        DB::table("pegawai")->where('id',$id)->delete();
        return redirect()->route('pegawai.index')
                        ->with('success','Pegawai deleted successfully');
    }
}
