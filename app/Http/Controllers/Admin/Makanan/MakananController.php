<?php

namespace App\Http\Controllers\Admin\Makanan;

use App\Http\Controllers\Controller;
use App\Food;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class MakananController extends Controller
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
//            $data = Food::with('users');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function (Food $food) {
                    return $food->user->name;
                })
                ->addColumn('type', function (Food $food) {
                    return $food->type->name;
                })
                ->addColumn('type2', function (Food $food) {
                    return $food->type->id;
                })
//                ->editColumn('user', function ($food){
//                    return $food->user;
//                })
                ->addColumn('action', function($row){
                    $route = 'detail-makanan/' . $row->id . '/' . 'create2';
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-circle btn-sm editProduct"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="' . $route . '" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Create" class="btn btn-success btn-circle btn-sm"><i class="fas fa-align-justify "></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-target="#exampleModal" data-toggle="modal"  data-id="'.$row->id.'" data-original-title="Show" class="btn btn-primary btn-circle btn-sm showProduct"><i class="fas fa-eye"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $types = Type::all();
        return view('admin.makanan.index')->with('types', $types);
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
        Food::updateOrCreate(['id' => $request->product_id],
            ['name' => $request->name, 'user_id' => Auth::user()->id, 'type_id' => $request->types]);

        return response()->json(['success'=>'Food saved successfully.']);
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
        $unit = Food::find($id);
        return response()->json($unit);
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
        Food::find($id)->delete();

        return response()->json(['success'=>'Food deleted successfully.']);
    }

    public function test()
    {
        $food = Food::all();
//        $asd = User::all();
//        dd($food[0]->type);
        foreach ($food as $item){
            echo $item->type . ' ';
        }
    }
}
