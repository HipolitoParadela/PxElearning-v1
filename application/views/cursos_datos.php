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
<div class="container-fluid" id="app_cursos">
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
                    <a href="#modalCursoFoto" data-toggle="modal" v-on:click="editarFormularioFoto(datosFormularioPrincipal)">
                        <img class="img-thumbnail" v-if="datosFormularioPrincipal.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+datosFormularioPrincipal.Imagen" alt="">
                        <img class="img-thumbnail" v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" alt="">
                    </a>
                    <h5 class="text-sm-center mt-2 mb-1">{{datosFormularioPrincipal.Nombre_principal}}</h5>

                </div>
            </div>
        </div>

        <!-- SECCION FICHA USUARIO -->
        <div class="col-lg-8">

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ active: mostrar == 1 }" href="#" v-on:click.prevent="mostrar = 1">Ficha</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ active: mostrar == 2 }" href="#" v-on:click.prevent="get_contenido_2('/cursos/obtener_modulos')">Módulos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ active: mostrar == 3 }" href="#" v-on:click.prevent="mostrar = 3">Alumnos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ active: mostrar == 4 }" href="#" v-on:click.prevent="getListadoSeguimiento('/cursos/obtener_seguimientos')">Seguimiento</a>
                </li>
            </ul>

            <!-- SECCION DATOS EDITABLES DEL USUARIO -->
            <div class="row" v-show="mostrar == '1'">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Ficha: {{datosFormularioPrincipal.Nombre_principal}}</strong>
                            <small>Última actualización
                                <code>{{datosFormularioPrincipal.Fecha_ult_actualizacion_curso | FechaB_datos}}</code>
                            </small>
                        </div>
                        <div class="card-body">
                            <div class="horizontal-form">
                                <form class="form-horizontal" action="post" v-on:submit.prevent="crearItemPrincipal('/cursos/crear_curso')">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Títudo del curso</label>
                                                <input type="text" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Nombre_principal">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Duración</label>
                                                <input type="number" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Duracion">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Descripción corta</label>
                                                <textarea class="form-control" rows="5" placeholder="" v-model="datosFormularioPrincipal.Descripcion_corta"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Objetivos larga</label>
                                                <textarea class="form-control" rows="5" placeholder="" v-model="datosFormularioPrincipal.Descripcion_larga"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Objetivos del curso</label>
                                                <textarea class="form-control" rows="5" placeholder="" v-model="datosFormularioPrincipal.Objetivos_curso"></textarea>
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Categoria de curso</label>
                                                <select class="form-control" v-model="datosFormularioPrincipal.Categoria_id">
                                                    <option value="0">Seleccionar categoría</option>
                                                    <option v-for="categoria in listaFiltro_1" v-bind:value="categoria.Id">{{categoria.Nombre_categoria}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Info privada</label>
                                                <textarea class="form-control" rows="5" placeholder="" v-model="datosFormularioPrincipal.Info_privada"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Costo normal</label>
                                                <input type="number" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Costo_normal">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Costo promocional</label>
                                                <input type="number" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Costo_promocional">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Info promocional</label>
                                                <textarea class="form-control" rows="5" placeholder="" v-model="datosFormularioPrincipal.Info_promocional"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Video youtube</label>
                                                <input type="text" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Video_youtube">
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
                            <strong>Módulos de este curso</strong>
                        </div>
                        <div class="card-body">
                            <div class="bootstrap-data-table-panel col-lg-12">
                                <div class="table-responsive">
                                    <table id="table2excel" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Título del módulo</th>
                                                <th>Descripción del módulo</th>
                                                <th>Ult. Actualización</th>
                                                <th>
                                                    <button class="btn btn-primary" v-on:click="limpiarForm_cont_2()" data-toggle="modal" data-target="#modalModulos" data-placement="top" title="Edición rápida">
                                                        <i class="ti-plus"></i> Añadir módulo
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="modulo in listaContenido_2">
                                                <td>
                                                    <a href="#modalModuloImagen" data-toggle="modal" v-on:click="editarFormularioFoto(modulo)">
                                                        <img class="img-rounded" v-if="modulo.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+modulo.Imagen" width="60px">
                                                        <img class="img-rounded" v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" width="50px" alt="">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a v-bind:href="'cursos/modulo/?Id=' + modulo.Id" class="btn btn-outline">
                                                        {{ modulo.Titulo_modulo }}
                                                    </a>
                                                </td>
                                                <td>{{ modulo.Descripcion_modulo }}</td>
                                                <td>{{ modulo.Fecha_ult_actualizacion | FechaB_datos }}</td>
                                                <td>
                                                    <button class="item" v-on:click="editarForm_cont_2(modulo)" data-toggle="modal" data-target="#modalModulos" data-placement="top" title="Edición rápida">
                                                        <i class="fas fa-pen-square"></i>
                                                    </button>
                                                    <button v-on:click="desactivarUsuario(modulo.Id)" class="item" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
    <div class="modal fade" id="modalCursoFoto" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                        <img v-else class="img-fluid" src="<?php echo base_url(); ?>uploads/addimagen.jpg" alt="">
                    </p>
                    <hr>
                    <div class="horizontal-form">
                        <!-- <form class="form-horizontal" action="post" enctype="multipart/form-data" v-on:submit.prevent="crearUsuarios()">  -->
                        <form class="form-horizontal" action="post" enctype="multipart/form-data" v-on:submit.prevent="upload( datosFoto.Id, 'tbl_cursos' )">
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
    <!-- Modal Fotos MODULOS-->
    <div class="modal fade" id="modalModuloImagen" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                        <img v-else class="img-fluid" src="<?php echo base_url(); ?>uploads/addimagen.jpg" alt="">
                    </p>
                    <hr>
                    <div class="horizontal-form">
                        <!-- <form class="form-horizontal" action="post" enctype="multipart/form-data" v-on:submit.prevent="crearUsuarios()">  -->
                        <form class="form-horizontal" action="post" enctype="multipart/form-data" v-on:submit.prevent="upload( datosFoto.Id, 'tbl_cursos_modulos' )">
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
    <!-- Modal CONTENIDO 2 || MODULOS -->
    <div class="modal fade" id="modalModulos" tabindex="-1" role="dialog" aria-labelledby="modalModulos" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalItemsCartaTitle">{{texto_boton}} módulo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="post" v-on:submit.prevent="crear_contenido_2('/cursos/cargar_modulo', '/cursos/obtener_modulos')">
                        <div class="horizontal-form">
                            <label class="control-label">Título del módulo</label>
                            <input type="text" class="form-control" placeholder="" v-model="cont2Data.Titulo_modulo">

                            <label class="control-label">Descripción del módulo</label>
                            <textarea class="form-control" placeholder="" v-model="cont2Data.Descripcion_modulo" cols="30" rows="6"></textarea>
                            <hr>
                            <!-- <input @change="archivoSeleccionado" type="file" class="form-control" name="Imagen">

                            <div class="col-sm-12" v-if="cont2Data.Archivo_pdf != null">
                                Archivo previamente cargado
                                <a target="_blank" v-bind:href="'<?php echo base_url(); ?>uploads/imagenes/'+cont2Data.Archivo_pdf"> Ver archivo</a>
                            </div>
                            <div class="col-sm-12" v-if="preloader != 0">
                                <p align="center">
                                    EL ARCHIVO SE ESTA CARGANDO. <br> No cerrar la ventana hasta finalizada la carga, dependiendo del peso del archivo puede demorar algunos minutos.
                                </p>
                                <p align="center">
                                    <img src="http://grupopignatta.com.ar/images/preloader.gif" alt="">
                                </p>
                            </div>
                            <hr> -->
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">{{texto_boton}}</button>
                        </div>
                    </form>
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
                        <form class="form-horizontal" action="post" v-on:submit.prevent="crearSeguimiento('/cursos/cargar_seguimiento', '/cursos/subirFotoSeguimiento', '/cursos/obtener_seguimientos')">
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