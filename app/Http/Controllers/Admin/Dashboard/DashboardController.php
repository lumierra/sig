<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Demand;
use App\Receipt;
use App\Spend;
use App\Restore;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $spend = Spend::count();
        // $demand = Demand::count();
        // $retur = Restore::count();
        // $receipt = Receipt::count();
        $asd = 'asd';


        return view('admin.dashboard.index')->with([
            'asd' => $asd,
            // 'retur' => $retur,
            // 'spend' => $spend,
            // 'demand' => $demand,
            // 'receipt' => $receipt,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
