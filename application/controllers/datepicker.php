<?php
require_once(APPPATH.'controllers/controls.php');
class Datepicker extends CI_Controller{
	function __construct(){
    parent::__construct();
    }
    public function index(){
        $this->load->view->('datepicker');
    }
}