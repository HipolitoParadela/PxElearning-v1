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
                    <h1 class="entry-title"><?= $TituloPagina; ?></h1>
                    <div class="ratings flex justify-content-center align-items-center">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <span>(4 votes)</span>
                    </div><!-- .ratings -->
                </header><!-- .entry-header -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .page-header-overlay -->
</div><!-- .page-header -->

<div class="container" id="app_cursos_curzado">
    <div class="row">
        <div class="col-12 offset-lg-1 col-lg-10">
            <div class="featured-image">
                <img src="<?php echo base_url(); ?>uploads/imagenes/<?= $Entrada["Imagen"]; ?>" alt="<?= $Entrada["Copete"]; ?>">

                <!-- <div class="course-cost">En curso</div> -->
            </div>
        </div><!-- .col -->
    </div><!-- .row -->

    <div class="row">
        <div class="col-12 offset-lg-1 col-lg-1">
            <div class="post-share">

                <ul class="flex flex-wrap align-items-center p-0 m-0">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-thumb-tack"></i></a></li>
                </ul>
            </div><!-- .post-share -->
        </div><!-- .col -->

        <div class="col-12 col-lg-8">
            <div class="course-info flex flex-wrap align-items-center">




            </div><!-- .course-info -->

            <div class="single-course-wrap">

                <h2><?= $Entrada["Copete"]; ?></h2>
            </div>
            <div class="single-course-wrap">
                <?= $Entrada["Contenido"]; ?>

            </div>
            <hr>
            <div class="single-course-wrap" style="border-left: 8px solid midnightblue; padding: 30px; background-color:ghostwhite; border-radius: 0px 20px 0px 20px;">
                <h4>Comentarios</h4>
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.3&appId=311617306413197&autoLogAppEvents=1"></script>
                <div class="fb-comments" data-href="<?= base_url(); ?>blog/entrada/?Id=<?= $_GET["Id"]; ?>" data-width="600" data-numposts="5"></div>
            </div>
        </div>

        <div class="related-courses">
            <header class="entry-heading flex flex-wrap justify-content-between align-items-center">
                <h2 class="entry-title">Cursos que podrian interesarte</h2>

                <a href="<?php echo base_url(); ?>cursos/listado">Ver todos</a>
            </header><!-- .entry-heading -->

            <div class="row mx-m-25">





                <div class="col-12 col-lg-6 px-25" v-for="curso in listaContenido_2">
                    <div class="course-content">
                        <figure class="course-thumbnail">
                            <a v-bind:href="'<?php echo base_url(); ?>cursos/informaciondelcurso/?Id=' + curso.Id">
                                <img v-if="curso.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+curso.Imagen" alt="">
                            </a>
                            <img v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" alt="">
                        </figure><!-- .course-thumbnail -->

                        <div class="course-content-wrap">
                            <header class="entry-header">
                                <h2 class="entry-title"><a v-bind:href="'<?php echo base_url(); ?>cursos/informaciondelcurso/?Id=' + curso.Id">{{curso.Titulo_curso}}</a></h2>

                                <!-- <div class="entry-meta flex flex-wrap align-items-center">
                                            <div class="course-author"><a href="#">Ms. Lucius</a></div>

                                            <div class="course-date">Dec 18, 2018</div>
                                        </div>.course-date -->
                            </header><!-- .entry-header -->

                            <footer class="entry-footer flex flex-wrap justify-content-between align-items-center">
                                <div class="course-cost" v-if="curso.Costo_promocional != null">
                                    {{curso.Costo_promocional}} <span class="price-drop">{{curso.Costo_normal}}</span>
                                </div><!-- .course-cost -->
                                <div v-else class="course-cost">
                                    {{curso.Costo_normal}} <span class="price-drop">{{curso.Costo_promocional}}</span>
                                </div><!-- .course-cost -->

                                <div class="course-ratings flex justify-content-end align-items-center">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star-o"></span>

                                    <span class="course-ratings-count">(4 votes)</span>
                                </div><!-- .course-ratings -->
                            </footer><!-- .entry-footer -->
                        </div><!-- .course-content-wrap -->
                    </div><!-- .course-content -->
                </div><!-- .col -->








            </div><!-- .row -->
        </div><!-- .related-course -->
    </div><!-- .single-course-wrap -->
</div><!-- .col -->
</div><!-- .row -->

<!-- Modal ENTRADAS -->
<div class="modal fade" id="modalInscriptos" tabindex="-1" role="dialog" aria-labelledby="modalInscriptos" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalItemsCartaTitle">{{texto_boton}} módulo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="post" v-on:submit.prevent="crear_contenido_3('/cursos/generar_examen', 1)">
                    <div class="horizontal-form">
                        <label class="control-label">Seleccionar Examen</label>
                        <select class="form-control" v-model="cont3Data.Examen_id" required>
                            <option v-for="examen in listaContenido_3" v-bind:value="examen.Id">{{examen.Titulo_examen}} </option>
                        </select>

                        <label class="control-label">Observaciones</label>
                        <textarea class="form-control" placeholder="" v-model="cont3Data.Observaciones" cols="30" rows="6"></textarea>

                        <hr>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Habilitar módulo</button>
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