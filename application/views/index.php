<?php
include("aa_cabecera.php");
include("aa_barra_navegacion.php");
?>

</header><!-- .site-header -->

<div class="hero-content-overlay">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-content-wrap flex flex-column justify-content-center align-items-start">
                    <header class="entry-header">
                        <h4>Cursos de formación en linea con certificación</h4>
                        <h1>Desde tu casa<br />En tus tiempos</h1>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p>Brindamos el mejor servicio de capacitación informática personalizada, para que todos puedan formarse con un nivel de aprendizaje superior.</p>
                        <h4>Más de 25 años de trayectoria avalan nuestra experiencia</h4>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer read-more">
                        <a href="<?php echo base_url(); ?>cursos/listado">CONOCÉ NUESTROS CURSOS</a>
                    </footer><!-- .entry-footer -->
                </div><!-- .hero-content-wrap -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .hero-content-hero-content-overlay -->
</div><!-- .hero-content -->
<div id="index">
    <div class="icon-boxes">
        <div class="container-fluid">
            <div class="flex flex-wrap align-items-stretch">
                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-user"></span>
                    </div><!-- .icon -->

                    <header class="entry-header">
                        <h2 class="entry-title">Aprende de expertos</h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p>Contamos con un grupo de profesores de primer nivel en sus materias. Los cuales tendrás como tutor en tu camino de aprendizaje.</p>
                    </div><!-- .entry-content -->

                    <!-- <footer class="entry-footer read-more">
                        <a href="#">read more<i class="fa fa-long-arrow-right"></i></a>
                    </footer> -->
                    <!-- .entry-footer -->
                </div><!-- .icon-box -->

                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-folder"></span>
                    </div><!-- .icon -->

                    <header class="entry-header">
                        <h2 class="entry-title">Material teorico y práctico</h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p>Aprenderás la teoria necesaria para poder comenzar a practicar y aplicar tus conocimientos cuanto antes.</p>
                    </div><!-- .entry-content -->

                    <!-- <footer class="entry-footer read-more">
                        <a href="#">read more<i class="fa fa-long-arrow-right"></i></a>
                    </footer> -->
                    <!-- .entry-footer -->
                </div><!-- .icon-box -->

                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-book"></span>
                    </div><!-- .icon -->

                    <header class="entry-header">
                        <h2 class="entry-title">Aprendizaje paso a paso</h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p>Cada curso esta cuidadosamente diseñado y divido en módulos y examenes que te llevarán paso a paso a aprender el 100% de los contenidos.</p>
                    </div><!-- .entry-content -->

                    <!-- <footer class="entry-footer read-more">
                        <a href="#">read more<i class="fa fa-long-arrow-right"></i></a>
                    </footer> -->
                    <!-- .entry-footer -->
                </div><!-- .icon-box -->

                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-world"></span>
                    </div><!-- .icon -->

                    <header class="entry-header">
                        <h2 class="entry-title">Salida laboral inmediata</h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p>Te ofrecemos cursos que te permitiran salir al ruedo con la formación necesaria requerida por las empresas y/o clientes particulares.</p>
                    </div><!-- .entry-content -->

                    <!-- <footer class="entry-footer read-more">
                        <a href="#">read more<i class="fa fa-long-arrow-right"></i></a>
                    </footer> -->
                    <!-- .entry-footer -->
                </div><!-- .icon-box -->
            </div><!-- .row -->
        </div><!-- .container-fluid -->
    </div><!-- .icon-boxes -->

    <section class="featured-courses horizontal-column courses-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <header class="heading flex justify-content-between align-items-center">
                        <h2 class="entry-title">Certificate en cursos que te recomendamos</h2>

                        <a class="btn mt-4 mt-sm-0" href="<?php echo base_url(); ?>cursos/listado">Ver todos</a>
                    </header><!-- .heading -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6" v-for="curso_gratis in listaCursosGratis">
                    <div class="course-content flex flex-wrap justify-content-between align-content-lg-stretch">
                        <figure class="course-thumbnail">
                            <a v-bind:href="'cursos/informaciondelcurso/?Id=' + curso_gratis.Id">
                                <img v-if="curso_gratis.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+curso_gratis.Imagen" alt="">
                                <img v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" alt="">
                            </a>
                        </figure><!-- .course-thumbnail -->

                        <div class="course-content-wrap">
                            <header class="entry-header">
                                <div class="course-ratings flex align-items-center">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star-o"></span>

                                    <span class="course-ratings-count">(4 votos)</span>
                                </div><!-- .course-ratings -->

                                <h2 class="entry-title"><a v-bind:href="'cursos/informaciondelcurso/?Id=' + curso_gratis.Id">{{ curso_gratis.Titulo_curso }}</a></h2>

                                <!--  <div class="entry-meta flex flex-wrap align-items-center">
                                    <div class="course-author"><a  v-bind:href="'cursos/informaciondelcurso/?Id=' + curso_gratis.Id">Ms. Lara Croft </a></div>

                                    <div class="course-date">July 21, 2018</div>
                                </div> -->
                                <!-- .course-date -->
                            </header><!-- .entry-header -->

                            <footer class="entry-footer flex justify-content-between align-items-center">
                                <div class="course-cost">
                                    <span class="free-cost">Super precio</span>
                                </div><!-- .course-cost -->
                            </footer><!-- .entry-footer -->
                        </div><!-- .course-content-wrap -->
                    </div><!-- .course-content -->
                </div><!-- .col -->

            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .courses-wrap -->

    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 align-content-lg-stretch">
                    <header class="heading">
                        <h2 class="entry-title">Formación certificada</h2>

                        <p>Certificación oficial a nivel Provincial CPCIPC, Consejo Profesional de ciencias Informáticas de la Provincia de Córdoba. (Ley 7.642)<br>

                            Certificación Oficial Nacional UTN, Universidad Tecnológica Nacional (FRVM)</p>
                    </header><!-- .heading -->

                    <div class="entry-content ezuca-stats">
                        <div class="stats-wrap flex flex-wrap justify-content-lg-between">
                            <div class="stats-count">
                                {{cantidad_inscriptos}}<!-- <span>M+</span> -->
                                <p>INSCRIPTOS</p>
                            </div><!-- .stats-count -->

                            <div class="stats-count">
                                {{cantidad_cursos_gratuitos}}<!-- <span>K+</span> -->
                                <p>CURSOS GRATUITOS</p>
                            </div><!-- .stats-count -->

                            <div class="stats-count">
                                {{cantidad_profesores}}<!-- <span>M+</span> -->
                                <p>INSTRUCTORES</p>
                            </div><!-- .stats-count -->

                            <div class="stats-count">
                                {{cantidad_cursos}}<!-- <span>+</span> -->
                                <p>CURSOS OFICIALES</p>
                            </div><!-- .stats-count -->
                        </div><!-- .stats-wrap -->
                    </div><!-- .ezuca-stats -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 flex align-content-center mt-5 mt-lg-0">
                    <div class="ezuca-video position-relative">
                        <div class="video-play-btn position-absolute">
                            <img src="<?php echo base_url(); ?>plantilla/images/video-icon.png" alt="Video Play">
                        </div><!-- .video-play-btn -->

                        <img src="<?php echo base_url(); ?>plantilla/images/video-screenshot.png" alt="">
                    </div><!-- .ezuca-video -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .about-section -->

    <section class="testimonial-section">
        <!-- Swiper -->
        <div class="swiper-container testimonial-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 order-2 order-lg-1 flex align-items-center mt-5 mt-lg-0">
                                <figure class="user-avatar">
                                    <img src="<?php echo base_url(); ?>uploads/imagenes/steve.jpg" alt="">
                                </figure><!-- .user-avatar -->
                            </div><!-- .col -->

                            <div class="col-12 col-lg-6 order-1 order-lg-2 content-wrap h-100">
                                <div class="entry-content">
                                    <p>La fortuna juega a favor de las mentes preparadas.</p>
                                </div><!-- .entry-content -->

                                <div class="entry-footer">
                                    <h3 class="testimonial-user">Luis Pasteur - <span>Cientifico</span></h3>
                                </div><!-- .entry-footer -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container -->
                </div><!-- .swiper-slide -->

                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 order-2 order-lg-1 flex align-items-center mt-5 mt-lg-0">
                                <figure class="user-avatar">
                                    <img src="<?php echo base_url(); ?>uploads/imagenes/laotze.jpg" alt="">
                                </figure><!-- .user-avatar -->
                            </div><!-- .col -->

                            <div class="col-12 col-lg-6 order-1 order-lg-2 content-wrap h-100">
                                <div class="entry-content">
                                    <p>Si tu no trabajas por tus sueños, alguien te contratará para que trabajes por los suyos.</p>
                                </div><!-- .entry-content -->

                                <div class="entry-footer">
                                    <h3 class="testimonial-user">Steve Jobs - <span>Fundador de Apple</span>
                                    </h3>
                                </div><!-- .entry-footer -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container -->
                </div><!-- .swiper-slide -->

                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 flex order-2 order-lg-1 align-items-center mt-5 mt-lg-0">
                                <figure class="user-avatar">
                                    <img src="<?php echo base_url(); ?>uploads/imagenes/pasteur.jpg" alt="">
                                </figure><!-- .user-avatar -->
                            </div><!-- .col -->

                            <div class="col-12 col-lg-6 order-1 order-lg-2 content-wrap h-100">
                                <div class="entry-content">
                                    <p>Un viaje de mil millas comienza con el primer paso. Hoy es el momento de darlo.</p>
                                </div><!-- .entry-content -->

                                <div class="entry-footer">
                                    <h3 class="testimonial-user">Lao Tze - <span>Filósofo</span>
                                    </h3>
                                </div><!-- .entry-footer -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container -->
                </div><!-- .swiper-slide -->
            </div><!-- .swiper-wrapper -->

            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 mt-5 mt-lg-0">
                        <div class="swiper-pagination position-relative flex justify-content-center align-items-center">
                        </div>
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .testimonial-slider -->
    </section><!-- .testimonial-section -->

    <section class="featured-courses vertical-column courses-wrap">
        <div class="container">
            <div class="row mx-m-25">
                <div class="col-12 px-25">
                    <header class="heading flex flex-wrap justify-content-between align-items-center">
                        <h2 class="entry-title">Cursos en línea</h2>

                        <nav class="courses-menu mt-3 mt-lg-0">
                            <ul class="flex flex-wrap justify-content-md-end align-items-center">
                                <li v-for="categoria in listaFiltro_1">
                                    <a v-bind:href="'<?php echo base_url(); ?>cursos/listado?Categoria=' + categoria.Nombre_categoria + '&Id=' + categoria.Id">
                                        {{categoria.Nombre_categoria}}
                                    </a>
                                </li>

                            </ul>
                        </nav><!-- .courses-menu -->
                    </header><!-- .heading -->
                </div><!-- .col -->

                <div class="col-12 col-md-6 col-lg-4 px-25" v-for="curso in lista_cursos">
                    <div class="course-content">
                        <figure class="course-thumbnail">
                            <a v-bind:href="'cursos/informaciondelcurso/?Id=' + curso.Id">
                                <img v-if="curso.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+curso.Imagen" alt="">
                                <img v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" alt="">
                            </a>
                        </figure><!-- .course-thumbnail -->


                        <div class="course-content-wrap">
                            <header class="entry-header">
                                <h2 class="entry-title"><a v-bind:href="'cursos/informaciondelcurso/?Id=' + curso.Id">{{curso.Titulo_curso}}</a></h2>
                                <div class="entry-meta flex align-items-center">
                                    <div class="course-author">{{curso.Nombre_categoria}}</div>

                                    <div class="course-date">{{curso.Duracion}} Meses</div>
                                </div>
                                <!-- .course-date -->
                            </header><!-- .entry-header -->

                            <footer class="entry-footer flex justify-content-between align-items-center">
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

                                    <span class="course-ratings-count">(4 votos)</span>
                                </div><!-- .course-ratings -->
                            </footer><!-- .entry-footer -->
                        </div><!-- .course-content-wrap -->
                    </div><!-- .course-content -->
                </div><!-- .col -->



                <div class="col-12 px-25 flex justify-content-center">
                    <a class="btn" href="<?php echo base_url(); ?>/cursos/listado">ver todos</a>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .courses-wrap -->

    <section class="latest-news-events">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <header class="heading flex justify-content-between align-items-center">
                        <h2 class="entry-title">Blog</h2>
                    </header><!-- .heading -->
                </div><!-- .col -->

                <div class="col-12 col-lg-4" v-for="blog in lista_blog">
                    <div class="featured-event-content">
                        <figure class="event-thumbnail position-relative m-0">
                            <a v-bind:href="'<?php echo base_url(); ?>blog/entrada/?Id=' + blog.Id">
                                <img v-if="blog.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+blog.Imagen" v-bind:alt="blog.Copete">
                                <img v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" v-bind:alt="blog.Copete">
                            </a>

                            <div class="posted-date position-absolute">
                                <div class="day">{{blog.Fecha_ult_actualizacion | Dia}}</div>
                                <div class="month">{{blog.Fecha_ult_actualizacion | Mes}}</div>
                            </div><!-- .posted-date -->
                        </figure><!-- .event-thumbnail -->

                        <header class="entry-header flex flex-wrap align-items-center">
                            <h2 class="entry-title">
                                <a v-bind:href="'<?php echo base_url(); ?>blog/entrada/?Id=' + blog.Id">{{blog.Titulo_curso}}</a>
                            </h2>

                            <div class="entry-content">
                                    <p>{{blog.Copete}}</p>
                                </div><!-- .entry-content -->
                        </header><!-- .entry-header -->
                    </div><!-- .featured-event-content -->
                </div><!-- .col -->


            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .latest-news-events -->


</div>
<?php
include("aa_pie.php");
?>