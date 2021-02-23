<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Potongan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class PotonganController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:potongan-list|potongan-create|potongan-edit|potongan-delete', ['only' => ['index','store']]);
         $this->middleware('permission:potongan-create', ['only' => ['create','store']]);
         $this->middleware('permission:potongan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:potongan-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Potongan::get();
        return view('kepegawaian.potongan.index', compact('data'))
                ->with('i', ($request->input('page',1) - 1) * 5);
    }

    public function create()
    {
        return view('kepegawaian.potongan.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_potongan'=>'required',
            'besar_potongan'=>'required'
        ]);
        $potongan = $request->get('besar_potongan');
        $potongan = str_replace("Rp. ","",$potongan);
        $potongan = str_replace(".","",$potongan);
        $potongan = (int)$potongan;

        $input = $request->all();
        $input['besar_potongan'] = $potongan;
        
        Potongan::create($input);

        return redirect()->route('potongan.index')
                        ->with('success','Potongan Created Successfully');
    }

    public function edit($id)
    {
        $potongan = Potongan::find($id);
        return view('kepegawaian.potongan.edit', compact('potongan'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_potongan' => 'required',
            'besar_potongan' => 'required'
        ]);
        $potongan = $request->get('besar_potongan');
        $potongan = str_replace("Rp. ","",$potongan);
        $potongan = str_replace(".","",$potongan);
        $potongan = (int)$potongan;

        $input = $request->all();
        $input['besar_potongan'] = $potongan;
        
        $potongan = Potongan::find($id);
        $potongan->update($input);

        return redirect()->route('potongan.index')
                        ->with('success','Potongan Updated Successfully');
    }

    public function destroy($id)
    {
        DB::table('potongan')->where('id',$id)->delete();

        return redirect()->route('potongan.index')
                        ->with('success', 'PotonganDeleted Successfully');
    }
}
