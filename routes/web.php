<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    AreaController,
    EmployeeController,
    UserController,
    PatientController,
    MedicineController,
    QuoteController,
    InvoiceController,
    HistoryController,
    ScheduleController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/Home', [HomeController::class, 'index'])->name('home');

Route::resource("/Usuario", UserController::class);
Route::get('/Usuario', [UserController::class, 'index'])->name('user.index');
Route::post('/check-username', [UserController::class, 'checkUsername'])->name('checkUsername');

Route::get('/Trabajadores', [EmployeeController::class, 'index'])->name('employee.index');
Route::post('/Trabajadores/Registrar', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/Trabajadores/editarAjax/{employee}', [EmployeeController::class, 'editAjax'])->name('employee.UpdateAjax');
Route::patch('/Trabajadores/Actualizar/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/Trabajadores/{employee}/eliminar', [EmployeeController::class, 'destroy'])->name('employee.destroy');

Route::get('/Departamentos', [AreaController::class, 'index'])->name('area.index');
Route::post('/check-depart', [AreaController::class, 'checkArea'])->name('checkArea');
Route::post('/Departamentos-register', [AreaController::class, 'store'])->name('area.register');
Route::get('/Departamentos/editarAjax/{area}', [AreaController::class, 'editAjax'])->name('area.updateAjax');
Route::patch('/Departamentos/Actualizar/{area}', [AreaController::class, 'update'])->name('area.update');
Route::delete('/Departamentos-delete/{area}', [AreaController::class, 'destroy'])->name('area.delete');

Route::get('/Departamentos/{area}/trabajadores', [AreaController::class, 'show'])->name('area.show');
Route::post('/Departamentos/{area}/registrar-trabajador', [AreaController::class, 'registerEmployee'])->name('area.registerEmployee');
Route::get('/Departamentos/editarAjaxEmploye/{area}/{employee}', [AreaController::class, 'editAjaxEmployeeArea'])->name('area.employeeUpdateAjax');
Route::patch('/Departamentos/ActualizarEmployee/{area}/{employee}', [AreaController::class, 'editEmployeeArea'])->name('area.employeeUpdate');
Route::delete('/Departamentos/trabajador/Eliminar/{area}/{employee}', [AreaController::class, 'employeeDelete'])->name('area.employeeDelete');

Route::get('/Departamentos/{area}/pacientes', [AreaController::class, 'showPatient'])->name('area.showPaciente');
Route::post('/Departamentos/{area}/registrar-paciente', [AreaController::class, 'registerPaciente'])->name('area.registerPaciente');
Route::get('/Departamentos/editarAjaxPatient/{area}/{patient}', [AreaController::class, 'editAjaxPacienteArea'])->name('area.patientAjaxUpdate');
Route::patch('/Departamentos/ActualizarPaciente/{area}/{patient}', [AreaController::class, 'editPacienteArea'])->name('area.patientUpdate');
Route::delete('/Departamentos/paciente/Eliminar/{area}/{patient}', [AreaController::class, 'patientDelete'])->name('area.pacientDelete');


Route::get('/Horarios', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/Horarios/{day}', [ScheduleController::class, 'show'])->name('schedule.show');
Route::post('/Horarios/{day}/registrar-trabajador', [ScheduleController::class, 'registerEmployee'])->name('schedule.register');
Route::get('/Horarios/editAjaxHorario/{day}/{employee}', [ScheduleController::class, 'editAjaxHorario'])->name('schedule.horarioUpdateAjax');
Route::patch('/Horarios/ActualizarHorario/{day}/{employee}', [ScheduleController::class, 'updateHorario'])->name('schedule.horarioUpdate');

Route::delete('/Horarios/trabajador/Eliminar/{day}/{employee}', [ScheduleController::class, 'scheduleDelet'])->name('schedule.destroy');

Route::get('/Pacientes', [PatientController::class, 'index'])->name('patient.index');

Route::post('/check-paciente', [PatientController::class, 'checkPaciente'])->name('checkPaciente');
Route::post('/Pacientes-register', [PatientController::class, 'store'])->name('patient.register');
Route::get('/Pacientes/ver/{patient}', [PatientController::class, 'show'])->name('patient.show');
Route::patch('/Pacientes/Actualizar/{patient}', [PatientController::class, 'update'])->name('patient.update');
Route::get('/Pacientes/editarAjax/{patient}', [PatientController::class, 'editAjax'])->name('patient.updateAjax');
Route::delete('/Pacientes-delete/{patient}', [PatientController::class, 'destroy'])->name('patient.delete');


Route::get('/Medicinas', [MedicineController::class, 'index'])->name('medicine.index');
Route::post('/Medicinas-register', [MedicineController::class, 'store'])->name('medicine.register');
Route::post('/check-medicine', [MedicineController::class, 'checkMedicine'])->name('checkMedicine');
Route::patch('/Medicinas/Actualizar/{medicine}', [MedicineController::class, 'update'])->name('medicine.Update');
Route::get('/Medicinas/editarAjax/{medicine}', [MedicineController::class, 'editAjax'])->name('medicine.UpdateAjax');
Route::delete('/Medicinas-delete/{medicine}', [MedicineController::class, 'destroy'])->name('medicine.delete');


Route::get('/Citas', [QuoteController::class, 'index'])->name('quote.index');
Route::get('/Citas/{schedule}', [QuoteController::class, 'show'])->name('quote.show');
Route::post('/Citas/{schedule}/registrar', [QuoteController::class, 'store'])->name('cita.register');
Route::patch('/Citas/ActualizarCita/{schedule}/{patient}', [QuoteController::class, 'updateCita'])->name('cita.update');
Route::get('/Citas/editarAjaxCita/{schedule}/{patient}', [QuoteController::class, 'editAjaxCita'])->name('cita.updateAjax');
Route::delete('/Citas/paciente/Eliminar/{schedule}/{patient}', [QuoteController::class, 'destroy'])->name('cita.delete');


Route::get('/HistorialMedico', [HistoryController::class, 'index'])->name('medicalHistory.index');
Route::get('/HistorialMedico/{history}', [HistoryController::class, 'show'])->name('medicalHistory.show');
Route::post('/HistorialMedico-register', [HistoryController::class, 'store'])->name('medicalHistory.register');
Route::patch('/HistorialMedico/Actualizar/{history}', [HistoryController::class, 'update'])->name('history.Update');
Route::get('/HistorialMedico/editarAjax/{history}', [HistoryController::class, 'editAjax'])->name('history.UpdateAjax');

Route::post('/HistorialMedico/{history}/register-diagnostico', [HistoryController::class, 'registerDiagnostico'])->name('diagnostico.register');
Route::patch('/HistorialMedico/Diagnostico/Actualizar/{history}/{area}', [HistoryController::class, 'diagnosisUpdate'])->name('diagnostico.Update');
Route::get('/HistorialMedico/Diagnostico/editarAjax/{history}/{area}', [HistoryController::class, 'daignosisEditAjax'])->name('diagnostico.UpdateAjax');
Route::delete('/HistorialMedico/Diagnostico/Eliminar/{history}/{diagnose}', [HistoryController::class, 'diagnosisDelete'])->name('diagnosis.delete');
Route::delete('/HistorialMedico/Eliminar/{history}', [HistoryController::class, 'destroy'])->name('medicalHistory.delete');


Route::get('/Facturas', [InvoiceController::class, 'index'])->name('invoice.index');
Route::post('/Facturas-register', [InvoiceController::class, 'store'])->name('invoice.register');
Route::patch('/Facturas/Actualizar/{invoice}', [InvoiceController::class, 'update'])->name('invoice.Update');
Route::get('/Facturas/editarAjax/{invoice}', [InvoiceController::class, 'editAjax'])->name('invoice.UpdateAjax');
Route::delete('/Facturas/Eliminar/{invoice}', [InvoiceController::class, 'destroy'])->name('invoice.delete');

Route::get('/Facturas/Descargar/{invoice}/', [InvoiceController::class, 'factura'])->name('factura');


Route::get('/Facturas/Detalles/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
Route::post('/Facturas/{invoice}/register-Medicines', [InvoiceController::class, 'registerMedicines'])->name('invoiceDetaills.register');
Route::patch('/Facturas/Detalles/Actualizar/{invoice}/{medicine}', [InvoiceController::class, 'invDetUpdate'])->name('invoiceDet.Update');
Route::get('/Facturas/Detalles/editarAjax/{invoice}/{medicine}', [InvoiceController::class, 'invDetUpdateAjax'])->name('invoiceDet.UpdateAjax');
Route::delete('/Facturas/Eliminar-Detalle/{invoice}/{medicine}', [InvoiceController::class, 'DetInvoiceDelete'])->name('invoiceDetaills.delete');







