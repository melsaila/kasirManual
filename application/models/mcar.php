<?php
require_once(APPPATH.'models/easymodel.php');
class Mcar extends EasyModel{
    protected $_table;
    protected $_column;
        //protected $_table_area = 'driver';
		protected $_table_area = 'car_profile';
		protected $_table_profile = 'driver';
        protected $_datareturn = array();
    public function __construct(){
        //$this->_table = sprintf('%s%s', $this->db->dbprefix, 'driver');
		$this->_table = sprintf('%s%s', $this->db->dbprefix, 'car_profile');
        //$this->_column = array("nik","driverstatus","phone","policenumber","statuslogin","taxinumber","imei_taxi",
							//"idcom","address","email","fullname","username","urlpicture");
		$this->_column = array("taxinumber","car_status","policenumber","product_year","typical_car","idcom");
        parent::__construct($this->_table, $this->_column);
    }
    public function detailcar($idcar){
        $dt = json_decode(parent::toSelect()->result(),TRUE);
        $car = array();
        foreach ($dt['rows'] as $ke) {
            $car[$ke['nik']] = $ke;
        }
        return isset($car[$idcar]) ? $car[$idcar] : '-';
    }
    public function AmbilNoTaksi(){
         $this->_table = sprintf('%s%s', $this->db->dbprefix, 'driver');
		 $this->_column = array("nik","taxinumber");
        //$this->_column = array("id_car","taxi_number","typical_car");
        parent::__construct($this->_table, $this->_column);
    }
    public function area_read($page, $rows, $sort, $order, $searchby, $keyword)
    {
        $offset = ((intval($page) - 1 ) * intval($rows));
        $key = strtolower($keyword);

        // if($searchby != '0' && $key != '0'):
            // $this->_sql = sprintf("SELECT * FROM %s WHERE id_car!=0 AND LOWER(%s) LIKE LOWER('%s') ORDER BY %s %s LIMIT %d OFFSET %d",$this->_table_area,$searchby,'%'.$keyword.'%',$sort,$order,$rows,$offset);
            // $this->_sqlall = sprintf("SELECT * FROM %s WHERE id_car!=0 AND LOWER(%s) LIKE LOWER('%s')", $this->_table_area,$searchby,'%'.$keyword.'%');
        // else:
            // $this->_sql = sprintf("SELECT * FROM %s WHERE id_car!=0 ORDER BY %s %s LIMIT %d OFFSET %d",$this->_table_area,$sort,$order,$rows,$offset);
            // $this->_sqlall = sprintf("SELECT * FROM %s WHERE id_car!=0",$this->_table_area) ;
			
		if($searchby != '0' && $key != '0'):
            $this->_sql = sprintf("SELECT *,c.policenumber FROM %s c LEFT JOIN driver d ON d.taxi_number=c.taxinumber WHERE c.taxinumber!='0' AND LOWER(%s) LIKE LOWER('%s') ORDER BY %s %s LIMIT %d OFFSET %d",$this->_table_area,$searchby,'%'.$keyword.'%',$sort,$order,$rows,$offset);
            $this->_sqlall = sprintf("SELECT *,c.policenumber FROM %s c LEFT JOIN driver d ON d.taxi_number=c.taxinumber WHERE c.taxinumber!='0' AND LOWER(%s) LIKE LOWER('%s')", $this->_table_area,$searchby,'%'.$keyword.'%');
        else:
            $this->_sql = sprintf("SELECT *,c.policenumber FROM %s c LEFT JOIN driver d ON d.taxi_number=c.taxinumber WHERE c.taxinumber!='0' ORDER BY %s %s LIMIT %d OFFSET %d",$this->_table_area,$sort,$order,$rows,$offset);
            $this->_sqlall = sprintf("SELECT *,c.policenumber FROM %s c LEFT JOIN driver d ON d.taxi_number=c.taxinumber WHERE c.taxinumber!='0'",$this->_table_area) ;	
        endif;
        $this->_query = $this->db->query(Controls::removewhitespace($this->_sql));
        $this->_queryall = $this->db->query(Controls::removewhitespace($this->_sqlall));
        $this->_datarow = $this->_queryall->num_rows();
        if($this->_datarow === 0) return json_encode(array('total' => '0', 'rows' => '0'));
        foreach ($this->_query->result() as $value):
            $this->_datareturn[] = $value;
        endforeach;
        return json_encode(array('total' => $this->_datarow, 'rows' => $this->_datareturn));
    }
}