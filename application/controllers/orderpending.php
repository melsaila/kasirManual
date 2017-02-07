<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/controls.php');
class Orderpending extends MY_Controller{
    public function index()
    {
        $this->load->model('Mcustreq');
        $this->Mcustreq->getUnreadToRead();

		$this->load->Model('Mdriver');
        $d['taxiId']=$this->Mdriver->getTaxiUseless();
		
        $d['taxixkey'] = 'keys';
        $this->load->view('vorderpending',$d);
    }
    public function getUnread()
    {
        $this->load->model('Mcustreq');
        $unread = $this->Mcustreq->getUnread()==0 ? '' :  '<span class="badge badge-important" id="badgex">'.$this->Mcustreq->getUnread().'</span>';
        echo $unread;
    }
    public function selects()
    {
        $page = $this->input->post('page') != '' ? $this->input->post('page',TRUE) : '1';
        $rows = $this->input->post('rows') != '' ? $this->input->post('rows',TRUE) : '10';
        $orderby = $this->input->post('order') != '' ? $this->input->post('order',TRUE) : 'asc';
        $sortby = $this->input->post('sort') !='' ? $this->input->post('sort',TRUE) : 'idorder';
        $searchby = $this->input->post('search') != '' ? Controls::alphanumeric($this->input->post('search',TRUE))  : '0';
        $keyword = $this->input->post('keyword') != '' ? Controls::alphanumeric($this->input->post('keyword',TRUE))  : '0';
        $offset = ((intval($page) - 1) * intval($rows));
        $taxixkey = $this->input->post('taxixkey',TRUE);

        /* Create multiple instance's class model */
        $this->load->model('Mlogorder');

        /*$drow = json_decode($x->toJoin(array('customer_request' => 'customer_request.id_req_taxi=log_order.custreq_id_req_taxi'))->result(),TRUE);
        $dt = json_decode($y->toSelect(array("json_req","json_rsp","id_car","id_log_order","extension","id_temp_order","timecreate","custreq_id_req_taxi","id_req_taxi","addrs_pickup","addrs_clue","customer_random_id","latitude","longitude","name","phone_number","rc","time_req","time_rsp","id_customer","id_taxi"))->toJoin(array('customer_request' => 'customer_request.id_req_taxi=log_order.custreq_id_req_taxi'))->toSearch('customer_request.rc','is null')->toOrderby('log_order.id_log_order','DESC')->toLimit($rows)->toOffset($offset)->result(),TRUE);
        $rowsColoumn =  json_decode($y->toSelect(array("id_car","id_log_order","extension","id_temp_order","timecreate","custreq_id_req_taxi","id_req_taxi","addrs_pickup","addrs_clue","customer_random_id","latitude","longitude","name","phone_number","rc","time_req","time_rsp","id_customer","id_taxi"))->toJoin(array('customer_request' => 'customer_request.id_req_taxi=log_order.custreq_id_req_taxi'))->toSearch('customer_request.rc','is null')->toOrderby('log_order.id_log_order','DESC')->result(),TRUE);

        $dt['total'] = $drow['total'];
        $temp = array();
        foreach ($dt['rows'] as $ke) {
            print_r($ke['id_car']);
            array_push($temp, array(
                "id_log_order" => $ke["id_log_order"],
                "extension" => $ke["extension"],
                "id_temp_order" => $ke["id_temp_order"],
                "timecreate" => $ke["timecreate"],
                "custreq_id_req_taxi" => $ke["custreq_id_req_taxi"],
                "id_req_taxi" => $ke["id_req_taxi"],
                "addrs_pickup" => $ke["addrs_pickup"],
                "addrs_clue" => $ke["addrs_clue"],
                "customer_random_id" => $ke["customer_random_id"],
                "latitude" => $ke["latitude"],
                "longitude" => $ke["longitude"],
                "name" => $ke["name"],
                "phone_number" => $ke["phone_number"],
                "angkarc"=>$ke["rc"],
                "json_req"=>$ke["json_req"],
                "json_rsp"=>$ke["json_rsp"],
                //"rc" => sprintf('%s%s%s', '<i>', self::_maprc($ke["rc"]), '</i>'),

                "time_req" => Controls::format_date2($ke["time_req"],"datetime"),
                "time_rsp" => Controls::format_date2($ke["time_rsp"], "datetime"),
                "id_customer" => $ke["id_customer"],
                "taxi_number"=>$this->Mlogorder->getKodeTaksi($ke['id_car'])->taxi_number
                ));
        }*/
        //echo json_encode(array('total' => $rowsColoumn['total'], 'rows' => $temp));
        echo json_encode($this->Mlogorder->area_read_orderpending($page, $rows, $sortby, $orderby, $searchby, $keyword,''));
    }
    public function update_status(){
        $id_req_taxi = $this->input->post("id_req_taxi");
        $addrs_pickup = $this->input->post("addrs_pickup");
        $addrs_clue = $this->input->post("addrs_clue");
        $name = $this->input->post("name");
        $phone_number = $this->input->post("phone_number");
        $longitude = $this->input->post("longitude");
        $latitude = $this->input->post("latitude");

        //$taxi_number = ;
        //$time_req=Controls::ConvertBulanToAngkaKe2($this->input->post("time_req"));
        $time_req=$this->input->post("time_req");
         $description=$this->input->post("cause")==''?"-":$this->input->post("cause");
        //$time_rsp=Controls::ConvertBulanToAngkaKe2($this->input->post("time_rsp"));
        $statuscode =  $this->input->post("sc");
        $id_taxi =  $this->input->post("taxi_number")==''?0:$this->input->post("taxi_number");
        $Alasan = $this->input->post("alasan")=='' ? "-" : $this->input->post("alasan");
        $this->load->model('Mdriver');
        $taxi_number = $this->Mdriver->getTaxiNumber($id_taxi)->taxi_number;
       //s $id_taxi=$this->Mlogorder->getIDCar($this->input->post("Kode_taxi"))->id_car;
        $micro_date = microtime();
        $date_array = explode(' ',substr($micro_date, 0, 5));

        //echo $id_req_taxi,$addrs_pickup,$addrs_clue,$customer_random_id,$json_req,$json_rsp,$latitude,$longitude,$name,$phone_number,$rc,$time_req,$time_rsp,$id_customer,$id_taxi->id_car;
            $this->load->model('Mcustreq');
            $this->Mcustreq->toUpdate(array('id_req_taxi' => $id_req_taxi),
                array(
                    "status_confirm"=>$statuscode,
                    "addrs_pickup" => $addrs_pickup, 
                    "addrs_clue" => $addrs_clue, 
                    //"custreq_id_req_taxi" => "$custreq_id_req_taxi", 
                    "latitude"=> $latitude, 
                    "longitude"=>$longitude, 
                    "name"=> $name, 
                    "phone_number"=>$phone_number, 
                    "id_car"=>$id_taxi, 
                    "time_req"=>$time_req,
                    "time_operator_response"=>date('Y-m-d H:i:s.'.$date_array[0]*10000), 
                    "description"=>$description)
                )->result();  
            echo json_encode(array('result'=>'success', 'description'=>$description, 'taxi_number'=>$taxi_number, 'name'=>$name, 'phone_number'=>$phone_number, 'addrs_pickup'=>$addrs_pickup, 'addrs_clue'=>$addrs_clue));                                     
    }

    public function getListRC() {
        $sql = "select * from status_confirm";
        $query = $this->db->query($sql);
        // print_r(json_encode($query->result()));
        echo json_encode($query->result());
    }
    public function getListKodeTaksi() {
        $sql = "select * from car_profile";
        $query = $this->db->query($sql);
        // print_r(json_encode($query->result()));
        echo json_encode($query->result());
    }
    private function _maprc($rc){
        $status = '';
        switch (strtoupper($rc)) {
            case 'SC00':
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
            case '':
                $status='';
                break;
            default:
                $status = sprintf('%s %s', 'STATUS', $rc);
                break;
        }
        return $status;
    }

}