<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Gaji;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Tunjangan;
use App\Models\Tunjangan_Pegawai;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class GajiController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:gaji-list|gaji-create|gaji-edit|gaji-delete', ['only' => ['index','store']]);
         $this->middleware('permission:gaji-create', ['only' => ['create','store']]);
         $this->middleware('permission:gaji-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:gaji-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $pegawai_id = Auth::user()->id;
        $data = Gaji::select('nama', 'gaji_pokok', 'total_tunjangan', 'tanggal', 
                DB::raw('gaji_pokok + total_tunjangan + bonus_loyaliyas as total_gaji'))
                -> join('pegawai','pegawai.id','=','gaji.pegawai_id')->get();
                dd($data);
                $data->total_gaji = $data->gaji_pokok + $data->total_tunjangan;
        return view('gaji.index', compact('data'));
    }
    
    public function create()
    {
        $data = Gaji::select('nama','gaji_pokok', 'tanggal', 'gaji.bonus_loyalitas', 'total_tunjangan',
                DB::raw('gaji_pokok + total_tunjangan + gaji.bonus_loyalitas as total_gaji'))
                -> join('pegawai', 'gaji.pegawai_id', '=', 'pegawai.id')
                -> get();
        
        return view('gaji.create', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'tanggal' => 'required'
        ]);
        $gaji = Gaji::get();
        $tggl = date("m", strtotime($request->input('tanggal')));
        // $check = DB::table('gaji')->whereMonth('tanggal', '=', Carbon::now()->month)->delete();
        $check = DB::table('gaji')->whereMonth('tanggal', '=', $tggl)->delete();

        $pegawai = Tunjangan::select('pegawai.id as pegawai_id','gaji_pokok','bonus_loyalitas', 
                        DB::raw('SUM(besar_tunjangan) as total_tunjangan'))
                        -> join('tunjangan_pegawai', 'tunjangan.id','=','tunjangan_pegawai.tunjangan_id')
                        -> rightJoin('pegawai', 'tunjangan_pegawai.pegawai_id','=','pegawai.id')
                        -> join('jabatan','pegawai.jabatan_id','=','jabatan.id')
                        -> groupBy('pegawai.id','gaji_pokok','bonus_loyalitas')
                        -> get()->toArray();

        foreach ($pegawai as $input) {
            $input['tanggal'] = $request->input('tanggal');
            // $input['tanggal'] = Carbon::today();
            if($input['total_tunjangan'] == null){
                $input['total_tunjangan'] = 0;
            };
            if($input['bonus_loyalitas'] == null){
                $input['bonus_loyalitas'] = 0;
            };
            $generate = Gaji::create($input);
        }
            // dd($generate);
        return redirect()->route('gaji.create')
                        ->with('success','Gaji Generated Succesfully');
    }

    public function edit($id)
    {
        $gaji = Gaji::find($id);

        return view('gaji.edit', compact('gaji'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_tunjangan' => 'required',
            'besar_tunjangan' => 'required'
        ]);
        $gaji = $request->get('besar_tunjangan');
        $gaji = str_replace("Rp. ","",$gaji);
        $gaji = str_replace(".","",$gaji);
        $gaji = (int)$gaji;

        $input = $request->all();
        $input['besar_tunjangan'] = $gaji;

        $Gaji = Gaji::find($id);
        $Gaji->update($input);

        return redirect()->route('gaji.index')
                        ->with('success','Gaji Updated Successfully');
    }

    public function destroy($id)
    {
        DB::table('gaji')->where('id',$id)->delete();

        return redirect()->route('gaji.index')
                        ->with('success', 'Gaji Deleted Successfully');
    }
}
