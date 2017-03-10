

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Tickets en los que participo</h3>
                </div>
                <div class="panel-body">
                  
                    
                    <div class="well"> 
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>NUMERO</th>
                                    <th>STATUS</th>
                                    <th>TIPO</th>
                                    <th>CREACION</th>
                                    <th>UTIMA ACTIVIDAD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <p>esasasxasdxasd</p> 
                        <hr>
                        <div class="clearfix"><button class="btn btn-primary btn-xs pull-right">Revisar</button></div>
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
