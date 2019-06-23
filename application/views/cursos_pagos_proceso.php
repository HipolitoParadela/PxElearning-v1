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
                    
                    

                </div><!-- .col -->
            </div><!-- .row -->
        </div>

    </div>

</div><!-- .container -->
<!-- Modal -->

<?php
include("aa_pie.php");
?>