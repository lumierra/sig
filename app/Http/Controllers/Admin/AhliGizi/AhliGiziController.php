<?php

namespace App\Http\Controllers\Admin\AhliGizi;

// use App\Room;
use App\Bed;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        return view('admin.ahliGizi.ruangan')->with([
          'bed' => $bed,
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
        $bed = Bed::find($id);

        return view('admin.ahliGizi.detail')->with([
          'bed' => $bed,
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
