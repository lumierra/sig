<?php

namespace App\Http\Controllers\Admin\Bahan;

use App\Unit;
use App\User;
use App\Material;
use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class BahanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Material::orderBy('name', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function (Material $material) {
                    return $material->category->name;
                })
                ->addColumn('unit', function (Material $material) {
                    return $material->unit->name;
                })
                ->addColumn('action', function($row){
                    $btn = '';
                    $btn = $btn.' <a href="javascript:void(0)" data-target="#exampleModal" data-toggle="modal"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-info btn-circle btn-sm editProduct"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $units = Unit::all();
        $categories = Category::all();

        return view('admin.bahan.index')->with([
            'units' => $units,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Material::updateOrCreate(
            ['id' => $request->product_id],
            [
                'name' => $request->name,
                'unit_id' => $request->unit,
                'user_id' => Auth::user()->id,
                'category_id' => $request->category,
            ]);

        return response()->json(['success'=>'Bahan Makanan Berhasil di Simpan']);
    }

    public function show($id)
    {
        $material = Material::find($id);
        $unit = $material->unit->name;
        $category = $material->category->name;

        return response()->json([
            'unit' => $unit,
            'data' => $material,
            'category' => $category,
        ]);
    }

    public function edit($id)
    {
        $material = Material::find($id);
        $unit = $material->unit->name;
        $category = $material->category->name;

        return response()->json([
            'unit' => $unit,
            'data' => $material,
            'category' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        $material = Material::find($request->product_id);
        $material->update([
            'name' => $request->name,
            'unit_id' => $request->unit,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category,
        ]);

        return response()->json(['success'=>'Bahan Makanan Berhasil di Simpan']);
    }

    public function destroy($id)
    {
        Material::find($id)->delete();

        return response()->json(['success'=>'Bahan Makanan Berhasil di Hapus']);
    }
}
