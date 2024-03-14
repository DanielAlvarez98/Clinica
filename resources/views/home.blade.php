@extends('layouts.masterpage')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Paciente Totales</p>
                        <h4 class="mb-0">{{$pat_count}}</h4>
                    </div>
                </div>
                    <canvas data-types="{{ $patientOfArea }}" id="chart_patient_of_area" style="">
                    </canvas>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                        <h4 class="mb-0">2,300</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">New Clients</p>
                        <h4 class="mb-0">3,462</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Sales</p>
                        <h4 class="mb-0">$103,430</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                <div class="card">
                    <div class="header">
                        <h2>Doctors</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Lastname</th>
                                    <th>Rol</th>
                                    <th>Dni</th>
                                    <th>Birthdate</th>
                                    <th>Specialty</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employeeAreas as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->employees->name }}</td>
                                        <td>{{ $employee->employees->lastname }}</td>
                                        <td>{{ $employee->employees->roles->rol }}</td>
                                        <td>{{ $employee->employees->dni }}</td>
                                        <td>{{ $employee->employees->birthdate }}</td>
                                        <td>{{ $employee->areas->area }}</td>
                                        <td>
                                            @if ($employee->status == 1)
                                                <span class="student-section-icon active"></span>
                                            @else
                                                <span class="student-section-icon inactive"></span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <p>No hay medicos registrados en los departamentos</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="header">
                        <h2>Medicines</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($medicines as $medicine)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $medicine->product }}</td>
                                        <td>{{ $medicine->price }}</td>
                                    </tr>
                                @empty
                                    <p>No hay medicamentos registrados</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Pacientes</h2>
                    </div>
                    <div class="tableBody">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Lastname</th>
                                        <th>Birthday</th>
                                        <th>Dni</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($patients as $patient)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $patient->name }}</td>
                                            <td>{{ $patient->lastname }}</td>
                                            <td>{{ $patient->birthday }}</td>
                                            <td>{{ $patient->dni }}</td>
                                            <td>{{ $patient->phone }}</td>
                                            <td>{{ $patient->gender }}</td>
                                        </tr>
                                    @empty
                                        <p>No hay Pacientes Registrados</p>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js') }}"></script>

        <script src="{{ asset('assets/js/kpis.js') }}"></script>
    @endsection
