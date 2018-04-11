var EMAIL_REGEX = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

$(document).ready(function () {
    $('body').bootstrapMaterialDesign();

    var validaciones = {
        'nombre': validarNombre,
        'email': validarEmail,
        'password': validarPassword,
        'confirm-password': validarConfirmPassword
    }

    $('form').submit(function (event) {
        var errors = {};
        $(this).find('[required]').each(function (item) {
            if (!$(this).val()) {
                errors[$(this).attr('name')] = 'es requerido';
            } else {
                var validationFunc = $(this).attr('data-validacion');
                if (validationFunc) {
                    var validationError = validaciones[validationFunc]($(this).val());
                    if (validationError) {
                        errors[$(this).attr('name')] = validationError;
                    }
                } else {
                    console.log($(this).attr('name'));
                }
            }
        });
        var alerts = [];
        for (var key in errors) {
            alerts.push('El campo ' + getLabelFor(key) + ' ' + errors[key]);
        }
        if (alerts.length) {
            event.preventDefault();
            $('#common-modal-body').html(getModalBody(alerts));
            $('#common-modal').modal();
        }

    });


    function getLabelFor(inputName) {
        var labelId = $('input[name="' + inputName + '"]').attr('id');
        return $('label[for="' + labelId + '"').html();
    }


    function validarNombre(value) {
        if (!/^[a-z]+$/i.test(value)) {
            return 'debe contener sólo letras';
        }
    }

    function validarEmail(value) {
        if (!EMAIL_REGEX.test(value)) {
            return 'no es válido';
        }
    }

    function validarPassword(value) {
        if (value.length < 6) {
            return 'debe tener al menos 6 caracteres, 1 caracter en minúscula, 1 caracter en mayúscula y 1 número o símbolo';
        }
        if (!/[a-z]{1,}/.test(value)) {
            return 'debe tener al menos 1 caracter en minúscula, 1 caracter en mayúscula y 1 número o símbolo';
        }
        if (!/[A-Z]{1,}/.test(value)) {
            return 'debe tener al menos 1 caracter en mayúscula y 1 número o símbolo';
        }
        if (!/([0-9]|W){1,}/.test(value)) {
            return 'debe tener al menos 1 número o símbolo';
        }
    }

    function validarConfirmPassword(value) {
        var pass = $('input[name="password"]').val();
        if (pass != value) {
            return 'debe ser igual al de contraseña';
        }
    }


    function getModalBody(alerts) {
        return alerts.join('<hr>');
    }
});



