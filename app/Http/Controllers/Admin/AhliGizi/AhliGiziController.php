<?php

namespace App\Http\Controllers\Admin\AhliGizi;

// use App\Room;
use App\Bed;
use App\Type;
use App\User;
use App\Room;
use App\BmPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AhliGiziController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::find(Auth::user()->id);
        $beds = Bed::all();

        return view('admin.ahliGizi.index')->with([
            'users' => $users,
            'beds' => $beds,
        ]);
    }

    public function ruangan($id)
    {
        $bed = Bed::find($id);

        $patients = BmPasien::where('KD_UNIT', $bed->unit[0]->KD_UNIT)->get();
        $rooms = Room::where('KD_UNIT', $bed->unit[0]->KD_UNIT)->orderBy('NAMA_KAMAR', 'asc')->get();

        return view('admin.ahliGizi.ruangan')->with([
          'bed' => $bed,
          'patients' => $patients,
          'rooms' => $rooms,
        ]);
    }

    public function diagnosa($id)
    {
        $data = DB::connection('sqlsrv_server2')
            ->table('MR_PENYAKIT')
            ->join('PENYAKIT', 'MR_PENYAKIT.KD_PENYAKIT', '=', 'PENYAKIT.KD_PENYAKIT')
            ->join('UNIT', 'MR_PENYAKIT.KD_UNIT', '=', 'UNIT.KD_UNIT')
            ->where([
                ['MR_PENYAKIT.KD_PASIEN', '=', $id],
                ['MR_PENYAKIT.URUT_MASUK', '>', 0],
                ['MR_PENYAKIT.TGL_MASUK', '>=', DB::raw("( SELECT TGL_MASUK FROM VIEW_BM_PASIEN_AKTIF WHERE KD_PASIEN = '$id' ) ")]

            ])
            ->select('MR_PENYAKIT.KD_PENYAKIT', 'PENYAKIT.PENYAKIT', 'MR_PENYAKIT.TGL_MASUK', 'UNIT.NAMA_UNIT')
            ->get();

        // $nama = $data[0]->PENYAKIT;
        // $data = count($data);
        $result = $data;


        return view('admin.ahliGizi.diagnosa')->with('data', $result);
    }

    public function getNamaDiagnosa($id)
    {
        $id = '0-60-05-17';
        $kdpasien = $id;
        $data = DB::connection('sqlsrv_server2')
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

        $test = $data[0]->PENYAKIT;

        return view('admin.ahliGizi.diagnosa')->with('diagnosa', $test);
    }

    public function create()
    {
        $types = Type::all();

        return view('admin.ahliGizi.ruangan')->with([
            'types' => $types,
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $bed = Bed::find($id);
        $patient = BmPasien::where('KD_PASIEN', $id)->first();
        // dd($patient);

        return view('admin.ahliGizi.detail')->with([
        //   'bed' => $bed,
          'patient' => $patient,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
