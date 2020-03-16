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
                <div class="col-5">
                    <input type="text" class="form-control-sm form-control" placeholder="Buscar persona" v-model="buscar">
                </div>
                <div class="col-5">
                    <select class="form-control-sm form-control" v-model="filtro_1" v-on:change="getListadoPrincipal('/usuarios/obtener_Usuarios')">
                        <option selected="selected" v-bind:value="0">Todos los roles</option>
                        <option v-for="rol in listaFiltro_1" v-bind:value="rol.Acceso">{{rol.Nombre_rol}} -{{rol.Descripcion}} </option>
                    </select>

                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalLong" v-on:click="limpiarFormulario()">
                        <i class="fas fa-plus"></i> Crear usuario
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
                                <th scope="col">Nombre</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Email</th>
                                <th scope="col">Alta</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="usuario in buscarItem">
                                <td>
                                    <a href="#modalUsuariosFoto" data-toggle="modal" v-on:click="editarFormularioFoto(usuario)">
                                        <img class="img-rounded" v-if="usuario.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+usuario.Imagen" width="60px">
                                        <img class="img-rounded" v-else src="<?php echo base_url(); ?>uploads/add_usuario.jfif" width="50px" alt="">
                                    </a>
                                </td>
                                <td>
                                    <a v-bind:href="'usuarios/datos/?Id=' + usuario.Id" class="btn btn-outline">
                                        {{usuario.Nombre_principal}}
                                    </a>
                                </td>
                                <td valign="baseline">
                                    {{usuario.Nombre_rol}}
                                </td>

                                <td valign="baseline">
                                    <a v-bind:href="'tel:' + usuario.Telefono">
                                        {{usuario.Telefono}}
                                    </a>
                                </td>
                                <td valign="baseline">
                                    <a v-bind:href="'mailto:' + usuario.Email">
                                        {{usuario.Email}}
                                    </a>
                                </td>
                                <td valign="baseline">
                                    {{usuario.Fecha_alta | Fecha}}
                                </td>
                                <td>
                                    <div class="table-data-feature">


                                        <button class="item" v-on:click="editarFormulario(usuario)" data-toggle="modal" data-target="#exampleModalLong" data-placement="top" title="Edición rápida">
                                            <i class="fas fa-pen-square"></i>
                                        </button>
                                        <button v-on:click="eliminar(usuario.Id, 'tbl_usuarios')" class="item" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                            <i class="fas fa-eraser"></i>
                                        </button>
                                        <?php
                                                if($this->session->userdata('Id') == '2')
                                                {
                                                    echo '<button v-on:click="tomar_usuario(usuario)" class="item" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                    Tomar
                                                </button>';
                                                }
                                        ?>
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
    <div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="post" v-on:submit.prevent="crearItemPrincipal('/usuarios/cargar_Usuarios')">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{texto_boton}} usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="contact-form">
                            <input type="text" placeholder="Nombre y Apellido" v-model="datosFormularioPrincipal.Nombre_principal" required>
                            <input type="email" placeholder="Email" v-model="datosFormularioPrincipal.Email" required>
                            <input type="number" placeholder="DNI" v-model="datosFormularioPrincipal.DNI" required>
                            <input type="number" placeholder="Teléfono" v-model="datosFormularioPrincipal.Telefono" required>
                            <input type="password" placeholder="Contraseña" v-model="datosFormularioPrincipal.Pass" pattern=".{8,}" required>
                            <select v-model="datosFormularioPrincipal.Rol_acceso" placeholder="Seleccionar rol" required>
                                <option v-for="rol in listaFiltro_1" v-bind:value="rol.Acceso">{{rol.Nombre_rol}} -{{rol.Descripcion}} </option>
                            </select>
                            <!-- <textarea placeholder="Your Message" rows="4"></textarea -->

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
    <!-- Modal Usuarios Fotos-->
    <div class="modal fade" id="modalUsuariosFoto" tabindex="-1" role="dialog" aria-labelledby="modalCategoriasCartaTitle" aria-hidden="true">
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

</div><!-- .container -->
<!-- Modal -->

<?php
include("aa_pie.php");
?>