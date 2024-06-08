@extends('layouts.masterpage')


@section('content')
<div class="block-header">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <h4 class="page-title">Pacientes</h4>
                    </li>
                </ul>
            </div>
        </div>
</div>   
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="materialTableHeader">
                <div class="right">
                    <ul class="tbl-export-btn">
                        <li class="tbl-header-btn">
                            <div class="mat-mdc-tooltip-trigger m-l-10" aria-describedby="cdk-describedby-message-ng-1-3" cdk-describedby-host="ng-1">
                                <button class="mdc-fab mdc-fab--mini mat-mdc-mini-fab mat-primary mat-mdc-button-base" data-bs-toggle="modal" data-bs-target="#ModRegPaciente">
                                 <mat-icon  class="mat-icon notranslate col-white material-icons mat-ligature-font mat-icon-no-color">add</mat-icon>                                
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="body overflow-auto">
                <div class="responsive_table">
                    <table data-url="{{route('patient.index')}}" id="pacientes-table"  class="table table-hover">
                        <thead >
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Lastname</th>
                                <th>Birthdate</th>
                                <th>Dni</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Action</th>
                              </tr>
                        </thead>
                
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modals')


<div class="modal fade" id="ModEditPatient" aria-labelledby="ModEditPatient" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success">
                <h5 class="modal-title text-white">Editar Paciente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>                                         <!-- #para que cargue  -->
            <form  id="edit-formPatient" class="text-start" role="form" method="POST" action="" enctype="multipart/form-data">
                @method('PATCH')
                @csrf                    
                <div class="modal-body">
                        <span id="complet-campos-edit" class="invalid-feedback" role="alert">
                            <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                            Completar todos los campos
                        </span>
                        <div class="input-group input-group-outline mt-2 mb-4">
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2 focused is-focused">
                                    <label class="form-label">Nombres</label>
                                    <input id="name_edit" type="text" class="form-control name" name="name" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2 focused is-focused">
                                    <label class="form-label">Apellido</label>
                                    <input id="lastname_edit" type="text" class="form-control lastname" name="lastname" required>
                                </div>
                            </div>
                        </div>
                        <div class="input-group input-group-outline mt-2 mb-4">
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2 focused is-focused">
                                    <label class="form-label">Correo</label>
                                    <input id="email_edit" type="email" class="form-control email" name="email" required>
                                </div>
                                <span id="email-repit-edit" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    El correo ya está registrado
                                </span>
                                <span id="email-invalid-edit" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    Ingrese un correo válido
                                </span>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2">
                                    <select id="gender_edit" class="form-control gender" name="gender" required>
                                        @foreach ($genders as $gender)
                                        <option value="{{$gender->value}}">{{$gender->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="input-group input-group-outline mt-2 mb-4">
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2 focused is-focused">
                                    <label class="form-label ">Nacimiento</label>
                                    <input id="birthday_edit" type="date" class="form-control birthday" name="birthday" required >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2 focused is-focused">
                                    <label class="form-label">dni</label>
                                    <input id="dni_edit" type="number" class="form-control dni" name="dni"required >
                                </div>
                                <span id="dni-repit-edit" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    Dni ya está registrado
                                </span>
                                <span id="dni-length-edit" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    Dni debe tener 8 caracteres
                                </span>
                            </div>
                        </div>
                        <div class="input-group input-group-outline mt-2 mb-4">
                            <div class="col-6">
                                <div class="input-group input-group-outline mb-3">
                                    <input type="file" class="form-control photo" id="photo" name="photo">
                                </div>
                                <span class="text-secondary text-xs ms-1" for="photo">Foto del Trabajador</span>
                                    <img id="previewImage" class="avatar avatar-sm me-3 border-radius-lg" alt="Vista previa de la imagen">
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2 focused is-focused">
                                    <label class="form-label">Celular</label>
                                    <input id="phone_Edit" type="number" class="form-control phone" name="phone" required>
                                    <span id="phono-min_edit" class="invalid-feedback" role="alert">
                                        <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                        El numero de celular debe tener minimo 9 caracteres
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" value="Actualizar" class="btn btn-success">
                            Actualizar</button>
                    </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="ModRegPaciente" tabindex="-1" aria-labelledby="ModRegPaciente" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success">
            <h5 class="modal-title text-white" >Registrar Paciente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>                                         
            <form id="paciente-register" class="text-start" role="form" method="POST" action="{{route('patient.register')}}" enctype="multipart/form-data">
                @csrf                    
                <div class="modal-body">
                    <span id="complet-campos" class="invalid-feedback" role="alert">
                        <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                        Completar todos los campos
                    </span>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">
                                <label class="form-label">Nombres</label>
                                <input id="name" type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">
                                <label class="form-label">Apellido</label>
                                <input id="lastname" type="text" class="form-control" name="lastname" required>
                            </div>
                        </div>
                    </div>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">
                                <label class="form-label">Correo</label>
                                <input id="email" type="email" class="form-control" name="email" required>
                            </div>
                            <span id="email-repit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                El correo ya está registrado
                            </span>
                            <span id="email-invalid" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Ingrese un correo válido
                            </span>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">
                                <select id="gender" class="form-control" name="gender" required>
                                    <option selected disabled>Genero</option>
                                    @foreach ($genders as $gender)
                                    <option value="{{$gender->value}}">{{$gender->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2 focused is-focused">
                                <label class="form-label ">Nacimiento</label>
                                <input id="birthday" type="date" class="form-control" name="birthday" required >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">
                                <label class="form-label">dni</label>
                                <input id="dni" type="number" class="form-control" name="dni"required >
                            </div>
                            <span id="dni-repit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Dni ya está registrado
                            </span>
                            <span id="dni-length" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Dni debe tener 8 caracteres
                            </span>
                        </div>
                    </div>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3">
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                            <span class="text-secondary text-xs ms-1" for="photo">Foto del Trabajador</span>
                                <img id="previewImage" class="avatar avatar-sm me-3 border-radius-lg" alt="Vista previa de la imagen">
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">
                                <label class="form-label">Celular</label>
                                <input id="phone" type="telephone" class="form-control" name="phone" required>
                                <span id="phono-min" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    El numero de celular debe tener minimo 9 caracteres
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                    <button id="submitbtnPaciente" type="submit" class="btn btn-success">{{ __('REGISTRARSE')
                    }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script   type="module" src="{{asset('assets/js/common.js')}}"></script>

@endsection


