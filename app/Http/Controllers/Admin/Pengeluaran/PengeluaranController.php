<?php

namespace App\Http\Controllers\Admin\Pengeluaran;

use Alert;
use App\Demand;
use App\Detail;
use App\Head;
use App\Http\Controllers\Controller;
use App\Material;
use App\Spend;
use App\Tail;
use App\Unit;
use App\One;
use App\Vendor;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PengeluaranController extends Controller
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
            $data = Spend::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = Material::all();
        $units = Unit::all();

        return view('admin.pengeluaran.create')->with([
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
                $newID = 'Pengeluaran-RSGZ/000001/' . $month . '/' . $year;
//                if ()
            }
        }

        $spend = Spend::create([
            'code' => $newID,
            'date' => new DateTime(),
            'tujuan' => $request->tujuan,
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
        }
        if (!$spend){
            Alert::error('Gagal', 'Data Gagal Di Tambah');
        } else {
            Alert::success('Berhasil', 'Data Berhasil Di Tambah');
        }

        return redirect()->route('admin.pengeluaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spend = Spend::find($id);
        $materials = Material::all();
        $units = Unit::all();

        return view('admin.pengeluaran.edit')->with([
            'spend' => $spend,
            'materials' => $materials,
            'units' => $units,
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
        $spend = Spend::find($id);
        $counter = count($request->jumlah);
        $counterDetail = count($spend->detail);

        $spend->update([
            'tujuan' => $request->tujuan,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Spend::find($id)->delete();

        foreach ($spend->detail as $detail){
            $item = One::where('spend_id', $spend->id)->first();
            $item->delete();
        }

        return response()->json(['success'=>'Pengeluaran Berhasil Di Hapus']);
    }

    public function cekBahan($id, $material)
    {
        $detail = Tail::find(1)->get();

        foreach ($detail as $item){

        }

//        $total = sum($detail->)

//        return $detail;

    }
}
