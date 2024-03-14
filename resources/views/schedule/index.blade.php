@extends('layouts.masterpage')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <h4 class="page-title">Horarios</h4>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary ps-2">Days</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($days as $day)
                                    <tr class="persona">
                                        <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                        <td class="info-nombre">
                                            <div class="d-flex flex-column justify-content-center">{{ $day->day }}</div>
                                        </td>

                                        <td class="align-middle text-uppercase text-sm">
                                            <a href="{{ route('schedule.show', $day) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="svg_view" height="1em"
                                                    viewBox="0 0 576 512">
                                                    <path
                                                        d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                                </svg>
                                            </a>
                                        </td>
                                    <tr>
                                    @empty
                                        <p>No hay Dias registradas</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
    <div class="row">
        <div class="col-sm">
            <ul style="display: flex; flex-wrap: wrap">
                @foreach ($employees as $employee)
                    <li data-duration='00:40' style="display: flex; width: 32%; margin: 5px" class="card draggable-event">
                        <p>{{ $employee->areas->area }}||{{ $employee->employees->roles->rol }}||{{ $employee->employees->name }}|{{ $employee->employees->lastname }}
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm">
            <div class="card">
                <div id='calendar' class="card-header p-3 pt-2">
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
    <script src={{asset('https://code.jquery.com/jquery-3.7.0.js')}}></script>
    <script>
        $(function() {

            $('.draggable-event').draggable({
                revert: true,
                revertDuration: 0,
                zIndex: 1000, // Establece el z-index inicial alto
                drag: function(event, ui) {
                    $(this).css('z-index', 2000); // Ajusta temporalmente el z-index durante el arrastre
                },
                stop: function(event, ui) {
                    $(this).css('z-index', 1000); // Restablece el z-index después de soltar el elemento
                }
            });

        });
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar')
            // var ln = navigator.language || navigator.browserLanguage;
            const calendar = new FullCalendar.Calendar(calendarEl, {
                // locale: ln,
                dayHeaderContent: function(arg) {
                    return arg.date.toLocaleDateString('es-ES', {
                        weekday: 'long'
                    }).toUpperCase();
                },
                initialView: 'timeGridWeek',
                editable: true,
                hiddenDays: [0, 6],
                headerToolbar: false,
                allDaySlot: false,
                selectable: true,
                selectHelper: true,
            })
            calendar.render()
        });
    </script>
@endsection
{{-- // dateClick: function(info) {
    //     alert('Clicked on: ' + info.dateStr);
    //     alert('Clicked on: ' + ln);
    //     const dayIndex = info.date.getDay();
    //     if (calendar.getOption('locale') === 'es-ES') {
    //         const daysOfWeek = ['Domingo','Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes',
    //             'Sábado'
    //         ];
    //         dayName = daysOfWeek[dayIndex];
    //     } else {
    //         const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday',
    //             'Friday', 'Saturday'
    //         ];
    //         dayName = daysOfWeek[dayIndex];
    //     }

    //     alert('Clicked on: ' + dayName);
    //     info.dayEl.style.backgroundColor = 'red';
    // } --}}
