<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\MedicalHistory;
use App\Models\Patient;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;


class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historys=MedicalHistory::all();

        $patients = Patient::whereDoesntHave('historys')->get();


        return view('medicalHistory.index',['historys'=>$historys,'patients'=>$patients]);
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
    public function store(Request $request)
    {
        $input=$request->all();
        MedicalHistory::create($input);
        return redirect()->route('medicalHistory.index')->with('flash_message', 'Addedd!');
    }

    public function editAjax(MedicalHistory $history)
    {
        $nameComplet=$history->patients->dni.'||'.$history->patients->name.'|'.$history->patients->lastname;
        $date_visit=$history->date_visit;

        return response()->json(['nameComplet'=>$nameComplet,'date_visit'=>$date_visit]);
    }
    
    public function update(Request $request, MedicalHistory $history)
    {
        $input=request()->all();
        $history->update($input);
        return redirect()->route('medicalHistory.index')->with('flash_message', 'Updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalHistory $history)
    {
        $patient = $history->patients;
        $areas=$history->diagnosisAreas;
        $areasPatient = $patient->patientsAreas()
                        ->where('status', 1)
                        ->whereDoesntHave('diagnosisAreas', function ($query) use ($history) {
                            $query->where('id_history', $history->id);
                        })->get();
                        
        return view('medicalHistory.show',['areas'=>$areas,'history'=>$history,'areasPatient'=>$areasPatient]);
    }
    public function registerDiagnostico(Request $request, MedicalHistory $history)
    {
        $diagnosis = $request['diagnosi'];
        $treatment = $request['treatment'];
        $date = $request['date'];

       $areasPatient=Area::findOrFail($request['id_patienArea']);
       $history->diagnosisAreas()->attach($areasPatient,[
           'diagnosi'=>$diagnosis,
           'treatment'=>$treatment,
           'date'=>$date,
       ]);
        return redirect()->route('medicalHistory.show',$history)->with('flash_message', 'Addedd!');
    }

    public function daignosisEditAjax(MedicalHistory $history, Area $area)
    {

        $diagnosisData = $area->diagnosisAreas()
            ->wherePivot('id_history', $history->id)
            ->select('diagnosi', 'treatment','date')
            ->first();
            
        $diagnosi = $diagnosisData->pivot->diagnosi;
        $treatment = $diagnosisData->pivot->treatment;
        $date = $diagnosisData->pivot->date;

        $areaP=$area->area;
        
        return response()->json([
            'areaP'=>$areaP,
            'diagnosi'=>$diagnosi,
            'treatment'=>$treatment,
            'date'=> $date
        ]);

    }

    public function diagnosisUpdate(Request $request,MedicalHistory $history, Area $area)
    {
        $area->diagnosisAreas()->updateExistingPivot($history,[
            'diagnosi'=>$request['diagnosi'],
            'treatment'=>$request['treatment'],
            'date'=>$request['date'],
        ]);
        return redirect()->route('medicalHistory.show',$history)->with('flash_message', 'Updated!');

    }

    /** hacer solo esto cuando  hay las mismas combinaciones de las llaves foraneas pero de con diferen descripiocn de la tabla pivot*/
    public function diagnosisDelete(MedicalHistory $history, Diagnosis $diagnose)
    {
        $diagnose->delete();
        return redirect()->route('medicalHistory.show', $history)->with('flash_message', 'deleted!');
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalHistory $history)
    {
        $history->delete();
        return redirect()->back()->with('flash_message', 'deleted!');  

    }
  
}
