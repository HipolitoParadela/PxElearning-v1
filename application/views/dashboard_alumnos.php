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
<div class="container-fluid" id="dashboard">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumbs">
                <ul class="flex flex-wrap align-items-center p-0 m-0">
                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li><i class="fa fa-users"></i> <?= $TituloPagina; ?></li>
                </ul>
            </div><!-- .breadcrumbs -->
        </div><!-- .col -->
    </div><!-- .row -->
    <div class="row">

        <div class="col-lg-2">
            <div class="card">
                <div class="card-header">
                    <h4>Perfil</h4>
                </div>
                <div class="card-body">
                    <a href="#modalUsuariosFoto" data-toggle="modal" v-on:click="editarFormularioFoto(datosUsuario)">
                        <img class="img-thumbnail" v-if="datosUsuario.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+datosUsuario.Imagen" alt="">
                        <img class="img-thumbnail" v-else src="<?php echo base_url(); ?>uploads/add_usuario.jfif" alt="">
                    </a>
                    <h5 class="text-sm-center mt-2 mb-1">{{datosUsuario.Nombre}}</h5>
                    <div class="location text-sm-center">
                        <i class="fa fa-map-marker"></i> {{datosUsuario.Domicilio}}</div>
                </div>
            </div>
            <hr>
            <div>
                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalLong">
                    <i class="fas fa-pen"></i> Editar perfil
                </button>
                <!-- <hr>
                
                <h4>Cursos de interes</h4>
                <ul>
                    <li> <a href="#">Desarrollo web</a> </li>
                    <li> <a href="#">Diseño Gráfico</a> </li>
                </ul> -->
            </div>
        </div>

        <!-- SECCION CURSOS DEL ALUMNO-->





        <div class="col-lg-10">

            <?php
            // SECCION COMPRA DE UN CURSO-->
            if ($Compra === true) {
                echo '
                <div class="card">
                    <div class="card-body">
                        <img src="' . base_url() . 'uploads/imagenes/' . $Datos_curso_comprado[0]["Imagen"] . '" class="rounded float-right" width="400px">
                        <h1>Adquiriste un nuevo curso</h1>
                        <h3 class="text-success display-3">La compra del curso de ' . $Datos_curso_comprado[0]["Titulo_curso"] . ' ha sido exitosa</h3>
                        <p>En el lapso de las próximas 24hs te asignaremos un profesor para que puedas comenzar con el cursado.</p>
                        <p> <b>Pueden también comunicarte vía whatsapp o email para agilizar este proceso.</b>  </p>
                    </div>
                </div>';
            }
            ?>



            <div class="card">
                <div class="card-header">
                    <h4>Tus cursos</h4>
                </div>
                <div class="card-body">

                    <div class="row">


                        <div class="col-12 col-md-6 col-lg-3 px-25" v-for="curso in lista_cursos_alumno">
                            <div class="course-content">
                                <figure class="course-thumbnail">
                                    <a v-bind:href="'<?php echo base_url(); ?>cursos/cursado/?Id=' + curso.Id">
                                        <img v-if="curso.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+curso.Imagen" alt="">
                                    </a>
                                </figure><!-- .course-thumbnail -->

                                <div class="course-content-wrap">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a v-bind:href="'<?php echo base_url(); ?>cursos/cursado/?Id=' + curso.Id">{{curso.Titulo_curso}}</a></h2>

                                        <div class="entry-meta flex align-items-center">
                                            <div class="course-author"><a href="#">{{curso.Nombre_profesor}} </a></div>

                                            <div v-if="curso.Estado > 0" class="course-date">Iniciado el {{curso.Fecha_inicio | Fecha}}</div>
                                        </div><!-- .course-date -->
                                    </header><!-- .entry-header -->

                                    <footer class="entry-footer flex justify-content-between align-items-center">
                                        <div class="course-cost">
                                            <span class="free-cost" v-if="curso.Estado == 0">Pendiente</span>
                                            <span class="free-cost" v-if="curso.Estado == 1">Curso en progreso</span>
                                            <span class="free-cost" v-if="curso.Estado == 2">Curso en progreso</span>
                                            <span class="free-cost" v-if="curso.Estado == 3">Curso finalizado</span>
                                        </div><!-- .course-cost -->
                                        <a v-if="curso.Estado == 3" v-bind:href="'<?php echo base_url(); ?>uploads/imagenes/' + curso.Url_archivo">Descargar diploma</a>
                                        <a v-if="curso.Estado == 0" v-bind:href="'<?php echo base_url(); ?>cursos/informaciondelcurso/?Id=' + curso.Id +'#comprar'">Comprar curso</a>


                                        <!-- <div class="course-ratings flex justify-content-end align-items-center">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star-o"></span>

                                    <span class="course-ratings-count">(4 votes)</span>
                                </div> -->
                                        <!-- .course-ratings -->
                                    </footer><!-- .entry-footer -->
                                </div><!-- .course-content-wrap -->
                            </div><!-- .course-content -->
                        </div><!-- .col -->
                    </div>


                </div>

            </div><!-- .container -->
            <hr>
            <div class="row">
                <div class="col-12 px-25 flex justify-content-center">
                    <a class="btn" href="<?php echo base_url(); ?>cursos/listado">Conoce todos los cursos que tenemos para ofrecerte</a>
                </div><!-- .col -->
            </div><!-- .row -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- <pre>
                   {{ datosUsuario}}
                </pre> -->
                <form action="post" v-on:submit.prevent="crearItemPrincipal('/usuarios/cargar_Usuarios')">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Editar perfil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="contact-form">
                            <input type="text" placeholder="Nombre y Apellido" v-model="datosUsuario.Nombre_principal" required>
                            <input type="email" placeholder="Email" v-model="datosUsuario.Email" required>
                            <input type="number" placeholder="DNI" v-model="datosUsuario.DNI" required>
                            <input type="number" placeholder="Teléfono" v-model="datosUsuario.Telefono" required>
                            <input type="text" placeholder="Dirección, ciudad y provincia" v-model="datosUsuario.Domicilio" required>
                            <input type="date" placeholder="Fecha de nacimiento" v-model="datosUsuario.Fecha_nacimiento" required>


                            <!-- <textarea placeholder="Expectativas sobre nuestros cursos" rows="4"></textarea> -->

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
</div>
</div>

<?php
include("aa_pie.php");
?>