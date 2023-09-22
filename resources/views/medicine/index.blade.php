@extends('layouts.masterpage')

@section('content')
<div class="block-header">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <h4 class="page-title">Medicinas</h4>
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
                                <button class="mdc-fab mdc-fab--mini mat-mdc-mini-fab mat-primary mat-mdc-button-base"   data-bs-toggle="modal" data-bs-target="#ModRegMedicine">
                                 <mat-icon  class="mat-icon notranslate col-white material-icons mat-ligature-font mat-icon-no-color">add</mat-icon>                                
                                </button>
                            </div>
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
                                <th>Medicine</th>
                                <th>price</th>
                                <th>Description</th>
                                <th>Action</th>
                              </tr>
                        </thead>
                        <tbody>
                            @forelse ($medicines as $medicine)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$medicine->product}}</td>
                              <td>{{$medicine->price}}</td>
                              <td>{{$medicine->description}}</td>
                              <td>
                                <button type="submit" data-bs-toggle="modal" data-bs-target="#ModEditMedicine"
                                data-url='{{route('medicine.Update',$medicine)}}'
                                data-send="{{route('medicine.UpdateAjax', $medicine)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="svg_edit" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                                </button>
                                <form  class="alertDelete" method="POST" action="{{ route('medicine.delete',$medicine) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="svg_delet" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                        </button>
                                </form>
                                </td>
                            </tr>
                            @empty
                                <p>No hay Medicamentos registrados</p>
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

<div class="modal fade" id="ModEditMedicine"  aria-labelledby="ModEditMedicine" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success">
                <h5 class="modal-title text-white">Editar Medicamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  id="edit_form_medicine" role="form" class="text-start" method="POST" action="" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <span id="complet-campos-edit-medi" class="invalid-feedback" role="alert">
                        <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                        Completar todos los campos
                    </span>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2 focused is-focused">
                                <label class="form-label">Medicamento</label>
                                <input id="product-edit" type="text" class="form-control product" name="product" required>
                            </div>
                            <span id="product-repit-edit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                El Medicamento ya está registrado
                            </span>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2 focused is-focused">
                                <label class="form-label">Precio</label>
                                <input id="price-edit" type="number" class="form-control price" name="price" required>
                            </div>
                            <span id="price-fail-edit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Ingrese un precio válido
                            </span>
                        </div>
                    </div>  
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="input-group input-group-outline  mb-3">
                            <textarea id="descrip-edit" name="description" class="form-control description" rows="5" placeholder="Description" spellcheck="false"></textarea>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                    <button id="editMedicBtn" type="submit" value="Actualizar" class="btn btn-success">
                        Actualizar</button>
                    </div>
            </form>

        </div>
    </div>
</div>





<div class="modal fade" id="ModRegMedicine" tabindex="-1" aria-labelledby="ModRegMedicine" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success">
                <h5 class="modal-title text-white">Registrar Medicamentos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  id="MedicineRegister" role="form" class="text-start" method="POST" action="{{route('medicine.register')}}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <span id="complet-campos" class="invalid-feedback" role="alert">
                        <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                        Completar todos los campos
                    </span>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">
                                <label class="form-label">Medicamento</label>
                                <input id="product" type="text" class="form-control" name="product" required>
                            </div>
                            <span id="product-repit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                El Medicamento ya está registrado
                            </span>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">
                                <label class="form-label">Precio</label>
                                <input id="price" type="number" class="form-control" name="price" required>
                            </div>
                            <span id="price-fail" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Ingrese un precio válido
                            </span>
                        </div>
                    </div>  
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="input-group input-group-outline  mb-3">
                            <textarea id="descrip" name="description" class="form-control" rows="5" placeholder="Description" spellcheck="false"></textarea>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                    <input id="submitbtnMedic" type="submit" value="Registrar" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection