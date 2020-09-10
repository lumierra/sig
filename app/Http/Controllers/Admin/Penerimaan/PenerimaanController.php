<?php

namespace App\Http\Controllers\Admin\Penerimaan;

use Alert;
use App\Head;
use App\ReceiptDetail;
use App\Tail;
use App\Unit;
use DateTime;
use App\Stock;
use App\Demand;
use App\Vendor;
use App\Detail;
use App\Receipt;
use App\Material;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PenerimaanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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
                    $route = 'penerimaan/' . $row->id . '/' . 'edit';
                    $btn = '';
//                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-circle btn-sm editProduct"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-target="#exampleModal" data-toggle="modal"  data-id="'.$row->id.'" data-original-title="Show" class="btn btn-success btn-circle btn-sm showProduct"><i class="fas fa-eye"></i></a>';
                    $btn = $btn.' <a href="' . $route . '" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-info btn-circle btn-sm"><i class="fas fa-edit"></i></a>';
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

    public function create()
    {
        $demands = Demand::where('status', 'proses')->get();
        $vendors = Vendor::all();
        $heads = Head::all();
        $materials = Material::all();
        $units = Unit::all();

        return view('admin.penerimaan.create')->with([
            'vendors' => $vendors,
            'heads' => $heads,
            'materials' => $materials,
            'units' => $units,
            'demands' => $demands,
        ]);
    }

    public function findDemand($id)
    {
        $demand = Demand::find($id);

        return response()->json([
            'data' => $demand,
            'vendor' => $demand->vendor,
            'head' => $demand->head,
            'details' => $demand->detail,
        ]);
    }

    public function store(Request $request)
    {
        $counter = count($request->jumlah);

        $today = new DateTime();
        $month = $today->format('m');
        $year = $today->format('Y');
        $now = '2020';

        $lastID = Receipt::select('code')->orderBy('id', 'desc')->first();
        if (!$lastID){
            $newID = 'Penerimaan-RSGZ/000001/' . $month . '/' . $year;
        }
        else{
            if ($year == $now){
                $lastIncrement = substr($lastID->code, 16, 6);
                $newIncrement = 'Penerimaan-RSGZ/' . str_pad($lastIncrement + 1, 6, 0, STR_PAD_LEFT);
                $newID = $newIncrement . '/' . $month . '/' . $year;
            }
            else {

                if ($year != $now){
                    $newID = 'Penerimaan-RSGZ/000001/' . $month . '/' . $year;
                }
                else {
                    $lastIncrement = substr($lastID->code, 16, 6);
                    $newIncrement = 'Penerimaan-RSGZ/' . str_pad($lastIncrement + 1, 6, 0, STR_PAD_LEFT);
                    $newID = $newIncrement . '/' . $month . '/' . $year;
                }
            }
        }

        $receipt = Receipt::create([
            'code' => $newID,
            'date' => new DateTime(),
            'vendor_id' => $request->vendors,
            'head_id' => $request->heads,
            'user_id' => Auth::user()->id,
            'name' => $request->demand,
        ]);

        $find = Receipt::where('code', $newID)->first();

        if ($counter > 1){
            for ($i=0; $i < $counter; $i++){
                ReceiptDetail::create([
                    'date' => new DateTime(),
                    'receipt_id' => $find->id,
                    'receipt_code' => $find->code,
                    'material_id' => $request->material[$i],
                    'unit_id' => $request->unit[$i],
                    'user_id' => Auth::user()->id,
                    'jumlah' => (int)$request->jumlah[$i],
                    'keterangan' => $request->keterangan[$i],
                ]);
            }
        }
        else {
            ReceiptDetail::create([
                'date' => new DateTime(),
                'receipt_id' => $find->id,
                'receipt_code' => $find->code,
                'material_id' => $request->material[0],
                'unit_id' => $request->unit[0],
                'user_id' => Auth::user()->id,
                'jumlah' => (int)$request->jumlah[0],
                'keterangan' => $request->keterangan[0],
            ]);
        }

        if (!$receipt){
            Alert::error('Gagal', 'Data Gagal Di Tambah');
        } else {
            Alert::success('Berhasil', 'Data Berhasil Di Tambah');
        }

        $demand = Demand::find($request->demand);
        $demand->update([
           'status' => 'selesai'
        ]);

        return redirect()->route('admin.penerimaan.index');
    }

    public function show($id)
    {
        $receipt = Receipt::find($id);
        return view('admin.penerimaan.show')->with('receipt', $receipt);
    }

    public function showReceipt($id)
    {
        $receipt = Receipt::find($id);
        return view('admin.penerimaan.show')->with('receipt', $receipt);
    }

    public function edit($id)
    {
        $receipt = Receipt::find($id);
        $vendors = Vendor::all();
        $heads = Head::all();
        $materials = Material::all();
        $units = Unit::all();

        return view('admin.penerimaan.edit')->with([
            'receipt' => $receipt,
            'vendors' => $vendors,
            'heads' => $heads,
            'materials' => $materials,
            'units' => $units,
        ]);
    }

    public function update(Request $request, $id)
    {
        $receipt = Receipt::find($id);
        $counter = count($request->jumlah);
        $counterDetail = count($receipt->detail);

        $receipt->update([
            'vendor_id' => $request->vendors,
            'head_id' => $request->heads,
            'user_id' => Auth::user()->id,
        ]);

        foreach ($receipt->detail as $i => $detail){
            Tail::destroy($detail->id);
        }
        for($i=0; $i < $counter; $i++){
            Tail::create([
                'receipt_id' => $receipt->id,
                'receipt_code' => $receipt->code,
                'material_id' => $request->material[$i],
                'unit_id' => $request->unit[$i],
                'user_id' => Auth::user()->id,
                'jumlah' => (int)$request->jumlah[$i],
                'keterangan' => $request->keterangan[$i],
            ]);

            $stock = Stock::where('material_id', $request->material[$i])->first();
            if (!$stock){
                Stock::create([
                    'material_id' => $request->material[$i],
                    'date' => new DateTime(),
                    'total' => (int)$request->jumlah[$i],
                    'total_lama' => 0,
                    'jumlah_baru' => (int)$request->jumlah[$i],
                    'jumlah_lama' => (int)$request->jumlah[$i],
                ]);
            } else {
                if ((int)$request->jumlah[$i] > $stock->total){
                    $stock->update([
                        'total_lama' => $stock->total,
                        'total' => ($stock->total - $stock->jumlah_lama) + (int)$request->jumlah[$i],
                        'jumlah_lama' => $stock->jumlah_baru,
                        'jumlah_baru' => (int)$request->jumlah[$i],
                    ]);
                } elseif ( (int)$request->jumlah[$i] < $stock->total ) {
                    $stock->update([
                        'total_lama' => $stock->total,
                        'total' => ($stock->total - $stock->jumlah_baru) + (int)$request->jumlah[$i],
                        'jumlah_lama' => $stock->jumlah_baru,
                        'jumlah_baru' => (int)$request->jumlah[$i],
                    ]);
                } else {
                    $stock->update([
                        'total_lama' => ($stock->total - (int)$request->jumlah[$i]) + (int)$request->jumlah[$i],
                        'total' => ($stock->total - (int)$request->jumlah[$i]) + (int)$request->jumlah[$i],
                        'jumlah_lama' => $stock->jumlah_baru,
                        'jumlah_baru' => (int)$request->jumlah[$i],
                    ]);
                }
            }
        }

//        if ($counter > $counterDetail){
//            foreach ($receipt->detail as $i => $detail){
//                Tail::destroy($detail->id);
//            }
//            for($i=0; $i < $counter; $i++){
//                Tail::create([
//                    'receipt_id' => $receipt->id,
//                    'receipt_code' => $receipt->code,
//                    'material_id' => $request->material[$i],
//                    'unit_id' => $request->unit[$i],
//                    'user_id' => Auth::user()->id,
//                    'jumlah' => (int)$request->jumlah[$i],
//                    'keterangan' => $request->keterangan[$i],
//                ]);
//
//                $stock = Stock::where('material_id', $request->material[$i])->first();
//                $stock->update([
//                    'total' => (int)$request->jumlah[$i],
//                    'total_lama' => (int)$stock->total,
//                ]);
//            }
//        }
//        else {
//            foreach ($receipt->detail as $i => $detail){
//                $item = Tail::find($detail->id);
//                $item->update([
//                    'material_id' => $request->material[$i],
//                    'unit_id' => $request->unit[$i],
//                    'user_id' => Auth::user()->id,
//                    'jumlah' => (int)$request->jumlah[$i],
//                    'keterangan' => $request->keterangan[$i],
//                ]);
//
//                $stock = Stock::where('material_id', $request->material[$i])->first();
//                $stock->update([
//                    'total' => (int)$request->jumlah[$i],
//                    'total_lama' => (int)$stock->total,
//                ]);
//            }
//        }

        if (!$receipt){
            Alert::error('Gagal', 'Data Gagal Di Ubah');
        } else {
            Alert::success('Berhasil', 'Data Berhasil Di Ubah');
        }
        return redirect()->route('admin.penerimaan.index');
    }

    public function destroy($id)
    {
//        Head::find($id)->delete();
//
//        return response()->json(['success'=>'Head deleted successfully.']);
    }

    public function delete($id)
    {
        $receipt = Receipt::find($id);
        foreach ($receipt->detail as $detail){
            $detail->delete();
        }
        $receipt->delete();

        return response()->json(['success'=>'Penerimaan deleted successfully.']);
    }
}
