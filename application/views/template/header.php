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
        <link href="<?= base_url(); ?>vendors/summernote/summernote.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url(); ?>vendors/css/timeline.css" rel="stylesheet" type="text/css"/>
    </head>
    <div class="modal_ajax">CARGANDO....</div>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">TICKETS DE SOPORTE</a>
          
          <form class="navbar-form navbar-left" action="<?= base_url() ?>/index.php/ticket/newTicket" method="post">
            <div class="form-group">
                <select class="form-control :required" >
                    <option value="">Seleccione tipo ticket</option>
                    <option value="1">Problemas notas de peddio</option>
                </select>
            </div>
            <button type="submit" class="btn btn-danger">Crear Ticket</button>
          </form>
          
          <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Numero Ticket">
            </div>
            <button type="submit" class="btn btn-success">Buscar</button>
          </form>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->session->nomUsr; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Salir</a></li>
              </ul>
            </li>
            </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>