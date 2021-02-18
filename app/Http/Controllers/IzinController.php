<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Izin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class IzinController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:izin-list|izin-create|izin-edit|izin-delete|izin-confirmation', ['only' => ['index','store']]);
         $this->middleware('permission:izin-create', ['only' => ['create','store']]);
         $this->middleware('permission:izin-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:izin-delete', ['only' => ['destroy']]);
         $this->middleware('permission:izin-confirmation', ['only' => ['confirm']]);
    }

    public function index(Request $request)
    {
        $izin = Izin::orderBy('id','DESC')->paginate();
        // dd($izin);
        Pegawai::pluck('nama','nama');
        return view('perizinan.index',compact('izin','nama'))
            ->with('i', ($request->input('page', 1) - 1) );
    }
     
    public function create()
    {
        
        return view('perizinan.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'type_izin' => 'required',
        ]);
        $id = Auth::user()->id;
        $input = $request->all();
        $input['pegawai_id'] = $id;
        $tes = Izin::create($input);
        // dd($tes);

        return redirect()->route('izin.index')
                        ->with('success','Izin created successfully');
    }

 
     
    public function show($id)
    {
        $izin = Izin::find($id);
        return view('perizinan.show',compact('izin'));
    }
    
    public function edit($id)
    {
        $izin = Izin::find($id);
        $pegawai = Pegawai::get();
        return view('perizinan.edit',compact('pegawai','izin'));
    }
    
    
      public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status_diterima' => 'required',
        ]);
    
        $izin = Izin::find($id);
        $input = $request->all();
        $izin->update($input);
    
        // $izin->syncPermissions($request->input('permission'));
    
        return redirect()->route('izin.index')
                        ->with('success','Izin updated successfully');
    }

      public function confirm($izin)
    {
        // dd($izin);
        $izin = Izin::find($izin);
        $status['status_diterima'] = 'diterima';
        $izin->update($status);
        // dd($izin);
        // $izin->syncPermissions($request->input('permission'));
    
        return redirect()->route('izin.index');
    }
    
    public function destroy($id)
    {
        DB::table("izin")->where('id',$id)->delete();
        return redirect()->route('izin.index')
                        ->with('success','Izin deleted successfully');
    }
}
