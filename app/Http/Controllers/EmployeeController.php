<?php

namespace App\Http\Controllers;

use App\Models\{Employee,Role};
use Illuminate\Http\Request;

use App\Services\AllService;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $allService;

    public function __construct(AllService $allService)
    {
        $this->allService=$allService;
    }
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
        $data = $request->all();
        
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
        $imagen = $request->file('photo');
        $nombreArchivo = md5(time() . $imagen->getClientOriginalName()) . '.' . $imagen->getClientOriginalExtension();
        $rutaArchivo = 'assets/img/fotos/' . $nombreArchivo;

        $imagen->move(public_path('assets/img/fotos/'), $nombreArchivo);

        $data['photo'] = $rutaArchivo;
        }else {
            $data['photo'] = 'assets/img/fotos/default.png'; 
        }

        $this->allService->store(Employee::class, $data);

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
        $data=$request->all();

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
            $data['photo'] = $rutaArchivo;
        } else {
            $data['photo'] = $employee->photo;
        }
        
        $this->allService->updateModel($employee,$data);

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
        $this->allService->deletePhoto($employee->photo);
        $this->allService->deleteModel(Employee::class, $employee->id);
        return redirect()->route('employee.index')->with('flash_message', 'Deleted!');  
    }
    
    

}
