@extends('layouts.masterpage')

@section('content')
<div class="block-header">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <h4 class="page-title">Departamentos</h4>
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
                            <input id="filtrar-tabla" placeholder="Search" type="text" aria-label="Search box" class="browser-default search-field">
                        </li>

                    </ul>
                </div>
                <div class="right">
                    <ul class="tbl-export-btn">
                        <li class="tbl-header-btn">
                            <div class="mat-mdc-tooltip-trigger m-l-10" aria-describedby="cdk-describedby-message-ng-1-3" cdk-describedby-host="ng-1">
                                <button class="mdc-fab mdc-fab--mini mat-mdc-mini-fab mat-primary mat-mdc-button-base"  data-bs-toggle="modal" data-bs-target="#ModRegDepart">
                                 <mat-icon  class="mat-icon notranslate col-white material-icons mat-ligature-font mat-icon-no-color">add</mat-icon>                                
                                </button>
                            </div>
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
                                <th class="text-uppercase text-secondary ps-2">Departamentos</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($areas as $area)
                            <tr class="persona">
                                <td class="align-middle text-center text-sm">{{$loop->iteration}}</td>
                                <td  class="info-nombre">
                                    <div class="d-flex flex-column justify-content-center">{{$area->area}}
                                    
                                    </div>
                                </td>
                                
                                <td class="align-middle text-uppercase text-sm">
                                    <a href="{{route('area.showPaciente',$area)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><style>svg{fill:#115ee4}</style><path d="M192 96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM120.5 247.2c12.4-4.7 18.7-18.5 14-30.9s-18.5-18.7-30.9-14C43.1 225.1 0 283.5 0 352c0 88.4 71.6 160 160 160c61.2 0 114.3-34.3 141.2-84.7c6.2-11.7 1.8-26.2-9.9-32.5s-26.2-1.8-32.5 9.9C240 440 202.8 464 160 464C98.1 464 48 413.9 48 352c0-47.9 30.1-88.8 72.5-104.8zM259.8 176l-1.9-9.7c-4.5-22.3-24-38.3-46.8-38.3c-30.1 0-52.7 27.5-46.8 57l23.1 115.5c6 29.9 32.2 51.4 62.8 51.4h5.1c.4 0 .8 0 1.3 0h94.1c6.7 0 12.6 4.1 15 10.4L402 459.2c6 16.1 23.8 24.6 40.1 19.1l48-16c16.8-5.6 25.8-23.7 20.2-40.5s-23.7-25.8-40.5-20.2l-18.7 6.2-25.5-68c-11.7-31.2-41.6-51.9-74.9-51.9H282.2l-9.6-48H336c17.7 0 32-14.3 32-32s-14.3-32-32-32H259.8z"/></svg>
                                    </a>
                                    <a href="{{route('area.show',$area)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="svg_view" viewBox="0 0 640 512"><path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z"/></svg>
                                    </a>
                                    <button type="submit" data-bs-toggle="modal" data-bs-target="#ModEditArea"
                                        data-url='{{route('area.update', $area)}}'
                                        data-send="{{route('area.updateAjax', $area)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg_edit" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                                    </button>
                                    <form  class="alertDelete" method="POST" action="{{route('area.delete',$area) }}" accept-charset="UTF-8" style="display:inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="svg_delet" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                        </button>
                                    </form>
                                </td>
                            <tr>
                            @empty
                                <p>No hay Departamentos registradas</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

@endsection

@section('modals')

<div class="modal fade" id="ModEditArea"  aria-labelledby="ModEditArea" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success">
                <h5 class="modal-title text-white">Editar Departamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-area-form" role="form" class="text-start" method="POST" action="" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <span id="complet-campos-edit" class="invalid-feedback" role="alert">
                        <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                        Completar todos los campos
                    </span>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2 focused is-focused" >
                                <label class="form-label">Departamento</label>
                                <input id="editeArea" type="text" class="form-control area" name="area" data-original-value="" required>
                            </div>
                            <span id="area-repit-edit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                El Departamento ya está registrado
                            </span>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="editAreaBtn" value="Actualizar" class="btn btn-success">
                         Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="ModRegDepart" tabindex="-1" aria-labelledby="ModRegDepart" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success">
                <h5 class="modal-title text-white">Registrar Departamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  id="DepartRegister" role="form" class="text-start" method="POST" action="{{route('area.register')}}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <span id="complet-campos" class="invalid-feedback" role="alert">
                        <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                        Completar todos los campos
                    </span>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">
                                <label class="form-label">Departamento</label>
                                <input id="area" type="text" class="form-control" name="area" required>
                            </div>
                            <span id="area-repit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                El Departamento ya está registrado
                            </span>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                    <input id="submitbtnArea" type="submit" value="Registrar" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
