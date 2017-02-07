<?php
require_once(APPPATH."models/easymodel.php");
class Mtaxidevice extends EasyModel{
    protected $_table;
    protected $_column;
    protected $_table_area = 'list_taxi';
    //protected $_table_profile = 'car_profile';
    protected $_datareturn = array();
    public function __construct(){
        $this->_table = sprintf('%s%s', $this->db->dbprefix, 'list_taxi');
        $this->_column = array("imei", "latitude","longitude", "status", "last_update");
        parent::__construct($this->_table, $this->_column);
    }
    public function detailtxdvcs($idtaxi){
        $taxi = array();
        $data = json_decode(parent::toSearch('id_car','IS NOT NULL')->result(),TRUE);
        foreach ($data['rows'] as $e) {
            $taxi[$e['id_taxi_device']] = $e;
        }
        return isset($taxi[$idtaxi]) ? $taxi[$idtaxi] : '-';
    }
    public function getNoTaksi($idcar) {
        $sql = "select car_profile.taxi_number from device_detail JOIN car_profile ON(device_detail.id_car=car_profile.id_car) WHERE device_detail.id_car='$idcar'";
        $query = $this->db->query($sql);   
        return $query->row();
    }
    public function getAllNoTaksi() {
        $sql = "select taxi_number, id_car from car_profile where taxi_number NOT IN (select taxi_number from device_detail JOIN car_profile ON(device_detail.id_car=car_profile.id_car))";
        $query = $this->db->query($sql);   
        return $query->result();
    }
    public function NumpangQuery($TempQuery){
        $query = $this->db->query($TempQuery);
        return;
    }
    public function getTaxiNumber($id_car){
        $sql="select taxi_number from car_profile where id_car='$id_car'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function GetIDDevices(){
        $query = $this->db->query("select max(id) from devices");
        return $query->row();
    }
    public function area_read($page, $rows, $sort, $order, $searchby, $keyword)
    {
        $offset = ((intval($page) - 1 ) * intval($rows));
        $key = strtolower($keyword);

        if($searchby != '0' && $key != '0'):
			//dikomen dr sana ny     $this->_sql = sprintf("SELECT taxi_device.*, car_profile.taxi_number FROM taxi_device JOIN car_profile ON (car_profile.id_car=taxi_device.id_car) WHERE LOWER(%s) LIKE LOWER('%s') ORDER BY %s %s LIMIT %d OFFSET %d",$searchby,'%'.$keyword.'%',$sort,$order,$rows,$offset);
			//dikomen dr sana ny     $this->_sqlall = sprintf("SELECT taxi_device.*, car_profile.taxi_number FROM taxi_device JOIN car_profile ON (car_profile.id_car=taxi_device.id_car) WHERE LOWER(%s) LIKE LOWER('%s')", $searchby,'%'.$keyword.'%');
			//$this->_sql = sprintf("SELECT id, name, uniqueid, mobile, car_profile.id_car, registerdate, car_profile.taxi_number FROM device_detail JOIN car_profile ON(device_detail.id_car=car_profile.id_car) WHERE LOWER(%s) LIKE LOWER('%s') ORDER BY %s %s LIMIT %d OFFSET %d",$searchby,'%'.$keyword.'%',$sort,$order,$rows,$offset);
			//$this->_sqlall = sprintf("SELECT id, name, uniqueid, mobile, car_profile.id_car, registerdate, car_profile.taxi_number FROM device_detail JOIN car_profile ON(device_detail.id_car=car_profile.id_car) WHERE LOWER(%s) LIKE LOWER('%s')", $searchby,'%'.$keyword.'%');
			$this->_sql = sprintf("SELECT imei, latitude, longitude, status, last_update FROM list_taxi WHERE LOWER(%s) LIKE LOWER('%s') ORDER BY %s %s LIMIT %d OFFSET %d",$searchby,'%'.$keyword.'%',$sort,$order,$rows,$offset);
			$this->_sqlall = sprintf("SELECT imei, latitude, longitude, status, last_update FROM list_taxi WHERE LOWER(%s) LIKE LOWER('%s')", $searchby,'%'.$keyword.'%');
		else:
            //dikomen dr sana ny $this->_sql = sprintf("SELECT taxi_device.*, car_profile.taxi_number FROM taxi_device JOIN car_profile ON (car_profile.id_car=taxi_device.id_car) ORDER BY %s %s LIMIT %d OFFSET %d",$sort,$order,$rows,$offset);
            //dikomen dr sana ny $this->_sqlall = sprintf("SELECT taxi_device.*, car_profile.taxi_number FROM taxi_device JOIN car_profile ON (car_profile.id_car=taxi_device.id_car)") ;
            //$this->_sql = sprintf("SELECT id, name, uniqueid, mobile, car_profile.id_car, registerdate, car_profile.taxi_number FROM device_detail JOIN car_profile ON(device_detail.id_car=car_profile.id_car) ORDER BY %s %s LIMIT %d OFFSET %d",$sort,$order,$rows,$offset);
            //$this->_sqlall = sprintf("SELECT id, name, uniqueid, mobile, car_profile.id_car, registerdate, car_profile.taxi_number FROM device_detail JOIN car_profile ON(device_detail.id_car=car_profile.id_car)") ;
			$this->_sql = sprintf("SELECT imei, latitude, longitude, status, last_update FROM list_taxi ORDER BY %s %s LIMIT %d OFFSET %d",$sort,$order,$rows,$offset);
			$this->_sqlall = sprintf("SELECT imei, latitude, longitude, status, last_update FROM list_taxi") ;
		endif;
        $this->_query = $this->db->query(Controls::removewhitespace($this->_sql));
        $this->_queryall = $this->db->query(Controls::removewhitespace($this->_sqlall));
        $this->_datarow = $this->_queryall->num_rows();
        if($this->_datarow === 0) return json_encode(array('total' => '0', 'rows' => '0'));
        foreach ($this->_query->result() as $value):
            $temp = array(
				"imei" => $value->imei,
                "latitude" => $value->latitude,
                "longitude" => $value->longitude,
                "status"=>$value->status,
                "last_update"=> $value->last_update
                // "id" => $value->id,
                // "name" => $value->name,
                // "uniqueid" => $value->uniqueid,
                // "mobile" => $value->mobile,
                // "id_car"=>$value->id_car,
                // "taxi_number"=> $this->getTaxiNumber($value->id_car)->taxi_number,
                // "registerdate"=>$value->registerdate,
                // "reg_date" => Controls::format_date2($value->registerdate,"datetime")
                );
            $this->_datareturn[] = $temp;
        endforeach;
        return json_encode(array('total' => $this->_datarow, 'rows' => $this->_datareturn));
    }
    public function deleteTaxiDevice($id_taxi_device){
        $sql1="select id_car from taxi_device where id_taxi_device=$id_taxi_device";
        $query1 = $this->db->query($sql1)->row();
        $sql2="delete from taxi_request where id_taxi_device=$id_taxi_device";
        $query2 = $this->db->query($sql2);
        $sql3="delete from log_order where id_car=".$query1->id_car;
        $query3 = $this->db->query($sql3);
        $sql4="delete from customer_request where id_taxi=".$query1->id_car;
        $query4 = $this->db->query($sql4);
    }
}