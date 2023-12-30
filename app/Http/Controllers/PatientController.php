<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

use App\Services\AllService;

class PatientController extends Controller
{
    protected $allService;
    public function __construct(AllService $Service)
    {
        $this->allService = $Service;
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->allService->getDatatable();
        }
        return view('patient.index');
        
        // $patients=Patient::all();
        // return view('patient.index',['patients'=>$patients]);

    }
    public function checkPaciente(Request $request)
    {
        $email = $request->input('email');
        $dni = $request->input('dni');
        $valueEmail = Patient::where('email', $email)->exists();
        $valueDni = Patient::where('dni', $dni)->exists();  

        return response()->json(['valueEmail'=>$valueEmail,'valueDni'=>$valueDni]);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $imagen = $request->file('photo');
            $nombreArchivo = md5(time() . $imagen->getClientOriginalName()) . '.' . $imagen->getClientOriginalExtension();
            $rutaArchivo = 'assets/img/fotos/' . $nombreArchivo;
    
            $imagen->move(public_path('assets/img/fotos/'), $nombreArchivo);
    
            $data['photo'] = $rutaArchivo;
        } else {
            $data['photo'] = 'assets/img/fotos/default.png'; 
        }
        
        $this->allService->store(Patient::class, $data);
    
        return redirect()->route('patient.index')->with('flash_message', 'Added!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $patient->loadMissing(
            [
                'file' => fn ($query) =>
                $query->where('file_type', 'imagenes')
                    ->where('category', 'patient'),

                'folders' => fn ($query2) =>
                $query2->where('level', 1),

                'type'
            ],
        );

        $folders = $patient->folders;

        return view('patient.show', [
            'patient' => $patient        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAjax(Patient $patient)
    {
        return response()->json($patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $data=$request->all();
        $this->allService->updateModel($patient, $data);

        return redirect()->route('patient.index')->with('flash_message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $this->allService->deletePhoto($patient->photo);
        $this->allService->deleteModel(Patient::class, $patient->id);
        return redirect()->route('patient.index')->with('flash_message', 'deleted!');  
    }
}
