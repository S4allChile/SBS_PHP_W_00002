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
class Ticket extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        
        $this->load->view('ticket');
    }
    
    public function escritorio(){
        
        $this->load->view('template/header');
        $this->load->view('escritorio');
    }
    
    public function newTicket(){
        
        $this->load->view('template/header');
        $this->load->view('newTicket');
        
    }
  
}
