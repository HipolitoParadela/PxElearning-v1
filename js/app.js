/// *********************************************************************************************/////
//// FILTROS
/// *******************************************

/// FECHA TIME STAMP
Vue.filter('FechaTimestamp', function (fecha) 
{
    if(fecha)
    { 
        fecha = fecha.split('T');

        //var fecha_dia = fecha[0].replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');
        var fecha_dia = fecha[0].replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');

        var fecha_hora = fecha[1].split(':');
        fecha_hora = fecha_hora[0] + ':' + fecha_hora[1];

        //return fecha_dia + ' ' + fecha_hora + 'hs '
        return fecha_dia
     }
    else{
        return "No definida"
    } 
})

/// FECHA AUTOMATICA BASE DATOS
Vue.filter('FechaB_datos', function (fecha) 
{
    if(fecha)
    { 
        fecha = fecha.split(' ');

        //var fecha_dia = fecha[0].replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');
        var fecha_dia = fecha[0].replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');

        var fecha_hora = fecha[1].split(':');
        fecha_hora = fecha_hora[0] + ':' + fecha_hora[1];

        return fecha_dia + ' ' + fecha_hora + 'hs '
     }
    else{
        return "No definida"
    } 
    
})

/// FECHA TIME STAMP
Vue.filter('Fecha', function (fecha) {
    if(fecha)
    {
        return fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');
    }
    else
    {
        return 'No definido'
    }

})

/// FORMATO DINERO
Vue.filter('Moneda', function (numero) {
    /// PARA QUE FUNCIONE DEBE TOMAR EL NUMERO COMO UN STRING
    //si no lo es, lo convierte

    if (numero > 0 || numero != null) {
        //if (numero % 1 == 0) {
        numero = numero.toString();
        //}

        // Variable que contendra el resultado final
        var resultado = "";
        var nuevoNumero;

        // Si el numero empieza por el valor "-" (numero negativo)
        if (numero[0] == "-") {
            // Cogemos el numero eliminando los posibles puntos que tenga, y sin
            // el signo negativo
            nuevoNumero = numero.replace(/\./g, '').substring(1);
        } else {
            // Cogemos el numero eliminando los posibles puntos que tenga
            nuevoNumero = numero.replace(/\./g, '');
        }

        // Si tiene decimales, se los quitamos al numero
        if (numero.indexOf(",") >= 0)
            nuevoNumero = nuevoNumero.substring(0, nuevoNumero.indexOf(","));

        // Ponemos un punto cada 3 caracteres
        for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i-- , j++)
            resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0) ? "." : "") + resultado;

        // Si tiene decimales, se lo añadimos al numero una vez forateado con 
        // los separadores de miles
        if (numero.indexOf(",") >= 0)
            resultado += numero.substring(numero.indexOf(","));

        if (numero[0] == "-") {
            // Devolvemos el valor añadiendo al inicio el signo negativo
            return "-" + resultado;
        } else {
            return resultado;
        }
    }
    else {
        return 0
    }
})

/// OBSERVACIONES RECORTAR LARGO
Vue.filter('Recortar', function(texto){
    if(texto != null){
        return texto.substr(0,30) + '...';
    }
    else{
        return 'Sin observaciones'
    }
})


/// ELEMENTOS COMUNES PARA LA WEB
new Vue({
    el: '#app',

    created: function () {        
        
        switch (pathname) 
        {
            case '/usuarios':
                this.getListadoPrincipal('/usuarios/obtener_listado_principal');
                this.getFiltro_1('/usuarios/obtener_roles');
                break; 

            case '/cursos':
                this.getListadoPrincipal('/cursos/obtener_listado_principal');
                this.getFiltro_1('/cursos/obtener_categorias');
                break; 
        }
    },

    data:
    {
        
        /// FORMULARIO PRINCIPAL
            listaPrincipal: [],
            datosFormularioPrincipal: [],
        
        /// IMAGEN PRINCIPAL
            datosFoto: { 'Id': '', 'Nombre_principal': '', 'Imagen': '' },
            Archivo: '',
            preloader: '0',
        
        /// FILTROS
            buscar: '',

            filtro_Data: {},

            listaFiltro_1: [],
            filtro_1: "0",

            listaFiltro_2: [],
            filtro_2: "0",

            listaFiltro_3: [],
            filtro_3: '0',

            listaFiltro_4: [],
            filtro_4: '0',

            listaFiltro_5: [],
            filtro_5: '0',

        /// OTROS 
            infoModal: {'Observaciones':''},
            mostrar: '1',
            texto_boton: "Cargar",
            Rol_usuario: '',
    },

    methods:
    {
             
        //// PRINCIPAL COMUN | MOSTRAR LISTADO  
        getListadoPrincipal: function (url_controller) {
            //var url = base_url + '/usuarios/obtener_Usuarios/?estado=' + estado; // url donde voy a mandar los datos
            var url = base_url + url_controller; // url donde voy a mandar los datos

            axios.post(url, {
                token: token,
                Estado: 1,
                Filtro_1: this.filtro_1,
                Filtro_2: this.filtro_2,
                Filtro_3: this.filtro_3,
                Filtro_4: this.filtro_4,
                Filtro_5: this.filtro_5,
            }).then(response => {
                this.listaPrincipal = response.data
            }).catch(error => {
                toastr.error('Error en la recuperación de los datos', 'Usuarios')
                console.log(error.response.data)
            });
        },

        ////  PRINCIPAL COMUN |  CREAR O EDITAR ITEM
        crearItemPrincipal: function (url_controller) {
            //var url = base_url + '/usuarios/cargar_Usuarios'; // url donde voy a mandar los datos
            var url = base_url + url_controller; // url donde voy a mandar los datos
            
            axios.post(url, {
                token: token,
                Datos: this.datosFormularioPrincipal
            }).then(response => {

                toastr.success('Proceso realizado correctamente', 'Usuarios')

                this.datosFormularioPrincipal.Id = response.data.Id;
                this.texto_boton = "Actualizar"

                /// UNICA PARTE DEL CÓDIGO A GENERAR POR CADA LISTA
                switch (pathname) {
                    case '/usuarios':
                        this.getListadoPrincipal('/usuarios/obtener_Usuarios'); 
                        break;

                    case '/cursos':
                        this.getListadoPrincipal('/cursos/obtener_listado_principal');  
                        break; 
                }
                

            }).catch(error => {
                
                //console.log(error.response.data)
                toastr.error('Error en la recuperación de los datos', 'Usuarios')
            });
        },

        //// PRINCIPAL COMUN |  Carga el formulario para editar
        editarFormulario(datos) {
            //this.datos = {};
            this.datosFormularioPrincipal = datos;
            this.texto_boton = "Actualizar";
        },

        ////   PRINCIPAL COMUN |  LIMPIAR EL FORMULARIO DE CREAR
        limpiarFormulario() {
            this.datosFormularioPrincipal = {}
            this.texto_boton = "Cargar";
        },

        //// ELIMINAR ALGO
        eliminar: function (Id, tbl) {
            var url = base_url + '/elementoscomunes/eliminar'; // url donde voy a mandar los datos

            //SOLICITANDO CONFIRMACIÓN PARA ELIMINAR
            var opcion = confirm("¿Esta seguro de eliminar esta información?");
            if (opcion == true) {

                axios.post(url, {
                    token: token,
                    Id: Id, tabla: tbl
                }).then(_response => {

                    switch (pathname) {
                        case '/usuarios':
                        this.getListadoPrincipal('/usuarios/obtener_Usuarios');
                        break;
                    }
                    switch (pathname) {
                        case '/cursos':
                            this.getListadoPrincipal('/cursos/obtener_listado_principal');
                            this.getFiltro_1('/cursos/obtener_categorias');
                        break;
                    }
                    toastr.success('Eliminado correctamente', '-')

                }).catch(error => {
                    toastr.error('Error en la recuperación de los datos', 'Usuarios')
                    console.log(error.response.data)
                });
            }
        },

        //// USUARIOS |  ACTIVAR/DESACTIVAR    
        activarUsuario: function (usuario) {
            var url = base_url + '/usuarios/cargar_Usuarios'; // url donde voy a mandar los datos

            if (usuario.Activo == 1) {
                usuario.Activo = 0;
            }
            else {
                usuario.Activo = 1;
            }

            axios.post(url, {
                token: token,
                datosFormularioPrincipal: usuario
            }).then(_response => {

               /// UNICA PARTE DEL CÓDIGO A GENERAR POR CADA LISTA
               switch (pathname) {
                    case '/usuarios':
                    this.getListadoPrincipal('/usuarios/obtener_Usuarios'); break;
                }

                toastr.success('Proceso realizado con éxito', 'Items Carta')

            }).catch(error => {
                
                toastr.error('Error en la recuperación de los datos', 'Usuarios')
                console.log(error.response.data)
            });
        },

        //// SUBIR FOTO
        archivoSeleccionado(event) {
            this.Archivo = event.target.files[0]
            //this.texto_boton = "Actualizar"
        },

        //// SUBIR FOTO
        upload(Id, tabla) {
            //this.texto_boton = "Actualizar"
            var url = base_url + '/elementoscomunes/subirImagen/?Id='+Id+'&tabla='+tabla; // url donde voy a mandar los datos
            this.preloader = 1;
            //const formData = event.target.files[0];
            const formData = new FormData();
            formData.append("Archivo", this.Archivo);

            formData.append('_method', 'PUT');

            //Enviamos la petición
            axios.post(url, formData)
                .then(response => {

                    ////DEBO HACER FUNCIONAR BIEN ESTO PARA QUE SE ACTUALICE LA FOTO QUE CARGO EN EL MOMENTO, SI NO PARECE Q NO SE CARGARA NADA
                    this.datosFoto.Imagen = response.data.Imagen;
                    
                    /// UNICA PARTE DEL CÓDIGO A GENERAR POR CADA LISTA
                    switch (pathname) {
                        case '/usuarios':
                        this.getListadoPrincipal('/usuarios/obtener_Usuarios'); break;
                    }
                    
                    toastr.success('Proceso realizado correctamente', 'Usuarios')

                    this.preloader = 0;
                }).catch(error => {
                    toastr.error('Error en la recuperación de los datos', 'Usuarios')
                    console.log(error.response.data)
                    this.preloader = 0;
                });
        },

        //// SUBIR FOTO
        editarFormularioFoto(datos) {
            this.datosFoto = datos;
            this.texto_boton = "Actualizar";
        },


        //// FILTROS |  Carga el formulario para editar
        editarFormulario_filtro(datos) {
            //this.datos = {};
            this.filtro_Data = datos;
            this.texto_boton = "Actualizar";
        },

        ////   FILTROS |  LIMPIAR EL FORMULARIO DE CREAR
        limpiarFormulario_filtro() {
            this.filtro_Data = {}
            this.texto_boton = "Cargar";
        },

        ////  Filtro COMUN |  CREAR O EDITAR ITEM
        crearItemFiltro: function (url_controller) {
            var url = base_url + url_controller; // url donde voy a mandar los datos
            
            axios.post(url, {
                token: token,
                Datos: this.filtro_Data
            }).then(response => {

                toastr.success('Proceso realizado correctamente', 'SISTEMA')

                this.filtro_Data.Id = response.data.Id;
                this.texto_boton = "Actualizar"

                /// PARTE EDITABLE -------------------
                    switch (pathname) {
                        case '/cursos':
                            this.getFiltro_1('/cursos/obtener_categorias'); 
                            break;
                    }
                /// ---------

            }).catch(error => {
                
                //console.log(error.response.data)
                toastr.error('Error en la recuperación de los datos', 'SISTEMA')
            });
        },

        
        ////  FILTRO_1 | MOSTRAR LISTADO  
        getFiltro_1: function (url_controller) {
            var url = base_url + url_controller; // url donde voy a mandar los datos

            axios.post(url, {
                token: token
            }).then(response => {
                this.listaFiltro_1 = response.data
            }).catch(error => {
                
                console.log(error.response.data)
                toastr.error('Error en la recuperación de los datos', 'Sistema')
            });
        },

        ////  FILTRO_2 | MOSTRAR LISTADO  
        getFiltro_2: function (url_controller) {
            var url = base_url + url_controller; // url donde voy a mandar los datos

            axios.post(url, {
                token: token
            }).then(response => {
                this.listaFiltro_2 = response.data
            }).catch(error => {
                
                console.log(error.response.data)
                toastr.error('Error en la recuperación de los datos', 'Sistema')
            });
        },

        ////  FILTRO_3 | MOSTRAR LISTADO  
        getFiltro_3: function (url_controller) {
            var url = base_url + url_controller; // url donde voy a mandar los datos

            axios.post(url, {
                token: token
            }).then(response => {
                this.listaFiltro_3 = response.data
            }).catch(error => {
                
                console.log(error.response.data)
                toastr.error('Error en la recuperación de los datos', 'Sistema')
            });
        },

        
        
    },

    ////// ACCIONES COMPUTADAS     
    computed:
    {
        buscarItem: function () {
            return this.listaPrincipal.filter((item) => item.Nombre_principal.toLowerCase().includes(this.buscar));
        },
    }   
});


///         --------------------------------------------------------------------   ////
//// Elemento para el manejo de usuarios por Id
new Vue({
    el: '#app_id',

    created: function () {
        this.getDatosPrincipal('/usuarios/obtener_Usuario');
        this.getListadoRoles();
        //this.getSuperiores();
        //this.getListadoEmpresas();
        //this.getListadoPuesto();
    },

    data: {

        mostrar: "1",
        preloader: 0,
        datosFormularioPrincipal : {},

        datosFoto: { 'Id': '', 'Nombre_principal': '', 'Imagen': '' },
        Archivo: '',

        listaSuperiores: [],

        listaRoles: [],
        texto_boton: "Cargar",

        listaContenido_2: [],
        cont2Data: {},

        listaSeguimiento: [],
        seguimientoData: {
                            'Id': '',
                            'Fecha': '',
                            'Nombre_principal': '', 
                            'Url_archivo': '',
                            'Descripcion': ''},

        /* listaEmpresas: [],
        listaPuestos: [], */
    },

    methods:
    {

        //// OBTENER DATOS PRINCIPALES
        getDatosPrincipal: function (url_controller) {
            var url = base_url + url_controller +'/?Id=' + Get_Id;  //// averiguar como tomar el Id que viene por URL aca

            axios.post(url, {
                token: token
            }).then(response => {
                this.datosFormularioPrincipal = response.data[0]
            }).catch(error => {
                toastr.error('Error en la recuperación de los datos', 'Sistema')
                console.log(error.response.data)
            });
        },
        
        //// USUARIOS | MOSTRAR LISTADO DE ROLES  
        getListadoRoles: function () {
            var url = base_url + '/usuarios/obtener_roles'; // url donde voy a mandar los datos

            axios.post(url, {
                token: token
            }).then(response => {
                this.listaRoles = response.data
            });
        },

        ////  PRINCIPAL COMUN |  CREAR O EDITAR ITEM
        crearItemPrincipal: function (url_controller) {
            //var url = base_url + '/usuarios/cargar_Usuarios'; // url donde voy a mandar los datos
            var url = base_url + url_controller +'/?Id=' + Get_Id; // url donde voy a mandar los datos
            
            axios.post(url, {
                token: token,
                Datos: this.datosFormularioPrincipal
            }).then(response => {

                toastr.success('Proceso realizado correctamente', 'Usuarios')

                this.datosFormularioPrincipal.Id = response.data.Id;
                this.texto_boton = "Actualizar"

                /// UNICA PARTE DEL CÓDIGO A GENERAR POR CADA LISTA
                switch (pathname) {
                    case '/usuarios':
                    this.getListadoPrincipal('/usuarios/obtener_Usuarios'); break;
                }

            }).catch(error => {
                
                console.log(error.response.data)
                toastr.error('Error en la recuperación de los datos', 'Usuarios')
            });
        },


        //// CREAR O EDITAR una formación
        crear_contenido_2: function (url_controller, url_controller_get) {
            
            var url = base_url + url_controller + '/?Id=' + Get_Id; // url donde voy a mandar los datos
            console.log(url)
            axios.post(url, {
                token: token,
                Datos: this.cont2Data
            }).then(response => {

                toastr.success('Datos actualizados correctamente', 'Usuarios')

                this.cont2Data.Id = response.data.Id;
                this.texto_boton = "Actualizar"
                this.get_contenido_2(url_controller_get);

            }).catch(error => {
                console.log(error.response.data)
                toastr.error('Error en la recuperación de los datos', 'Usuarios')
            });
        },

        //// MOSTRAR LISTADO DE FORMACIONES
        get_contenido_2: function (url_controller) {
            var url = base_url + url_controller + '/?Id=' + Get_Id;  //// averiguar como tomar el Id que viene por URL aca

            axios.post(url, {
                token: token
            }).then(response => {
                    
                this.mostrar = 2
                this.listaContenido_2 = response.data

            }).catch(error => {
                toastr.error('Error en la recuperación de los datos', 'Sistema')
                console.log(error.response.data)
            });
        },

        editarForm_cont_2: function (formacion) {
            this.cont2Data = formacion;
        },

        //// LIMPIAR FORMULARIO FORMACION
        limpiarForm_cont_2: function () {
            this.cont2Data = { 'Id': '', 'Titulo': '', 'Establecimiento': '', 'Anio_inicio': '', 'Anio_finalizado': '', 'Descripcion_titulo': '' }
        },

        //// SUBIR FOTO
        archivoSeleccionado(event) {
            this.Archivo = event.target.files[0]
            //this.texto_boton = "Actualizar"
        },

        //// SUBIR FOTO
        upload(Id, tabla) {
            //this.texto_boton = "Actualizar"
            var url = base_url + '/elementoscomunes/subirImagen/?Id='+Id+'&tabla='+tabla; // url donde voy a mandar los datos
            this.preloader = 1;
            //const formData = event.target.files[0];
            const formData = new FormData();
            formData.append("Archivo", this.Archivo);

            formData.append('_method', 'PUT');

            //Enviamos la petición
            axios.post(url, formData)
                .then(response => {

                    ////DEBO HACER FUNCIONAR BIEN ESTO PARA QUE SE ACTUALICE LA FOTO QUE CARGO EN EL MOMENTO, SI NO PARECE Q NO SE CARGARA NADA
                    this.datosFoto.Imagen = response.data.Imagen;
                    
                    /// UNICA PARTE DEL CÓDIGO A GENERAR POR CADA LISTA
                    switch (pathname) {
                        case '/usuarios':
                        this.getListadoPrincipal('/usuarios/obtener_Usuarios'); break;
                    }
                    
                    toastr.success('Proceso realizado correctamente', 'Usuarios')

                    this.preloader = 0;
                }).catch(error => {
                    toastr.error('Error en la recuperación de los datos', 'Usuarios')
                    console.log(error.response.data)
                    this.preloader = 0;
                });
        },

        //// SUBIR FOTO
        editarFormularioFoto(datos) {
            this.datosFoto = datos;
            this.texto_boton = "Actualizar";
        },

        //// SEGUIMIENTO | MOSTRAR LISTADO
        getListadoSeguimiento: function (url_controller) {
            var url = base_url + url_controller + '/?Id=' + Get_Id; // url donde voy a mandar los datos

            axios.post(url, {
                token: token
            }).then(response => {
                this.listaSeguimiento = response.data;
                this.mostrar = '4'
            });
        },

        //// SEGUIMIENTO |  CREAR O EDITAR
        crearSeguimiento: function (url_controller, url_controller_upload, url_controller_get) {
            var url = base_url + url_controller; // url donde voy a mandar los datos

            axios.post(url, {
                token: token,
                Datos: this.seguimientoData, 
                Id: Get_Id
            }).then(response => {

                this.seguimientoData.Id = response.data.Id;

                /// si eso se ralizó bien, debe comprobar si hay un archivo a cargar.
                if (this.Archivo != null) {
                    var url = base_url + url_controller_upload+'/?Id=' + this.seguimientoData.Id;
                    this.preloader = 1;

                    //const formData = event.target.files[0];
                    const formData = new FormData();
                    formData.append("Archivo", this.Archivo);

                    formData.append('_method', 'PUT');

                    //Enviamos la petición
                    axios.post(url, formData)
                        .then(response => {

                            this.seguimientoData.Url_archivo = response.data.Url_archivo;

                            toastr.success('El archivo se cargo correctamente', 'Proveedores')
                            this.preloader = 0;
                            this.getListadoSeguimiento(url_controller_get);

                        }).catch(error => {
                            alert("MAL LA CARGA EN FUNCIÓN DE CARGAR ARCHIVO");
                            this.preloader = 0;
                            //this.seguimientoData.Url_archivo = response.data.Url_archivo;
                        });
                }
                // si lo hay lo carga, si no lo hay no hace nada

                this.getListadoSeguimiento(url_controller_get);
                this.Archivo = null
                this.texto_boton = "Actualizar"
                toastr.success('Datos actualizados correctamente', 'Proveedores')

            }).catch(error => {
                alert("MAL LA CARGA EN FUNCIÓN DE CARGAR DATOS");
            });
        },

        /// SEGUIMIENTO | EDITAR UN SEGUIMIENTO
        editarFormularioSeguimiento: function (dato) {
            this.seguimientoData = dato;
        },

        //// SEGUIMIENTO | LIMPIAR FORMULARIO SEGUIMIENTO
        limpiarFormularioSeguimiento: function () {
            this.seguimientoData = {}
        },

        //// ELIMINAR ALGO
        eliminar: function (Id, tbl) {
            var url = base_url + '/elementoscomunes/eliminar'; // url donde voy a mandar los datos

            //SOLICITANDO CONFIRMACIÓN PARA ELIMINAR
            var opcion = confirm("¿Esta seguro de eliminar a este usuario?");
            if (opcion == true) {

                axios.post(url, {
                    token: token,
                    Id: Id, tabla: tbl
                }).then(_response => {

                    switch (pathname) {
                        case '/usuarios':
                        this.getListadoPrincipal('/usuarios/obtener_Usuarios');
                        break;
                    }
                    toastr.success('Eliminado correctamente', '-')

                }).catch(error => {
                    toastr.error('Error en la recuperación de los datos', 'Usuarios')
                    console.log(error.response.data)
                });
            }
        },

    },

    ////// ACCIONES COMPUTADAS     
    computed:
    {

    }
});

///         --------------------------------------------------------------------   ////
//// Elemento para el manejo de CURSOS por Id
new Vue({
    el: '#app_cursos',

    created: function () {
        this.getDatosPrincipal('/cursos/obtener_curso');
        this.getFiltro_1('/cursos/obtener_categorias');
        //this.getSuperiores();
        //this.getListadoEmpresas();
        //this.getListadoPuesto();
    },

    data: {

        mostrar: "1",
        preloader: 0,
        datosFormularioPrincipal : {},

        datosFoto: { 'Id': '', 'Nombre_principal': '', 'Imagen': '' },
        Archivo: '',

        listaSuperiores: [],

        listaRoles: [],
        texto_boton: "Cargar",

        listaContenido_2: [],
        cont2Data: {},

        listaSeguimiento: [],
        seguimientoData: {
                            'Id': '',
                            'Fecha': '',
                            'Nombre_principal': '', 
                            'Url_archivo': '',
                            'Descripcion': ''},

        listaFiltro_1: [],
        /* listaPuestos: [], */
    },

    methods:
    {

        //// OBTENER DATOS PRINCIPALES
        getDatosPrincipal: function (url_controller) {
            var url = base_url + url_controller +'/?Id=' + Get_Id;  //// averiguar como tomar el Id que viene por URL aca

            axios.post(url, {
                token: token
            }).then(response => {
                this.datosFormularioPrincipal = response.data[0]
            }).catch(error => {
                toastr.error('Error en la recuperación de los datos', 'Sistema')
                console.log(error.response.data)
            });
        },
        
        ////  FILTRO_1 | MOSTRAR LISTADO  
        getFiltro_1: function (url_controller) {
            var url = base_url + url_controller; // url donde voy a mandar los datos

            axios.post(url, {
                token: token
            }).then(response => {
                this.listaFiltro_1 = response.data
            }).catch(error => {
                
                console.log(error.response.data)
                toastr.error('Error en la recuperación de los datos', 'Sistema')
            });
        },

        ////  PRINCIPAL COMUN |  CREAR O EDITAR ITEM
        crearItemPrincipal: function (url_controller) {
            //var url = base_url + '/usuarios/cargar_Usuarios'; // url donde voy a mandar los datos
            var url = base_url + url_controller +'/?Id=' + Get_Id; // url donde voy a mandar los datos
            
            axios.post(url, {
                token: token,
                Datos: this.datosFormularioPrincipal
            }).then(response => {

                toastr.success('Proceso realizado correctamente', 'Usuarios')

                this.datosFormularioPrincipal.Id = response.data.Id;
                this.texto_boton = "Actualizar"

                /// UNICA PARTE DEL CÓDIGO A GENERAR POR CADA LISTA
                switch (pathname) {
                    case '/usuarios':
                    this.getListadoPrincipal('/usuarios/obtener_Usuarios'); break;
                }

            }).catch(error => {
                
                console.log(error.response.data)
                toastr.error('Error en la recuperación de los datos', 'Usuarios')
            });
        },

        //// CREAR O EDITAR una formación
        crear_contenido_2: function (url_controller, url_controller_get) {
            
            var url = base_url + url_controller + '/?Id=' + Get_Id; // url donde voy a mandar los datos
            console.log(url)
            axios.post(url, {
                token: token,
                Datos: this.cont2Data
            }).then(response => {

                toastr.success('Datos actualizados correctamente', 'Usuarios')

                this.cont2Data.Id = response.data.Id;
                this.texto_boton = "Actualizar"
                this.get_contenido_2(url_controller_get);

            }).catch(error => {
                console.log(error.response.data)
                toastr.error('Error en la recuperación de los datos', 'Usuarios')
            });
        },

        //// MOSTRAR LISTADO DE FORMACIONES
        get_contenido_2: function (url_controller) {
            var url = base_url + url_controller + '/?Id=' + Get_Id;  //// averiguar como tomar el Id que viene por URL aca

            axios.post(url, {
                token: token
            }).then(response => {
                    
                this.mostrar = 2
                this.listaContenido_2 = response.data

            }).catch(error => {
                toastr.error('Error en la recuperación de los datos', 'Sistema')
                console.log(error.response.data)
            });
        },

        editarForm_cont_2: function (formacion) {
            this.cont2Data = formacion;
        },

        //// LIMPIAR FORMULARIO FORMACION
        limpiarForm_cont_2: function () {
            this.cont2Data = { 'Id': '', 'Titulo': '', 'Establecimiento': '', 'Anio_inicio': '', 'Anio_finalizado': '', 'Descripcion_titulo': '' }
        },

        //// SUBIR FOTO
        archivoSeleccionado(event) {
            this.Archivo = event.target.files[0]
            //this.texto_boton = "Actualizar"
        },

        //// SUBIR FOTO
        upload(Id, tabla) {
            //this.texto_boton = "Actualizar"
            var url = base_url + '/elementoscomunes/subirImagen/?Id='+Id+'&tabla='+tabla; // url donde voy a mandar los datos
            this.preloader = 1;
            //const formData = event.target.files[0];
            const formData = new FormData();
            formData.append("Archivo", this.Archivo);

            formData.append('_method', 'PUT');

            //Enviamos la petición
            axios.post(url, formData)
                .then(response => {

                    ////DEBO HACER FUNCIONAR BIEN ESTO PARA QUE SE ACTUALICE LA FOTO QUE CARGO EN EL MOMENTO, SI NO PARECE Q NO SE CARGARA NADA
                    this.datosFoto.Imagen = response.data.Imagen;
                    
                    /// UNICA PARTE DEL CÓDIGO A GENERAR POR CADA LISTA
                    switch (pathname) {
                        case '/usuarios':
                        this.getListadoPrincipal('/usuarios/obtener_Usuarios'); break;
                    }
                    
                    toastr.success('Proceso realizado correctamente', 'Usuarios')

                    this.preloader = 0;
                }).catch(error => {
                    toastr.error('Error en la recuperación de los datos', 'Usuarios')
                    console.log(error.response.data)
                    this.preloader = 0;
                });
        },

        //// SUBIR FOTO
        editarFormularioFoto(datos) {
            this.datosFoto = datos;
            this.texto_boton = "Actualizar";
        },

        //// SEGUIMIENTO | MOSTRAR LISTADO
        getListadoSeguimiento: function (url_controller) {
            var url = base_url + url_controller + '/?Id=' + Get_Id; // url donde voy a mandar los datos

            axios.post(url, {
                token: token
            }).then(response => {
                this.listaSeguimiento = response.data;
                this.mostrar = '4'
            });
        },

        //// SEGUIMIENTO |  CREAR O EDITAR
        crearSeguimiento: function (url_controller, url_controller_upload, url_controller_get) {
            var url = base_url + url_controller; // url donde voy a mandar los datos

            axios.post(url, {
                token: token,
                Datos: this.seguimientoData, 
                Id: Get_Id
            }).then(response => {

                this.seguimientoData.Id = response.data.Id;

                /// si eso se ralizó bien, debe comprobar si hay un archivo a cargar.
                if (this.Archivo != null) {
                    var url = base_url + url_controller_upload+'/?Id=' + this.seguimientoData.Id;
                    this.preloader = 1;

                    //const formData = event.target.files[0];
                    const formData = new FormData();
                    formData.append("Archivo", this.Archivo);

                    formData.append('_method', 'PUT');

                    //Enviamos la petición
                    axios.post(url, formData)
                        .then(response => {

                            this.seguimientoData.Url_archivo = response.data.Url_archivo;

                            toastr.success('El archivo se cargo correctamente', 'Proveedores')
                            this.preloader = 0;
                            this.getListadoSeguimiento(url_controller_get);

                        }).catch(error => {
                            alert("MAL LA CARGA EN FUNCIÓN DE CARGAR ARCHIVO");
                            this.preloader = 0;
                            //this.seguimientoData.Url_archivo = response.data.Url_archivo;
                        });
                }
                // si lo hay lo carga, si no lo hay no hace nada

                this.getListadoSeguimiento(url_controller_get);
                this.Archivo = null
                this.texto_boton = "Actualizar"
                toastr.success('Datos actualizados correctamente', 'Proveedores')

            }).catch(error => {
                alert("MAL LA CARGA EN FUNCIÓN DE CARGAR DATOS");
            });
        },

        /// SEGUIMIENTO | EDITAR UN SEGUIMIENTO
        editarFormularioSeguimiento: function (dato) {
            this.seguimientoData = dato;
        },

        //// SEGUIMIENTO | LIMPIAR FORMULARIO SEGUIMIENTO
        limpiarFormularioSeguimiento: function () {
            this.seguimientoData = {}
        },

        //// ELIMINAR ALGO
        eliminar: function (Id, tbl) {
            var url = base_url + '/elementoscomunes/eliminar'; // url donde voy a mandar los datos

            //SOLICITANDO CONFIRMACIÓN PARA ELIMINAR
            var opcion = confirm("¿Esta seguro de eliminar a este usuario?");
            if (opcion == true) {

                axios.post(url, {
                    token: token,
                    Id: Id, tabla: tbl
                }).then(_response => {

                    switch (pathname) {
                        case '/usuarios':
                        this.getListadoPrincipal('/usuarios/obtener_Usuarios');
                        break;
                    }
                    toastr.success('Eliminado correctamente', '-')

                }).catch(error => {
                    toastr.error('Error en la recuperación de los datos', 'Usuarios')
                    console.log(error.response.data)
                });
            }
        },

    },

    ////// ACCIONES COMPUTADAS     
    computed:
    {

    }
});