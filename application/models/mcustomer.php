<?php
require_once(APPPATH."models/easymodel.php");
class Mcustomer extends EasyModel{
    public function __construct(){
        parent::__construct("customer",array("id_customer","imei","mobile_number","name"));
    }
}
