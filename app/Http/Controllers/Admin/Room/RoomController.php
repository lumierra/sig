<?php

namespace App\Http\Controllers\Admin\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Room;

class RoomController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Room::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
//                ->addColumn('category', function (Material $material) {
//                    return $material->category->name;
//                })
//                ->addColumn('unit', function (Material $material) {
//                    return $material->unit->name;
//                })
                ->addColumn('action', function($row){
                    $btn = '';
                    $btn = $btn.' <a href="javascript:void(0)" data-target="#exampleModal" data-toggle="modal"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-info btn-circle btn-sm editProduct"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

//        $units = Unit::all();
//        $categories = Category::all();

        return view('admin.room.index');
    }

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
        Room::updateOrCreate(
            ['id' => $request->product_id],
            [
                'name' => $request->name,
                'description' => $request->description,
            ]);

        return response()->json(['success'=>'Bahan Makanan Berhasil di Simpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);
        return response()->json($room);
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
        Room::find($id)->delete();

        return response()->json(['success'=>'Type deleted successfully.']);
    }
}
