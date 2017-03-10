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
}
