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
                    <h1>LISTADO DE USUARIOS</h1>
                </header><!-- .entry-header -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div><!-- .page-header-overlay -->
</div><!-- .page-header -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumbs">
                <ul class="flex flex-wrap align-items-center p-0 m-0">
                    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                    <li>Listado de usuarios</li>
                </ul>
            </div><!-- .breadcrumbs -->
        </div><!-- .col -->
    </div><!-- .row -->

    <div class="row justify-content-between">
        <div class="col-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Launch demo modal
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div><!-- .col -->

        <div class="col-12 col-lg-6">
            <div class="contact-form">
                <h3>Contact Form</h3>

                <form>
                    <input type="text" placeholder="Your Name">
                    <input type="email" placeholder="Your Email">
                    <input type="text" placeholder="Subject">
                    <textarea placeholder="Your Message" rows="4"></textarea>
                    <input type="submit" value="Send Message">
                </form>
            </div><!-- .contact-form -->
        </div><!-- .col -->

        <div class="col-12 col-lg-6">
            <div class="contact-info">
                <h3>Contact Information</h3>

                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia dese mollit anim id est
                    laborum. </p>

                <ul class="p-0 m-0">
                    <li><span>Location:</span>40 Baria Sreet 133/2 NewYork City, US</li>
                    <li><span>Email:</span><a href="#">info.deeercreative@gmail.com</a></li>
                    <li><span>Phone:</span><a href="#">(203) 123-6666</a></li>
                </ul>
            </div><!-- .contact-info -->
        </div><!-- .col -->
    </div><!-- .row -->

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
        Launch demo modal D
    </button>

    <!-- Modal -->
    <div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div><!-- .container -->
<!-- Modal -->

<?php
include("aa_pie.php");
?>