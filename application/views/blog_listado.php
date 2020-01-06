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

<div class="container" id="app">
    <div class="row">

        <div class="col-12">
            <div class="breadcrumbs">
                <ul class="flex flex-wrap align-items-center p-0 m-0">
                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="<?php echo base_url(); ?>blog">
                            <!-- <i class="fa fa-users"></i> --> <?= $TituloPagina; ?></a></li>
                </ul>
            </div><!-- .breadcrumbs -->
        </div><!-- .col -->
    </div><!-- .row -->
    <div class="row">
        <div class="col-12 col-lg-9">
            <?php
            if ($this->session->userdata('Rol_acceso') > 2) {
                echo '<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalLong" v-on:click="limpiarFormulario()">
                            <i class="fas fa-plus"></i> Crear entrada
                        </button><hr>';
            }

            ?>
            <div class="featured-courses courses-wrap">
                <div class="row mx-m-25">


                    <div class="col-12 col-md-6 px-25" v-for="blog in listaPrincipal">
                        <div class="blog-post-content">
                            <figure class="blog-post-thumbnail position-relative m-0">
                                <a v-bind:href="'<?php echo base_url(); ?>blog/entrada/?Id=' + blog.Id">
                                    <img v-if="blog.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+blog.Imagen" v-bind:alt="blog.Copete">
                                    <img v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" v-bind:alt="blog.Copete">
                                </a>

                                <div class="posted-date position-absolute">
                                    <div class="day">{{blog.Fecha_ult_actualizacion | Dia}}</div>
                                    <div class="month">{{blog.Fecha_ult_actualizacion | Mes}}</div>
                                </div>
                            </figure><!-- .blog-post-thumbnail -->

                            <div class="blog-post-content-wrap">
                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <a v-bind:href="'<?php echo base_url(); ?>blog/entrada/?Id=' + blog.Id">{{blog.Titulo_curso}}</a>
                                    </h2>

                                </header><!-- .entry-header -->

                                <div class="entry-content">
                                    <p>{{blog.Copete}}</p>
                                </div><!-- .entry-content -->
                                <?php
                                if ($this->session->userdata('Rol_acceso') > 2) {
                                    echo '<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalLong" v-on:click="editarFormulario(blog)">
                                                <i class="fas fa-plus"></i> Editar entrada
                                            </button><hr>';
                                }

                                ?>
                            </div><!-- .blog-post-content-wrap -->
                        </div><!-- .blog-post-content -->
                    </div><!-- .col -->


                </div><!-- .row -->
            </div><!-- .featured-courses -->

            <!-- <div class="pagination flex flex-wrap justify-content-between align-items-center">
                <div class="col-12 col-lg-4 order-2 order-lg-1 mt-3 mt-lg-0">
                    <ul class="flex flex-wrap align-items-center order-2 order-lg-1 p-0 m-0">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>

                <div class="col-12 flex justify-content-start justify-content-lg-end col-lg-8 order-1 order-lg-2">
                    <div class="pagination-results flex flex-wrap align-items-center">
                        <p class="m-0">Showing 1–3 of 12 results</p>

                        <form>
                            <select>
                                <option>Show: 06</option>
                                <option>Show: 12</option>
                                <option>Show: 18</option>
                                <option>Show: 24</option>
                            </select>
                        </form>
                    </div> .pagination-results -->
            <!-- </div>
            </div> -->
            <!-- .pagination -->
        </div> <!-- .col -->

        <div class="col-12 col-lg-3">
            <div class="sidebar">

                <div class="latest-courses">
                    <h2>Cursos</h2>

                    <ul class="p-0 m-0">

                        <li class="flex flex-wrap justify-content-between align-items-center" v-for="curso in listaFiltro_2">

                            <a v-bind:href="'cursos/informaciondelcurso/?Id=' + curso.Id">
                                <img v-if="curso.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+curso.Imagen" v-bind:alt="curso.Descripcion_corta">
                                <img v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" v-bind:alt="curso.Descripcion_corta">
                            </a>

                            <div class="content-wrap">
                                <h3><a v-bind:href="'cursos/informaciondelcurso/?Id=' + curso.Id">{{curso.Titulo_curso}}</a></h3>

                                <div class="course-cost" v-if="curso.Costo_promocional == null || curso.Costo_promocional == 0">

                                    $ {{curso.Costo_normal | Moneda}} <!-- <span class="price-drop">{{curso.Costo_promocional}}</span> -->
                                </div><!-- .course-cost -->
                                <div class="course-cost" v-if="curso.Costo_promocional > 0">
                                    $ {{curso.Costo_promocional | Moneda}} <span class="price-drop">$ {{curso.Costo_normal | Moneda}}</span>
                                </div><!-- .course-cost -->
                            </div><!-- .content-wrap -->
                        </li>
                    </ul>
                </div><!-- .latest-courses -->

                <div class="ads">
                    <img src="images/ads.jpg" alt="">
                </div><!-- .ads -->

                <!-- <div class="popular-tags">
                    <h2>Popular Tags</h2>

                    <ul class="flex flex-wrap align-items-center p-0 m-0">
                        <li><a href="#">Creative</a></li>
                        <li><a href="#">Unique</a></li>
                        <li><a href="#">Photography</a></li>
                        <li><a href="#">ideas</a></li>
                        <li><a href="#">Wordpress Template</a></li>
                        <li><a href="#">startup</a></li>
                    </ul>
                </div> -->
                <!-- .popular-tags -->
            </div><!-- .sidebar -->
        </div><!-- .col -->
    </div><!-- .row -->
    <!-- Modal -->
    <div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="post" v-on:submit.prevent="crearItemPrincipal('/blog/crear_entrada')">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{texto_boton}} entrada</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="contact-form">
                            <input type="text" placeholder="Titulo de la entrada" v-model="datosFormularioPrincipal.Titulo_curso" required>
                            <textarea placeholder="Copete" v-model="datosFormularioPrincipal.Copete" rows="3" required></textarea>
                            <textarea id="ckeditor" placeholder="Contenido de la noticia" v-model="datosFormularioPrincipal.Contenido" rows="7" required></textarea>
                            
                            <!--  -->
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input @change="archivoSeleccionado" type="file" class="form-control" name="Imagen">
                                </div>
                                <div class="col-sm-12" v-if="datosFormularioPrincipal.Imagen != null">
                                    Archivo previamente cargado
                                    <a target="_blank" v-bind:href="'<?php echo base_url(); ?>uploads/imagenes/'+datosFormularioPrincipal.Imagen"> Ver archivo</a>
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
</div><!-- .container -->




<?php
include("aa_pie.php");
?>