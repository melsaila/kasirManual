<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'models/easymodel.php');
class Mwuser extends EasyModel{
    protected $_table;
    protected $_column;
    public function __construct() {
        $this->_table = sprintf('%s%s', $this->db->dbprefix, 'user_company');
        $this->_column = array('id','created','last_login','password','status','username_company','userrole');
        parent::__construct($this->_table, $this->_column);
    }
}