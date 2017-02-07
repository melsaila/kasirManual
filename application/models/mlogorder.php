<?php
require_once(APPPATH."models/easymodel.php");
class Mlogorder extends EasyModel{
    protected $_table;
    protected $_column;
    protected $_datareturn = array();
    public function __construct()
    {
        $this->_table = sprintf('%s%s', $this->db->dbprefix, 'log_transaksi');
        //$this->_column = array("id_log_order","extension","id_temp_order","timecreate","custreq_id_req_taxi", "id_car");
        $this->_column = array("id_log_trx","company_taxi","email_cust","end_location","id_req","imei_taxi","req","respon","start_location","time_end","time_start","driver_name");
		parent::__construct($this->_table, $this->_column);
    }
    public function getKodeTaksi($idcar) {
        //$sql = "select car_profile .taxi_number from car_profile JOIN customer_request ON(car_profile.id_car=customer_request.id_car) WHERE car_profile .id_car='$idcar'";
        $query = $this->db->query($sql);  
        return $query->row();
    }
    public function getKodeTaksi2($idcar) {
        $sql = "select car_profile .taxi_number from car_profile JOIN customer_request ON(car_profile.id_car=customer_request.id_car) WHERE car_profile .id_car='$idcar'";
        $query = $this->db->query($sql);   
        return $query->row();
    }
    public function getListRC() {
        $sql = "select * from rc_map";
        $query = $this->db->query($sql);   
        return json_encode($query->result());
    }
    public function getIDCar($taxi_number){
        $sql = "select id_car FROM car_profile where taxi_number='$taxi_number'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function area_read($page, $rows, $sort, $order, $searchby, $keyword, $ResponseCode)
    {
        $offset = ((intval($page) - 1 ) * intval($rows));
        $key = strtolower($keyword);

        if($searchby != '0' && $key != '0'):
            //dr sananya
			//$this->_sql = sprintf("SELECT log_order.* from log_order where log_order.status='%s' AND LOWER(%s) LIKE LOWER('%s') ORDER BY %s %s LIMIT %d OFFSET %d",$ResponseCode, $searchby,'%'.$keyword.'%',$sort,$order,$rows,$offset);
            
			$this->_sql = sprintf("SELECT * from log_transaksi where respon='%s' AND LOWER(%s) LIKE LOWER('%s') ORDER BY %s %s LIMIT %d OFFSET %d",$ResponseCode, $searchby,'%'.$keyword.'%',$sort,$order,$rows,$offset);
			
			//dr sananya
			//$this->_sqlall = sprintf("SELECT log_order.* from log_order where log_order.status='%s' AND LOWER(%s) LIKE LOWER('%s')", $ResponseCode,$searchby,'%'.$keyword.'%');
			
			$this->_sqlall = sprintf("SELECT * from log_transaksi where respon='%s' AND LOWER(%s) LIKE LOWER('%s')", $ResponseCode,$searchby,'%'.$keyword.'%');
			
        else:
            //$this->_sql = sprintf("SELECT log_order.* from log_order where log_order.status='%s' ORDER BY %s %s LIMIT %d OFFSET %d",$ResponseCode, $sort,$order,$rows,$offset);
			
			$this->_sql = sprintf("SELECT * from log_transaksi where respon='%s' ORDER BY %s %s LIMIT %d OFFSET %d",$ResponseCode, $sort,$order,$rows,$offset);
            //$this->_sqlall = sprintf("SELECT log_order.* from log_order where log_order.status='%s'", $ResponseCode);
			
			$this->_sqlall = sprintf("SELECT * from log_transaksi where respon='%s'", $ResponseCode);
        endif;
        $this->_query = $this->db->query(Controls::removewhitespace($this->_sql));
        $this->_queryall = $this->db->query(Controls::removewhitespace($this->_sqlall));
        $this->_datarow = $this->_queryall->num_rows();
        //$temp=array();
        if($this->_datarow === 0) return array('total' => '0', 'rows' => '0');
        foreach ($this->_query->result() as $value):
                //array_push($temp, array(
                $temp = array(
                "id_log_trx" => $value->id_log_trx,
				"start_location" => $value->start_location,
				"end_location" => $value->end_location,
				//"status" => sprintf('%s%s%s', '<i>', self::getDeskripsiRc($value->status)->description, '</i>'),
				"time_start" => Controls::format_date2($value->time_start,"datetime"),
				"time_end" => Controls::format_date2($value->time_end,"datetime"),
				"driver_name" => $value->driver_name
				
				// "addrs_pickup" => $value->addrs_pickup,
                // "addrs_clue" => $value->addrs_clue,
                // "idorder" => $value->idorder,
                // "latitude" => $value->latitude,
                // "longitude" => $value->longitude,
                // "name" => $value->name,
                // "phone_number" => $value->phone_number,
                // "rc" => sprintf('%s%s%s', '<i>', self::getDeskripsiRc($value->status_confirm)->description, '</i>'),

                // "time_req" => Controls::format_date2($value->time_req,"datetime"),
                // "time_rsp" => Controls::format_date2($value->time_operator_response, "datetime"),
                // "taxi_number"=>$this->getKodeTaksi($value->id_car)->taxi_number,
                // "alasan"=>$value->description
                );
            $this->_datareturn[] = $temp;
        endforeach;
        return array('total' => $this->_datarow, 'rows' => $this->_datareturn);
        //return json_encode(array('total' => $this->_datarow, 'rows' => $this->_datareturn));

    }
    public function area_read_allOrder($page, $rows, $sort, $order, $searchby, $keyword)
    {
        $offset = ((intval($page) - 1 ) * intval($rows));
        $key = strtolower($keyword);

        if($searchby != '0' && $key != '0'):
            //$this->_sql = sprintf("SELECT customer_request.* from customer_request where customer_request.status_confirm is not null AND LOWER(%s) LIKE LOWER('%s') ORDER BY %s %s LIMIT %d OFFSET %d", $searchby,'%'.$keyword.'%',$sort,$order,$rows,$offset);
			$this->_sql = sprintf("SELECT lo.id_log_order, u.username, cq.startlocation, cq.detaillocation, u.phone,
									lo.status, lo.time_create, lo.time_end, lo.nik_driver 
									FROM log_order lo 
									JOIN customer_request cq ON cq.id_cust_taxi=lo.id_req
									JOIN users u ON u.imei=cq.imei
									JOIN driver d ON d.nik=lo.nik_driver 
									WHERE cq.status is not null AND LOWER(%s) LIKE LOWER('%s') ORDER BY %s %s LIMIT %d OFFSET %d", $searchby,'%'.$keyword.'%',$sort,$order,$rows,$offset);
            //$this->_sqlall = sprintf("SELECT customer_request.* from customer_request where customer_request.status_confirm is not null AND LOWER(%s) LIKE LOWER('%s')", $searchby,'%'.$keyword.'%');
			$this->_sqlall = sprintf("SELECT lo.id_log_order, u.username, cq.startlocation, cq.detaillocation, u.phone,
									lo.status, lo.time_create, lo.time_end, lo.nik_driver 
									FROM log_order lo 
									JOIN customer_request cq ON cq.id_cust_taxi=lo.id_req
									JOIN users u ON u.imei=cq.imei
									JOIN driver d ON d.nik=lo.nik_driver 
									WHERE cq.status is not null AND LOWER(%s) LIKE LOWER('%s')", $searchby,'%'.$keyword.'%');			
        else:
            //$this->_sql = sprintf("SELECT customer_request.* from customer_request where customer_request.status_confirm is not null ORDER BY %s %s LIMIT %d OFFSET %d",$sort,$order,$rows,$offset);
			$this->_sql = sprintf("SELECT lo.id_log_order, u.username, cq.startlocation, cq.detaillocation, u.phone,
									lo.status, lo.time_create, lo.time_end, lo.nik_driver 
									FROM log_order lo 
									JOIN customer_request cq ON cq.id_cust_taxi=lo.id_req
									JOIN users u ON u.imei=cq.imei
									JOIN driver d ON d.nik=lo.nik_driver 
									WHERE cq.status is not null ORDER BY %s %s LIMIT %d OFFSET %d",$sort,$order,$rows,$offset);
            //$this->_sqlall = sprintf("SELECT customer_request.* from customer_request where customer_request.status_confirm is not null") ;
			$this->_sqlall = sprintf("SELECT lo.id_log_order, u.username, cq.startlocation, cq.detaillocation, u.phone,
									lo.status, lo.time_create, lo.time_end, lo.nik_driver 
									FROM log_order lo 
									JOIN customer_request cq ON cq.id_cust_taxi=lo.id_req
									JOIN users u ON u.imei=cq.imei
									JOIN driver d ON d.nik=lo.nik_driver 
									WHERE cq.status is not null") ;
        endif;
        $this->_query = $this->db->query(Controls::removewhitespace($this->_sql));
        $this->_queryall = $this->db->query(Controls::removewhitespace($this->_sqlall));
        $this->_datarow = $this->_queryall->num_rows();
        //$temp=array();
        if($this->_datarow === 0) return array('total' => '0', 'rows' => '0');
        foreach ($this->_query->result() as $value):
                //array_push($temp, array(
                $temp = array(
				"id_log_order" => $value->id_log_order,
				"username" => $value->username,
				"startlocation" => $value->startlocation,
				"detaillocation" => $value->detaillocation,
				"phone" => $value->phone,
				"status" => $value->status,
				"time_create" => $value->time_create,
				"time_end" => $value->time_end,
				"nik_driver" => $value->nik_driver
                // "id_req_taxi" => $value->id_req_taxi,
                // "addrs_pickup" => $value->addrs_pickup,
                // "addrs_clue" => $value->addrs_clue,
                // "idorder" => $value->idorder,
                // "latitude" => $value->latitude,
                // "longitude" => $value->longitude,
                // "name" => $value->name,
                // "phone_number" => $value->phone_number,
                // "rc" => sprintf('%s%s%s', '<i>', self::getDeskripsiRc($value->status_confirm)->description, '</i>'),

                // "time_req" => Controls::format_date2($value->time_req,"datetime"),
                // "time_rsp" => Controls::format_date2($value->time_operator_response, "datetime"),
                // "taxi_number"=>$this->getKodeTaksi($value->id_car)->taxi_number,
                // "cause"=>$value->cause
                );
            $this->_datareturn[] = $temp;
        endforeach;
        return array('total' => $this->_datarow, 'rows' => $this->_datareturn);
        //return json_encode(array('total' => $this->_datarow, 'rows' => $this->_datareturn));

    }
    public function area_read_orderpending($page, $rows, $sort, $order, $searchby, $keyword, $ResponseCode)
    {
        $offset = ((intval($page) - 1 ) * intval($rows));
        $key = strtolower($keyword);

        // if($searchby != '0' && $key != '0'):
        //     $this->_sql = sprintf("SELECT customer_request.*, log_order.* from customer_request JOIN log_order ON (customer_request.id_req_taxi=log_order.custreq_id_req_taxi) where customer_request.rc is null AND LOWER(%s) LIKE LOWER('%s') ORDER BY %s %s LIMIT %d OFFSET %d", $searchby,'%'.$keyword.'%',$sort,$order,$rows,$offset);
        //     $this->_sqlall = sprintf("SELECT customer_request.*, log_order.* from customer_request JOIN log_order ON (customer_request.id_req_taxi=log_order.custreq_id_req_taxi) where customer_request.rc is null AND LOWER(%s) LIKE LOWER('%s')",$searchby,'%'.$keyword.'%');
        // else:
        //     $this->_sql = sprintf("SELECT customer_request.*, log_order.* from customer_request JOIN log_order ON (customer_request.id_req_taxi=log_order.custreq_id_req_taxi) where customer_request.rc is null ORDER BY %s %s LIMIT %d OFFSET %d",$sort,$order,$rows,$offset);
        //     $this->_sqlall = sprintf("SELECT customer_request.*, log_order.* from customer_request JOIN log_order ON (customer_request.id_req_taxi=log_order.custreq_id_req_taxi) where customer_request.rc is null") ;
        // endif;
        if($searchby != '0' && $key != '0'):
            $this->_sql = sprintf("SELECT * from req_taxi_status where LOWER(%s) LIKE LOWER('%s') ORDER BY %s %s LIMIT %d OFFSET %d", $searchby,'%'.$keyword.'%',$sort,$order,$rows,$offset);
			$this->_sqlall = sprintf("SELECT * from req_taxi_status where LOWER(%s) LIKE LOWER('%s')",$searchby,'%'.$keyword.'%');
	    else:
            $this->_sql = sprintf("SELECT * from req_taxi_status ORDER BY %s %s LIMIT %d OFFSET %d",$sort,$order,$rows,$offset);
			$this->_sqlall = sprintf("SELECT * from req_taxi_status") ;
        endif;
        $this->_query = $this->db->query(Controls::removewhitespace($this->_sql));
        $this->_queryall = $this->db->query(Controls::removewhitespace($this->_sqlall));
        $this->_datarow = $this->_queryall->num_rows();
        //$temp=array();
        if($this->_datarow === 0) return array('total' => '0', 'rows' => '0');
        foreach ($this->_query->result() as $value):
                //array_push($temp, array(
                $temp = array(
				"idorder" => $value->idorder,
				"status" => $value->status,
				"id_request" => $value->id_request
				// $temp = array(
                // "id_log_order" => $value->id_log_order,
                // "extension" => $value->extension,
                // "id_temp_order" => $value->id_temp_order,
                // "timecreate" => $value->timecreate,
                // "custreq_id_req_taxi" => $value->custreq_id_req_taxi,
                // "id_req_taxi" => $value->id_req_taxi,
                // "addrs_pickup" => $value->addrs_pickup,
                // "addrs_clue" => $value->addrs_clue,
                // "customer_random_id" => $value->customer_random_id,
                // "latitude" => $value->latitude,
                // "longitude" => $value->longitude,
                // "name" => $value->name,
                // "phone_number" => $value->phone_number,
                // "rc" => sprintf('%s%s%s', '<i>', self::_maprc($value->rc), '</i>'),

                // "time_req" => Controls::format_date2($value->time_req,"datetime"),
                // "time_rsp" => Controls::format_date2($value->time_rsp, "datetime"),
                // "id_customer" => $value->id_customer,
                // "taxi_number"=>$this->getKodeTaksi($value->id_car)->taxi_number
                );
   $temp = array(
				"idorder" => $value->idorder,
				"status" => $value->status,
				"id_request" => $value->id_request
                // "id_req_taxi" => $value->id_req_taxi,
                // "addrs_pickup" => $value->addrs_pickup,
                // "addrs_clue" => $value->addrs_clue,
                // "latitude" => $value->latitude,
                // "longitude" => $value->longitude,
                // "name" => $value->name,
                // "phone_number" => $value->phone_number,,
                // "rc" => $value->status_confirm,
                // "time_req" => Controls::format_date2($value->time_req,"datetime"),
                // "description"=>$value->description,
                // "time_rsp" => Controls::format_date2($value->time_operator_response, "datetime"),
                // "taxi_number"=> $value->id_car != '' ? $this->getKodeTaksi($value->id_car)->taxi_number : ''
                );
            $this->_datareturn[] = $temp;
        endforeach;
        return array('total' => $this->_datarow, 'rows' => $this->_datareturn);
        //return json_encode(array('total' => $this->_datarow, 'rows' => $this->_datareturn));

    }
    public function getDeskripsiRc($string) {
        $sql = "select description from status_confirm where statuscode='$string'";
        $query = $this->db->query($sql);
        // print_r(json_encode($query->result()));
        return $query->row();
    }
        
        private function _maprc($rc){
        $status = '';
        switch (strtoupper($rc)) {
            case 'R08':
                $status = 'SUKSES';
                break;
            case 'SC88':
                $status = 'SUKSES DIKONFIRMASI PELANGGAN';
                break;
            case 'SC99':
                $status = 'BELUM DIKONFIRMASI PELANGGAN';
                break;
            case 'SC10':
                $status = 'KELUAR DARI ANTRIAN';
                break;
            case 'SC20':
                $status = 'PENUGASAN KEMBALI';
                break;
            case 'SC30':
                $status = 'DIBATALKAN OLEH PELANGGAN';
                break;
            case 'SC40':
                $status = 'DIBATALKAN OLEH SISTEM';
                break;
            case 'SC50':
                $status = 'TAKSI TIDAK TERSEDIA';
                break;
            case 'SC60':
                $status = 'TAKSI TIDAK TERSEDIA';
                break;
            default:
                $status = sprintf('%s %s', 'STATUS', $rc);
                break;
        }
        return $status;
    }
}