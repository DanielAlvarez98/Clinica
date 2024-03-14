<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Employee_in_Area, Medicine, Patient, Area};
use App\Services\DashboardService;


class HomeController extends Controller
{
    private $dashboardService;
    public function __construct(DashboardService $service)
    {
            $this->dashboardService=$service;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employeeAreas = Employee_in_Area::where('status', 1)->get();
        $medicines = Medicine::all();
        $patients = Patient::all();
        $pat_count= Patient::count();
        $patientOfArea= $this->dashboardService->getCountPatient();

        return view('home', [
            'employeeAreas' => $employeeAreas,
            'medicines' => $medicines,
            'patients' => $patients,
            'patientOfArea'=>$patientOfArea,
            'pat_count'=>$pat_count
        ]);

    }

}

