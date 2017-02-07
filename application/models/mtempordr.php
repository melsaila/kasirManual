<?php
require_once(APPPATH."models/easymodel.php");
class Mtempordr extends EasyModel{
    public function __construct()
    {
        parent::__construct("temp_order",array("id_assgn_order","id_temp_order","timecreate","id_req_taxi","id_taxi_device","queue"));
    }
}
