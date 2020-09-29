<?php

namespace App\Http\Controllers\Admin\AhliGizi;

// use App\Room;
use App\Bed;
use App\BmPasien;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Support\Facades\Auth;

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
