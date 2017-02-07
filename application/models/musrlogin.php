<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'models/easymodel.php');
class Musrlogin extends EasyModel{
    public function __construct()
    {
        parent::__construct("user_company",array("username","password","userrole"));
    }
    public function dologin($username, $password){}
}
