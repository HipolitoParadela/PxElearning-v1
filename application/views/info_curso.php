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
                    <h4 align="center" class="text-warning">Curso a distancia con cerficación. </h4>
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
                <img src="<?php echo base_url(); ?>uploads/imagenes/<?= $Datos_curso["Imagen"]; ?>" alt="<?= $Datos_curso["Descripcion_corta"]; ?>">

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
            <div class="single-course-wrap">
                <div class="course-info flex flex-wrap align-items-center">


                    <div class="course-cats mt-3">
                        <label class="m-0">Categoría</label>
                        <div class="author-name"><a href="#"><?= $Datos_curso["Nombre_categoria"]; ?></a></div>
                    </div><!-- .course-cats -->

                    <div class="course-students mt-3">
                        <label class="m-0">Programa</label>
                        <div class="author-name"> <?= count($Modulos); ?> módulos</div>
                    </div><!-- .course-students -->

                    <div class="buy-course mt-3">
                        <a class="btn" href="#comprar">Comprar curso</a>
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

                        <div class="total-lectures-time"><?= $Datos_curso["Duracion"]; ?> meses</div>
                    </header><!-- .entry-header -->

                    <div class="entry-contents">
                        <div class="accordion-wrap type-accordion">

                            <?php

                            foreach ($Modulos as $modulo) 
                            {
                                echo '<h3';
                                
                                if($modulo["Final"] == 1){ echo ' style="border:medium solid gray" ';} 

                                echo ' class="entry-title flex flex-wrap justify-content-between align-items-lg-center">
                                    <span class="arrow-r"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>
                                    <span class="lecture-group-title">' . $modulo["Titulo_modulo"] . '</span>
                                    <span class="number-of-lectures">
                                        
                                    </span> 
                                    <span class="total-lectures-time">
                                        
                                    </span>
                                </h3>

                                <div class="entry-content">
                                    
                                    <p> ' . $modulo["Descripcion_modulo"] . ' </p>
                                </div>';
                            }


                            ?>


                        </div>
                    </div><!-- .entry-contents -->

                    <hr>
                    <div class="single-course-wrap" style="border-right: 8px solid midnightblue; padding: 30px; background-color:ghostwhite; border-radius: 0px 20px 0px 20px;">
                        <h2>Preguntas</h2>
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.3&appId=311617306413197&autoLogAppEvents=1"></script>
                        <div class="fb-comments" data-href="<?= base_url(); ?>cursos/informaciondelcurso/?Id=<?= $_GET["Id"]; ?>" data-width="600" data-numposts="5"></div>
                    </div>
                </div><!-- .single-course-accordion-cont  -->


            </div>
            <a name="comprar"></a>
            <div class="container-fluid" style="margin-top:50px; border-left: 8px solid greenyellow; padding: 30px;">
                <div class="card-deck mb-3 text-center">

                    <h3> Compra ahora curso a distancia de <span class="text-success"><?= $TituloPagina; ?> </span></h3>
                    <p>Podes elegir abonar con todos los medios de pago y con la seguridad que te brinda el sistema de Mercado Pago</p>

                    <div class="card mb-6 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Compra segura</h4>
                        </div>
                        <div class="card-body">
                            <img class="rounded img-fluid" src="http://institutojlc.com/img/mercadopago.jpg">
                            <p>Abona en cuotas con todas las tarjetas. O con efectivo en un Pago Facil o Rapipago.
                                Siempre con la garantìa de compra segura de Mercado Pago.
                            </p>
                        </div>
                    </div>
                    <div class="card mb-6 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Compralo ahora</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">
                                <span style="font-size:20px">$</span>
                                <?
                                if ($Datos_curso["Costo_promocional"] == 0 || $Datos_curso["Costo_promocional"] == null) {
                                    echo $Datos_curso["Costo_normal"];
                                } else {
                                    echo $Datos_curso["Costo_promocional"];
                                    echo ' / <span style="margin-left: 10px;
                                            font-size: 18px;
                                            font-weight: 400;
                                            font-style: italic;
                                            color: #c0c1cd;
                                            text-decoration: line-through">$' . $Datos_curso["Costo_normal"] . '</span>
                                            <br><span class="text-success" style="font-size:18px"> Estas ahorrando $';
                                    $ahorro = $Datos_curso["Costo_normal"] - $Datos_curso["Costo_promocional"];

                                    echo $ahorro;
                                    echo '</spán>';
                                }
                                ?>
                            </h1>
                            <p align="center">
                                <?php
                                if ($this->session->userdata('Login') == true) {
                                    if ($Datos_curso["Costo_promocional"] == 0 || $Datos_curso["Costo_promocional"] == null) {
                                        echo $Datos_curso["Script_pago_normal"];
                                    } else {
                                        echo $Datos_curso["Script_pago_promocional"];
                                    }
                                } else {
                                    echo '<em>Debes <a href="#inicio">iniciar sesión</a> con tu cuenta de google para poder comprar este curso </em> 
                                            <br><div style="margin-top:8px" id="my-signin3"></div><!-- <a class="btn" href="#inicio">Iniciar</a> --> ';
                                }


                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <h4>¿Tienes dudas?</h4>

                <p>Escribenos un mensaje para que un representante de ventas pueda asesorarte y acordar un método de pago adecuado a tus necesidades.</p>

                <a class="btn" href="https://api.whatsapp.com/send?phone=5493513615144&text=Estoy%20interesado%20en%20comprar%20un%20curso%20">Enviar whatsapp</a>
                <a class="btn" href="mailto:info@institutojlc.com">Enviar email a info@institutojlc.com</a>

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
    </div>
</div>
</div>
</div><!-- .col -->
</div><!-- .row -->


</div><!-- .container -->
<!-- Modal -->

<?php
include("aa_pie.php");
?>