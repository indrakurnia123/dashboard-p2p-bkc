<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\DatastudioData;
use Yajra\DataTables\Facades\DataTables;

class DataNominatifPembiayaan extends Controller
{


    public function data(Request $request)
    {
        $data=DB::select('call getPembiayaanByTglAndStatus(?,?,?)',array('2021-11-01',date('Y-m-d'),$request->status));
        return DataTables::of($data)->toJson();
    }
}
