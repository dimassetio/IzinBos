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
         $this->middleware('permission:izin-list|izin-create|izin-edit|izin-delete|izin-confirmation', ['only' => ['data','store']]);
         $this->middleware('permission:izin-create', ['only' => ['create','store']]);
         $this->middleware('permission:izin-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:izin-delete', ['only' => ['destroy']]);
         $this->middleware('permission:izin-confirmation', ['only' => ['confirm','index']]);
    }

    public function index(Request $request)
    {
        $izin = Izin::select(['izin.id','tanggal_mulai','tanggal_selesai','type_izin','status_diterima','nama'])
                    ->join('pegawai','izin.pegawai_id', '=', 'pegawai.id')->get();
        return view('perizinan.index',compact('izin'));
    }
    
    public function data(Request $request)
    {
        $id = Auth::user()->id;
        $izin = Izin::select(['izin.id','tanggal_mulai','tanggal_selesai','type_izin','status_diterima','nama'])
                    ->where('izin.pegawai_id',$id)
                    ->join('pegawai','izin.pegawai_id', '=', 'pegawai.id')->get();
        return view('perizinan.index',compact('izin'));
    }
     
    public function create()
    {
        // dd(Auth::user()->can('izin-create'));
        $id = Auth::user()->id;
        $izin = Izin::select()->where('pegawai_id',$id)
                            ->where('type_izin', '!=','terlambat')
                            ->where('status_diterima', '!=','ditolak')->get();
        // dd($izin);
        $max_izin = 5;
        if($izin->count()>= $max_izin){
            return redirect()->route('izin.data')
                    ->with('warning', 'Jumlah izin anda sudah mencapai maksimal');
        }
        foreach($izin as $izin){
            $check = strtotime($izin->tanggal_selesai)>=strtotime('today');
            if ($izin->status_diterima == 'menunggu') {
                return redirect()->route('izin.data')
                    ->with('warning', 'Anda masih memiliki izin yang belum dikonfirmasi');
            }
            elseif ($check == true) {
                return redirect()->route('izin.data')
                    ->with('warning', 'Anda masih memiliki izin yang berjalan');
            }
        }
        return view('perizinan.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required|after_or_equal:tanggal_mulai',
            'type_izin' => 'required',
        ]);
        $id = Auth::user()->id;
        $input = $request->all();
        $input['pegawai_id'] = $id;
        $tes = Izin::create($input);
        // dd($tes);

        return redirect()->route('izin.data')
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
    
        $izin = Izin::find($id);
        $input = $request->all();
        // dd($input['status_diterima']);
        if (!isset($input['status_diterima'])) {
            $input['status_diterima'] = 'menunggu';
        }
        $izin->update($input);

        if (Auth::user()->can('izin-confirmation')) {   
            return redirect()->route('izin.index')
            ->with('success','Izin updated successfully');
        } else{
            return redirect()->route('izin.data')
            ->with('success','Izin updated successfully');
        }
    }

      public function confirm(Request $request, $izin)
    {
        $izin = Izin::find($izin);
        $status = $request->all();
        $izin->update($status);
    
        return redirect()->route('izin.index')
                        ->with('success','Izin berhasil disetujui');
    }
      
    public function destroy($id)
    {
        DB::table("izin")->where('id',$id)->delete();
        return redirect()->route('izin.index')
                        ->with('success','Izin deleted successfully');
    }
}
