<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tunjangan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class TunjanganController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:tunjangan-list|tunjangan-create|tunjangan-edit|tunjangan-delete', ['only' => ['index','store']]);
         $this->middleware('permission:tunjangan-create', ['only' => ['create','store']]);
         $this->middleware('permission:tunjangan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:tunjangan-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Tunjangan::orderBy('id', 'DESC')->paginate(5);
        return view('kepegawaian.tunjangan.index', compact('data'))
                ->with('i', ($request->input('page',1) - 1) * 5);
    }

    public function create()
    {
        return view('kepegawaian.tunjangan.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_tunjangan' => 'required',
            'besar_tunjangan' => 'required'
        ]);
        $input = $request->all();
        Tunjangan::create($input);

        return redirect()->route('tunjangan.index')
                        ->with('success','Tunjangan Created Succesfully');
    }

    public function edit($id)
    {
        $tunjangan = Tunjangan::find($id);

        return view('kepegawaian.tunjangan.edit', compact('tunjangan'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_tunjangan' => 'required',
            'besar_tunjangan' => 'required'
        ]);
        $input = $request->all();
        $tunjangan = Tunjangan::find($id);
        $tunjangan->update($input);

        return redirect()->route('tunjangan.index')
                        ->with('success','Tunjangan Updated Successfully');
    }

    public function destroy($id)
    {
        DB::table('tunjangan')->where('id',$id)->delete();

        return redirect()->route('tunjangan.index')
                        ->with('success', 'Tunjangan Deleted Successfully');
    }
}
