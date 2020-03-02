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

<div class="container-fluid" id="app_cursos_modulos">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumbs">
                <ul class="flex flex-wrap align-items-center p-0 m-0">
                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="<?php echo base_url(); ?>cursos"><i class="fas fa-book"></i> Cursos</a></li>
                    <li><a v-bind:href="'<?php echo base_url(); ?>cursos/datos?Id='+datosFormularioPrincipal.Curso_id"> {{ datosFormularioPrincipal.Titulo_curso }}</a></li>
                    <li>{{datosFormularioPrincipal.Titulo_modulo}}</li>
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
                    <p class="text-sm-center mt-2 mb-1">
                        <a v-bind:href="'<?php echo base_url(); ?>cursos/datos?Id='+datosFormularioPrincipal.Curso_id"><i class="fas fa-book"></i> {{ datosFormularioPrincipal.Titulo_curso }}</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- SECCION FICHA MÓDULO -->
        <div class="col-lg-8">

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ active: mostrar == 1 }" href="#" v-on:click.prevent="mostrar = 1">Contenido</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" v-bind:class="{ active: mostrar == 2 }" href="#" v-on:click.prevent="get_contenido_2('/cursos/obtener_examens')">Examenes</a>
                </li>
            </ul>

            <!-- SECCION DATOS EDITABLES DEL MÓDULO -->
            <div class="row" v-show="mostrar == '1'">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Ficha: {{datosFormularioPrincipal.Nombre_principal}}</strong>
                            <small>Última actualización
                                <code>{{datosFormularioPrincipal.Fecha_ult_actualizacion | FechaB_datos}}</code>
                            </small>
                        </div>
                        <div class="card-body">
                            <div class="horizontal-form">
                                <form class="form-horizontal" action="post" v-on:submit.prevent="crearItemPrincipal('/cursos/cargar_modulo', '/cursos/subir_archivo')">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">Títudo del módulo</label>
                                                <input type="text" class="form-control" placeholder="" v-model="datosFormularioPrincipal.Titulo_modulo">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Descripción del módulo</label>
                                                <textarea class="form-control" rows="5" placeholder="" v-model="datosFormularioPrincipal.Descripcion_modulo"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Contenido del curso en formato HTML</label>
                                                <textarea class="form-control" rows="30" placeholder="" v-model="datosFormularioPrincipal.Contenido_html"></textarea>
                                            </div>

                                            <div class="row">
                                                <hr>
                                                <div class="col-sm-6">
                                                    <div v-if="datosFormularioPrincipal.Url_archivo != null">
                                                        <p align="center">
                                                            Archivo previamente cargado
                                                            <a class="btn" target="_blank" v-bind:href="'<?php echo base_url(); ?>uploads/imagenes/'+datosFormularioPrincipal.Url_archivo">
                                                                Ver archivo
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Adjuntar archivo al módulo. </label>
                                                        <input @change="archivoSeleccionado" type="file" class="form-control" name="Imagen">
                                                        <em>Se admite Word, Excel, Pdf, Jpg</em>
                                                    </div>
                                                    <div class="form-group" v-show="preloader == 1">
                                                        <p align="center">
                                                            EL ARCHIVO SE ESTA CARGANDO. <br> No cerrar la ventana hasta finalizada la carga, dependiendo del peso del archivo puede demorar algunos minutos.
                                                        </p>
                                                        <p align="center">
                                                            <img src="http://grupopignatta.com.ar/images/preloader.gif" alt="">
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
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
                            <strong>Examenes de este módulo</strong>
                        </div>
                        <div class="card-body">
                            <div class="bootstrap-data-table-panel col-lg-12">
                                <div class="table-responsive">
                                    <table id="table2excel" class="table table-striped">
                                        <thead>
                                            <tr>

                                                <th>Título</th>
                                                <th>Descripción</th>
                                                <th>Archivo</th>
                                                <th>Ult. Actualización</th>
                                                <th>
                                                    <button class="btn btn-primary" v-on:click="limpiarForm_cont_2()" data-toggle="modal" data-target="#modalModulos" data-placement="top" title="Edición rápida">
                                                        <i class="fas fa-plus"></i> Examen
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="examen in listaContenido_2">

                                                <td>
                                                    <button class="btn" v-on:click="editarForm_cont_2(examen)" data-toggle="modal" data-target="#modalModulos" data-placement="top" title="Edición rápida">
                                                        {{ examen.Titulo_examen }}
                                                    </button>
                                                </td>
                                                <td>{{ examen.Descripcion_examen }}</td>
                                                <td>
                                                    <a v-if="examen.URL_archivo" target="_blank" v-bind:href="'<?php echo base_url(); ?>uploads/imagenes/'+examen.URL_archivo"> Ver archivo</a>
                                                </td>
                                                <td>{{ examen.Fecha_ult_actualizacion | FechaB_datos }}</td>
                                                <td>
                                                    <button class="item" v-on:click="editarForm_cont_2(examen)" data-toggle="modal" data-target="#modalModulos" data-placement="top" title="Edición rápida">
                                                        <i class="fas fa-pen-square"></i>
                                                    </button>
                                                    <button v-on:click="eliminar(examen.Id, 'tbl_cursos_examen')" class="item" data-toggle="tooltip" data-placement="top" title="Eliminar">
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
                        <!-- <form class="form-horizontal" action="post" enctype="multipart/form-data" v-on:submit.prevent="crearMÓDULOs()">  -->
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
    <!-- /.modal -->
    <!-- Modal CONTENIDO 2 || EXAMEN -->
    <div class="modal fade" id="modalModulos" tabindex="-1" role="dialog" aria-labelledby="modalModulos" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalItemsCartaTitle">{{texto_boton}} examen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="post" v-on:submit.prevent="crear_contenido_2('/cursos/cargar_examen', '/cursos/subir_archivo_examen', '/cursos/obtener_examens')">
                        <div class="horizontal-form">
                            <label class="control-label">Título del examen</label>
                            <input type="text" class="form-control" placeholder="" v-model="cont2Data.Titulo_examen">

                            <label class="control-label">Descripción del examen</label>
                            <textarea class="form-control" placeholder="" v-model="cont2Data.Descripcion_examen" cols="30" rows="3"></textarea>
                            <hr>
                            <input @change="archivoSeleccionado" type="file" class="form-control" name="Imagen">

                            <div class="col-sm-12" v-if="cont2Data.URL_archivo != null">
                                Archivo previamente cargado
                                <a target="_blank" v-bind:href="'<?php echo base_url(); ?>uploads/imagenes/'+cont2Data.URL_archivo"> Ver archivo</a>
                            </div>
                            <div class="col-sm-12" v-if="preloader != 0">
                                <p align="center">
                                    EL ARCHIVO SE ESTA CARGANDO. <br> No cerrar la ventana hasta finalizada la carga, dependiendo del peso del archivo puede demorar algunos minutos.
                                </p>
                                <p align="center">
                                    <img src="http://grupopignatta.com.ar/images/preloader.gif" alt="">
                                </p>
                            </div>
                            <hr>
                            <label class="control-label">Contenido del examen</label>
                            <textarea class="form-control" placeholder="" v-model="cont2Data.Contenido_html" cols="30" rows="15"></textarea>
                            <hr>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">{{texto_boton}}</button>
                        </div>
                    </form>
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