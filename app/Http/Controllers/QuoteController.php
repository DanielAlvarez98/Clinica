<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\{Patient,Schedule};


class QuoteController extends Controller
{

    public function index()
    {
        $schedules = Schedule::whereHas('employeeInAreas', function ($query) {
            $query->where('status', 1);
        })
        ->orderBy('id_day')
        ->get(); 

        return view('quote.index',['schedules' => $schedules]);
    }


    public function store(Request $request,Schedule $schedule)
    {
        $patient = Patient::findOrFail($request['id_patient']);

        $schedule->quotes()->attach($patient,[
            'start_time'=>$request['start_time'],
            'end_time'=>$request['end_time'],
            'description'=>$request['description'],
            'status'=>$request['status'] = 1
        ]);

        return redirect()->route('quote.show',$schedule)->with('flash_message', 'Addedd!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        $patients=$schedule->quotes;
        $pacientes = Patient::whereDoesntHave('quotes', function ($query) use ($schedule) {
            $query->where('id_schedule', $schedule->id);
        })->get();

        return view('quote.show',['patients'=>$patients,'pacientes'=>$pacientes,'schedule'=>$schedule]);
    }


    public function editAjaxCita(Schedule $schedule, Patient $patient)
    {
        $pivotData = $patient->quotes()
            ->wherePivot('id_schedule', $schedule->id)
            ->first()->pivot;
    
        $status = $pivotData->status;
        $start_time = $pivotData->start_time;
        $end_time = $pivotData->end_time;
        $description = $pivotData->description;
    
        $namePac = $patient->dni.'|'.$patient->name.'|'.$patient->lastname;
    
        return response()->json([
            'namePac' => $namePac,
            'status' => $status,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'description' => $description
        ]);
    }
    

    public function updateCita(Request $request, Schedule $schedule, Patient $patient)
    {
        
        $status=$request['cita_active']=='on' ? 1 : 0;

        $patient->quotes()->updateExistingPivot($schedule,[
            'start_time'=>$request['start_time'],
            'end_time'=>$request['end_time'],
            'description'=>$request['description'],
            'status'=>$status,
        ]);
        return redirect()->route('quote.show',$schedule)->with('flash_message', 'Updated!');

    }


    public function destroy(Schedule $schedule,Patient $patient)
    {
        $patient->quotes()->detach($schedule);
         
        return redirect()->route('quote.show', $schedule)->with('flash_message', 'deleted!');

    }
}
