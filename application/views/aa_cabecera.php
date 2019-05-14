<!DOCTYPE html>
<html lang="es">

<head>
    <title><?= $TituloPagina; ?></title>
    <meta meta="description" content="<?= $Descripcion; ?>" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plantilla/css/bootstrap.min.css">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plantilla/css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plantilla/css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plantilla/css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plantilla/css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plantilla/style.css">
</head>

<body>
    <div class="hero-content">
        <header class="site-header">
            <div class="top-header-bar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-6 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                            <div class="header-bar-email d-flex align-items-center">
                                <i class="fa fa-envelope"></i><a href="#">tuanna.design@gmail.com</a>
                            </div><!-- .header-bar-email -->

                            <div class="header-bar-text lg-flex align-items-center">
                                <p><i class="fa fa-phone"></i>001-1234-88888 </p>
                            </div><!-- .header-bar-text -->
                        </div><!-- .col -->

                        <div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                            <div class="header-bar-search">
                                <!-- COLOCAR UN ID DE VUE PARA QUE FUNCIONE ESTA BUSQUEDA -->
                                <form class="flex align-items-stretch">
                                    <input type="search" placeholder="Que te gustaría aprender?">
                                    <button type="submit" value="" class="flex justify-content-center align-items-center">
                                        <i class="fa fa-search"></i></button>
                                </form>
                            </div><!-- .header-bar-search -->

                            <div class="header-bar-menu">
                                <ul class="flex justify-content-center align-items-center py-2 pt-md-0">
                                    <li><a href="#">Registrate</a></li>
                                    <li><a href="#">Inicia Sesión</a></li>
                                </ul>
                            </div><!-- .header-bar-menu -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .container-fluid -->
            </div><!-- .top-header-bar -->