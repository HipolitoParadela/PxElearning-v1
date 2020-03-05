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
    <section class="about-section" v-if="Rol_acceso > 2">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 align-content-lg-stretch">
                    <header class="heading">
                        <h2 class="entry-title">
                            <a href="<?php echo base_url(); ?>cursos">
                                Gestionar Cursos
                            </a>
                        </h2>

                        <p>
                            <b>Objetivo del mes: </b> Lograr los 10 primeros inscriptos en cualquier curso Online.
                        </p>
                        <p>
                            <b>Tarea del día: </b> Publicicar tres cursos online en grupos de facebook.
                        </p>
                    </header><!-- .heading -->

                    <div class="entry-content ezuca-stats">
                        <div class="stats-wrap flex flex-wrap justify-content-lg-between">
                            <div class="stats-count">
                                {{cantidad_inscriptos}}
                                <!-- <span>M+</span> -->
                                <p>Estudiantes inscriptos</p>
                            </div><!-- .stats-count -->

                            <div class="stats-count">
                                {{cantidad_cursos_activos}}
                                <!-- <span>K+</span> -->
                                <p>Cursos Activos</p>
                            </div><!-- .stats-count -->

                            <div class="stats-count">
                                {{cantidad_profesores}}
                                <!-- <span>M+</span> -->
                                <p>Profesores</p>
                            </div><!-- .stats-count -->

                            <div class="stats-count">
                                {{cantidad_cursos}}
                                <!-- <span>+</span> -->
                                <p>Cursos totales</p>
                            </div><!-- .stats-count -->
                        </div><!-- .stats-wrap -->
                    </div><!-- .ezuca-stats -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 flex align-content-center mt-5 mt-lg-0">
                    <div class="ezuca-video position-relative">
                        <div class="video-play-btn position-absolute">
                            <a href="<?php echo base_url(); ?>cursos">
                                <img src="<?php echo base_url(); ?>plantilla/images/video-icon.png" alt="Video Play">
                            </a>
                        </div><!-- .video-play-btn -->

                        <img src="<?php echo base_url(); ?>plantilla/images/video-screenshot.png" alt="">
                    </div><!-- .ezuca-video -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .about-section -->
    <section class="latest-news-events">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-1"></div>
                <div class="col-xl-5">
                    <h3>Alumnos curzando actualmente | <a v-if="Rol_acceso > 3" class="btn" href="<?php echo base_url(); ?>usuarios">Ver Todos</a></h3>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Curso/Profesor</th>
                                <th scope="col">Fecha Inicio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(usuario, index) in lista_alumnos_cursando" v-show="(pag - 1) * NUM_RESULTS <= index  && pag * NUM_RESULTS > index">
                                <td>
                                    <div class="course-author flex flex-wrap">

                                        <img v-if="usuario.Imagen != null" v-bind:src="'<?php echo base_url(); ?>uploads/imagenes/'+usuario.Imagen" width="60px">
                                        <img v-else src="<?php echo base_url(); ?>uploads/add_usuario.jfif" width="50px" alt="">

                                    </div>
                                </td>
                                <td>
                                    <b>
                                        <a v-bind:href="'<?php echo base_url(); ?>usuarios/datos/?Id=' + usuario.Alumno_id">
                                            {{usuario.Nombre_alumno}}
                                        </a>
                                    </b>
                                    <br>
                                    {{usuario.Telefono}}

                                </td>
                                <td valign="baseline">
                                    <b><a v-bind:href="'<?php echo base_url(); ?>cursos/cursado/?Id=' + usuario.Id">
                                            {{usuario.Titulo_curso}}
                                        </a></b>
                                    <br>
                                    <span class="text-info" v-if="usuario.Nombre_profesor != null">
                                        {{usuario.Nombre_profesor}}
                                    </span>
                                    <span class="text-info" v-else>
                                        <a v-bind:href="'<?php echo base_url(); ?>cursos/datos/?Id=' + usuario.Curso_id">Asignar profesor</a>
                                    </span>

                                </td>
                                <td>
                                    {{usuario.Fecha_inicio | Fecha }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-8">
                            <nav aria-label="Page navigation" class="text-center">
                                <hr>
                                <ul class="pagination text-center">
                                    <li>
                                        <a href="#" class="btn btn-secondary btn-sm" aria-label="Previous" v-show="pag_inscriptos != 1" @click.prevent="pag_inscriptos -= 1">
                                            <span aria-hidden="true">Anterior</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-secondary btn-sm" aria-label="Next" v-show="pag_inscriptos * NUM_RESULTS / lista_alumnos_cursando.length < 1" @click.prevent="pag_inscriptos += 1">
                                            <span aria-hidden="true">Siguiente</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-lg-2">
                            <nav aria-label="Page navigation" class="text-center">
                                <hr>
                                <ul class="pagination text-center">
                                    <li>
                                        <select class="form-control" v-model="NUM_RESULTS">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="500">500</option>
                                        </select>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>




                </div>
                <div class="col-xl-5">
                    <h3>Últimos movimientos en examenes</h3>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Curso<br>Movimiento</th>
                                <th scope="col">Alumno<br> Profesor</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(movimiento, index) in lista_movimientos_examen" v-show="(pag - 1) * NUM_RESULTS <= index  && pag * NUM_RESULTS > index">
                                <td>
                                    <a v-bind:href="'<?php echo base_url(); ?>cursos/cursado_modulo/?Id=' + movimiento.Id">
                                        {{movimiento.Titulo_curso}}
                                        <br>
                                        <span v-if="movimiento.Estado==1"> <b> Habilitado</b></span>
                                        <span v-if="movimiento.Estado==2"><b>Examen realizado</b></span>
                                        <span v-if="movimiento.Estado==3"><b>Examen Corregido</b></span>
                                        <span class="text-info">{{movimiento.Titulo_modulo}}</span>
                                    </a>
                                </td>
                                <td valign="baseline">
                                    {{movimiento.Nombre_alumno}}
                                    <br>
                                    <span class="text-info">{{movimiento.Nombre_profesor}}</span>
                                </td>
                                <td>
                                    {{ movimiento.Fecha_ult_actualizacion | FechaB_datos }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-lg-8">
                            <nav aria-label="Page navigation" class="text-center">
                                <hr>
                                <ul class="pagination text-center">
                                    <li>
                                        <a href="#" class="btn btn-secondary btn-sm" aria-label="Previous" v-show="pag != 1" @click.prevent="pag -= 1">
                                            <span aria-hidden="true">Anterior</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-secondary btn-sm" aria-label="Next" v-show="pag * NUM_RESULTS / lista_movimientos_examen.length < 1" @click.prevent="pag += 1">
                                            <span aria-hidden="true">Siguiente</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-lg-2">
                            <nav aria-label="Page navigation" class="text-center">
                                <hr>
                                <ul class="pagination text-center">
                                    <li>
                                        <select class="form-control" v-model="NUM_RESULTS">
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="500">500</option>
                                        </select>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>

                <div class="col-xl-1"></div>

            </div>
        </div>
    </section>
    <section class="about-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-4">
                            <br>
                            <h2>Nuestro</h2>
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.3&appId=1902946569932282&autoLogAppEvents=1"></script>
                            <div class="fb-page" data-href="https://www.facebook.com/institutojlc/" data-tabs="timeline" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <blockquote cite="https://www.facebook.com/institutojlc/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/institutojlc/">Instituto Jerónimo Luis de Cabrera</a></blockquote>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <h2>Villa María</h2>
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.3&appId=1902946569932282&autoLogAppEvents=1"></script>
                            <div class="fb-page" data-href="https://www.facebook.com/cursosvillamariaeduca/" data-tabs="timeline" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <blockquote cite="https://www.facebook.com/cursosvillamariaeduca/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/cursosvillamariaeduca/">Villa María Educa</a></blockquote>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <h2>Mariano Moreno</h2>
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.3&appId=1902946569932282&autoLogAppEvents=1"></script>
                            <div class="fb-page" data-href="https://www.facebook.com/institutommoreno" data-tabs="timeline" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <blockquote cite="https://www.facebook.com/institutommoreno" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/institutommoreno">Mariano Moreno</a></blockquote>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <h2>Ceicos</h2>
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.3&appId=1902946569932282&autoLogAppEvents=1"></script>
                            <div class="fb-page" data-href="https://www.facebook.com/InstitutoCeicos/" data-tabs="timeline" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <blockquote cite="https://www.facebook.com/InstitutoCeicos/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/InstitutoCeicos/">Ceicos</a></blockquote>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <h2>Cetsi</h2>
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.3&appId=1902946569932282&autoLogAppEvents=1"></script>
                            <div class="fb-page" data-href="https://www.facebook.com/cetcicordoba/" data-tabs="timeline" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <blockquote cite="https://www.facebook.com/cetcicordoba/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/cetcicordoba/">Cetsi</a></blockquote>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <h2>Ralseef</h2>
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.3&appId=1902946569932282&autoLogAppEvents=1"></script>
                            <div class="fb-page" data-href="https://www.facebook.com/ralseffcursos/" data-tabs="timeline" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <blockquote cite="https://www.facebook.com/ralseffcursos/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ralseffcursos/">Instituto Ralseef</a></blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <h2>Noticias sobre cursos online</h2>

                    <div class="row" v-for="noticia in listaNoticias.articles" class="au-message__item">
                        <div class="col-4">
                            <img class="img-fluid" v-bind:src="noticia.urlToImage">
                        </div>
                        <div class="col-8">
                            <h5 class="name">{{noticia.title}}</h5>
                            <p>{{noticia.content}}</p>
                            <p><a target="_blank" v-bind:href="noticia.url">Leer más </a></p>
                        </div>
                    </div>

                </div>
            </div><!-- .container -->
    </section><!-- .about-section -->


</div><!-- .container -->
<!-- Modal -->

<?php
include("aa_pie.php");
?>