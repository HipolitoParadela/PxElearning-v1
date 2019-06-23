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

<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-12">
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
                <div class="col-12">
                    
                    
                    
                    
                    
                    
                    
                    
                    <?php
                        echo 'Collection_id: ';
                        echo $_GET["collection_id"];
                        "<br> collection_status: ";
                        echo $_GET["collection_status"];
                        "<br>preference_id: ";
                        echo $_GET["preference_id"];
                        "<br>external_reference: ";
                        echo $_GET["external_reference"];
                        "<br>payment_type: ";
                        echo $_GET["payment_type"];
                        "<br>merchant_order_id: ";
                        echo $_GET["merchant_order_id"];
                    ?>
                    collection_id=4888990607&collection_status=approved&preference_id=391624298-85ac2f3b-3166-40fa-8fb1-66e5aee88801&external_reference=prueba&payment_type=credit_card&merchant_order_id=1116999819


                    En las próximas 24hs te asignaremos un profesor para que puedas comenzar con el cursado de "Community Manager".

                    NO MOSTRAR EL BOTON DE COMPRAR SIN ANTES HABERSE REGISTRADO. 

                    PONER EL LISTADO DE TODOS LOS CURSOS EN EL DASHBOARD DE LOS REGISTRADOS


                    usando la referencia externa, el estado del pago y el Id de la persona registrada ya puedo crear el vinculo con el curso_alumno

                <a href="#"> ir a tu panel de alumno</a>
                   

                </div><!-- .col -->
            </div><!-- .row -->
        </div>


    </div>

</div><!-- .container -->
<!-- Modal -->

<?php
include("aa_pie.php");
?>