<?php
require_once(APPPATH.'controllers/controls.php');
class Imei extends CI_Controller{
    public function index(){
        //$d['taxi_number'] = $this->getNumberTaxi();
        //$d['nomor_taxi'] = $this->getnewtaxi();

        $d['taxixkey'] = 'keys';
        $this->load->view('vimei',$d);
    }
    public function selects(){
        $this->load->model('Mtaxidevice');
        $this->load->model('Mcar');
        $page = $this->input->post('page') != '' ? $this->input->post('page',TRUE) : '1';
        $rows = $this->input->post('rows') != '' ? $this->input->post('rows',TRUE) : '10';
        $orderby = $this->input->post('order') != '' ? $this->input->post('order',TRUE) : 'asc';
        $sortby = $this->input->post('sort') !='' ? $this->input->post('sort',TRUE) : 'imei';
        $searchby = $this->input->post('search') != '' ? Controls::alphanumeric($this->input->post('search',TRUE)) : '0';
        $keyword = $this->input->post('keyword') != '' ? Controls::alphanumeric($this->input->post('keyword',TRUE)) : '0';
        $a = new $this->Mtaxidevice();
        $c = new $this->Mcar();
        $data = json_decode($a->toSelect()->toSearch('imei','is not null')->result(),TRUE);
        $row = $data['total'];
        $dfilter = array();
        $i = 1;
        // foreach ($data['rows'] as $y) {
        //     $dcar = $y['id_car'] != '' ? $c->detailcar($y['id_car']) : '-';
        //     $dfilter[] = array('id_car'=>$y['id_car'],'id_taxi_device'=>$y['id_taxi_device'],'imei' => $y['imei'], 'taxi_number' => is_array($dcar) ? $dcar['taxi_number'] : '-','nosimcard'=>$y['nosimcard'],'status' => 'on');
        // }
        //echo json_encode(array('total' => $row, 'rows' => $dfilter));
        echo ($this->Mtaxidevice->area_read($page, $rows, $sortby, $orderby, $searchby, $keyword));
    }
    public function insert(){
        $imei = $this->input->post('uniqueid',TRUE);
        $id_car = $this->input->post('taxi_number',TRUE) != '' ? $this->input->post('taxi_number',TRUE) : NULL;
        $name = $this->input->post('name',TRUE) != '' ? $this->input->post('name',TRUE) : NULL;
        $mobile = $this->input->post('mobile',TRUE) != '' ? $this->input->post('mobile',TRUE) : "-";
        $micro_date = microtime();
        $date_array = explode(' ',substr($micro_date, 0, 5));

        $this->load->model('Mtaxidevice');
        $id_Devices = ($this->Mtaxidevice->GetIDDevices()->max)+1;
        $insertDevices = "INSERT INTO devices(id, uniqueid, name, latestposition_id) VALUES('$id_Devices', '$imei', '$name', NULL)";
        $this->Mtaxidevice->NumpangQuery($insertDevices);
        $insertDevices = "INSERT INTO users_devices(users_id, devices_id) VALUES(1, '$id_Devices')";
        $this->Mtaxidevice->NumpangQuery($insertDevices);
        echo $this->Mtaxidevice->toInsert(array('uniqueid' => $imei, 'id_car' => $id_car, 'name'=>$name,'mobile' => $mobile, 'registerdate'=>date('Y-m-d H:i:s.'.$date_array[0]*10000)))->result();
    }
    public function update(){
        $this->load->model('Mcar');
        $tempImei = $this->input->post('tempuniqueid', TRUE);
        $imei = $this->input->post('uniqueid',TRUE);
        $idtaxidevice = $this->input->post('id',TRUE);
        $id_car = $this->input->post('taxi_number');
        $registerdate = $this->input->post('registerdate');
        $no_sim_card = $this->input->post('mobile',TRUE) != '' ? $this->input->post('mobile',TRUE) : "-";
        $taxixkey = $this->input->post('taxixkey',TRUE);

        $car = new $this->Mcar();

        $find_car = json_decode($car->toWhere(array('taxi_number' => $id_car))->result(), TRUE);
        if($find_car['total'] == '0'){
            $car_id = $id_car;
        }else{
            $car_id = $find_car['rows'][0]['id_car'];
        }
        $this->load->model('Mtaxidevice');
        $insertDevices = "SELECT id from devices where uniqueid='$tempImei'";
        $this->Mtaxidevice->NumpangQuery($insertDevices);

        $insertDevices2 = "update devices set uniqueid='$imei' where uniqueid='$tempImei'";
        $this->Mtaxidevice->NumpangQuery($insertDevices2);
        if($taxixkey == 'keys'){
            $this->load->model('Mtaxidevice');
            echo $this->Mtaxidevice->toUpdate(array('id' => $idtaxidevice), array('uniqueid' => $imei, 'id_car' => $car_id, 'name'=>null, 'simcardnumber'=>null,'mobile' => $no_sim_card, 'registerdate'=>$registerdate))->result();
        }else{
            echo json_encode(array('result' => 'failed', 'message' => 'Restricted request'));
        }
    }
    public function delete(){
        $id = $this->input->post("id");
        $this->load->model('Mtaxidevice');
        $uniqueid=$this->getUniqueid($id)->uniqueid;
        $DeleteDevices = "DELETE from devices where uniqueid='$uniqueid'";
        $this->Mtaxidevice->NumpangQuery($DeleteDevices);
        $DeleteDevices = "DELETE from device_detail where id='$id'";
        $this->Mtaxidevice->NumpangQuery($DeleteDevices);
        echo json_encode(array('result' => 'success'));
        //echo $this->Mtaxidevice->toDelete(array('id_taxi_device'=>$id_taxi_device))->result();
    }
    public function getnewtaxi(){
        $sql = "SELECT device_detail.id_car, taxi_number, license_plate FROM car_profile JOIN device_detail ON(car_profile.id_car=device_detail.id_car) WHERE car_profile.id_car=device_detail.id_car";
        $query = $this->db->query($sql);
        $dt = array();
        foreach ($query->result() as $e) {
            $dt[] = $e;
        }
        return $dt;
    }
    public function getNumberTaxi(){
        $sql = "select taxi_number, id_car from car_profile where taxi_number NOT IN (select taxi_number from device_detail JOIN car_profile ON(device_detail.id_car=car_profile.id_car))";
        $query = $this->db->query($sql);
        $dt = array();
        foreach ($query->result() as $e) {
            $dt[] = $e;
        }
        return $dt;
    }

    public function getimei(){
        $sql = "SELECT imei FROM taxi_device WHERE nik IS NULL AND id_car IS NULL";
        $query = $this->db->query($sql);
        $imei = array();
        if($query->num_rows() > 0){
            foreach ($query->result() as $e) {
                $imei[] = $e;
            }
            echo json_encode($imei);
        }else{
            echo json_encode($imei);
        }
    }
    public function getIDTaxi($string){
        $sql = "select id_car from car_profile where taxi_number='$string'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function getUniqueid($string){
        $sql = "select uniqueid from device_detail where id='$string'";
        $query = $this->db->query($sql);
        return $query->row();
    }
}