<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees=Employee::whereHas('roles', function ($query) {
            $query->where('rol', '!=', 'Administrador');
        })->get();
        $roles=Role::all();
        return view('employee.index',['employees'=>$employees,'roles'=>$roles]);
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
        $input = $request->all();
        
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
        $imagen = $request->file('photo');
        $nombreArchivo = md5(time() . $imagen->getClientOriginalName()) . '.' . $imagen->getClientOriginalExtension();
        $rutaArchivo = 'assets/img/fotos/' . $nombreArchivo;

        $imagen->move(public_path('assets/img/fotos/'), $nombreArchivo);

        $input['photo'] = $rutaArchivo;
        }else {
            $input['photo'] = 'assets/img/fotos/default.png'; 
        }
        Employee::create($input);
        return redirect()->route('employee.index')->with('flash_message', 'Addedd!');
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
    public function editAjax(Employee $employee)
    {
        return response()->json([
            'id_rol'=>$employee->id_rol,
            'rol_name'=>$employee->roles->rol,
            'name'=>$employee->name,
            'lastname'=>$employee->lastname,
            'dni'=>$employee->dni,
            'email'=>$employee->email,
            'gender'=>$employee->gender,
            'birthdate'=>$employee->birthdate,
            'photo'=>$employee->photo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $input=$request->all();

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $imagen = $request->file('photo');
            $nombreArchivo = md5(time() . $imagen->getClientOriginalName()) . '.' . $imagen->getClientOriginalExtension();
            $rutaArchivo = 'assets/img/fotos/' . $nombreArchivo;
    
            if ($employee->url_img != '') {
                $rutaImagenAnterior = public_path($employee->photo);
                if (file_exists($rutaImagenAnterior)) {
                    unlink($rutaImagenAnterior);
                }
            }
            $imagen->move(public_path('assets/img/fotos/'), $nombreArchivo);
            $input['photo'] = $rutaArchivo;
        } else {
            $input['photo'] = $employee->photo;
        }

        $employee->update($input);
        return redirect()->route('employee.index')->with('flash_message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $imagen=$employee->photo;
        $employee->delete();
        
        if ($imagen !== 'assets/img/fotos/default.png') {
            if (!empty($imagen) && file_exists(public_path($imagen))) {
                unlink(public_path($imagen));
            }
        }
        return redirect()->route('employee.index')->with('flash_message', 'deleted!');  
    }
}
