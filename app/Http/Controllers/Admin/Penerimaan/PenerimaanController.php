<?php

namespace App\Http\Controllers\Admin\Penerimaan;

use App\Demand;
use App\Head;
use App\Http\Controllers\Controller;
use App\Material;
use App\Tail;
use App\Unit;
use App\Vendor;
use Illuminate\Http\Request;
use App\Receipt;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use DateTime;
use App\Detail;

class PenerimaanController extends Controller
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
            $data = Receipt::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('vendor', function (Receipt $receipt) {
                    return $receipt->vendor->name;
                })
                ->addColumn('head', function (Receipt $receipt) {
                    return $receipt->head->name;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-circle btn-sm editProduct"><i class="fas fa-edit"></i></a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->editColumn('date', function ($row) {
                    return [
                        'display' => e($row->created_at->format('d/m/Y')),
                        'timestamp' => $row->created_at->timestamp
                    ];
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $heads = Head::all();
        $vendors = Vendor::all();
        return view('admin.penerimaan.index')->with([
            'heads' => $heads,
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
        $vendors = Vendor::all();
        $heads = Head::all();
        $materials = Material::all();
        $units = Unit::all();

        return view('admin.penerimaan.create')->with([
            'vendors' => $vendors,
            'heads' => $heads,
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
        $counter = count($request->jumlah);
        $lastID = Receipt::select('code')->orderBy('id', 'desc')->first();
        if (!$lastID){
            $newID = 'PN-0001';
        }
        else{
            $lastIncrement = substr($lastID->code, -4);
            $newID = 'PN-' . str_pad($lastIncrement + 1, 4, 0, STR_PAD_LEFT);
        }

        $receipt = Receipt::create([
            'code' => $newID,
            'date' => new DateTime(),
            'vendor_id' => $request->vendors,
            'head_id' => $request->heads,
            'user_id' => Auth::user()->id,
            'name' => 'Penerimaan ' . $newID,
        ]);

        $find = Receipt::where('code', $newID);
        if ($counter > 1){
            for ($i=0; $i < $counter; $i++){
                Tail::create([
                    '' => $find->id,
                    'demand_core' => $newID,
                    'material_id' => $request->material[$i],
                    'unit_id' => $request->unit[$i],
                    'user_id' => Auth::user()->id,
                    'jumlah' => $request->jumlah[$i],
                    'keterangan' => $request->keterangan[$i],
                ]);
            }
        }
        else {
            Detail::create([
                'demand_id' => $find->id,
                'demand_core' => $newID,
                'material_id' => $request->material[0],
                'unit_id' => $request->unit[0],
                'user_id' => Auth::user()->id,
                'jumlah' => $request->jumlah[0],
                'keterangan' => $request->keterangan[0],
            ]);
        }

        return redirect()->route('admin.penerimaan.index');




//        Receipt::updateOrCreate(
//            ['id' => $request->product_id],
//            [
//                'code' => $newID,
//                'date' => new DateTime(),
//                'vendor_id' => $request->vendors,
//                'head_id' => $request->heads,
//                'user_id' => Auth::user()->id,
//                'name' => 'Penerimaan ' . $newID,
//            ]);

//        return response()->json(['success'=>'Receipt saved successfully.']);
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
//        $head = Head::find($id);
//        return response()->json($head);
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
//        Head::find($id)->delete();
//
//        return response()->json(['success'=>'Head deleted successfully.']);
    }
}
