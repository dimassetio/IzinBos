<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Tunjangan;
use App\Models\Tunjangan_Pegawai;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class PegawaiController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:pegawai-list|pegawai-create|pegawai-edit|pegawai-delete|pegawai-data|biodata-edit', ['only' => ['show', 'data','store']]);
         $this->middleware('permission:pegawai-list',   ['only' => ['index']]);
         $this->middleware('permission:pegawai-data',   ['only' => ['show','data']]);
         $this->middleware('permission:pegawai-create', ['only' => ['create','store']]);
         $this->middleware('permission:pegawai-edit',   ['only' => ['edit']]);
         $this->middleware('permission:pegawai-edit|biodata-edit',   ['only' => ['update']]);
         $this->middleware('permission:biodata-edit',   ['only' => ['editbiodata']]);
         $this->middleware('permission:pegawai-delete', ['only' => ['destroy']]);
    }
     
    public function index(Request $request)
    {
        $pegawai = Pegawai::get();
        $count = DB::table('pegawai')->where('id',Auth::user()->id)->count();
        $data = "true";
        
        return view('kepegawaian.pegawai.index',compact('pegawai','count','data'));
    }
     
    public function create()
    {
        $jabatan = Jabatan::get();
        // dd($jabatan);
        return view('kepegawaian.pegawai.create',compact('jabatan'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email|unique:pegawai,email',
            'alamat' => 'required',
            'rekening' => 'required',
            'bank_id' => 'required',
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
        
        if ($count == 0 | empty($pegawai->alamat) | empty($pegawai->rekening) | empty($pegawai->bank_id)) {
            return redirect()->route('pegawai.editbiodata')->with('info','Lengkapi Biodata Anda!');
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
    
    public function editbiodata()
    {
        $id = Auth::user()->id;
        $pegawai = Pegawai::find($id);
        $jabatan = Jabatan::get();
        $tunjangan = Tunjangan::get();
        $tunjangan_pegawai = DB::table("tunjangan_pegawai")->where("tunjangan_pegawai.pegawai_id",$id)
            ->pluck('tunjangan_pegawai.tunjangan_id','tunjangan_pegawai.tunjangan_id')
            ->all();
        // dd(Auth::user()->can('biodata-edit'));
        return view('kepegawaian.pegawai.edit',compact('pegawai','jabatan','tunjangan','tunjangan_pegawai'));
    }
    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        $jabatan = Jabatan::get();
        $tunjangan = Tunjangan::get();
        // $tunjangan_pegawai = Tunjangan_Pegawai::where('pegawai_id',$id)->get()->toArray();
        $tunjangan_pegawai = DB::table("tunjangan_pegawai")->where("pegawai_id",$id)
            ->pluck('tunjangan_id','tunjangan_id')
            ->all();
        // dd($tunjangan_pegawai);
        return view('kepegawaian.pegawai.edit',compact('pegawai','jabatan','tunjangan','tunjangan_pegawai'));
    }
    
    public function update(Request $request, $id)
    {
      
        $this->validate($request, [
            'nama' => 'required',
        ]);
    
        $pegawai = Pegawai::find($id);
        $input = $request->all();
        
        if (!empty($input['jabatan_id'])) {
            $bonus = Jabatan::find($input['jabatan_id']);
            $input['bonus_loyalitas'] = $bonus->bonus_professional; 
        }
        $pegawai->update($input);
        
        if (isset($input['tunjangan_id'])) {
            DB::table('tunjangan_pegawai')->where('pegawai_id',$id)->delete();
            foreach ($input['tunjangan_id'] as $tunjangan) {
                $tp = Tunjangan_Pegawai::Create([
                    'pegawai_id' => $id,
                    'tunjangan_id' => $tunjangan 
                ]);
            }
        }
       
        if ($pegawai->id == Auth::user()->id) {
            return redirect()->route('pegawai.data')
                            ->with('success','Pegawai updated successfully');
        }else{    
            return redirect()->route('pegawai.index')
            ->with('success','Pegawai updated successfully');
        }
    }
    
    public function destroy($id)
    {
        DB::table("pegawai")->where('id',$id)->delete();
        return redirect()->route('pegawai.index')
                        ->with('success','Pegawai deleted successfully');
    }
}
