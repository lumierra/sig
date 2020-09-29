<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Test;
use App\Vendor;
use App\Vendor2;
use App\Head;
use App\Employee;
use App\User;
use App\Food;
use App\Bed;
use App\Room;
use App\BmPasien;
use App\RuangUnit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Penyakit;

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
        // $query = Head::all();
        // $query = $query[0];
        // $asd = Employee::where('KD_KARYAWAN', '000662')->first();
        // $asd = User::with('employee')->where('employee_id', '000662')->first();
        // $bilangan=1234; // Nilai Proses
        // $fzeropadded = sprintf("%0d", $bilangan);
        // $food = Food::all();
        // $ruang = RuangUnit::all();
        // $bm = BmPasien::all();
        // $bed = Bed::all();
        // $bed = Bed::find(18);
        // $test = $bm[3]->unit;
        // $pasien = BmPasien::where('KD_UNIT', $bed->unit[0]->KD_UNIT)->get();

        // $asd = Room::where('KD_UNIT', $bed->unit[0]->KD_UNIT)->get();

        // $penyakit = Penyakit::where('KD_UNIT', 211)->take(10)->get();
        $kdpasien = '0-60-05-17';


        $test = DB::connection('sqlsrv_server2')
            ->table('PASIEN_INAP')
            ->join('TRANSAKSI', function ($join){
                $join->on('PASIEN_INAP.KD_KASIR', '=', 'TRANSAKSI.KD_KASIR')->on('PASIEN_INAP.NO_TRANSAKSI', '=', 'TRANSAKSI.NO_TRANSAKSI');
            })
            ->join('PASIEN', 'TRANSAKSI.KD_PASIEN', '=', 'PASIEN.KD_PASIEN')
            ->join('KUNJUNGAN', 'TRANSAKSI.KD_PASIEN', '=', 'KUNJUNGAN.KD_PASIEN')
            ->leftJoin('SJP_KUNJUNGAN', function($join){
                $join->on('SJP_KUNJUNGAN.KD_PASIEN', '=', 'KUNJUNGAN.KD_PASIEN')
                ->on('SJP_KUNJUNGAN.KD_UNIT', '=', 'KUNJUNGAN.KD_UNIT')
                ->on('SJP_KUNJUNGAN.TGL_MASUK', '=', 'KUNJUNGAN.TGL_MASUK')
                ->on('SJP_KUNJUNGAN.URUT_MASUK', '=', 'KUNJUNGAN.URUT_MASUK');
            })
            ->join('DOKTER', 'KUNJUNGAN.KD_DOKTER', '=', 'DOKTER.KD_DOKTER')
            ->join('DOKTER_NAMA', 'KUNJUNGAN.KD_DOKTEr', '=', 'DOKTER_NAMA.KD_DOKTER')
            ->join('spesialisasi', function($join){
                $join->on('spesialisasi.KD_SPESIAL', '=', 'PASIEN_INAP.KD_SPESIAL')
                ->on('TRANSAKSI.TGL_TRANSAKSI', '=', 'KUNJUNGAN.TGL_MASUK')
                ->on('TRANSAKSI.KD_UNIT', '=', 'KUNJUNGAN.KD_UNIT')
                ->on('TRANSAKSI.URUT_MASUK', '=', 'KUNJUNGAN.URUT_MASUK');
            })
            ->join('CUSTOMER', 'KUNJUNGAN.KD_CUSTOMER', '=', 'CUSTOMER.KD_CUSTOMER')
            ->leftJoin('KONTRAKTOR', function($join){
                $join->on('KONTRAKTOR.KD_CUSTOMER', '=', 'CUSTOMER.KD_CUSTOMER');
            })
            ->join('UNIT', 'PASIEN_INAP.KD_UNIT', '=', 'UNIT.KD_UNIT')
            ->join('KELAS', 'UNIT.KD_KELAS', '=', 'KELAS.KD_KELAS')
            ->join('TARIF_CUST', 'KUNJUNGAN.KD_CUSTOMER', '=', 'TARIF_CUST.KD_CUSTOMER')
            ->where([
                ['PASIEN.KD_PASIEN', '=', $kdpasien],
                ['KUNJUNGAN.TGL_KELUAR', '=', null],
                ['TRANSAKSI.TGL_DOK', '=', null]

            ])
            // ->where('')
            // ->where(DB::raw("PASIEN.KD_PASIEN = '$kdpasien' AND KUNJUNGAN.TGL_KELUAR IS NULL and TRANSAKSI.TGL_DOK is null AND (TRANSAKSI.KD_UNIT IN (SELECT KD_UNIT FROM UNIT WHERE Parent = '1001') OR PASIEN_INAP.KD_UNIT IN (SELECT KD_UNIT FROM UNIT WHERE Parent = '1001')"))
            ->select('DOKTER.KD_DOKTER','DOKTER_NAMA.NAMA_LENGKAP')
            ->get();



        $test = $test[0]->NAMA_LENGKAP;

        $query = DB::connection('sqlsrv_server2')
            ->table('MR_PENYAKIT')
            ->join('PENYAKIT', 'MR_PENYAKIT.KD_PENYAKIT', '=', 'PENYAKIT.KD_PENYAKIT')
            ->join('UNIT', 'MR_PENYAKIT.KD_UNIT', '=', 'UNIT.KD_UNIT')
            ->where([
                ['MR_PENYAKIT.KD_PASIEN', '=', $kdpasien],
                ['MR_PENYAKIT.URUT_MASUK', '>', 0],
                ['MR_PENYAKIT.TGL_MASUK', '>=', DB::raw("( SELECT TGL_MASUK FROM VIEW_BM_PASIEN_AKTIF WHERE KD_PASIEN = '$kdpasien' ) ")]

            ])
            ->select('MR_PENYAKIT.KD_PENYAKIT', 'PENYAKIT.PENYAKIT', 'MR_PENYAKIT.TGL_MASUK', 'UNIT.NAMA_UNIT')
            ->get();

        return response()->json($query);
    }
}
