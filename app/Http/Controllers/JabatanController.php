<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jabatan;
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
        $data = Jabatan::orderBy('id', 'DESC')->paginate(5);
        return view('kepegawaian.jabatan.index', compact('data'))
                ->with('i', ($request->input('page',1) - 1) * 5);
    }

    public function create()
    {
        return view('kepegawaian.jabatan.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required',
            'bonus_professional' => 'required'
        ]);
        $input = $request->all();
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
        $jabatan->nama_jabatan = $request->input('nama_jabatan');
        $jabatan->gaji_pokok = $request->input('gaji_pokok');
        $jabatan->bonus_professional = $request->input('bonus_professional');
        
        $jabatan->save();

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
