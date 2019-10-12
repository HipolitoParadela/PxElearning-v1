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

<a name="cursos"></a>


<div class="container-fluid" id="app_cursos_publico">
    <div class="row">

        <div class="col-12">
            <div class="breadcrumbs">
                <ul class="flex flex-wrap align-items-center p-0 m-0">
                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="<?php echo base_url(); ?>cursos">
                            <!-- <i class="fa fa-users"></i> --> <?= $TituloPagina; ?></a></li>
                </ul>
            </div><!-- .breadcrumbs -->
        </div><!-- .col -->
    </div><!-- .row -->
    <div class="row">
        <div class="col-12 col-lg-9">
            <div class="featured-courses courses-wrap">
                <div class="row mx-m-25">

                    <div class="col-12 col-md-4 px-25" v-for="curso in buscarCurso">
                        <div class="course-content">
                            <figure class="course-thumbnail">
                                <a v-bind:href="'<?php echo base_url(); ?>cursos/informaciondelcurso/?Id=' + curso.Id">
                                    <img v-if="curso.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+curso.Imagen" v-bind:alt="curso.Descripcion_corta">
                                    <img v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" v-bind:alt="curso.Descripcion_corta">
                                </a>
                            </figure><!-- .course-thumbnail -->


                            <div class="course-content-wrap">
                                <header class="entry-header">
                                    <h2><a v-bind:href="'<?php echo base_url(); ?>cursos/informaciondelcurso/?Id=' + curso.Id">{{curso.Titulo_curso}}</a></h2>
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
                <div class="search-widget">
                    <!-- <form class="flex flex-wrap align-items-center"> -->
                    <input type="search" placeholder="Buscar curso..." v-model="buscar">
                    <!-- <button type="submit" class="flex justify-content-center align-items-center">
                            <i class="fa fa-search"></i>
                        </button>
                    </form> .flex -->
                </div><!-- .search-widget -->

                <div class="cat-links">
                    <h2>
                        <a href="<?php echo base_url(); ?>/cursos/listado#cursos">Categorías</a>

                    </h2>

                    <ul class="p-0 m-0">
                        <li v-for="categoria in listaFiltro_1">
                            <a v-bind:href="'<?php echo base_url(); ?>/cursos/listado?Categoria=' + categoria.Nombre_categoria + '&Id=' + categoria.Id+ '#cursos'">
                                {{categoria.Nombre_categoria}}
                            </a>
                        </li>
                    </ul>
                </div><!-- .cat-links -->

                <div class="latest-courses">
                    <h2>Últimos cursos</h2>

                    <ul class="p-0 m-0">

                        <li class="flex flex-wrap justify-content-between align-items-center" v-for="ult_curso in listaContenido_2">

                            <a v-bind:href="'<?php echo base_url(); ?>cursos/informaciondelcurso/?Id=' + ult_curso.Id">
                                <img v-if="ult_curso.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+ult_curso.Imagen" v-bind:alt="ult_curso.Descripcion_corta">
                                <img v-else src="<?php echo base_url(); ?>uploads/addimagen.jpg" v-bind:alt="ult_curso.Descripcion_corta">
                            </a>

                            <div class="content-wrap">
                                <h3><a v-bind:href="'<?php echo base_url(); ?>cursos/informaciondelcurso/?Id=' + ult_curso.Id">{{ult_curso.Titulo_curso}}</a></h3>

                                <div class="course-cost" v-if="ult_curso.Costo_promocional == null || ult_curso.Costo_promocional == 0">

                                        $ {{ult_curso.Costo_normal | Moneda}} <!-- <span class="price-drop">{{ult_curso.Costo_promocional}}</span> -->
                                    </div><!-- .course-cost -->
                                    <div class="course-cost" v-if="ult_curso.Costo_promocional > 0">
                                        $ {{ult_curso.Costo_promocional | Moneda}} <span class="price-drop">$ {{ult_curso.Costo_normal | Moneda}}</span>
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
                </div> --><!-- .popular-tags -->
            </div><!-- .sidebar -->
        </div><!-- .col -->
    </div><!-- .row -->

</div><!-- .container -->
<!-- Modal -->

<?php
include("aa_pie.php");
?>