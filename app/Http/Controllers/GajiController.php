<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Gaji;
use App\Models\Detail_Gaji;
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
        $data = Gaji::select('gaji.id','nama','gaji_pokok', 'gaji.tanggal', 'gaji.bonus_loyalitas', 'total_tunjangan',
                DB::raw('gaji_pokok + total_tunjangan + gaji.bonus_loyalitas as total_gaji'))
                -> join('pegawai', 'gaji.pegawai_id', '=', 'pegawai.id')
                -> where('pegawai.id','=',$pegawai_id)
                -> orderBy('tanggal','desc')
                // -> whereMonth('tanggal','=',Carbon::now()->month)
                -> first();

        if (isset($data->id)) {   
            $tunjangan = Tunjangan::select('nama_tunjangan', 'nominal_tunjangan')
            -> join('detail_gaji','tunjangan.id','=','tunjangan_id')
            -> where('gaji_id','=',$data->id)
            -> get();
        }
        
        // dd($data,$tunjangan);
        if (empty($data)) {
            return view('gaji.index');
        } else return view('gaji.index', compact('data','tunjangan'));
    }
    
    public function create()
    {
        $data = Gaji::select('gaji.id','nama','gaji_pokok', 'tanggal', 'gaji.bonus_loyalitas', 'total_tunjangan',
                DB::raw('gaji_pokok + total_tunjangan + gaji.bonus_loyalitas as total_gaji'))
                -> join('pegawai', 'gaji.pegawai_id', '=', 'pegawai.id')
                -> orderBy('tanggal','DESC')
                -> get();
        
        return view('gaji.create', compact('data'));
    }

    public function store(Request $request)
    // public function store()
    {
        // $this->validate($request,[
        //     'tanggal' => 'required'
        // ]);
        $gaji = Gaji::get();
        $tggl = date("m", strtotime($request->input('tanggal')));
        $check = DB::table('gaji')->whereMonth('tanggal', '=', $tggl)->delete();
        // $check = DB::table('gaji')->whereMonth('tanggal', '=', Carbon::now()->month)->delete();

        $tunjangan = Tunjangan::select('pegawai.id as pegawai_id','gaji_pokok','bonus_professional', 'tanggal_masuk',
                        DB::raw('SUM(besar_tunjangan) as total_tunjangan'))
                        -> join('tunjangan_pegawai', 'tunjangan.id','=','tunjangan_pegawai.tunjangan_id')
                        -> rightJoin('pegawai', 'tunjangan_pegawai.pegawai_id','=','pegawai.id')
                        -> join('jabatan','pegawai.jabatan_id','=','jabatan.id')
                        -> groupBy('pegawai.id','gaji_pokok','bonus_professional','tanggal_masuk')
                        -> get()->toArray();
        
        

        foreach ($tunjangan as $input) {
            $input['tanggal'] = $request->input('tanggal');
            // dd($input);
            // $input['tanggal'] = Carbon::today();
            if($input['total_tunjangan'] == null){
                $input['total_tunjangan'] = 0;
            };
            $diff = abs(strtotime(Carbon::today()) - strtotime($input['tanggal_masuk']));
            $lama_kerja = floor($diff / (365*60*60*24));
            $input['bonus_loyalitas'] = $lama_kerja * $input['bonus_professional'];
            // dd($input['bonus_loyalitas']);
            $generate = Gaji::create($input);
            $pegawai = Pegawai::where('id','=',$input['pegawai_id'])->first();
            $pegawai->bonus_loyalitas = $input['bonus_loyalitas'];
            $pegawai->save();
            // dd($generate);
            $tunjangan = Tunjangan::select('tunjangan_id','besar_tunjangan','pegawai_id')
                            -> join('tunjangan_pegawai','tunjangan.id','=','tunjangan_id')
                            -> where('pegawai_id','=',$generate->pegawai_id)
                            ->get();
            foreach ($tunjangan as $detail) {
                dd($detail,$generate, $detail->besar_tunjangan);
                Detail_Gaji::create([
                    'gaji_id' => $generate->id,
                    'pegawai_id' => $detail->pegawai_id,
                    'tanggal' => $generate->tanggal,
                    'tunjangan_id' => $detail->tunjangan_id,
                    'nominal_tunjangan' => $detail->besar_tunjangan
                ]);
            }

        }
            // dd($generate);
        return redirect()->route('gaji.create')
                        ->with('success','Gaji Generated Succesfully');
    }
    
    public function show($id){
        $data = Gaji::select('gaji.id','nama','gaji_pokok', 'gaji.tanggal', 'gaji.bonus_loyalitas', 'total_tunjangan',
                DB::raw('gaji_pokok + total_tunjangan + gaji.bonus_loyalitas as total_gaji'))
                -> join('pegawai', 'gaji.pegawai_id', '=', 'pegawai.id')
                -> where('gaji.id','=',$id)
                -> first();
        // dd($data);
        if (isset($data->id)) {   
            $tunjangan = Tunjangan::select('nama_tunjangan', 'nominal_tunjangan')
            -> join('detail_gaji','tunjangan.id','=','tunjangan_id')
            -> where('gaji_id','=',$data->id)
            -> get();
        }
        
        if (empty($data)) {return view('gaji.index') ;
        } else return view('gaji.index', compact('data','tunjangan'));
    }
    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
