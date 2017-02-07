<?php
require_once(APPPATH."models/easymodel.php");
class Mtaxireq extends EasyModel{
    public function __construct()
    {
    parent::__construct("taxi_request", array("id","json_req","json_rsp","rc","time_req","time_rsp","id_taxi_device"));
    }
}