<?php
// CABECERA
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
<div class="container" id="index">
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
    <div class="row breadcrumbs">
        <div class="col-12">
            <div class="login-form">
                <form action="login/iniciar_session" method="post" role="form">
                    <p align="center" class="text-danger">
                        <?php
                        if (isset($_GET["Error"])) {
                            if ($_GET["Error"] == 1) {
                                echo "Contraseña erronea.";
                            } elseif ($_GET["Error"] == 2) {
                                echo "Usuario no registrado.";
                            } elseif ($_GET["Error"] == 3) {
                                echo "Solicite permiso al administrador para poder acceder.";
                            }
                        }
                        ?>
                    </p>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>DNI</label>
                                <input id="dni" name="dni" type="number" value="" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input id="Pass" name="Pass" type="password" value="" class="form-control" placeholder="" required>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="login-checkbox">
                                            <label>
                                                <input type="checkbox" name="remember">Remember Me
                                            </label>
                                            <label>
                                                <a href="#">Forgotten Password?</a>
                                            </label>
                                        </div> -->
                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Ingresar</button>
                    <!--<div class="social-login-content">
                                            <div class="social-button">
                                                <button class="au-btn au-btn--block au-btn--blue m-b-20">sign in with facebook</button>
                                                <button class="au-btn au-btn--block au-btn--blue2">sign in with twitter</button>
                                            </div>
                                        </div>-->
                </form>
                <!--<div class="register-link">
                                        <p>
                                            Don't you have account?
                                            <a href="#">Sign Up Here</a>
                                        </p>
                                    </div>-->
            </div>
        <hr>
        <p align="center"><img src="<?php echo base_url(); ?>uploads/imagenes/logoazul.png" width="150px"></p>
    </div>
 

<?php
// CABECERA
include "aa_pie.php"; ?>
</body>

</html>
<!-- end document-->