<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ticket SBS</title>
        
        
        <link href="<?= base_url(); ?>vendors/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url(); ?>vendors/vanadium/vanadium.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url(); ?>vendors/css/propio.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <div class="modal_ajax">CARGANDO....</div>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">TICKETS DE SOPORTE</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <form id="frmLogin" method="post" class="navbar-form navbar-right">
            <div class="form-group">
                <input type="text" name="user" placeholder="Email" class="form-control :required :email">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Contraseña" class="form-control :required">
            </div>
            <button type="submit" class="btn btn-success">Ingresar</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Sistema de Tickets</h1>
        <p>Ingrese su correo y contraseña para revisar y crear tickets de soporte </p>
        
      </div>
    </div>

    


    <!--  JavaScript
    ================================================== -->
    <script src="<?= base_url(); ?>vendors/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>vendors/bootstrap-3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>vendors/vanadium/vanadium.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#frmLogin').submit(function(e){
                e.preventDefault();
                var dato = $(this).serialize();
                
                $.ajax({
                        data:  dato,
                        url:   '<?= base_url(); ?>index.php/ajax/validaLogin',
                        type:  'post',
                        beforeSend: function () {
                                $('body').addClass('loading');                    
                            },
                        success:  function (response) {
                                $('body').removeClass('loading');
                                
                                switch(response){
                                    
                                    case '0':
                                        alert('Usuario o contraseña incorrecto');
                                        break;
                                    
                                    case '1':
                                        window.location.replace('<?= base_url(); ?>index.php/ticket/escritorio');
                                        break;
                                }
                        },
                        error: function(e){
                            $('body').removeClass('loading');
                            alert('ERROR AJAX: '+e);

                        }
                    });

                
                
            });
        });
    </script>
        
    
  </body>
</html>
