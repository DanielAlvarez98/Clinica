@extends('layouts.masterpage')


@section('content')
    <h4>
        <a href="{{ route('patient.index') }}">Paciente</a>
        <span> / {{ $patient->name }} </span>
    </h4>
    <div class="mt-4">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div>
                        <div>
                            <h6>Crear Carpeta </h6>
                        </div>
                        <div class="card-block">
                            <form action="{{ route('folder.create', $patient) }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input name='name' type="text" class="form-control"
                                            placeholder="Ingresa el nombre de la carpeta" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="submit" class="btn btn-primary" value="Crear">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-sm-12 folder-container">
                    @forelse ($folders as $folder)
                        <a href="{{ route('folder.view', $folder) }}" class="folder-link">
                            <div class="folder-card">
                                <img class="folder-img" src="{{ asset('assets/img/folder.png') }}" alt="Card image cap">
                                <div>
                                    <p class="card-text">{{ $folder->name }}</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <h5 class="text-center">Aún no has creado carpetas </h5>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
