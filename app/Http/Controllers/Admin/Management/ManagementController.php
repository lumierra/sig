<?php

namespace App\Http\Controllers\Admin\Management;

use App\Role;
use App\Bed;
use App\User;
use App\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ManagementController extends Controller
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
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function (User $user) {
                    $result = implode(', ', $user->roles()->get()->pluck('name')->toArray());
                    return ucfirst($result);
                })
                ->addColumn('nama', function (User $user) {
                    $name = $user->employee->GELAR_DEPAN . $user->employee->NAMA . $user->employee->GELAR_BELAKANG;
                    return $name;
                })
                ->addColumn('emailK', function (User $user) {
                    return $user->employee->EMAIL;
                })
                ->addColumn('kode', function (User $user) {
                    return $user->employee->KD_KARYAWAN;
                })
                ->addColumn('action', function($row){
                    $route = 'managament/' . $row->id . '/' . 'showRoom';
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-circle btn-sm editProduct"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="' . $route . '" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Show" class="btn btn-success btn-circle btn-sm roomUser"><i class="fas fa-plus-circle"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Password" class="btn btn-warning btn-circle btn-sm changePassword"><i class="fas fa-key"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-circle btn-sm deleteProduct"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $roles = Role::all();
        $employees = Employee::all();
        $rooms = Bed::all();
        $user = User::find(Auth::user()->id);
        return view('admin.management.index')->with([
            'roles' => $roles,
            'employees' => $employees,
            'rooms' => $rooms,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $employee = Employee::where('KD_KARYAWAN', $request->employee)->first();
      $name = $employee->GELAR_DEPAN . $employee->NAMA . $employee->GELAR_BELAKANG;
      $email = $employee->EMAIL;

        $user = User::updateOrCreate(
            ['id' => $request->product_id],
            [
              'employee_id' => $request->employee,
              'name' => $name,
              'email' => $email,
              'password' => Hash::make('asd')
            ]);

        $user->roles()->sync($request->role);

        return response()->json(['success'=>'User Berhasil Di Simpan']);
    }

    public function store2(Request $request)
    {
        $user = User::find($request->product_id);
        $user->rooms()->sync($request->room);

        return response()->json(['success'=>'Berhasil sync room']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $rooms = Bed::all();

        return view('admin.management.room')->with([
           'user' => $user,
            'rooms' => $rooms,
        ]);
    }

    public function showRoom($id)
    {
        $user = User::find($id);
        $rooms = Bed::all();

        return view('admin.management.room')->with([
            'user' => $user,
            'rooms' => $rooms,
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
        $user = User::find($id);
        $role = implode(', ', $user->roles()->get()->pluck('id')->toArray());

        return response()->json([
            'user' => $user,
            'role' => $role,
        ]);
    }

    public function updateRoom(Request $request)
    {
        $user = User::find($request->userId);
        $user->rooms()->sync($request->rooms);

        return redirect()->route('admin.management-user.index');
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
        $user = User::find($request->product_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->roles()->sync($request->role);

        return response()->json(['success'=>'Bahan Makanan Berhasil di Simpan']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
//        $user->roles()->detach();

        return response()->json(['success'=>'Bahan Makanan Berhasil di Hapus']);
    }

    public function changePassword(Request $request)
    {
      $user = User::find($request->product_id);

      if ($user->id == Auth::user()->id){
        $user->update([
          'password' => Hash::make($request->password)
        ]);

        return redirect()->route('admin.management-user.index');
      }
      else {
        $user->update([
          'password' => Hash::make($request->password)
        ]);

        return response()->json(['success' => 'Sukses ganti password']);
      }
    }

    public function keluar()
    {
      Auth::logout();

      return redirect()->route('login');
    }
}
