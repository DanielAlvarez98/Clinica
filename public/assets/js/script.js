import {
    VerDniEmail,
    verificarArea,
    verificarMedi,
    validarCampos,
    manejarRespuestaVerificacion,
} from "./function.js";

$(document).ready(function () {
    $("#submitBtn").click(function (e) {
        e.preventDefault();

        var username = $("#username").val();
        var password = $("#password").val();
        var passwordConfirmation = $("#password-confirm").val();
        var token = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: "/check-username",
            method: "POST",
            data: {
                username: username,
                _token: token,
            },
            success: function (response) {
                if (response.exists) {
                    $("#username-repit").show();
                    $("#ModRegUser").modal("show");
                } else {
                    // Verificar las otras condiciones y enviar el formulario si todo está bien
                    if (
                        password === passwordConfirmation &&
                        password.length >= 8
                    ) {
                        $("#userRegister").submit();
                    } else if (password != passwordConfirmation) {
                        $("#password-lenght-message").hide();
                        $("#password-coincide-message").show();
                    } else if (password.length < 8) {
                        $("#password-coincide-message").hide();
                        $("#password-lenght-message").show();
                    }
                }
            },
        });
    });
});

$(document).ready(function () {
    $("#submitbtnPaciente").click(function (e) {
        e.preventDefault();
        var name = $("#name").val();
        var email = $("#email").val();
        var validEmail = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        var lastname = $("#lastname").val();
        var gender = $("#gender").val();
        var date = $("#birthday").val();
        var dni = $("#dni").val();
        var phone = $("#phone").val();

        VerDniEmail(email, dni, function (verifResult) {
            var valueEmail = verifResult[0];
            var valueDni = verifResult[1];
            if (valueEmail) {
                $("#email-repit").show();
                $("#ModRegPaciente").modal("show");
            } else if (valueDni) {
                $("#email-repit").hide();
                $("#dni-repit").show();
                $("#ModRegPaciente").modal("show");
            } else {
                if (
                    validEmail.test(email) &&
                    dni.length === 8 &&
                    name != "" &&
                    email != "" &&
                    lastname != "" &&
                    gender != "" &&
                    date != "" &&
                    phone.length >= 9
                ) {
                    $("#paciente-register").submit();
                } else if (
                    dni.length === "" ||
                    name === "" ||
                    email === "" ||
                    lastname === "" ||
                    gender === "" ||
                    date === "" ||
                    phone === ""
                ) {
                    $(
                        "#phono-min,#dni-repit,#dni-length,#email-invalid,#email-repit"
                    ).hide();
                    $("#complet-campos").show();
                } else if (phone.length < 9) {
                    $(
                        "#complet-campos,#dni-repit,#dni-length,#email-invalid,#email-repit"
                    ).hide();
                    $("#phono-min").show();
                } else if (dni.length != 8) {
                    $(
                        "#complet-campos,#dni-repit,#phono-min,#email-invalid,#email-repit"
                    ).hide();
                    $("#dni-length").show();
                } else {
                    $(
                        "#complet-campos,#dni-repit,#phono-min,#dni-length,#email-repit"
                    ).hide();
                    $("#email-invalid").show();
                }
            }
        });
    });

    $("#ModEditPatient").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var url = button.data("url");
        var getDataUrl = button.data("send");
        var modal = $(this);

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                var name = data.name;
                var lastname = data.lastname;
                var birthday = data.birthday;
                var dni = data.dni;
                var phone = data.phone;
                var email = data.email;
                var gender = data.gender;
                var photo = data.photo;

                modal.find(".name").val(name);
                modal.find(".lastname").val(lastname);
                modal.find(".birthday").val(birthday);
                modal.find(".dni").val(dni);
                modal.find(".phone").val(phone);
                modal.find(".email").val(email);
                modal.find(".gender").val(gender);
                modal.find("#previewImage").attr("src", photo);
            },
            error: function (response) {},
        });

        modal.find("#edit-formPatient").attr("action", url);
    });
}); /*

*/

$(document).ready(function () {
    $("#submitbtnArea").click(function (e) {
        e.preventDefault();

        var area = $("#area").val();

        verificarArea(area, function (areaRepetida) {
            if (areaRepetida) {
                $("#complet-campos").hide();
                $("#area-repit").show();
                $("#ModRegDepart").modal("show");
            } else {
                if (area.length != "") {
                    $("#DepartRegister").submit();
                } else {
                    $("#area-repit").hide();
                    $("#complet-campos").show();
                }
            }
        });
    });
    $("#ModEditArea").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var url = button.data("url");
        var getDataUrl = button.data("send");
        var modal = $(this);

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                var area = data.area;
                modal.find(".area").data("original-value", area);
                modal.find(".area").val(area);
            },
            error: function (response) {},
        });
        modal.find("#edit-area-form").attr("action", url);
    });

    $("#editAreaBtn").click(function (e) {
        e.preventDefault();
        var modal = $("#ModEditArea");
        var editarea = $("#editeArea").val();
        var valorOriginal = modal.find(".area").data("original-value"); // Obtener el valor original usando data()

        if (editarea === "") {
            $("#area-repit-edit").hide();
            $("#complet-campos-edit").show();
            $("#ModEditArea").modal("show");
        } else if (editarea === valorOriginal) {
            $("#edit-area-form").submit();
        } else {
            verificarArea(editarea, function (areaRepetida) {
                if (areaRepetida) {
                    $("#complet-campos-edit").hide();
                    $("#area-repit-edit").show();
                    $("#ModEditArea").modal("show");
                } else {
                    $("#edit-area-form").submit();
                }
            });
        }
    });
});

$(document).ready(function () {
    $("#submitbtnMedic").click(function (e) {
        e.preventDefault();

        var price = $("#price").val();
        var product = $("#product").val();
        var descrip = $("#descrip").val();
        if (validarCampos(price, product, descrip)) {
            verificarMedi(product, function (mediRepit) {
                manejarRespuestaVerificacion(mediRepit);
            });
        } else {
            $("#product-repit, #price-fail").hide();
            $("#complet-campos").show();
        }
    });

    $("#ModEditMedicine").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var url = button.data("url");
        var getDataUrl = button.data("send");
        var modal = $(this);

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                var product = data.product;
                var price = data.price;
                var description = data.description;

                modal.find(".product").data("original-value", product);
                modal.find(".product").val(product);
                modal.find(".price").val(price);
                modal.find(".description").val(description);
            },
            error: function (response) {},
        });
        modal.find("#edit_form_medicine").attr("action", url);
    });

    $("#editMedicBtn").click(function (e) {
        e.preventDefault();
        var modal = $("#ModEditMedicine");
        var editProd = $("#product-edit").val();
        var editPrice = $("#price-edit").val();
        var editDescr = $("#descrip-edit").val();
        var origProd = modal.find(".product").data("original-value");

        var camposValidos = validarCampos(editPrice, editProd, editDescr);

        if (camposValidos) {
            var cambiosRealizados = editProd != origProd;
            if (cambiosRealizados) {
                verificarMedi(editProd, function (RepitMedi) {
                    if (RepitMedi) {
                        $("#complet-campos-edit-medi").hide();
                        $("#product-repit-edit").show();
                        modal.modal("show");
                    } else {
                        $("#edit_form_medicine").submit();
                    }
                });
            } else {
                $("#edit_form_medicine").submit();
            }
        } else {
            $("#complet-campos-edit-medi").show();
            modal.modal("show");
        }
    });
});

$(document).ready(function () {
    $("#btnInvDet").click(function (e) {
        e.preventDefault();
        var amount = parseInt($("#amount").val(), 10); // Convertir a número entero
        var medicine = $("#id_medicine").val();

        if (!isNaN(amount) && amount > 0 && medicine !== null) {
            $("#invoiceDetall").submit();
        } else if (amount === null || medicine == null) {
            $("#complet-campos").show();
            $("#amount-fail").hide();
        } else if (isNaN(amount) || amount <= 0) {
            $("#amount-fail").show();
            $("#complet-campos").hide();
        }
    });

    /* -----  EDIT Medicos MODAL AJAX -------*/

    $("#ModEditMedico").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var url = button.data("url");
        var getDataUrl = button.data("send");
        var modal = $(this);

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                var id_rol = data.id_rol;
                var rol_name = data.rol_name;
                var name = data.name;
                var lastname = data.lastname;
                var dni = data.dni;
                var email = data.email;
                var gender = data.gender;
                var birthdate = data.birthdate;
                var photo = data.photo;

                modal.find(".rol_select").val(id_rol);
                modal.find(".rol_select").text(rol_name);
                modal.find(".name").val(name);
                modal.find(".lastname").val(lastname);
                modal.find(".dni").val(dni);
                modal.find(".email").val(email);
                modal.find(".gender").val(gender);
                modal.find(".birthdate").val(birthdate);
                modal.find("#previewImage").attr("src", photo);
            },
            error: function (response) {},
        });

        modal.find("#edit-employee-form").attr("action", url);
    });

    $("#ModEditHorarioEmployee").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var url = button.data("url");
        var getDataUrl = button.data("send");
        var modal = $(this);

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                var start_time = data.start_time;
                var end_time = data.end_time;
                var name = data.nameComplet;

                modal.find(".employee_name").val(name);
                modal.find(".start_time").val(start_time);
                modal.find(".end_time").val(end_time);
            },
            error: function (response) {},
        });

        modal.find("#employee_form_horario").attr("action", url);
    });
});

$(document).ready(function () {
    $("#ModEditAreaEmployee").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var url = button.data("url");
        var getDataUrl = button.data("send");
        var modal = $(this);

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                var nameComplet = data.nameComplet;
                var status = data.status;

                modal.find(".employee_name").val(nameComplet);

                if (status == 1) {
                    modal.find(".activeAreaEmployee").prop("checked", true);
                } else {
                    modal.find(".activeAreaEmployee").prop("checked", false);
                }
            },
            error: function (response) {},
        });

        modal.find("#employee_form_area").attr("action", url);
    });

    $("#ModEditAreaPatient").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var url = button.data("url");
        var getDataUrl = button.data("send");
        var modal = $(this);

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                var nameComp = data.nameComp;
                var status = data.status;

                modal.find(".patient_name").val(nameComp);

                if (status == 1) {
                    modal.find(".activeAreaPatient").prop("checked", true);
                } else {
                    modal.find(".activeAreaPatient").prop("checked", false);
                }
            },
            error: function (response) {},
        });

        modal.find("#patient_form_area").attr("action", url);
    });
});

$(document).ready(function () {
    $("#ModEditHistory").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var url = button.data("url");
        var getDataUrl = button.data("send");
        var modal = $(this);

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                var nameComplet = data.nameComplet;
                var date_visit = data.date_visit;

                modal.find(".paciente_name").val(nameComplet);
                modal.find(".date_visit").val(date_visit);
            },
            error: function (response) {},
        });

        modal.find("#history_form_edit").attr("action", url);
    });

    $("#ModEditDiagnosis").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var url = button.data("url");
        var getDataUrl = button.data("send");
        var modal = $(this);

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                var areaP = data.areaP;
                var diagnosi = data.diagnosi;
                var treatment = data.treatment;
                var date = data.date;

                modal.find(".area_name").val(areaP);
                modal.find(".diagnosi").val(diagnosi);
                modal.find(".treatment").val(treatment);
                modal.find(".date").val(date);
            },
            error: function (response) {},
        });

        modal.find("#diagnosis_form_edit").attr("action", url);
    });
});

$(document).ready(function () {
    $("#ModEditarCita").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var url = button.data("url");
        var getDataUrl = button.data("send");
        var modal = $(this);

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                var patient = data.namePac;
                var start_time = data.start_time;
                var end_time = data.end_time;
                var description = data.description;
                var status = data.status;

                modal.find(".patient_name").val(patient);
                modal.find(".start_time").val(start_time);
                modal.find(".end_time").val(end_time);
                modal.find(".description").val(description);

                if (status == 1) {
                    modal.find(".activeCitaPatient").prop("checked", true);
                } else {
                    modal.find(".activeCitaPatient").prop("checked", false);
                }
            },
            error: function (response) {},
        });
        modal.find("#edit-form-cita").attr("action", url);
    });

    $("#ModEditInvoice").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var url = button.data("url");
        var getDataUrl = button.data("send");
        var modal = $(this);

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                var nameP = data.nameP;
                var fecha = data.fecha;

                modal.find(".patient_name").val(nameP);
                modal.find(".date_issue").val(fecha);
            },
            error: function (response) {},
        });

        modal.find("#invoice_form_edit").attr("action", url);
    });

    $("#ModEditInvoiceDet").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var url = button.data("url");
        var getDataUrl = button.data("send");
        var modal = $(this);

        $.ajax({
            type: "GET",
            url: getDataUrl,
            dataType: "JSON",
            success: function (data) {
                var mediName = data.mediName;
                var amount = data.amount;

                modal.find(".medicine_name").val(mediName);
                modal.find(".amount").val(amount);
            },
            error: function (response) {},
        });

        modal.find("#invoiceDetall_form_edit").attr("action", url);
    });
});

