$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
const SwalDelete = Swal.mixin({
    title: '¿Estás seguro?',
    text: "¡Esta acción no podrá ser revertida!",
    icon: 'warning',
    showCancelButton: true,
                confirmButtonText: '¡Sí!',
    cancelButtonText: 'Cancelar',
    reverseButtons: true,
});

if ($("#pacientes-table").length) {
    var pacientesTables = $("#pacientes-table");
    var getDataUrl = pacientesTables.data("url");
    var pacientesTable = pacientesTables.DataTable({
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: getDataUrl,
        columns: [
            { data: "id", name: "id" },
            {
                data: "photo",
                name: "photo",
                render: function (data, type, full, meta) {
                    var imageUrl = data
                        ? '<img src="' + data + '" alt="Foto" height="30" />'
                        : "";
                    return imageUrl;
                },
            },
            { data: "name", name: "name" },
            { data: "lastname", name: "lastname" },
            { data: "birthday", name: "birthday" },
            { data: "dni", name: "dni" },
            { data: "phone", name: "phone" },
            { data: "email", name: "email" },
            { data: "gender", name: "gender" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
}

if ($('#files_folder_patient_table').length) {
    var filesTableEle = $('#files_folder_patient_table');
    var getDataUrl = filesTableEle.data('url');
    var filesTable = filesTableEle.DataTable({
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: getDataUrl,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'filename', name: 'filename', orderable: false },
            { data: 'file_type', name: 'file_type' },
            { data: 'category', name: 'category' },
            { data: 'parent_folder', name: 'parent_folder', orderable: false },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
    $('.main-content').on('click', '.deleteFile', function () {
        var url = $(this).data('url')

        SwalDelete.fire().then(function (e) {
            if (e.value === true) {
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    dataType: 'JSON',
                    success: function (result) {
                        if (result.success === true) {
                            filesTable.draw();
                            Toast.fire({
                                icon: 'success',
                                text: '¡Archivo eliminado!',
                            })
                        }
                    },
                    error: function (result) {
                        Toast.fire({
                            icon: 'error',
                            title: '¡Ocurrió un error inesperado!',
                        });
                    }
                });
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        });

    })
}