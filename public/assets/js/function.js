
export function VerDniEmail(email,dni, callback){
    var token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajax({
        url: '/check-paciente',
        method: 'POST',
        data: {
            email: email,
            dni: dni,
            _token: token
        },
        success: function (response) {
            callback([response.valueEmail,response.valueDni]);
        }
    });
}

export  function verificarArea(area, callback) {
    var token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajax({
        url: '/check-depart', // Ruta a tu controlador o ruta 
        method: 'POST',
        data: {
            area: area,
            _token: token
        },
        success: function (response) {
            callback(response.valueArea);
        }
    });
}

export function verificarMedi(product,callback){
    var token = $('meta[name="csrf-token"]').attr('content'); 
    $.ajax({
        url: '/check-medicine',
        method: 'POST',
        data: {
            product: product,
            _token: token
        },
        success: function (response) {
            callback(response.valueProduct);
        }
    });
}

export function validarCampos(price, product, descrip) {
    if (price === "" || product === "" || descrip === "") {
        return false; 
    }
    if (isNaN(price)) {
        return false; 
    }
    return true;
}
export function manejarRespuestaVerificacion(mediRepit) {
    if (mediRepit) {
        $('#price-fail, #complet-campos').hide();
        $('#product-repit').show();
        $('#ModRegMedicine').modal('show');
    }else{
        $('#MedicineRegister').submit();
    };
}