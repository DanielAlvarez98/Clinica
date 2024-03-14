@extends('layouts.masterpage')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <h4 class="page-title">Citas</h4>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="materialTableHeader">
                    <div class="left">
                        <ul class="header-buttons-left ms-0">
                            <li class="tbl-search-box">
                                <label for="search-input"><i class="material-icons search-icon">search</i></label>
                                <input placeholder="Search" type="text" aria-label="Search box"
                                    class="browser-default search-field">
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="body overflow-auto">
                    <div class="responsive_table">
                        <table class="mat-mdc-table mdc-data-table__table cdk-table mat-sort mat-cell advance-table">
                            <thead class="rowgroup">
                                <tr>
                                    <th>#</th>
                                    <th>Day</th>
                                    <th>Departamento</th>
                                    <th>Rol</th>
                                    <th>Name</th>
                                    <th>Lastname</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($schedules as $schedule)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $schedule->weekdays->day }}</td>
                                        <td>{{ $schedule->employeeInAreas->areas->area }}</td>
                                        <td>{{ $schedule->employeeInAreas->employees->roles->rol }}</td>
                                        <td>{{ $schedule->employeeInAreas->employees->name }}</td>
                                        <td>{{ $schedule->employeeInAreas->employees->lastname }}</td>
                                        <td>
                                            <a href="{{ route('quote.show', $schedule) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="svg_view" height="1em"
                                                    viewBox="0 0 576 512">
                                                    <path
                                                        d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>No hay Horarios para registradas Citas</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
