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

            <div class="row justify-content-between">

            Mostrar una ficha del alumno más estética y con un modal para editar sus datos.
            Los datos a pedir son:
            - Nombre y apellido completos. Para la emisión de diplomas.
            - DNI 
            - Domicilio
            - Localidad, Provincia
            - Teléfono
            - 
                <!-- <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">

                                </th>
                                <th scope="col">Curso</th>
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
                </div> -->
                <!-- .col -->
            </div><!-- .row -->
        </div>

    </div>
    
    
    <section class="featured-courses vertical-column courses-wrap">
        <div class="container">
            <div class="row mx-m-25">
                <div class="col-12 px-25">
                    <header class="heading flex flex-wrap justify-content-between align-items-center">
                        <h2 class="entry-title">Tus cursos</h2>

                        <!-- <nav class="courses-menu mt-3 mt-lg-0">
                            <ul class="flex flex-wrap justify-content-md-end align-items-center">
                                <li class="active"><a href="#">All</a></li>
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Design</a></li>
                                <li><a href="#">Web Development</a></li>
                                <li><a href="#">Photography</a></li>
                            </ul>
                        </nav> --><!-- .courses-menu -->
                    </header><!-- .heading -->
                </div><!-- .col -->

                <div class="col-12 col-md-6 col-lg-4 px-25" v-for="curso in lista_cursos_alumno">
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

                                    <div class="course-date">Iniciado el {{curso.Fecha_inicio | Fecha}}</div>
                                </div><!-- .course-date -->
                            </header><!-- .entry-header -->

                            <footer class="entry-footer flex justify-content-between align-items-center">
                                <div class="course-cost">
                                    <span class="free-cost" v-if="curso.Estado < 3">Curso en progreso</span>
                                    <span class="free-cost" v-if="curso.Estado == 3">Curso finalizado</span>
                                </div><!-- .course-cost -->
                                Descargar diploma
                                <!-- <div class="course-ratings flex justify-content-end align-items-center">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star-o"></span>

                                    <span class="course-ratings-count">(4 votes)</span>
                                </div> --><!-- .course-ratings -->
                            </footer><!-- .entry-footer -->
                        </div><!-- .course-content-wrap -->
                    </div><!-- .course-content -->
                </div><!-- .col -->

                

                <!-- <div class="col-12 px-25 flex justify-content-center">
                    <a class="btn" href="#">ver todos</a>
                </div> --><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .courses-wrap -->
    <section class="testimonial-section">
        <!-- Swiper -->
        <div class="swiper-container testimonial-slider">
            

            <div class="container">
                <div class="row">
                    
                        <h1 align="center">SEGUI FORMANDOTE</h1>
                        
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .testimonial-slider -->
    </section><!-- .testimonial-section -->


</div><!-- .container -->
<!-- Modal -->

<?php
include("aa_pie.php");
?>