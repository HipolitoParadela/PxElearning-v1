<?php
include("aa_cabecera.php");
include("aa_barra_navegacion.php");
?>

</header><!-- .site-header -->

<div class="page-header-overlay">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <header class="entry-header">
                    <h1><?= $TituloPagina; ?></h1>
                </header><!-- .entry-header -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .page-header-overlay -->
</div><!-- .page-header -->

<!-- <div class="container-fluid" id="app"> -->
<div class="container-fluid" id="app_id">
    <div class="row">
        
        <div class="col-12">
            <div class="breadcrumbs">
                <ul class="flex flex-wrap align-items-center p-0 m-0">
                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="<?php echo base_url(); ?>usuarios"><i class="fa fa-users"></i> <?= $TituloPagina; ?></a></li>
                    <li>{{datosFormularioPrincipal.Nombre}}</li>
                </ul>
            </div><!-- .breadcrumbs -->
        </div><!-- .col -->
    </div><!-- .row -->
    <div class="row">
        
        

        <div class="col-lg-2">
            <div class="card">
                <div class="card-header">
                    <h4>Info</h4>
                </div>
                <div class="card-body">
                    <a href="#modalUsuariosFoto" data-toggle="modal" v-on:click="editarFormularioFoto(datosFormularioPrincipal)">
                        <img class="img-thumbnail" v-if="datosFormularioPrincipal.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+datosFormularioPrincipal.Imagen" alt="">
                        <img class="img-thumbnail" v-else src="<?php echo base_url(); ?>uploads/add_usuario.jfif" alt="">
                    </a>
                    <h5 class="text-sm-center mt-2 mb-1">{{datosFormularioPrincipal.Nombre}}</h5>
                    <div class="location text-sm-center">
                        <i class="fa fa-map-marker"></i> {{datosFormularioPrincipal.Domicilio}}</div>
                </div>
            </div>
            <div>
                <a target="_blank" v-bind:href="'https://api.whatsapp.com/send?phone=+549'+datosFormularioPrincipal.Telefono" class="btn btn-success btn-block">
                    <i class="fab fa-whatsapp"></i> Enviar whatsapp
                </a>
                <hr>
                <a target="_blank" v-bind:href="'mailto:'+datosFormularioPrincipal.Email" class="btn btn-info btn-block">
                    <i class="fa fa-envelope"></i> Enviar email
                </a>
            </div>
        </div>

        <!-- SECCION FICHA USUARIO -->
        <div class="col-lg-8">

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ active: mostrar == 1 }" href="#" v-on:click.prevent="mostrar = 1">Ficha</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ active: mostrar == 2 }" href="#" v-on:click.prevent="get_contenido_2('/usuarios/obtener_formaciones')">Formaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ active: mostrar == 3 }" href="#" v-on:click.prevent="get_contenido_3('/usuarios/obtener_cursos')">Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ active: mostrar == 4 }" href="#" v-on:click.prevent="getListadoSeguimiento('/usuarios/obtener_seguimientos')">Seguimiento</a>
                </li>
            </ul>

            <!-- SECCION DATOS EDITABLES DEL USUARIO -->
            <div class="row" v-show="mostrar == '1'">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Ficha: {{datosFormularioPrincipal.Nombre_principal}}</strong>
                            <small>Última actualización
                                <code>{{datosFormularioPrincipal.Ultima_actualizacion | Fecha}}</code>
                            </small>
                        </div>
                        <div class="card-body">
                            <div class="horizontal-form">
                                <form class="form-horizontal" action="post" v-on:submit.prevent="crearItemPrincipal('/usuarios/cargar_Usuarios')">
                                    <div class="row">
                                        <div class="col-sm-offset-2 col-sm-12">
                                            <p align="right"><button type="submit" class="btn btn-success">Actualizar datos</button></p>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4>Datos personales</h4>
                                            <hr>
                                            <div class="form-group">
                                                <label class="control-label">Nombre</label>
                                                <input type="text" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Nombre">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">DNI</label>
                                                <input type="number" class="form-control" placeholder="" v-model="datosFormularioPrincipal.DNI">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Domicilio, localidad y provincia</label>
                                                <input type="text" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Domicilio">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Nacionalidad</label>
                                                <input type="text" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Nacionalidad">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Genero</label>
                                                <select class="form-control" v-model="datosFormularioPrincipal.Genero">
                                                    <option value="1">Masculino</option>
                                                    <option value="2">Femenino</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Telefono</label>
                                                <input type="tel" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Telefono">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <input type="email" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Email">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Estado civil</label>
                                                <select class="form-control" v-model="datosFormularioPrincipal.Estado_civil">
                                                    <option value="Soltero">Soltero</option>
                                                    <option value="Casado">Casado</option>
                                                    <option value="Viudo">Viudo</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Cantidad de hijos</label>
                                                <input type="number" class="form-control" placeholder="" min="0" v-model="datosFormularioPrincipal.Hijos">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Fecha de nacimiento</label>
                                                <input type="date" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Fecha_nacimiento">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Obra social</label>
                                                <input type="text" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Obra_social">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Número de afiliado obra social</label>
                                                <input type="text" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Numero_obra_social">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Nombre y datos de persona de contacto</label>
                                                <textarea class="form-control" rows="5" placeholder="" v-model="datosFormularioPrincipal.Datos_persona_contacto"></textarea>
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            <h4>Datos institucionales</h4>
                                            <hr>
                                            <div class="form-group">
                                                <label class="control-label">Rol</label>
                                                <select class="form-control" v-model="datosFormularioPrincipal.Rol_acceso">
                                                    <option v-for="rol in listaRoles" v-bind:value="rol.Acceso">{{rol.Nombre_rol}} -{{rol.Descripcion}} </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Fecha ingreso</label>
                                                <input type="date" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Fecha_alta">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">CUIL</label>
                                                <input type="number" class="form-control" placeholder="" v-model="datosFormularioPrincipal.CUIT_CUIL">
                                            </div>
                                            <!-- 
                                            <div class="form-group">
                                                <label class="control-label">Empresa</label>
                                                <select class="form-control" v-model="datosFormularioPrincipal.Empresa_id">
                                                    <option value="0">...</option>
                                                    <option v-for="empresas in listaEmpresas" v-bind:value="empresas.Id">{{empresas.Nombre_empresa}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Puesto</label>
                                                <select class="form-control" v-model="datosFormularioPrincipal.Puesto_Id">
                                                    <option value="0">...</option>
                                                    <option v-for="puestos in listaPuestos" v-bind:value="puestos.Id">{{puestos.Nombre_puesto}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Tiene personal a cargo</label>
                                                <select class="form-control" v-model="datosFormularioPrincipal.Lider">
                                                    <option value="1">Si</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Superior inmediato</label>
                                                <select class="form-control" v-model="datosFormularioPrincipal.Superior_inmediato">
                                                    <option v-for="persona in listaSuperiores" v-bind:value="persona.Id">{{persona.Nombre}}</option>
                                                </select>
                                            </div> -->

                                            <div class="form-group">
                                                <label class="control-label">Datos bancarios</label>
                                                <textarea class="form-control" rows="5" placeholder="" v-model="datosFormularioPrincipal.Datos_bancarios"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Periodo de liquidación de sueldo</label>
                                                <select class="form-control" v-model="datosFormularioPrincipal.Periodo_liquidacion_sueldo">
                                                    <option value="4">Diario</option>
                                                    <option value="3">Semanal</option>
                                                    <option value="2">Quincenal</option>
                                                    <option value="1">Mensual</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Horario laboral</label>
                                                <input type="text" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Horario_laboral">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Observaciones</label>
                                                <textarea class="form-control" rows="5" placeholder="" v-model="datosFormularioPrincipal.Observaciones"></textarea>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label class="control-label">Password</label>
                                                <input type="password" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Pass">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-offset-2 col-sm-12">
                                            <p align="right"><button type="submit" class="btn btn-success">Actualizar datos</button></p>

                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- SECCION DATOS DE FORMACIÓN -->
            <div class="row" v-show="mostrar == '2'">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Formaciones académicas y técnicas</strong>
                        </div>
                        <div class="card-body">
                            <div class="bootstrap-data-table-panel col-lg-12">
                                <div class="table-responsive">
                                    <table id="table2excel" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <!-- <th></th> -->
                                                <th>Titulo</th>
                                                <th>Establecimiento</th>
                                                <th>Fecha inicio</th>
                                                <th>Fecha finalizado</th>
                                                <th>Descripcion</th>
                                                <th>
                                                    <button class="item" v-on:click="limpiarForm_cont_2()" data-toggle="modal" data-target="#modalFormaciones" data-placement="top" title="Edición rápida">
                                                        <i class="ti-plus"></i> Añadir formación
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="formacion in listaContenido_2">
                                                <td>{{formacion.Titulo}}</td>
                                                <td>{{formacion.Establecimiento}}</td>
                                                <td>{{formacion.Anio_inicio | Fecha}}</td>
                                                <td>{{formacion.Anio_finalizado | Fecha}}</td>
                                                <td>{{formacion.Descripcion_titulo}}</td>
                                                <td>
                                                    <button class="item" v-on:click="editarForm_cont_2(formacion)" data-toggle="modal" data-target="#modalFormaciones" data-placement="top" title="Edición rápida">
                                                        <i class="fas fa-pen-square"></i>
                                                    </button>
                                                    <button v-on:click="desactivarUsuario(usuario.Id)" class="item" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                        <i class="fas fa-eraser"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </DIV>
                </DIV>
            </div>

            <!-- SECCION DATOS DE FORMACIÓN -->
            <div class="row" v-show="mostrar == '3'">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Cursos</strong>
                        </div>
                        <div class="card-body">
                            <div class="bootstrap-data-table-panel col-lg-12">
                                <div class="table-responsive">
                                    <table id="table2excel" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <!-- <th></th> -->
                                                <th>Nombre</th>
                                                <th>Profesor</th>
                                                <th>Fecha inicio</th>
                                                <th>Fecha finalizado</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="curso in listaContenido_3">
                                                <td>{{curso.Titulo_curso}}</td>
                                                <td>{{curso.Nombre_profesor}}</td>
                                                <td>{{curso.Fecha_inicio | Fecha}}</td>
                                                <td>{{curso.Fecha_finalizacion | Fecha}}</td>
                                                <td>{{curso.Estado}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </DIV>
                </DIV>
            </div>

            <!-- SECCION DATOS DE SEGUIMIENTO -->
            <div class="row" v-show="mostrar == '4'">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Seguimiento</strong>
                        </div>
                        <div class="card-body">
                            <div class="bootstrap-data-table-panel col-lg-12">
                                <div class="table-responsive">
                                    <table id="table2excel" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Archivo</th>
                                                <th>Descripcion</th>
                                                <th>Registrado por</th>
                                                <th>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSeguimiento" v-on:click="limpiarFormularioSeguimiento()">
                                                        Crear reporte
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="seguimiento in listaSeguimiento">
                                                <td>{{seguimiento.Fecha | Fecha}}</td>
                                                <td><a v-if="seguimiento.Url_archivo != null" target="_blank" v-bind:href="'<?php echo base_url(); ?>uploads/imagenes/'+seguimiento.Url_archivo"> Ver archivo</a></td>

                                                <td>{{seguimiento.Descripcion}}</td>
                                                <td>{{seguimiento.Nombre}}</td>
                                                <td>
                                                    <button class="item" v-on:click="editarFormularioSeguimiento(seguimiento)" data-toggle="modal" data-target="#modalSeguimiento" data-placement="top" title="Editar">
                                                        <i class="fas fa-pen-square"></i>
                                                    </button>
                                                    <button v-on:click="eliminar(seguimiento.Id, 'tbl_usuarios_seguimiento')" class="item" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                        <i class="fas fa-eraser"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </DIV>
                </DIV>
            </div>
        </div>

        <div class="col-2">
            <?php include("aa-barra-navegacion-login.php"); ?>
        </div>
    </div>


    <!-- Modal Fotos-->
    <div class="modal fade" id="modalUsuariosFoto" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalItemsFoto">Fotografía de {{datosFoto.Nombre_principal}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p align="center">
                        <img v-if="datosFoto.Imagen != null" class="img-fluid" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+datosFoto.Imagen" alt="">
                        <img v-else class="img-fluid" src="<?php echo base_url(); ?>uploads/add_usuario.jfif" alt="">
                    </p>
                    <hr>
                    <div class="horizontal-form">
                        <!-- <form class="form-horizontal" action="post" enctype="multipart/form-data" v-on:submit.prevent="crearUsuarios()">  -->
                        <form class="form-horizontal" action="post" enctype="multipart/form-data" v-on:submit.prevent="upload( datosFoto.Id, 'tbl_usuarios' )">
                            <div class="form-group">

                                <div class="col-sm-12">
                                    <input @change="archivoSeleccionado" type="file" class="form-control" name="Imagen">
                                </div>
                            </div>
                            <p align="center" v-show="preloader == 1">
                                <img src="http://grupopignatta.com.ar/images/preloader.gif" alt="">
                            </p>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-12">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success">{{texto_boton}} imagen</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    <!-- Modal CONTENIDO 2 || FORMACIONES-->
    <div class="modal fade" id="modalFormaciones" tabindex="-1" role="dialog" aria-labelledby="modalFormaciones" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalItemsCartaTitle">{{texto_boton}} formación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="horizontal-form">
                        <form class="modal-content" action="post" v-on:submit.prevent="crear_contenido_2('/usuarios/cargar_formacion', '/usuarios/obtener_formaciones')">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="control-label">Titulo</label> <input type="text" class="form-control" placeholder="" v-model="cont2Data.Titulo">
                                </div>
                                <div class="col-sm-12">
                                    <label class="control-label">Establecimiento</label>
                                    <input type="text" class="form-control" placeholder="" v-model="cont2Data.Establecimiento">
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="control-label">Año Inicio</label>
                                            <input type="date" class="form-control" placeholder="" v-model="cont2Data.Anio_inicio">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">Año Finalizado</label>
                                            <input type="date" class="form-control" placeholder="" v-model="cont2Data.Anio_finalizado">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="control-label">Descripcion del titulo</label>
                                    <textarea class="form-control" rows="5" placeholder="" v-model="cont2Data.Descripcion_titulo"></textarea>
                                </div>
                                <div class="col-sm-12">
                                    <hr>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success">{{texto_boton}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    <!-- Modal SEGUIMIENTO-->
    <div class="modal fade" id="modalSeguimiento" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{texto_boton}} reporte de seguimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="horizontal-form">
                        <form class="form-horizontal" action="post" v-on:submit.prevent="crearSeguimiento('/usuarios/cargar_seguimiento', '/usuarios/subirFotoSeguimiento', '/usuarios/obtener_seguimientos')">
                            <div class="form-group">
                                <label class=" form-control-label">Fecha del reporte</label>
                                <input type="date" class="form-control" placeholder="" v-model="seguimientoData.Fecha">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Datos del seguimiento</label>
                                <textarea class="form-control" rows="5" placeholder="" v-model="seguimientoData.Descripcion"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input @change="archivoSeleccionado" type="file" class="form-control" name="Imagen">
                                </div>
                                <div class="col-sm-12" v-if="seguimientoData.Url_archivo != null">
                                    Archivo previamente cargado
                                    <a target="_blank" v-bind:href="'<?php echo base_url(); ?>uploads/imagenes/'+seguimientoData.Url_archivo"> Ver archivo</a>
                                </div>
                            </div>
                            <div class="form-group" v-show="preloader == 1">
                                <p align="center">
                                    EL ARCHIVO SE ESTA CARGANDO. <br> No cerrar la ventana hasta finalizada la carga, dependiendo del peso del archivo puede demorar algunos minutos.
                                </p>
                                <p align="center">
                                    <img src="http://grupopignatta.com.ar/images/preloader.gif" alt="">
                                </p>
                            </DIV>
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> <button type="submit" class="btn btn-success" :disabled="preloader == 1">{{texto_boton}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

</div><!-- .container -->
<!-- Modal -->

<?php
include("aa_pie.php");
?>