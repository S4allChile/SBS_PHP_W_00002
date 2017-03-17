

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Nuevo Ticket</h3>
                </div>
                <div class="panel-body">
                  
                    
                    <div class="well"> 
                        <form id="frmPedido" method="post">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <input type="text" name="pedAno" id="pedAno" class="form-control" placeholder="Numero-Año pedido">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Aceptar" class="btn btn-success" />
                                
                            </div>
                            <small>Pedidos del año en curso solo ingrese numero</small>
                        </form>
                        
                  </div> 
                    
                    <div id="ingreso" class="hidden">
                    <div class="well">
                        <div class="alert alert-info" role="alert">El pedido ingresado no tiene registro de actividad</div>
                        <form id="frmIngreso" method="post" name="frmIngreso">
                            <input type="hidden" id="pedido" name="pedido" >
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Enviar a </label>
                                <select class="form-control" name="asignado">
                                    <option value="">Ingrese Persona</option>
                                    <?php
                                        foreach ($personal AS $persona){
                                    ?>
                                    <option value="<?= $persona->id_personal; ?>"><?= $persona->nombre_personal; ?></option>
                                        <?php } ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Descripcion </label>
                                <input type="text" name="descripcion" class="form-control" onKeyUp="frmIngreso.descripcion.value=frmIngreso.descripcion.value.toUpperCase()" />

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Detalle </label>
                                        <textarea class="form-control" name="detalle" id="txaDetalle"></textarea>
                                    </div>
                                </div>
                            </div>

                            <hr/>
                            <input type="submit" class="btn btn-success" value="Guardar" />
                        </form>
                    </div>
                    </div>
                    
                    <div id="resultado">
               
                        
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
    <script src="<?= base_url(); ?>vendors/summernote/summernote.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            
            $('#txaDetalle').summernote({
                height: 250
            });
            
            $('#frmPedido').submit(function(e){
                e.preventDefault();
                var dato = $(this).serialize();
                
                $.ajax({
                        data:  dato,
                        url:   '<?= base_url(); ?>index.php/ajax/buscaTicket',
                        type:  'post',
                        beforeSend: function () {
                                $('body').addClass('loading');                    
                            },
                        success:  function (response) {
                                $('body').removeClass('loading');
                                
                                if(response == 0){
                                    
                                    $('#resultado').addClass('hidden');
                                    $('#ingreso').removeClass('hidden');
                                    $('#pedido').val($('#pedAno').val());
                                    
                                }else{
                                    $('#ingreso').addClass('hidden');
                                    $('#resultado').removeClass('hidden');
                                    $('#resultado').html(response);
                                }
                                
                        },
                        error: function(e){
                            $('body').removeClass('loading');
                            alert('ERROR AJAX: '+e);

                        }
                });
            });
            
            
            $('#frmIngreso').submit(function(e){
                e.preventDefault();
                var dato = $(this).serialize();
                var ped = $('#pedido').val();
                
                $.ajax({
                        data:  dato,
                        url:   '<?= base_url(); ?>index.php/ajax/nuevoTicket',
                        type:  'post',
                        beforeSend: function () {
                                $('body').addClass('loading');                    
                            },
                        success:  function (response) {
                                $('body').removeClass('loading');
                                
                                switch(response){
                                    
                                    case '0':
                                        alert('EL TICKET NO PUDO SER INGRESADO INTENTE NUEVAMENTE');
                                        break;
                                    case '1':
                                        
                                        $.ajax({
                                                data:  'pedAno='+ped,
                                                url:   '<?= base_url(); ?>index.php/ajax/buscaTicket',
                                                type:  'post',
                                                beforeSend: function () {
                                                        $('body').addClass('loading');                    
                                                    },
                                                success:  function (response) {
                                                        $('body').removeClass('loading');

                                                        if(response == 0){

                                                            $('#resultado').addClass('hidden');
                                                            $('#ingreso').removeClass('hidden');
                                                            $('#pedido').val($('#pedAno').val());

                                                        }else{
                                                            $('#ingreso').addClass('hidden');
                                                            $('#resultado').removeClass('hidden');
                                                            $('#resultado').html(response);
                                                            $('#frmIngreso')[0].reset();
                                                        }

                                                },
                                                error: function(e){
                                                    $('body').removeClass('loading');
                                                    alert('ERROR AJAX: '+e);

                                                }
                                        });
                                        
                                        
                                        
                                        break;
                                        
                                    case '2':
                                        alert('NO SE PUDO INGRESAR EL DETALLE DEL TICKET');
                                        break;    
                                    
                                }
                                
                        },
                        error: function(e){
                            $('body').removeClass('loading');
                            alert('ERROR AJAX: '+e);

                        }
                });
            });
            
            $('body').on('click','#comentario',function(){
                
                $('#ingreso').removeClass('hidden');
                $('#pedido').val($('#pedAno').val());
            });
            
            
            
            
            
            
            
            
        });
    </script>
        
    
  </body>
</html>
