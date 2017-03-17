<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ajax
 *
 * @author pfrias
 */
class Ajax extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('ticket_DAO');
        //$this->output->enable_profiler(TRUE); 
    }
    
    public function validaLogin(){
        //Cargamos el modelo
        $this->load->model('usuario_DAO');
        //Capturamos las variables
        $user = $this->input->post('user');
        $pass = $this->input->post('password');
        
        //encriptamos la contraseña
        $pass = sha1($pass);
        //llevamos a minisculas el usuario
        $user = strtolower($user);
        
        $validacion = $this->usuario_DAO->validaLogin($user,$pass);
        
        if(empty($validacion)){
            
            echo 0;
            
        }else{
            //inicio las sesiones
            $this->session->set_userdata('idUsr',$validacion->id_usr);
            $this->session->set_userdata('nomUsr',$validacion->nombre_usr);
            $this->session->set_userdata('emailUsr',$validacion->email);
            
            echo 1;
        }
        
    }
    
    public function par($valor){
        
        if($valor%2 == 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function buscaTicket(){
        
        
        //capturo el valor
        $valor = $this->input->post('pedAno');

        //divido valor para ver si tiene el año
        $pedAno = explode('-', $valor);
        if(count($pedAno) > 1){
            $ped = $pedAno[0];
            $ano = $pedAno[1];
        }else{
            $ped = $pedAno[0];
            $ano = date('Y');
        }
        
        //Buscamos si el pedido ya tiene movimientos
        $ticket = $this->ticket_DAO->buscaTicketPedido($ped,$ano);
        
        if(!empty($ticket)){
            //Busco el detalle del ticket
            $detalles = $this->ticket_DAO->buscaDetalleTicket($ticket->id_ticket);
            
            if(!empty($detalles)){
                
                echo '<div class="container">';
                        echo '<div class="page-header">';
                        echo    '<h1 id="timeline">Detalle Ticket Nº '.$ticket->num_ticket.'</h1> ';
                        echo '</div>';
                        echo '<ul class="timeline">';
                $con = 1;
                foreach ($detalles AS $detalle){
                    
                    if($this->par($con)){
                        
                        $posicion = "timeline-inverted";
                        
                    }else{
                        
                        $posicion = "";
                    }
                    
                    
                    
                    
                    echo '<li class="'.$posicion.'">';
                        echo '<div class="timeline-badge warning"><i class="glyphicon glyphicon-check"></i></div>';
                        echo '<div class="timeline-panel">';
                            echo '<div class="timeline-heading">';
                                echo '<h4 class="timeline-title">'.$detalle->nombre_creador.'</h4>';
                                echo '<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> '.$detalle->fecha_detalle.'</small></p>';
                            echo '</div>';
                            echo '<div class="timeline-body">';
                                echo '<p>'.$detalle->detalle_ticket.'</p>';
                            echo '</div>';
                        echo '</div>';
                    echo '</li>';
                        
                            
                    $con++;        
                    
                    
                }
                
                    echo '</ul>';
                    echo '<hr/>';
                    echo '<button class="btn btn-danger" id="comentario">Agregar Comentario</button>';
                echo ' </div>';
            }
            
        }else{
            echo 0;
        }

    }
    
    public function nuevoTicket(){
        
        //Capturo las variables
        
        $valor = $this->input->post('pedido');
        $pedAno = explode('-', $valor);
        if(count($pedAno) > 1){
            $ped = $pedAno[0];
            $ano = $pedAno[1];
        }else{
            $ped = $pedAno[0];
            $ano = date('Y');
        }
        
        //Valido si ya existe un encabezado
        $ticket = $this->ticket_DAO->buscaTicketPedido($ped,$ano);
        if(empty($ticket)){
        
        
        //Solicito correlativo
        $numero = $this->ticket_DAO->nuevoCorrelativo('TICKET');
        
        
        
        $dtoUsuario = $this->ticket_DAO->buscaUsuarioIdUsuario($this->session->idUsr);
        
        $encabezado = array(
            'num_ticket' => $numero,
            'fecha_crea' => date('Y-m-d H:i:s'),
            'id_usuario_crea' => $this->session->idUsr,
            'id_usuario_asignado' => $this->input->post('asignado'),
            'asunto' => $this->input->post('descripcion'),
            'estado' => 1,
            'codigo_directo' => token(),
            'num_pedido' => $ped."-".$ano,
            'mail_creador' => $dtoUsuario->email_personal,
            'nombre_creador' => $dtoUsuario->nombre_personal
        );
        
        $idEncabezado = $this->ticket_DAO->addEncabezadoTicket($encabezado);
        }else{
            
            $idEncabezado = $ticket->id_ticket;
            
        }
        if($idEncabezado == 0){
            
            echo 0; //PROBLEMAS AL INGRESAR EL ENCABEZADO del TICKET
            
        }else{
            //Agregamos el detalle del ticket
            $datoAsignado = $this->ticket_DAO->buscaUsuarioIdPersonal($this->input->post('asignado'));
            $dtoUsuario = $this->ticket_DAO->buscaUsuarioIdUsuario($this->session->idUsr);
            $detalle = array(
                'detalle_ticket' => $this->input->post('detalle'),
                'usuario_crea' => $this->session->idUsr,
                'fecha_detalle' => date('Y-m-d H:i:s'),
                'id_enc_ticket' => $idEncabezado,
                'estado' => 1,
                'id_asignado' => $this->input->post('asignado'),
                'nombre_asignado' => $datoAsignado->nombre_personal,
                'email_asignado' => $datoAsignado->email_personal,
                'email_creador' => $dtoUsuario->email_personal,
                'nombre_creador' => $dtoUsuario->nombre_personal
                
            );
            
            if($this->ticket_DAO->addDetalleTicket($detalle)){
                
                echo 1; //TICKET INGRESADO SIN PROBLEMAS
                
            }else{
                
                echo 2; //PROBLEMAS AL INGRESAR EL DETALLE DEL TICKET
                
            }
            
        }
        
        
    }
}
