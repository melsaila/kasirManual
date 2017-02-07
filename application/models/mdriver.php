<?php
require_once(APPPATH."models/easymodel.php");
class Mdriver extends EasyModel{
    protected $_table;
    protected $_column;
    protected $_table_area = 'driver';
    protected $_datareturn = array();
    public function __construct() {
        $this->_table = sprintf('%s%s', $this->db->dbprefix, 'driver');
        //$this->_column = array("nik","active_date_since","addrs","birthday","driver_status","marital","name","phone","sex", "taxi_number");
        $this->_column = array("nik","driverstatus","phone","statuslogin","idcom","imei_taxi","address","email","fullname","username", "urlpicture","taxi_number");
		parent::__construct($this->_table, $this->_column);
    }
    public function detailsopir($nik) {
        $list = json_decode(parent::toSelect()->result(),TRUE);
        $sopir = array();
        foreach ($list['rows'] as $e) {
            $sopir[$e['nik']] = $e;
        }
        return isset($sopir[$nik]) ? $sopir[$nik] : '-';
    }
    public function getNoTaksi($idcar) {
        $sql = "select taxi_number from driver JOIN car_profile ON(driver.taxi_number=car_profile.taxi_number) WHERE driver.taxi_number='$idcar'";
        $query = $this->db->query($sql);   
        return $query->row();
    }
    public function getKodeTaksi() {
        $sql = "select taxinumber from car_profile";
        $query = $this->db->query($sql);   
        return $query->result();
    }
    public function getTaxiNumber($taxi_number) {
        $sql = "select taxi_number from car_profile where taxi_number='$taxi_number'";
        $query = $this->db->query($sql);   
        return $query->row();
    }
    public function getAllNoTaksi() {
        $sql = "select taxi_number, taxi_number from car_profile where taxi_number NOT IN (select taxi_number from driver JOIN car_profile ON(driver.taxi_number=car_profile.taxi_number))";
        $query = $this->db->query($sql);   
        return $query->result();
    }
	
	//public function getIdComp(){
	/* 	$sql = "select idcom, name from taxi_com";
        $query = $this->db->query($sql);   
        return $query->result();
	} */
	
	public function getTaxiUseless(){
		$sql = "Select taxinumber from car_profile WHERE taxinumber<>'none' AND car_status='ST10' AND taxinumber not in 
				(select car_profile.taxinumber from car_profile, driver where driver.taxi_number = car_profile.taxinumber)";
        $query = $this->db->query($sql);   
        return $query->result();
	}
	
	public function getImei(){
		$sql = "select imei from list_taxi WHERE status='ST04'";
        $query = $this->db->query($sql);   
        return $query->result();
	}
	
	public function updateStatusTaxi($taxinumber){
		$sql = "update car_profile SET car_status='ST11' WHERE taxinumber=$taxinumber";
        $query = $this->db->query($sql);   
        return $query->result();
	}
	
    public function area_read($page, $rows, $sort, $order, $searchby, $keyword)
    {
        $offset = ((intval($page) - 1 ) * intval($rows));
        $key = strtolower($keyword);

        if($searchby != '0' && $key != '0'):
            $this->_sql = sprintf("SELECT * FROM %s WHERE LOWER(%s) LIKE LOWER('%s') ORDER BY %s %s LIMIT %d OFFSET %d",$this->_table_area,$searchby,'%'.$keyword.'%',$sort,$order,$rows,$offset);
            $this->_sqlall = sprintf("SELECT * FROM %s WHERE LOWER(%s) LIKE LOWER('%s')", $this->_table_area,$searchby,'%'.$keyword.'%');
        else:
            $this->_sql = sprintf("SELECT * FROM %s ORDER BY %s %s LIMIT %d OFFSET %d",$this->_table_area,$sort,$order,$rows,$offset);
            $this->_sqlall = sprintf("SELECT * FROM %s",$this->_table_area) ;
        endif;
        $this->_query = $this->db->query(Controls::removewhitespace($this->_sql));
        $this->_queryall = $this->db->query(Controls::removewhitespace($this->_sqlall));
        $this->_datarow = $this->_queryall->num_rows();
        if($this->_datarow === 0) return json_encode(array('total' => '0', 'rows' => '0'));
        foreach ($this->_query->result() as $value):
                $temp = array(
				"nik" => $value->nik,
				"driverstatus" => $value->driverstatus,
				"imei_taxi" =>$value->imei_taxi,
				"phone" => $value->phone,
				"statuslogin" => $value->statuslogin,
				"idcom" => $value->idcom,
				"address" => $value->address,
				"email" => $value->email,
				"fullname" => $value->fullname,
				"username" => $value->username, 
				"urlpicture" => $value->urlpicture
                // "nik" => $value->nik,
                // "active_date_since" => $value->active_date_since,
                // "addrs" => $value->addrs,
                // "birthday" => Controls::format_date3($value->birthday,'datetime'),
                // "birthdayTemp"=>$value->birthday,
                // "driver_status" => $value->driver_status,
                // "marital" => $value->marital,
                // "name" => $value->name,
                // "phone" => $value->phone,
                // "sex" => $value->sex,
                // "taxi_number"=>$value->taxi_number,
                // "taxi_number" => $this->getNoTaksi($value->taxi_number)->taxi_number
                );
            $this->_datareturn[] = $temp;
        endforeach;
        return json_encode(array('total' => $this->_datarow, 'rows' => $this->_datareturn));
    }
}
