
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