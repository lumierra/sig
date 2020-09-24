<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Test;
use App\Vendor;
use App\Vendor2;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class VendorController extends Controller
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
            $data = Vendor::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('vendor', function (Vendor $vendor) {
                    return $vendor->penyedia->nama_vendor;
                })
                ->addColumn('keterangan', function (Vendor $vendor) {
                    return $vendor->penyedia->bentuk_perusahaan;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-circle btn-sm editProduct"><i class="fas fa-edit"></i></a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $vendors = DB::connection('sqlsrv_server')->table('vendor')->get();

        return view('admin.vendor.index')->with([
            'vendors' => $vendors,
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
        Vendor::updateOrCreate(['id' => $request->product_id],
            ['vendor_id' => $request->vendors, 'name' => $request->name]);

        return response()->json(['success'=>'Vendor saved successfully.']);
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
        $vendor = Vendor::find($id);
        return response()->json($vendor);
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
        Vendor::find($id)->delete();

        return response()->json(['success'=>'Vendor deleted successfully.']);
    }

    public function test()
    {

        // $query = DB::connection('sqlsrv_server')->table('vendor')->take(1)->get();
        // $query = DB::connection('sqlsrv_server2')->table('GZ_VENDOR')
        //     ->join('vendor', '');
        $query = Vendor::with('penyedia')->get();
        return response()->json($query);
    }
}
