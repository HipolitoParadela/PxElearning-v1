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
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>plantilla/css/font-awesome.min.css">

    <!-- ElegantFonts CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plantilla/css/elegant-fonts.css">

    <!-- themify-icons CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plantilla/css/themify-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plantilla/css/swiper.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>plantilla/style.css">

    <!-- Google Login -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="644903989514-1qujhghgktm8l1rli5kbiasp6bcrtrr2.apps.googleusercontent.com">

    <script>
        function onSignIn(googleUser) {

            var profile = googleUser.getBasicProfile();
            //console.log('Google_id: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
            //console.log('Name: ' + profile.getName());
            //console.log('Image URL: ' + profile.getImageUrl());
            //console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.

            jQuery.ajax({
                // la URL para la petición
                url: 'http://institutojlc.com/login/iniciar_session_google',

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data: {
                    'Google_id': profile.getId(), // Do not send to your backend! Use an ID token instead.
                    'Name': profile.getName(),
                    'Image_URL': profile.getImageUrl(),
                    'Email': profile.getEmail(),

                },

                // especifica si será una petición POST o GET
                type: 'GET',

                // el tipo de información que se espera de respuesta
                dataType: 'json',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success: function(json) {
                    //alert('Bien');
                    //console.log(json)
                    window.location = "http://institutojlc.com/dashboard";
                },

                // código a ejecutar si la petición falla;
                // son pasados como argumentos a la función
                // el objeto de la petición en crudo y código de estatus de la petición
                error: function(xhr, status) {
                    console.log(xhr.responseText)
                    console.log(status)
                    alert('Disculpe, existió un problema');

                },

                // código a ejecutar sin importar si la petición falló o no
                complete: function(xhr, status) {

                    //alert('Petición realizada');
                }
            });
        }

        
    </script>
</head>

<body <?= $body_class; ?>>
    <div <?= $div_inicial_class; ?>>
        <header class="site-header">
            <div class="top-header-bar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-6 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                            <div class="header-bar-email d-flex align-items-center">
                                <i class="fa fa-envelope"></i><a href="mailto:info@institutojlc.com">info@institutojlc.com</a>
                            </div><!-- .header-bar-email -->

                            <div class="header-bar-text lg-flex align-items-center">
                                <p>
                                    <i class="fa fa-phone"></i>
                                    03572 423471

                                </p>
                            </div><!-- .header-bar-text -->
                        </div><!-- .col -->

                        <div class="col-12 col-lg-6 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                            <!-- <div class="header-bar-search">
                                
                                <form class="flex align-items-stretch">
                                    <input type="   " placeholder="Que te gustaría aprender?">
                                    <button type="submit" value="" class="flex justify-content-center align-items-center">
                                        <i class="fa fa-search"></i></button>
                                </form>
                            </div> -->
                            <!-- .header-bar-search -->

                            <div class="header-bar-menu">
                                <ul class="flex justify-content-center align-items-center py-2 pt-md-0">
                                    <?php
                                    if ($this->session->userdata('Login') == true) {
                                        echo '  <li><a href="' . base_url() . 'dashboard">' . $this->session->userdata('Nombre') . '</a>  </li>';
                                                //<li><a href="#" onclick="signOut();"> <i class="zmdi zmdi-power"></i>Cerrar Sesión</a></li>'
                                    } else {
                                        /* echo '  <li><a href="#">Registrate</a></li>
                                                    <li><a href="' . base_url() . '/login">Inicia Sesión</a></li>'; */
                                        echo '<div class="g-signin2" data-onsuccess="onSignIn"></div>';
                                    }
                                    ?>

                                </ul>
                            </div><!-- .header-bar-menu -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .container-fluid -->
            </div><!-- .top-header-bar -->