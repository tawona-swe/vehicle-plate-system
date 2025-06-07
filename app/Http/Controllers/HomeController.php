<?php

namespace App\Http\Controllers;

use App\Models\VehiclePlate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vehicles = VehiclePlate::all();
        $total = count($vehicles);
        $settled = VehiclePlate::where('is_settled', 1)->count();
        $unsettled = VehiclePlate::where('is_settled', 0)->count();


        return view('dashboard', compact('total', 'settled', 'unsettled'));
    }
}
