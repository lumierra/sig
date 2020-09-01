<?php

namespace App\Http\Controllers\Admin\Penerimaan;

use App\Demand;
use App\Head;
use App\Http\Controllers\Controller;
use App\Vendor;
use Illuminate\Http\Request;
use App\Receipt;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use DateTime;

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
        $lastID = Receipt::select('code')->orderBy('id', 'desc')->first();
        if (!$lastID){
            $newID = 'PN-0001';
        }
        else{
            $lastIncrement = substr($lastID->code, -4);
            $newID = 'PN-' . str_pad($lastIncrement + 1, 4, 0, STR_PAD_LEFT);
        }

        Receipt::updateOrCreate(
            ['id' => $request->product_id],
            [
                'code' => $newID,
                'date' => new DateTime(),
                'vendor_id' => $request->vendors,
                'head_id' => $request->heads,
                'user_id' => Auth::user()->id,
                'name' => 'Penerimaan ' . $newID,
            ]);

        return response()->json(['success'=>'Receipt saved successfully.']);
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
