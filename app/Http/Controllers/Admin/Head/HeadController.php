<?php

namespace App\Http\Controllers\Admin\Head;

use App\Head;
use App\Employee;
use App\Material;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class HeadController extends Controller
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
            $data = Head::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('pj', function (Head $head) {
                    $name = $head->employee->GELAR_DEPAN . $head->employee->NAMA . $head->employee->GELAR_BELAKANG;
                    return $name;
                })
                ->addColumn('status', 'PJ')
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-circle btn-sm editProduct"><i class="fas fa-edit"></i></a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $employees = Employee::all();
        // $asd = Head::find(1);

        return view('admin.head.index')->with([
            'employees' => $employees,
            // 'asd' => $asd->employee,
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
        $employee = Employee::where('KD_KARYAWAN', $request->name)->first();
        $name = $employee->GELAR_DEPAN . $employee->NAMA . $employee->GELAR_BELAKANG;

        Head::updateOrCreate(['id' => $request->product_id],
            ['name' => $name, 'head_id' => $request->name]);

        return response()->json(['success'=>'Head saved successfully.']);
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
        $head = Head::find($id);
        return response()->json($head);
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
        Head::find($id)->delete();

        return response()->json(['success'=>'Head deleted successfully.']);
    }
}
