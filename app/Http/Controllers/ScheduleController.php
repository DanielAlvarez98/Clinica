<?php

namespace App\Http\Controllers;

use App\Models\Employee_in_Area;
use App\Models\Schedule;
use App\Models\Weekday;
use Illuminate\Database\Eloquent\Collection;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $days=Weekday::all();

        return view('schedule.index',['days'=>$days]);
    }

    public function show(Weekday $day)
    {
        $employee_Area=$day->schedules;

        $employees = Employee_in_Area::where('status', 1)
        ->whereDoesntHave('schedules', function ($query) use ($day) {
            $query->where('id_day', $day->id);
        })
        ->get();

        return view('schedule.show',['day'=>$day,'employeesAreas'=>$employee_Area,'employees'=>$employees]);
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
    public function registerEmployee(Request $request, Weekday $day)
    {
      $employee_Area=Employee_in_Area::findOrFail($request['id_employeeArea']);

      $day->schedules()->attach($employee_Area,[
          'start_time'=>$request['start_time'],
          'end_time'=>$request['end_time']
      ]);
      return redirect()->route('schedule.show', $day)->with('flash_message', 'Addedd!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAjaxHorario(Weekday $day,Employee_in_Area $employee)
    {

        $employeeData = $employee->schedules()
            ->wherePivot('id_day', $day->id)
            ->select('start_time', 'end_time')
            ->first();
            
        $start_time = $employeeData->pivot->start_time;
        $end_time = $employeeData->pivot->end_time;

        $nameComp=$employee->areas->area.'|'.$employee->employees->roles->rol.'|'.$employee->employees->name.'|'.$employee->employees->lastname;
        
        return response()->json([
            'start_time'=>$start_time,
            'end_time'=>$end_time,
            'nameComplet'=> $nameComp,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateHorario(Request $request,Weekday $day,Employee_in_Area $employee)
    {

        $starTime=$request['start_time'];
        $endTime=$request['end_time'];
        
        $employee->schedules()->updateExistingPivot($day,[
            'start_time'=>$starTime,
            'end_time'=>$endTime
        ]);
        return redirect()->route('schedule.show',$day)->with('flash_message', 'Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function scheduleDelet(Weekday $day,Employee_in_Area $employee)
    {
        $employee->schedules()->detach($day);
        return redirect()->route('schedule.show', $day)->with('flash_message', 'deleted!');
    }
}
