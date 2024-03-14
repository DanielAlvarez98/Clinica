@extends('layouts.masterpage')


@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('patient.index') }}">Pacientes</a>
                        <span> / <a href="{{ route('patient.show', $patient) }}"> {{ $patient->name }} </a> </span>
                        @foreach ($parent_folder_collection as $parent_folder)
                            / <a href="{{ route('folder.view', $parent_folder) }}"> {{ $parent_folder->name }} </a>
                        @endforeach
                        <span> / {{ $folder->name }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="folder-action-container">

        <h5 class="title-header-show">Carpeta:   <span> {{$folder->name}} </span> </h5>
    
        <div class="mt-4">

            <div>
                <div>
                    <h6>Editar nombre</h6>
                </div>
                <div>
                    <form action="{{route('folder.update',$folder)}}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input name='name' type="text" class="form-control" placeholder="Ingresa el nombre de la carpeta" required autocomplete="off" value="{{$folder->name}}">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-primary">    
                                            <i class="fa-solid fa-arrows-rotate fa-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>
    <div class="row">
        <h5 class="title-header-show mb-4"> Archivos: </span> </h5>
        <div class="files-section-container">
            <div>
                <h6> Añadir Archivo </h6>
            </div>
            <div>
                <form action="{{route('folders.file.store',$folder)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="file" name="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-primary waves-effect waves-light" value="Guardar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body overflow-auto">
                    <div class="responsive_table">
                        <table data-url="{{route('files.index',$folder)}}" id="files_folder_patient_table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Categoría</th>
                                    <th>Pertenece a</th>
                                    <th>Creado el</th>
                                    <th>Actualizado el</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="folder-inner-container">
            <form id="delete-folder-form" method="POST" action="{{route('folder.destroy', $folder)}}">
                @csrf @method('DELETE')
                <button id="btn-destroy-folder" class="btn btn-danger" type="submit">
                    <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; Eliminar Carpeta
                </button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')

<script   type="module" src="{{asset('assets/js/common.js')}}"></script>
<script src="https://kit.fontawesome.com/469f55554f.js" crossorigin="anonymous"></script>

@endsection