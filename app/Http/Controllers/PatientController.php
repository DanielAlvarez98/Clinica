<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients=Patient::all();
        return view('patient.index',['patients'=>$patients]);

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
        $request->validate([
            'name' => ['required'],
            'lastname' => ['required'],
            'birthday' => ['required'],
            'dni' => ['required', 'integer', 'digits:8', 'unique:patients'],
            'phone' => ['required','string','min:9'],
            'email'=>['required','string','max:100','unique:patients'],
            'gender' => ['required'],
            'photo' => [''],

        ]);
        
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
        $imagen = $request->file('photo');
        $nombreArchivo = md5(time() . $imagen->getClientOriginalName()) . '.' . $imagen->getClientOriginalExtension();
        $rutaArchivo = 'assets/img/fotos/' . $nombreArchivo;

        $imagen->move(public_path('assets/img/fotos/'), $nombreArchivo);

        $request['photo'] = $rutaArchivo;
        }else {
            $request['photo'] = 'assets/img/fotos/default.png'; 
        }
        Patient::create([
            'name'=>$request['name'],
            'lastname'=>$request['lastname'],
            'birthday'=>$request['birthday'],
            'dni'=>$request['dni'],
            'phone'=>$request['phone'],
            'email'=>$request['email'],
            'gender'=>$request['gender'],
            'photo'=>$request['photo'],

        ]);
        return redirect()->route('patient.index')->with('flash_message', 'Addedd!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $input=$request->all();
        $patient->update($input);

        return redirect()->route('patient.index')->with('flash_message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient =Patient::find($id);
        $imagen=$patient->photo;
        $patient->delete();
        
        if ($imagen !== 'assets/img/fotos/default.png') {
            if (!empty($imagen) && file_exists(public_path($imagen))) {
                unlink(public_path($imagen));
            }
        }
        return redirect()->route('patient.index')->with('flash_message', 'deleted!');  
    }
}
