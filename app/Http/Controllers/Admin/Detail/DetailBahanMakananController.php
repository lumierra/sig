<?php

namespace App\Http\Controllers\Admin\Detail;

use App\Food;
use App\Type;
use App\Unit;
use App\Material;
use App\FoodMaterial;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class DetailBahanMakananController extends Controller
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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Food::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
//                ->addColumn('user', function (Food $food) {
//                    return $food->user->name;
//                })
                ->addColumn('type', function (Food $food) {
                    return $food->type->name;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-circle btn-sm editProduct" alt="edit"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Show" class="btn btn-success btn-circle btn-sm showProduct"><i class="fas fa-eye"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $types = Type::all();
        return view('admin.detailBahan.index')->with('types', $types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $foods = Food::all();
        $materials = Material::all();
        $units = Unit::all();


        return view('admin.detailBahan.create')->with([
            'types' => $types,
            'foods' => $foods,
            'materials' => $materials,
            'units' => $units,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $counter = count($request->material);

        if ($counter > 1){
            for ($i = 0; $i < $counter; $i++){
                FoodMaterial::create([
                    'type_id' => $request->type,
                    'food_id' => $request->food,
                    'material_id' => $request->material[$i],
                    'satuan' => (int)$request->jumlah[$i],
                    'unit_id' => $request->unit[$i],
                    'keterangan' => $request->keterangan[$i],
                ]);
            }
            Alert::success('Berhasil', 'Data Berhasil Di Tambah');
        }
        else {
            FoodMaterial::create([
                'type_id' => $request->type,
                'food_id' => $request->food,
                'material_id' => $request->material[0],
                'satuan' => (int)$request->jumlah[0],
                'unit_id' => $request->unit[0],
                'keterangan' => $request->keterangan[0],
            ]);
            Alert::success('Berhasil', 'Data Berhasil Di Tambah');
        }

        return redirect()->route('admin.detail-makanan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $food = Food::find(17);
//        dd($food->materials);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
