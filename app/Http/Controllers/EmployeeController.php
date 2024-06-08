<?php

namespace App\Http\Controllers;

use App\Enums\GenderEnum;
use App\Http\Requests\StoreUserRequest;
use App\Models\{Employee, Role};
use Illuminate\Http\Request;

use App\Services\AllService;

class EmployeeController extends Controller
{

    protected $allService;

    public function __construct(AllService $allService)
    {
        $this->allService = $allService;
    }
    public function index()
    {
        $genders = GenderEnum::getInstances();
        $employees = Employee::whereHas('roles', function ($query) {
            $query->where('rol', '!=', 'Administrador');
        })->get();
        $roles = Role::all();
        return view('employee.index', ['employees' => $employees, 'roles' => $roles, 'genders' => $genders]);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $imagen = $request->file('photo');
                $nombreArchivo = md5(time() . $imagen->getClientOriginalName()) . '.' . $imagen->getClientOriginalExtension();
                $rutaArchivo = 'assets/img/fotos/' . $nombreArchivo;

                $imagen->move(public_path('assets/img/fotos/'), $nombreArchivo);

                $data['photo'] = $rutaArchivo;
            } else {
                $data['photo'] = 'assets/img/fotos/default.png';
            }

            $this->allService->store(Employee::class, $data);

            return redirect()->route('employee.index')->with('flash_message', 'Addedd!');
        } catch (\Throwable $th) {
            return response()->json([
                'data' => $data
            ]);
        }
    }


    public function editAjax(Employee $employee)
    {
        return response()->json([
            'id_rol' => $employee->id_rol,
            'rol_name' => $employee->roles->rol,
            'name' => $employee->name,
            'lastname' => $employee->lastname,
            'dni' => $employee->dni,
            'email' => $employee->email,
            'gender' => $employee->gender,
            'birthdate' => $employee->birthdate,
            'photo' => $employee->photo,
        ]);
    }


    public function update(Request $request, Employee $employee)
    {
        $data = $request->all();

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

        $this->allService->updateModel($employee, $data);

        return redirect()->route('employee.index')->with('flash_message', 'Updated!');
    }

    public function destroy(Employee $employee)
    {
        $this->allService->deletePhoto($employee->photo);
        $this->allService->deleteModel(Employee::class, $employee->id);
        return redirect()->route('employee.index')->with('flash_message', 'Deleted!');
    }
}
