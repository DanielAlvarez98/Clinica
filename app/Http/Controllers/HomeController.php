<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Employee_in_Area,Medicine,Patient};


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
        $employeeAreas = Employee_in_Area::where('status',1)->get();
        $medicines=Medicine::all();
        $patients=Patient::all();

        return view('home', ['employeeAreas' => $employeeAreas,
        'medicines'=>$medicines,'patients'=>$patients]);

    }
    
}

