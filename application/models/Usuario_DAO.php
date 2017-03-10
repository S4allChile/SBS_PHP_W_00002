<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_DAO
 *
 * @author pfrias
 */
class Usuario_DAO extends CI_Model {
   
    public function __construct() {
        parent::__construct();
        
        $this->dbEntel = $this->load->database('WebEntel',TRUE);
    }
    
    public function validaLogin($user,$pass){
        
        $this->dbEntel->SELECT('*');
        $this->dbEntel->FROM('usuarios');
        $this->dbEntel->WHERE('username',$user);
        $this->dbEntel->WHERE('pass',$pass);
        $sql = $this->dbEntel->get();
        
        return $sql->row();
        
        
    }
    
}
