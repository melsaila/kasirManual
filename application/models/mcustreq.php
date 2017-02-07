<?php
require_once(APPPATH."models/easymodel.php");
class Mcustreq extends EasyModel{
	protected $_table;
    protected $_column;
    public function __construct()
    {
    	$this->_table = sprintf('%s%s', $this->db->dbprefix, 'req_taxi_status');
        //$this->_column = array("id_req_taxi","imei","addrs_pickup","cause","addrs_clue","notif","idorder","json_req","json_rsp","latitude","longitude","name","phone_number","status_confirm","time_req","time_rsp","id_car", "description", "time_operator_response");
		$this->_column = array("idorder","status","id_request");
        parent::__construct($this->_table, $this->_column);
    //parent::__construct("customer_request",array("id_req_taxi","addrs_pickup","addrs_clue","customer_random_id","json_req","json_rsp","latitude","longitude","name","phone_number","rc","time_req","time_rsp","id_customer","id_taxi"));
    }
    public function getUnread(){
        $sql = "select notif FROM customer_request where notif=0";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    public function getUnreadToRead(){
        $sql = "update customer_request SET notif=1 where notif=0";
        $query = $this->db->query($sql);
        return;
    }
    public function getLatLongKonsumen(){
        $sql = "select cus.name, cus.id_req_taxi, cus.latitude, cus.longitude, cus.phone_number, car.taxi_number from customer_request cus JOIN car_profile car ON (cus.id_car=car.id_car) where cus.status_confirm='90' or cus.status_confirm='00'";
        $query = $this->db->query($sql);
        return $query->result();
    }

}
