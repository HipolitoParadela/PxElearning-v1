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

<div class="container" id="app_cursos_curzado_examen">
    <?php
    if ($Datos["Imagen_modulo"] == null) {
        echo "<!-- ";
    }
    ?>
    <div class="row">
        <div class="col-12 offset-lg-1 col-lg-10">
            <div class="featured-image">
                <img src="<?php echo base_url(); ?>uploads/imagenes/<?= $Datos["Imagen_modulo"]; ?>" alt="">

            </div>
        </div>
    </div>
    <?php
    if ($Datos["Imagen_modulo"] == null) {
        echo " --> ";
    }
    ?>
    <!--.row -->

    <div class="row">
        <!-- <div class="col-12 offset-lg-1 col-lg-1">
            <div class="post-share">
                <h3>share</h3>

                <ul class="flex flex-wrap align-items-center p-0 m-0">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-thumb-tack"></i></a></li>
                </ul>
            </div>
        </div>.col -->

        <div class="col-12 col-lg-12">
            <div class="single-course-wrap">
                <div class="course-info flex flex-wrap align-items-center">
                    <div class="course-author flex flex-wrap align-items-center mt-3">
                        <img v-if="datosFormularioPrincipal.Imagen_alumno != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+datosFormularioPrincipal.Imagen_alumno" alt="">
                        <img v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" alt="">
                        <div class="author-wrap">
                            <label class="m-0">Alumno</label>
                            <div class="author-name"><a href="#">{{ datosFormularioPrincipal.Nombre_alumno }}</a></div>
                        </div><!-- .author-wrap -->
                    </div><!-- .course-author -->

                    <div class="course-students mt-3">
                        <label class="m-0">Curso</label>
                        <div class="author-name">
                            <a v-bind:href="'<?php echo base_url(); ?>/cursos/cursado/?Id='+datosExamen_curso.Curso_alumno_id">
                                {{ datosFormularioPrincipal.Titulo_curso }}
                            </a>
                        </div>
                    </div><!-- .course-students -->

                    <div class="course-students mt-3">
                        <label class="m-0">Profesor</label>
                        <div class="author-name">
                            <a href="#profesor">{{ datosFormularioPrincipal.Nombre_profesor }}</a>
                        </div>
                    </div><!-- .course-students -->
                    <div class="course-cats mt-3">
                        <label class="m-0">Estado actual</label>
                        <div class="author-name" v-if="datosFormularioPrincipal.Estado==1"> <em> Modulo Habilitado</em></div>
                        <div class="author-name" v-if="datosFormularioPrincipal.Estado==2"><em>Examen realizado</em></div>
                        <div class="author-name" v-if="datosFormularioPrincipal.Estado==3"><em>Examen Corregido</em></div>
                    </div><!-- .course-cats -->
                </div><!-- .course-info -->

                <div class="single-course-cont-section">
                    <?php
                    if ($Datos["Url_archivo_modulo"] != null) {
                        echo '
                    <div class="float-right">
                        <p align="center">
                            <a target="_blank" href="' . base_url() . 'uploads/imagenes/' . $Datos["Url_archivo_modulo"] . '">
                                <img width="150" src="' .  base_url() . 'uploads/descargar.png" alt="">
                                <br>
                                Descargar
                            </a>
                        </p>
                    </div>';
                    }
                    ?>
                    <h3>
                        <?= $Datos["Descripcion_modulo"]; ?>
                    </h3>

                    <div>
                        <?= $Datos["Contenido_html_modulo"]; ?>
                    </div>



                    <!-- <ul class="p-0 m-0 green-ticked">
                        <p>{{datosFormularioPrincipal.Descripcion_corta}}</p>
                    </ul> -->



                </div>

                <a name="examen"></a>
                <div class="instructors-info" style="border-left: 8px solid #610B38; padding: 30px; background-color:beige; border-radius: 0px 20px 0px 20px;">
                    <header class="entry-heading">
                        <h2 class="entry-title">Examen</h2>

                    </header><!-- .entry-heading -->

                    <h4><?= $Datos["Titulo_examen"]; ?></h4>
                    <?php
                    if ($Datos["Url_archivo_examen"] == null) {
                        echo '<!--';
                    }
                    ?>
                    <div class="float-right" v-if="datosExamen_curso.Url_archivo != null">
                        <p align="center">
                            <a target="_blank" href="<?php echo base_url(); ?>uploads/imagenes/<?= $Datos["Url_archivo_examen"]; ?> ">
                                <img width="150" src="<?php echo base_url(); ?>uploads/descargar.png" alt="">
                                <br>Adjunto examen
                            </a>
                        </p>
                    </div>
                    <?php
                    if ($Datos["Url_archivo_examen"] == null) {
                        echo ' -->';
                    }
                    ?>
                    <em>
                        <?= $Datos["Descripcion_examen"]; ?>
                    </em>
                    <hr>
                    <div>
                        <?= $Datos["Contenido_html_examen"]; ?>
                    </div>
                    <hr>
                    <hr>
                    <h4>Completa el examen</h4>
                    <form action="post" v-on:submit.prevent="crearItemPrincipal('/cursos/generar_examen', '/cursos/subir_archivo_respuesta_examen', 2)">
                        <div class="horizontal-form">

                            <label class="control-label">Escribe aquí tus respuestas</label>
                            <textarea class="form-control" placeholder="" v-model="datosExamen_curso.Respuesta_html" cols="30" rows="20" :disabled="datosExamen_curso.Estado != 1"></textarea>
                            <hr>
                            <label class="control-label">Si se lo solicita puede adjuntar un archivo aquí</label>
                            <div class="form-group">
                                <div class="col-sm-12" v-show="datosExamen_curso.Estado == 1">
                                    <input @change="archivoSeleccionado" type="file" class="form-control" name="Imagen">
                                </div>
                                <div class="col-sm-12" v-if="datosExamen_curso.Url_archivo != null">

                                    <p align="center">
                                        <a target="_blank" v-bind:href="'<?php echo base_url(); ?>uploads/archivos/'+datosExamen_curso.Url_archivo">
                                            <img width="150" src="<?php echo base_url(); ?>uploads/descargar.png" alt="">
                                            <br>Adjunto respuesta
                                        </a>
                                    </p>
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
                            <hr>
                            <button type="submit" class="btn btn-success" v-show="datosExamen_curso.Estado == 1">Enviar respuestas</button>

                            <p v-show="datosExamen_curso.Estado == 2 & Rol_acceso == 2">Su examen se encuentra en etapa de corrección</p>
                        </div>
                    </form>
                    <div v-show="datosExamen_curso.Estado > 1">
                        <form action="post" v-on:submit.prevent="crearItemPrincipal('/cursos/generar_examen', '/cursos/subir_archivo_respuesta_examen', 3)">
                            <label class="control-label">Nota</label>
                            <input class="form-control" v-model="datosExamen_curso.Nota" type="number" :disabled="datosExamen_curso.Estado != 2 || Rol_acceso < 3">

                            <label class="control-label">Observaciones sobre la corrección</label>
                            <textarea class="form-control" v-model="datosExamen_curso.Observaciones_correccion" cols="30" rows="3" :disabled="datosExamen_curso.Estado != 2 || Rol_acceso < 3"></textarea>
                            <br>
                            <button type="submit" class="btn btn-success" v-show="datosExamen_curso.Estado == 2 & Rol_acceso > 2">Enviar correción y nota</button>
                        </form>
                    </div>
                </div>

                <a name="profesor"></a>
                <div class="instructors-info">
                    <header class="entry-heading">
                        <h2 class="entry-title">Profesor</h2>
                    </header><!-- .entry-heading -->

                    <div class="instructor-short-info flex flex-wrap">
                        <div class="instructors-stats">
                            <img v-if="datosFormularioPrincipal.Imagen_profesor != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+datosFormularioPrincipal.Imagen_profesor" alt="">
                            <img v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" alt="">

                            <!-- <ul class="p-0 m-0 mt-3">
                                <li><i class="fa fa-star"></i> 4.7 .7 Average rating</li>
                                <li><i class="fa fa-comment"></i> 25,182 Reviews</li>
                                <li><i class="fa fa-user"></i> 11,085 Students</li>
                                <li><i class="fa fa-play-circle"></i> 2 Courses</li>
                            </ul> -->
                        </div><!-- .instructors-stats -->

                        <div class="instructors-details">
                            <!-- <div class="ratings flex align-items-center">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> (4 votes)</span>
                            </div> -->
                            <!-- .ratings -->

                            <h2 class="entry-title mt-3">{{ datosFormularioPrincipal.Nombre_profesor }}</h2>

                            <div class="course-teacher mt-3">
                                Contacto: <a href="#">{{ datosFormularioPrincipal.Email_profesor }}</a>
                            </div><!-- .course-teacher -->

                            <div class="entry-content mt-3">
                                <p>{{ datosFormularioPrincipal.Observaciones_profesor }}</p>
                            </div><!-- .entry-content -->
                        </div><!-- .instructors-details -->
                    </div><!-- .instructor-short-info -->
                </div><!-- .instructors-info -->

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


                                        <div class="course-cost" v-if="curso.Costo_promocional == null || curso.Costo_promocional == 0">
                                            $ {{curso.Costo_normal | Moneda}} <!-- <span class="price-drop">{{curso.Costo_promocional}}</span> -->
                                        </div><!-- .course-cost -->
                                        <div class="course-cost" v-if="curso.Costo_promocional > 0">
                                            $ {{curso.Costo_promocional | Moneda}} <span class="price-drop">$ {{curso.Costo_normal | Moneda}}</span>
                                        </div><!-- .course-cost -->



                                        <div class="course-ratings flex justify-content-end align-items-center">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star-o"></span>

                                            <!-- <span class="course-ratings-count">(4 votos)</span> -->
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



</div><!-- .container -->
<!-- Modal -->

<?php
include("aa_pie.php");
?>