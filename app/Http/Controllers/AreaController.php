<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\{Area,Employee,Patient};

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas=Area::all();
        return view('area.index',['areas'=>$areas]);
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
    public function checkArea(Request $request)
    {
        $area = $request->input('area');
        $valueArea = Area::where('area', $area)->exists();

        return response()->json(['valueArea'=>$valueArea]);
    }
    public function store(Request $request)
    {
        $input=$request->all();
        Area::create($input);
        return redirect()->route('area.index')->with('flash_message', 'Addedd!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {

        $employee_areas = $area->employeeAreas;

        $employees = Employee::whereDoesntHave('employeeAreas', function ($query) use ($area) {
            $query->where('id_area', $area->id);
        })->whereHas('roles', function ($query) {
            $query->where('rol', '!=', 'Administrador');
        })->get();

        return view('area.show', [
            'employee_areas' => $employee_areas,
            'area' => $area,
            'employees' => $employees
        ]);
    }

    public function registerEmployee(Request $request, Area $area)
    {
        
        $employee_status=$request['status'] = 1; 

        $employees = Employee::findOrFail($request['id_employee_area']);

        $area->employeeAreas()->attach($employees, [
            'status' => $employee_status
        ]);

        return redirect()->route('area.show', $area)->with('flash_message', 'Addedd!');
    }
    public function editAjaxEmployeeArea(Area $area,Employee $employee)
    {
        $status=$employee->employeeAreas()
            ->wherePivot('id_area',$area->id)
            ->first()->pivot->status;

       $nombreEm=$employee->roles->rol.'|'.$employee->dni.'|'.$employee->name.'|'.$employee->lastname;
        
       return response()->json([
           'status'=>$status,
           'nameComplet'=> $nombreEm
       ]);
    }

    public function editEmployeeArea(Request $request,Area $area,Employee $employee )
    {
        $status=$request['employee_active']=='on' ? 1 : 0;

        $employee->employeeAreas()->updateExistingPivot($area,[
            'status'=>$status
        ]);
        return redirect()->route('area.show',$area)->with('flash_message', 'Updated!');

    }

    public function employeeDelete(Area $area, Employee $employee)
    {
        $employee->employeeAreas()->detach($area);

        return redirect()->route('area.show', $area)->with('flash_message', 'deleted!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showPatient(Area $area)
    {
        $patient_areas = $area->patientsAreas;
        $patients = Patient::whereDoesntHave('patientsAreas', function ($query) use ($area) {
            $query->where('id_area', $area->id);
        })->get();

        return view('area.showPaciente', [
            'patient_areas' => $patient_areas,
            'area' => $area,
            'patients' => $patients
        ]);
    }
    public function registerPaciente(Request $request, Area $area)
    {
        
        $patient_status=$request['status'] = 1; 

        $patient = Patient::findOrFail($request['id_patient_area']);

        $area->patientsAreas()->attach($patient, [
            'status' => $patient_status
        ]);

        return redirect()->route('area.showPaciente', $area)->with('flash_message', 'Addedd!');
    }

    public function editAjaxPacienteArea(Area $area, Patient $patient)
    {
        $status=$patient->patientsAreas()
            ->wherePivot('id_area',$area->id)
            ->first()->pivot->status;
            
        $nameCom=$patient->dni.'|'.$patient->name.'|'.$patient->lastname;

        return response()->json([
            'status'=>$status,
            'nameComp'=>$nameCom
        ]);
    }

    public function editPacienteArea(Request $request,Area $area, Patient $patient )
    {
        $status=$request['patient_active']=='on' ? 1 : 0;

        $patient->patientsAreas()->updateExistingPivot($area,[
            'status'=>$status
        ]);
        return redirect()->route('area.showPaciente', $area)->with('flash_message', 'Updated!');

    }
    public function patientDelete(Area $area, Patient $patient)
    {
        $patient->patientsAreas()->detach($area);

        return redirect()->route('area.showPaciente', $area)->with('flash_message', 'deleted!');
    }


    

    public function editAjax(Area $area)
    {
        return response()->json($area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $input=$request->all();
        $area->update($input);
        return redirect()->route('area.index')->with('flash_message', 'Updated!');

    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area =Area::find($id);
        $area->delete();
        return redirect()->route('area.index')->with('flash_message', 'deleted!');  
    }
}
