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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Material::latest()->get();
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
//                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Test" class="edit btn btn-info btn-circle btn-sm testProduct"><i class="fas fa-user"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-target="#exampleModal" data-toggle="modal"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-info btn-circle btn-sm editProduct"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $categories = Category::all();
        $units = Unit::all();

        return view('admin.bahan.index')->with([
            'categories' => $categories,
            'units' => $units
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Material::updateOrCreate(['id' => $request->product_id],
            [
                'name' => $request->name,
                'user_id' => Auth::user()->id,
                'category_id' => $request->category,
                'unit_id' => $request->unit,
            ]);

        return response()->json(['success'=>'Material saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $material = Material::find($id);
        $category = $material->category->name;
        $unit = $material->unit->name;

        return response()->json([
            'data' => $material,
            'category' => $category,
            'unit' => $unit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = Material::find($id);
        $category = $material->category->name;
        $unit = $material->unit->name;

        return response()->json([
            'data' => $material,
            'category' => $category,
            'unit' => $unit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $material = Material::find($request->product_id);
        $material->update([
            'name' => $request->name,
            'category_id' => $request->category,
            'unit_id' => $request->unit,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json(['success'=>'Material updated successfully.']);
    }

    public function updateData(Request $request, $id)
    {
        $material = Material::find($request->product_id);
        dd($request->product_id);
//        $material->update([
//            'name' => $request->name,
//            'category_id' => $request->category,
//            'unit_id' => $request->unit,
//            'user_id' => Auth::user()->id,
//        ]);

        return response()->json(['success'=>'Material updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Material::find($id)->delete();

        return response()->json(['success'=>'Material deleted successfully.']);
    }
}
