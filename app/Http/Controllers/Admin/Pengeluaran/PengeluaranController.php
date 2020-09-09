<?php

namespace App\Http\Controllers\Admin\Pengeluaran;

use Alert;
use App\One;
use App\Head;
use App\Tail;
use DateTime;
use App\Unit;
use App\Stock;
use App\Place;
use App\Spend;
use App\Demand;
use App\Detail;
use App\Vendor;
use App\Material;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PengeluaranController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Spend::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('place', function (Spend $spend) {
                    return $spend->place->name;
                })
                ->addColumn('action', function($row){
                    $route = 'pengeluaran/' . $row->id . '/' . 'edit';
                    $btn = '';
                    $btn = $btn.' <a href="javascript:void(0)" data-target="#exampleModal" data-toggle="modal"  data-id="'.$row->id.'" data-original-title="Show" class="btn btn-success btn-circle btn-sm showProduct"><i class="fas fa-eye"></i></a>';
                    $btn = $btn.' <a href="' . $route . '" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-info btn-circle btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->editColumn('date', function ($row) {
                    return [
                        'display' => e($row->created_at->format('d/m/Y h:i:s')),
                        'timestamp' => $row->created_at->timestamp
                    ];
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $heads = Head::all();
        $vendors = Vendor::all();
        return view('admin.pengeluaran.index')->with([
            'heads' => $heads,
            'vendors' => $vendors,
        ]);
    }

    public function create()
    {
        $materials = Material::all();
        $units = Unit::all();
        $places = Place::all();

        return view('admin.pengeluaran.create2')->with([
            'materials' => $materials,
            'units' => $units,
            'places' => $places,
        ]);
    }

    public function store(Request $request)
    {
        $counter = count($request->jumlah);

        $today = new DateTime();
        $month = $today->format('m');
        $year = $today->format('Y');
        $now = '2020';

        $lastID = Spend::select('code')->orderBy('id', 'desc')->first();
        if (!$lastID){
            $newID = 'Pengeluaran-RSGZ/000001/' . $month . '/' . $year;
        }
        else{
            if ($year == $now){
                $lastIncrement = substr($lastID->code, 17, 6);
                $newIncrement = 'Pengeluaran-RSGZ/' . str_pad($lastIncrement + 1, 6, 0, STR_PAD_LEFT);
                $newID = $newIncrement . '/' . $month . '/' . $year;
            }
            else {
                if ($year != $now){
                    $newID = 'Pengeluaran-RSGZ/000001/' . $month . '/' . $year;
                } else {
                    $lastIncrement = substr($lastID->code, 17, 6);
                    $newIncrement = 'Pengeluaran-RSGZ/' . str_pad($lastIncrement + 1, 6, 0, STR_PAD_LEFT);
                    $newID = $newIncrement . '/' . $month . '/' . $year;
                }
            }
        }

        $spend = Spend::create([
            'code' => $newID,
            'date' => new DateTime(),
            'place_id' => $request->place,
            'user_id' => Auth::user()->id,
            'name' => $newID,
        ]);

        $find = Spend::where('code', $newID)->first();

        if ($counter > 1){
            for ($i=0; $i < $counter; $i++){
                One::create([
                    'spend_id' => $find->id,
                    'spend_code' => $find->code,
                    'material_id' => $request->material[$i],
                    'unit_id' => $request->unit[$i],
                    'user_id' => Auth::user()->id,
                    'jumlah' => (int)$request->jumlah[$i],
                    'keterangan' => $request->keterangan[$i],
                ]);

                $stock = Stock::where('material_id', $request->material[$i])->first();
                if(!$stock){
                    Stock::create([
                        'material_id' => $request->material[$i],
                        'date' => new DateTime(),
                        'total' => (int)$request->jumlah[$i],
                        'total_lama' => (int)$request->jumlah[$i],
                        'jumlah_lama' => (int)$request->jumlah[$i],
                        'jumlah_baru' => (int)$request->jumlah[$i]
                    ]);
                } else {
                    $stock->update([
                        'total' => $stock->total - (int)$request->jumlah[$i],
                        'total_lama' => $stock->total,
                        'jumlah_lama' => $stock->jumlah_baru,
                        'jumlah_baru' => (int)$request->jumlah[$i],
                    ]);
                }
            }
        }
        else {
            One::create([
                'spend_id' => $find->id,
                'spend_code' => $find->code,
                'material_id' => $request->material[0],
                'unit_id' => $request->unit[0],
                'user_id' => Auth::user()->id,
                'jumlah' => (int)$request->jumlah[0],
                'keterangan' => $request->keterangan[0],
            ]);

            $stock = Stock::where('material_id', $request->material[0])->first();
            if(!$stock){
                Stock::create([
                    'material_id' => $request->material[0],
                    'date' => new DateTime(),
                    'total' => (int)$request->jumlah[0],
                    'total_lama' => (int)$request->jumlah[0],
                    'jumlah_lama' => (int)$request->jumlah[0],
                    'jumlah_baru' => (int)$request->jumlah[0]
                ]);
            } else {
                $stock->update([
                    'total' => $stock->total - (int)$request->jumlah[0],
                    'total_lama' => $stock->total,
                    'jumlah_lama' => $stock->jumlah_baru,
                    'jumlah_baru' => (int)$request->jumlah[0],
                ]);
            }
        }

        if (!$spend){
            Alert::error('Gagal', 'Data Gagal Di Tambah');
        } else {
            Alert::success('Berhasil', 'Data Berhasil Di Tambah');
        }

        return redirect()->route('admin.pengeluaran.index');
    }

    public function show($id)
    {
        $spend = Spend::find($id);
        return view('admin.pengeluaran.show')->with('spend', $spend);
    }

    public function showSpend($id)
    {
        $spend = Spend::find($id);
        return view('admin.pengeluaran.show')->with('spend', $spend);
    }

    public function edit($id)
    {
        $spend = Spend::find($id);
        $materials = Material::all();
        $units = Unit::all();
        $places = Place::all();

        return view('admin.pengeluaran.edit')->with([
            'spend' => $spend,
            'materials' => $materials,
            'units' => $units,
            'places' => $places,
        ]);
    }

    public function update(Request $request, $id)
    {
        $spend = Spend::find($id);
        $counter = count($request->jumlah);
        $counterDetail = count($spend->detail);

        $spend->update([
            'place_id' => $request->place,
            'user_id' => Auth::user()->id,
        ]);

        if ($counter > $counterDetail){
            foreach ($spend->detail as $i => $detail){
                One::destroy($detail->id);
            }
            for($i=0; $i < $counter; $i++){
                One::create([
                    'spend_id' => $spend->id,
                    'spend_code' => $spend->code,
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
        }
        else {
            foreach ($spend->detail as $i => $detail){
                $item = One::find($detail->id);
                $item->update([
                    'material_id' => $request->material[$i],
                    'unit_id' => $request->unit[$i],
                    'user_id' => Auth::user()->id,
                    'jumlah' => (int)$request->jumlah[$i],
                    'keterangan' => $request->keterangan[$i],
                ]);
            }
        }

        if (!$spend){
            Alert::error('Gagal', 'Data Gagal Di Ubah');
        }else {
            Alert::success('Berhasil', 'Data Berhasil Di Ubah');
        }
        return redirect()->route('admin.pengeluaran.index');
    }

    public function destroy($id)
    {
        Spend::find($id)->delete();

        foreach ($spend->detail as $detail){
            $item = One::where('spend_id', $spend->id)->first();
            $item->delete();
        }

        return response()->json(['success'=>'Pengeluaran Berhasil Di Hapus']);
    }

    public function cekBahan($material)
    {
        $stock = Stock::where('material_id', $material)->first();

//        return $stock->total;
        return response()->json($stock->total);
    }
}
