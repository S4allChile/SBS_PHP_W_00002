

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Nuevo Ticket</h3>
                </div>
                <div class="panel-body">
                  
                    
                    <div class="well"> 
                        <form>
                            
                            <input type="text" id="pedido" class="form-control" placeholder="Numero-Año pedido">
                            <input type="submit" value="Aceptar" class="btn btn-success" />
                        </form>
                        
                  </div> 
                    
                    
                    
                    
                </div>
            </div>
        </div>
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
                        data:  parametros,
                        url:   'index.php/ajax/validaLogin',
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
                                        window.location.replace('index.php/aplicacion/escritorio');
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
