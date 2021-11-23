/**
 * Verificaciones formularios admin
 */
// Actualizar-Modificar Menu
$(document).ready(function() {
    $('#actualizarMenu').bootstrapValidator({
        message: 'Este valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            menombre: {
                message: ' Nombre no valido',
                validators: {
                    notEmpty: {
                        message: ' El nombre del menú es obligatorio'
                    },
                    stringLength: {
                        min: 4,
                        message: ' Debe tener al menos un caracter'
                    }
                }
            },
            medescripcion: {
                message: ' Número no valido',
                validators: {
                    notEmpty: {
                        message: ' La descripción del menú es obligatoria'
                    },
                    stringLength: {
                        min: 4,
                        message: ' Debe tener al menos un caracter'
                    }
                }
            },
            idpadre: {
                message: ' Número no valido',
                validators: {
                    notEmpty: {
                        message: ' Ingrese un número por favor'
                    },
                    stringLength: {
                        min: 1,
                        message: ' Debe tener al menos un número'
                    }
                }
            }
        },
    });
});
