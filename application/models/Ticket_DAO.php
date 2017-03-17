<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ticket
 *
 * @author pfrias
 */
class Ticket_DAO extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function buscaTicketPedido($pedido,$ano){
        
        $this->db->SELECT('*');
        $this->db->FROM('encabezado_ticket');
        $this->db->WHERE('num_pedido',$pedido."-".$ano);
        $sql = $this->db->get();
        
        return $sql->row();
        
    }
    
    public function buscaDetalleTicket($idTicket){
        
        $this->db->SELECT('*');
        $this->db->FROM('detalle_ticket');
        $this->db->WHERE('id_enc_ticket',$idTicket);
        $sql = $this->db->get();
        
        return $sql->result();
    }
    
    
    public function listaPersonal(){
        
        $this->db->SELECT('*');
        $this->db->FROM('personal');
        $sql = $this->db->get();
        
        return $sql->result();
    }
    
    public function addEncabezadoTicket($valores){
        
        if($this->db->INSERT('encabezado_ticket',$valores) > 0){
            
            return $this->db->insert_id();
            
        }else{
            
            return 0;
        }
    }
    
    public function addDetalleTicket($valores){
        
        if($this->db->INSERT('detalle_ticket',$valores) > 0){
            
            return TRUE;
            
        } else {
            
            return FALSE ;
            
        }
        
    }
    
    public function nuevoCorrelativo($tipo){
        
        $this->db->SELECT_MAX('correlativo');
        $this->db->FROM('correlativo');
        $this->db->WHERE('tipo_correlativo',$tipo);
        $sql = $this->db->get();
        
        $res = $sql->row();
        
        $actual = $res->correlativo;
        $nuevo = $actual+1;
        $valores = array(
            'correlativo' => $nuevo
        );
        $this->db->where('tipo_correlativo', $tipo);
        $this->db->update('correlativo', $valores);
        
        return $nuevo;
        
        
    }
    
    public function buscaUsuarioIdUsuario($idUsuario){
        
        $this->db->SELECT('*');
        $this->db->FROM('personal');
        $this->db->WHERE('id_usuario',$idUsuario);
        $sql = $this->db->get();
        
        return $sql->row();
    }
    
    public function buscaUsuarioIdPersonal($idPersonal){
        
        $this->db->SELECT('*');
        $this->db->FROM('personal');
        $this->db->WHERE('id_personal',$idPersonal);
        $sql = $this->db->get();
        
        return $sql->row();
    }
    
    // -------------------------------------------------------------------------
    
    /**
     * Busca segun el id del usuario, en los detalles de un ticket, los
     * encabezados en los que el usuario participa.
     * 
     * 
     * @author Pablo Frias Carter <pablo.frias@tgpinversiones.cl>
     * @since version 1.0.1
     * 
     * @param int $idUsr
     * @return array
     */
    
    public function buscaTicketUsuario($idUsr){
        
        $this->db->SELECT('id_enc_ticket');
        $this->db->FROM('detalle_ticket');
        $this->db->WHERE('usuario_crea',$id_Usr);
        $this->db->GROUP_BY('id_enc_ticket');
        $sql = $this->db->get();
        
        return $sql->result();
                
        
    }
    
    // -------------------------------------------------------------------------
    
    
    // -------------------------------------------------------------------------
    
    /**
     * Busca segun el id del encabezado de ticket, el ultimo detalle ingresado
     * de un ticket 
     * 
     * 
     * @author Pablo Frias Carter <pablo.frias@tgpinversiones.cl>
     * @since version 1.0.1
     * 
     * @param int $idticket
     * @return array(1 registro)
     */
    
    public function buscaUtimoComentario($idTicket){
        
        $this->db->SELECT('*');
        $this->db->SELECT_MAX('id_detalle_ticket');
        $this->db->FROM('detalle_ticket');
        $this->db->WHERE('id_enc_ticket',$idTicket);
        $sql = $this->db->get();
        
        return $sql->row();
                
        
    }
    
    // -------------------------------------------------------------------------
    
    
    // -------------------------------------------------------------------------
    
    /**
     * Busca los datos del encabezado de un ticket X id del encabezado
     * 
     * 
     * 
     * @author Pablo Frias Carter <pablo.frias@tgpinversiones.cl>
     * @since version 1.0.1
     * @date 16-03-2017
     * 
     * @param int $idticket
     * @return array (1 registro)
     */
    
    public function buscaEncTicket($idTicket){
        
        $this->db->SELECT('*');
        $this->db->FROM('encabezado_ticket');
        $this->db->WHERE('id_enc_ticket',$idTicket);
        $sql = $this->db->get();
        
        return $sql->row();
                
        
    }
    
    // -------------------------------------------------------------------------
    
    
}
