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
                <img v-if="datosFormularioPrincipal.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+datosFormularioPrincipal.Imagen" alt="">
                <img v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" alt="">

                <div class="course-cost">En curso</div>
            </div>
        </div><!-- .col -->
    </div><!-- .row -->

    <div class="row">
        <div class="col-12 offset-lg-1 col-lg-1">
            <div class="post-share">
                <h3>share</h3>

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
            <div class="single-course-wrap">
                <div class="course-info flex flex-wrap align-items-center">
                    

                    <div class="course-cats mt-3">
                        <label class="m-0">Categoría</label>
                        <div class="author-name"><a href="#">{{ datosFormularioPrincipal.Nombre_categoria }}</a></div>
                    </div><!-- .course-cats -->

                    <div class="course-students mt-3">
                        <label class="m-0">Programa</label>
                        <div class="author-name"> <?= count($Modulos); ?> módulos</div>
                    </div><!-- .course-students -->

                    <div class="buy-course mt-3">
                        <a class="btn" href="#">Comprar curso</a>
                    </div><!-- .buy-course -->
                </div><!-- .course-info -->

                <div class="single-course-cont-section">
                    <h2>¿Qué aprenderas?</h2>

                    <ul class="p-0 m-0 green-ticked">
                        <p><?= $Datos_curso["Descripcion_corta"]; ?></p>
                    </ul>

                    <h2>Objetivos</h2>

                    <ul class="p-0 m-0 black-doted">
                        <?= $Datos_curso["Objetivos_curso"]; ?>
                    </ul>

                    <h2>Descripción</h2>

                    <?= $Datos_curso["Descripcion_larga"]; ?>
                    <hr>
                </div>

                <div class="single-course-accordion-cont mt-3">
                    <header class="entry-header flex flex-wrap justify-content-between align-items-center">
                        <h2>Programa</h2>

                        <div class="number-of-lectures"><?= count($Modulos); ?> módulos</div>

                        <div class="total-lectures-time">{{datosFormularioPrincipal.Duracion}} meses</div>
                    </header><!-- .entry-header -->

                    <div class="entry-contents">
                        <div class="accordion-wrap type-accordion">

                            <?php

                            foreach ($Modulos as $modulo) {
                                echo '<h3 class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">' . $modulo["Titulo_modulo"] . '</span>
                                    <span class="number-of-lectures">
                                        
                                    </span> 
                                    <span class="total-lectures-time">
                                        
                                    </span>
                                </h3>

                                <div class="entry-content">
                                    
                                    <p> ' . $modulo["Descripcion_modulo"] . ' </p>';

                                    
                                    echo '
                                        
                                </div>';
                            }


                            ?>


                        </div>
                    </div><!-- .entry-contents -->
                </div><!-- .single-course-accordion-cont  -->
               
                <div class="related-courses">
                    <header class="entry-heading flex flex-wrap justify-content-between align-items-center">
                        <h2 class="entry-title">Cursos que podrian interesarte</h2>

                        <a href="#">Ver todos</a>
                    </header><!-- .entry-heading -->

                    <div class="row mx-m-25">





                        <div class="col-12 col-lg-6 px-25" v-for="curso in listaContenido_2">
                            <div class="course-content">
                                <figure class="course-thumbnail">
                                    <a href="#"><img v-if="curso.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+curso.Imagen" alt=""></a>
                                    <img v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" alt="">
                                </figure><!-- .course-thumbnail -->

                                <div class="course-content-wrap">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="#">{{curso.Titulo_curso}}</a></h2>

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

    <!-- Modal CONTENIDO 3 || INSCRIPTOS -->
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