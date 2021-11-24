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
// Actualizar-Modificar Usuario
$(document).ready(function() {
    $('#actualizarUsuario').bootstrapValidator({
        message: 'Este valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            usnombre: {
                message: ' Nombre de usuario no valido',
                validators: {
                    notEmpty: {
                        message: ' El nombre de usuario es obligatorio'
                    },
                    regexp: {
                        regexp: /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/,
                        message: 'La primer letra en mayúscula. Solo letras.'
                    }
                }
            },
            uspass: {
                message: ' Contraseña no valida',
                validators: {
                    notEmpty: {
                        message: ' La contraseña es obligatoria'
                    },
                    regexp: {
                        regexp: /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/,
                        message: 'La primer letra en mayúscula. Solo letras.'
                    }
                }
            },
            usmail: {
                message: ' Correo electronico no valido',
                validators: {
                    notEmpty: {
                        message: ' El correo electronico es obligatorio'
                    },
                    regexp: {
                        regexp: /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/,
                        message: 'Ejemplo: ejemplo@gmail.com'
                    }
                }
            },
            idrol: {
                message: ' Rol no valido',
                validators: {
                    notEmpty: {
                        message: ' El rol es obligatorio'
                    },
                }
            }
        },
    });
});
// Nuevo Menu
$(document).ready(function() {
    $('#menuNuevo').bootstrapValidator({
        message: 'Este valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            menombre: {
                message: ' Nombre del menu no valido',
                validators: {
                    notEmpty: {
                        message: ' El nombre del menu es obligatorio'
                    },
                    regexp: {
                        regexp: /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/,
                        message: 'La primer letra en mayúscula. Solo letras.'
                    }
                }
            },
            medescripcion: {
                message: ' Descripcion no valida',
                validators: {
                    notEmpty: {
                        message: ' La descripcion es obligatoria'
                    },
                    regexp: {
                        regexp: /^([a-z])\w/,
                        message: 'Todo minusculas. Solo letras.'
                    }
                }
            },
            idpadre: {
                message: ' ID Padre no valido',
                validators: {
                    notEmpty: {
                        message: ' El ID del Padre es obligatorio'
                    }
                }
            },
        },
    });
});
// Nuevo Usuario
$(document).ready(function() {
    $('#usuarioNuevo').bootstrapValidator({
        message: 'Este valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            usnombre: {
                message: ' Nombre de usuario no valido',
                validators: {
                    notEmpty: {
                        message: ' El nombre de usuario es obligatorio'
                    },
                    regexp: {
                        regexp: /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/,
                        message: 'La primer letra en mayúscula. Solo letras.'
                    }
                }
            },
            uspass: {
                message: ' Contraseña no valida',
                validators: {
                    notEmpty: {
                        message: ' La contraseña es obligatoria'
                    },
                    regexp: {
                        regexp: /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/,
                        message: 'La primer letra en mayúscula. Solo letras.'
                    }
                }
            },
            usmail: {
                message: ' Correo electronico no valido',
                validators: {
                    notEmpty: {
                        message: ' El correo electronico es obligatorio'
                    },
                    regexp: {
                        regexp: /^[^@]+@[^@]+\.[a-zA-Z]{2,}$/,
                        message: 'Ejemplo: ejemplo@gmail.com'
                    }
                }
            },
            idrol: {
                message: ' Rol no valido',
                validators: {
                    notEmpty: {
                        message: ' El rol es obligatorio'
                    },
                }
            }
        },
    });
});
// Nuevo Producto
$(document).ready(function() {
    $('#productoNuevo').bootstrapValidator({
        message: 'Este valor no es valido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            idproducto: {
                message: ' Codigo del producto no valido',
                validators: {
                    notEmpty: {
                        message: ' El codigo del producto es obligatorio'
                    }
                }
            },
            pronombre: {
                message: ' Nombre del producto no valido',
                validators: {
                    notEmpty: {
                        message: ' El nombre del producto es obligatorio'
                    },
                    regexp: {
                        regexp: /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/,
                        message: 'La primer letra en mayúscula. Solo letras.'
                    }
                }
            },
            prodetalle: {
                message: ' Detalle del producto no valido',
                validators: {
                    notEmpty: {
                        message: ' El detalle del producto es obligatorio'
                    },
                    regexp: {
                        regexp: /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/,
                        message: 'La primer letra en mayúscula. Solo letras.'
                    }
                }
            },
            proprecio: {
                message: ' Precio del producto no valido',
                validators: {
                    notEmpty: {
                        message: ' El precio del producto es obligatorio'
                    },
                    regexp: {
                        regexp: /^[0-9]/,
                        message: 'Solo numeros.'
                    }
                }
            },
            prodescuento: {
                message: ' Descuento del producto no valido',
                validators: {
                    notEmpty: {
                        message: ' El descuento del producto es obligatorio'
                    },
                    regexp: {
                        regexp: /^[0-9]/,
                        message: 'Solo numeros.'
                    }
                }
            },
            procantstock: {
                message: ' Stock del producto no valido',
                validators: {
                    notEmpty: {
                        message: ' El stock del producto es obligatorio'
                    },
                    regexp: {
                        regexp: /^[0-9]/,
                        message: 'Solo numeros.'
                    }
                }
            },
            provecescomprado: {
                message: ' Veces producto comprado no valido',
                validators: {
                    notEmpty: {
                        message: ' Veces producto comprado es obligatorio'
                    },
                    regexp: {
                        regexp: /^[0-9]/,
                        message: 'Solo numeros.'
                    }
                }
            }
        },
    });
});