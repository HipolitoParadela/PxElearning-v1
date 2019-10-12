<!DOCTYPE html>
<html lang="es">

<head>
    <title>Curso Online de <?= $TituloPagina; ?></title>
    <meta meta="description" content="Curso Online de <?= $TituloPagina; ?> dictado por el Instituto JLC. <?= $Descripcion; ?>" />

    <!-- Open Graph data -->
    <meta property="og:title" content="Curso Online de <?= $TituloPagina; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?php echo base_url(); ?>" />
    <?php
    $imagenFace = "http://institutojlc.com/uploads/jlc-mini.png";
    if (isset($Imagen)) {
        $imagenFace =  base_url() . 'uploads/imagenes/' . $Imagen;
    }
    ?>

    <meta property="og:image" content="<?= $imagenFace ?>" />
    <meta property="og:description" content="Curso Online de <?= $TituloPagina; ?> dictado por el Instituto JLC. <?= $Descripcion; ?>" />
    <meta property="fb:app_id" content="311617306413197" />
    <meta property="fb:admins" content="100009572917964" />

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.3&appId=149767902205993&autoLogAppEvents=1"></script>

    <!-- RichSnnipets -->

    <? if (isset($Datos_curso)) {
        echo '
        <script> 
        var course = {}; 
        course.id_course = ' . $Datos_curso["Id"] . '; 
        course.price = ' . $Datos_curso["Costo_normal"] . '; 
        course.name = "Curso Online de ' . $TituloPagina . ' dictado por el Instituto JLC. ' . $Descripcion . '"; 
        course.price_offer = ' . $Datos_curso["Costo_promocional"] . ' 
        course.online = 1; 
        dataLayer = [{ 
            "edu_pagetype": "program", 
            "edu_pid": ' . $Datos_curso["Id"] . '
        }]; 
    </script>
    
    
    <script type="application/ld+json"> 
    [
        { 
            "@context": "http:\/\/schema.org\/", 
            "@type": "Course", 
            "name": "Curso Online de ' . $TituloPagina . ' dictado por el Instituto JLC. ' . $Descripcion . ', 
            "description": "Curso Online de ' . $TituloPagina . ' dictado por el Instituto JLC. ' . $Descripcion . ', 
            "provider": 
            { 
                "@type": "EducationalOrganization", 
                "name": "Instituto Jerónimo Luis de Cabrera de Río Segundo, Córdoba" 
            } 
        }, 
        { 
            "@context": "http:\/\/schema.org\/", 
            "@type": "Product", 
            "name": "Curso Online de ' . $TituloPagina . ' dictado por el Instituto JLC. ' . $Descripcion . ', 
            "description": "Curso Online de ' . $TituloPagina . ' dictado por el Instituto JLC. ' . $Descripcion . ', 
            "image": "$imagenFace", 
            "sku": "' . $Datos_curso["Id"] . '", 
            "brand": 
            { 
                "@type": "EducationalOrganization", 
                "name": "Instituto Jerónimo Luis de Cabrera de Río Segundo, Córdoba"
            }, 
            "offers": 
            { 
                "@type": "Offer", 
                "priceCurrency": "ARS", 
                "price": "' . $Datos_curso["Costo_normal"] . '", 
                "availability": "http://schema.org/InStock", 
                "url":' . base_url() . 'cursos/informaciondelcurso/?Id=' . $Datos_curso["Id"] . '" 
            }, 
            "review": 
            [
                { 
                    "@type": "Review", 
                    "datePublished": "2019-06-03 14:00:36", 
                    "reviewBody": "Acabo de terminarlo y me ha resultado muy ameno, con unos manuales bien organizados y con muchos ejemplos.", 
                    "author": 
                    { 
                        "type": "Person", 
                        "name": "Axel" 
                    }, 
                    "reviewRating": 
                    { 
                        "type": "Rating", 
                        "ratingValue": 5, 
                        "bestRating": 5, 
                        "worstRating": 0 
                    } 
                } 
            ], 
            "aggregateRating": 
            { 
                "@type": "AggregateRating", 
                "ratingValue": "5", 
                "reviewCount": "1", 
                "bestRating": "5" 
            } 
        }
    ] 
    </script>';
    }
    ?>

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

    <meta name="google-signin-client_id" content="644903989514-1qujhghgktm8l1rli5kbiasp6bcrtrr2.apps.googleusercontent.com">

    <script>
        function onSuccess(googleUser) {
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

        function onFailure(error) {
            console.log(error);
        }

        function renderButton() {
            gapi.signin2.render('my-signin2', {
                'scope': 'profile email',
                'width': 300,
                'height': 40,
                'longtitle': false,
                'theme': 'dark',
                'onsuccess': onSuccess,
                'onfailure': onFailure,
            });

            gapi.load('auth2', function() {
                gapi.auth2.init();
            });
        }

        //// CERRAR SESIÓN
        function signOut() 
        {
            console.log("Solicitud de cerrar sesión recibida 2")

            var auth2 = gapi.auth2.getAuthInstance();

            auth2.signOut().then(function() 
            {
                console.log('Usuario deslogueado.');
                jQuery.ajax({
                    // la URL para la petición
                    url: 'http://institutojlc.com/login/logout',

                    // la información a enviar // (también es posible utilizar una cadena de datos)
                    data: {},

                    // especifica si será una petición POST o GET
                    type: 'GET',

                    // el tipo de información que se espera de respuesta
                    dataType: 'json',

                    // código a ejecutar si la petición es satisfactoria; // la respuesta es pasada como argumento a la función
                    success: function(json) {
                        console.log(json);
                        //console.log(json)
                        window.location = "http://institutojlc.com";
                    },

                    // código a ejecutar si la petición falla;
                    // son pasados como argumentos a la función
                    // el objeto de la petición en crudo y código de estatus de la petición
                    error: function(xhr, status) {
                        console.log(xhr.responseText)
                        console.log(status)
                        console.log('Disculpe, existió un problema');

                    },

                    // código a ejecutar sin importar si la petición falló o no
                    complete: function(xhr, status) {

                        console.log('Petición realizada');
                    }

                });
            }); 
        }


    </script>
    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
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
                        <a name="inicio"></a>
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
                                        echo '
                                            <li><a href="' . base_url() . 'dashboard"><i class="fas fa-book-reader"></i> Mi Panel </a>  </li>  
                                            <li><a href="' . base_url() . 'dashboard">' . $this->session->userdata('Nombre') . '</a>  </li>
                                            <li><a href="#" onclick="signOut();"> <i class="zmdi zmdi-power"></i>Cerrar Sesión</a></li>';
                                    } else {
                                        /* echo '  <li><a href="#">Registrate</a></li>
                                                    <li><a href="' . base_url() . '/login">Inicia Sesión</a></li>'; */
                                        echo '<div style="margin-top:8px" id="my-signin2"></div>';
                                    }
                                    ?>

                                </ul>
                            </div><!-- .header-bar-menu -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .container-fluid -->
            </div><!-- .top-header-bar -->