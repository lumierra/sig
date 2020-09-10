<?php

namespace App\Http\Controllers\Admin\Retur;

use Alert;
use App\One;
use App\Place;
use App\Two;
use App\Head;
use DateTime;
use App\Unit;
use App\Spend;
use App\Vendor;
use App\Restore;
use App\Material;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ReturController extends Controller
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
            $data = Restore::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $route = 'retur/' . $row->id . '/' . 'edit';
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

        return view('admin.retur.index');
    }
    public function findSpend($id)
    {
        $spend = Spend::find($id);

        return response()->json([
            'data' => $spend,
            'details' => $spend->detail,
            'place' => $spend->place
        ]);
    }

    public function create()
    {
        $materials = Material::all();
        $units = Unit::all();
        $places = Place::all();
        $spends = Spend::all();

        return view('admin.retur.create')->with([
            'materials' => $materials,
            'units' => $units,
            'places' => $places,
            'spends' => $spends,
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

        $today = new DateTime();
        $month = $today->format('m');
        $year = $today->format('Y');
        $now = '2020';

        $lastID = Restore::select('code')->orderBy('id', 'desc')->first();
        if (!$lastID){
            $newID = 'Retur-RSGZ/000001/' . $month . '/' . $year;
        }
        else{
            if ($year == $now){
                $lastIncrement = substr($lastID->code, 11, 6);
                $newIncrement = 'Retur-RSGZ/' . str_pad($lastIncrement + 1, 6, 0, STR_PAD_LEFT);
                $newID = $newIncrement . '/' . $month . '/' . $year;
            }
            else {
                if ($year != $now){
                    $newID = 'Retur-RSGZ/000001/' . $month . '/' . $year;
                } else {
                    $lastIncrement = substr($lastID->code, 11, 6);
                    $newIncrement = 'Retur-RSGZ/' . str_pad($lastIncrement + 1, 6, 0, STR_PAD_LEFT);
                    $newID = $newIncrement . '/' . $month . '/' . $year;
                }
            }
        }

        $retur = Restore::create([
            'code' => $newID,
            'date' => new DateTime(),
            'dari' => $request->dari,
            'user_id' => Auth::user()->id,
            'name' => $newID,
        ]);

        $find = Restore::where('code', $newID)->first();

        if ($counter > 1){
            for ($i=0; $i < $counter; $i++){
                Two::create([
                    'restore_id' => $find->id,
                    'restore_code' => $find->code,
                    'material_id' => $request->material[$i],
                    'unit_id' => $request->unit[$i],
                    'user_id' => Auth::user()->id,
                    'jumlah' => (int)$request->jumlah[$i],
                    'keterangan' => $request->keterangan[$i],
                ]);
            }
        }
        else {
            Two::create([
                'restore_id' => $find->id,
                'restore_code' => $find->code,
                'material_id' => $request->material[0],
                'unit_id' => $request->unit[0],
                'user_id' => Auth::user()->id,
                'jumlah' => (int)$request->jumlah[0],
                'keterangan' => $request->keterangan[0],
            ]);
        }
        if (!$retur){
            Alert::error('Gagal', 'Data Gagal Di Tambah');
        } else {
            Alert::success('Berhasil', 'Data Berhasil Di Tambah');
        }

        return redirect()->route('admin.retur.index');
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

    public function showRetur($id)
    {
        $retur = Restore::find($id);
        return view('admin.retur.show')->with('retur', $retur);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $retur = Restore::find($id);
        $materials = Material::all();
        $units = Unit::all();
        $spends = Spend::all();

        return view('admin.retur.edit')->with([
            'retur' => $retur,
            'materials' => $materials,
            'units' => $units,
            'spends' => $spends,
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
        $retur = Restore::find($id);
        $counter = count($request->jumlah);
        $counterDetail = count($retur->detail);

        $retur->update([
            'dari' => $request->dari,
            'user_id' => Auth::user()->id,
        ]);

        if ($counter > $counterDetail){
            foreach ($retur->detail as $i => $detail){
                Two::destroy($detail->id);
            }
            for($i=0; $i < $counter; $i++){
                Two::create([
                    'restore_id' => $retur->id,
                    'restore_code' => $retur->code,
                    'material_id' => $request->material[$i],
                    'unit_id' => $request->unit[$i],
                    'user_id' => Auth::user()->id,
                    'jumlah' => (int)$request->jumlah[$i],
                    'keterangan' => $request->keterangan[$i],
                ]);
            }
        }
        else {
            foreach ($retur->detail as $i => $detail){
                $item = Two::find($detail->id);
                $item->update([
                    'material_id' => $request->material[$i],
                    'unit_id' => $request->unit[$i],
                    'user_id' => Auth::user()->id,
                    'jumlah' => (int)$request->jumlah[$i],
                    'keterangan' => $request->keterangan[$i],
                ]);
            }
        }

        if (!$retur){
            Alert::error('Gagal', 'Data Gagal Di Ubah');
        }else {
            Alert::success('Berhasil', 'Data Berhasil Di Ubah');
        }

        return redirect()->route('admin.retur.index');
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
