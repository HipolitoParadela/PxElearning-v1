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
<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-10">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs">
                        <ul class="flex flex-wrap align-items-center p-0 m-0">
                            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
                            <li><?= $TituloPagina; ?></li>
                        </ul>
                    </div><!-- .breadcrumbs -->
                </div><!-- .col -->
            </div><!-- .row -->
            <div class="row breadcrumbs">
                <div class="col-4">
                    <input type="text" class="form-control-sm form-control" placeholder="Buscar curso" v-model="buscar">
                </div>
                <div class="col-4">
                    <select class="form-control-sm form-control" v-model="filtro_1" v-on:change="getListadoPrincipal('/cursos/obtener_listado_principal')">
                        <option value="0">Todas las categorias</option>
                        <option v-for="categoria in listaFiltro_1" v-bind:value="categoria.Id">{{categoria.Nombre_categoria}}</option>
                    </select>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#principalModal" v-on:click="limpiarFormulario()">
                        + Crear curso
                    </button>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#CategoriaModal" v-on:click="limpiarFormulario_filtro()">
                        Gestionar categorias
                    </button>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">

                                </th>
                                <th scope="col">Nombre curso</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Duración</th>
                                <th scope="col">Costo normal</th>
                                <th scope="col">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="curso in buscarItem">
                                <td>
                                    <a href="#modalCursosFoto" data-toggle="modal" v-on:click="editarFormularioFoto(curso)">
                                        <img class="img-rounded" v-if="curso.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+curso.Imagen" width="60px">
                                        <img class="img-rounded" v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" width="50px" alt="">
                                    </a>
                                </td>
                                <td>
                                    <a v-bind:href="'cursos/datos/?Id=' + curso.Id" class="btn btn-outline">
                                        {{curso.Nombre_principal}}
                                    </a>
                                </td>
                                <td valign="baseline">
                                    {{curso.Nombre_categoria}}
                                </td>

                                <td valign="baseline">
                                    {{curso.Duracion}} meses
                                </td>
                                <td valign="baseline">
                                    $ {{curso.Costo_normal | Moneda}}
                                </td>
                                <td>
                                    <div class="table-data-feature">


                                        <button class="item" v-on:click="editarFormulario(curso)" data-toggle="modal" data-target="#principalModal" data-placement="top" title="Edición rápida">
                                            <i class="fas fa-pen-square"></i>
                                        </button>
                                        <button v-on:click="eliminar(curso.Id, 'tbl_Cursos')" class="item" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            <i class="fas fa-eraser"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- .col -->
            </div><!-- .row -->
        </div>

        <div class="col-2">
            <?php include("aa-barra-navegacion-login.php"); ?>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade " id="principalModal" tabindex="-1" role="dialog" aria-labelledby="principalModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="post" v-on:submit.prevent="crearItemPrincipal('/cursos/crear_curso')">
                    <div class="modal-header">
                        <h5 class="modal-title" id="principalModalTitle">{{texto_boton}} curso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="contact-form">
                            <select v-model="datosFormularioPrincipal.Categoria_id" required>
                                <option value="0">Elegir categoria del curso</option>
                                <option v-for="categoria in listaFiltro_1" v-bind:value="categoria.Id">{{categoria.Nombre_categoria}}</option>
                            </select>
                            <input type="text" placeholder="Título del curso" v-model="datosFormularioPrincipal.Titulo_curso" required>
                            <input type="number" placeholder="Duración estimada en meses" v-model="datosFormularioPrincipal.Duracion" required>
                            <input type="number" placeholder="Costo Normal" v-model="datosFormularioPrincipal.Costo_normal" required>
                            <textarea rows="2" placeholder="Descripcion corta del curso" v-model="datosFormularioPrincipal.Descripcion_corta" required></textarea>
                            <textarea rows="2" placeholder="Describir promocion " v-model="datosFormularioPrincipal.Info_promocional"></textarea>
                            <input type="number" placeholder="Costo Promocional" v-model="datosFormularioPrincipal.Costo_promocional">
                        </div><!-- .contact-form -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Cursos Fotos-->
    <div class="modal fade" id="modalCursosFoto" tabindex="-1" role="dialog" aria-labelledby="modalCategoriasCartaTitle" aria-hidden="true">
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
                        <img v-else class="img-fluid" src="<?php echo base_url(); ?>uploads/add_curso.jfif" alt="">
                    </p>
                    <hr>
                    <div class="horizontal-form">
                        <!-- <form class="form-horizontal" action="post" enctype="multipart/form-data" v-on:submit.prevent="crearCursos()">  -->
                        <form class="form-horizontal" action="post" enctype="multipart/form-data" v-on:submit.prevent="upload( datosFoto.Id, 'tbl_Cursos' )">
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
    <!-- modal Categoria-->
    <div class="modal fade" id="CategoriaModal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollmodalLabel">Listado de Categoria de proveedores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless table-striped table-earning">
                        <tbody>
                            <tr v-for="categoria in listaFiltro_1">
                                <td><b>{{categoria.Nombre_categoria}}</b></td>
                                <td>{{categoria.Descripcion}}</td>
                                <td>
                                    <button class="item" v-on:click="editarFormulario_filtro(categoria)" title="Editar">
                                        <i class="fas fa-pen-square"></i>
                                    </button>
                                    <button v-on:click="eliminar(categoria.Id, 'tbl_cursos_categorias')" class="item" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                        <i class="fas fa-eraser"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                </div>
                <form class="form-horizontal" action="post" v-on:submit.prevent="crearItemFiltro('/cursos/cargar_categorias')">
                    <div class="modal-body">
                        <div class="horizontal-form">
                            <div class="form-group">
                                <label class=" form-control-label">Indentifcador de la categoria</label> 
                                <input type="text" class="form-control" placeholder="" v-model="filtro_Data.Nombre_categoria">
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Descripción de la categoria</label>
                                <textarea class="form-control" rows="5" placeholder="" v-model="filtro_Data.Descripcion"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">{{texto_boton}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal manzana -->

</div><!-- .container -->
<!-- Modal -->

<?php
include("aa_pie.php");
?>