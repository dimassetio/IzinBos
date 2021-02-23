<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PegawaiController;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class JabatanController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:jabatan-list|jabatan-create|jabatan-edit|jabatan-delete', ['only' => ['index','store']]);
         $this->middleware('permission:jabatan-create', ['only' => ['create','store']]);
         $this->middleware('permission:jabatan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:jabatan-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $data = Jabatan::get();
        return view('kepegawaian.jabatan.index', compact('data'));
    }

    public function create()
    {
        return view('kepegawaian.jabatan.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required'
        ]);
        $gaji = $request->get('gaji_pokok');
        $gaji = str_replace("Rp. ","",$gaji);
        $gaji = str_replace(".","",$gaji);
        $gaji = (int)$gaji;
        
        $bonus = $request->get('bonus_professional');
        $bonus = str_replace("Rp. ","",$bonus);
        $bonus = str_replace(".","",$bonus);
        $bonus = (int)$bonus;

        $input = $request->all();
        $input['gaji_pokok'] = $gaji;
        $input['bonus_professional'] = $bonus;
        
        $jabatan = Jabatan::create($input);

        return redirect()->route('jabatan.index')
                        ->with('success','Jabatan Created Succesfully');
    }

    public function edit($id)
    {
        $jabatan = Jabatan::find($id);

        return view('kepegawaian.jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required',
            'bonus_professional' => 'required'
        ]); 
        $jabatan = Jabatan::find($id);
        $gaji = $request->get('gaji_pokok');
        $gaji = str_replace("Rp. ","",$gaji);
        $gaji = str_replace(".","",$gaji);
        $gaji = (int)$gaji;
        
        $bonus = $request->get('bonus_professional');
        $bonus = str_replace("Rp. ","",$bonus);
        $bonus = str_replace(".","",$bonus);
        $bonus = (int)$bonus;

        $input = $request->all();
        $input['gaji_pokok'] = $gaji;
        $input['bonus_professional'] = $bonus;
        
        $jabatan->update($input);
        // $pegawai->save();
        return redirect()->route('jabatan.index')
                        ->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        DB::table("jabatan")->where('id',$id)->delete();
        return redirect()->route('jabatan.index')
                        ->with('success','Jabatan deleted succesfully');
    }

}
