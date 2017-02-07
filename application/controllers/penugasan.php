<?php
class Penugasan extends CI_Controller{
    public function index(){
        $d['taxixkey'] = 'keys';
        $this->load->view('vpenugasan',$d);
    }
    public function addpenugasan(){
        $idimei = $this->input->post('pimei',TRUE);
        $idtaksi = $this->input->post('ptaksi',TRUE);
        $idsopir = $this->input->post('psopir',TRUE);
        $this->load->model('Mtaxidevice');
        echo $this->Mtaxidevice->toUpdate(array('imei'=>$idimei), array('nik'=>$idsopir,'id_car'=>$idtaksi))->result();
    }
    public function updatesopir(){
        $idpenugasan = '';
        $idsopir = '';
        $this->load->model('Mtaxidevice');
        echo $this->Mtaxidevice->toUpdate(array('id_taxi_device' => $idpenugasan), array('nik' => $idsopir))->result();
    }
    public function updatetaxi(){
        $idpenugasan = '';
        $idtaxi = '';
        $this->load->model('Mtaxidevice');
        echo $this->Mtaxidevice->toUpdate(array('id_taxi_device' => $idpenugasan), array('id_car' => $idtaxi))->result();
    }
    public function updateimei(){
        $idpenugasan = '';
        $imei = '';
        $this->load->model('Mtaxidevice');
        echo $this->Mtaxidevice->toUpdate(array('id_taxi_device'=>$idpenugasan), array('imei' => $imei))->result();
    }
    public function delpenugasan(){
        $idpenugasan = $this->input->post('id_taxi_device');
        $this->load->model('Mtaxidevice');
        echo $this->Mtaxidevice->toDelete(array('id_taxi_device' => $idpenugasan))->result();
    }
    public function selects(){
        $this->load->model('Mtaxidevice');
        $dt = $this->Mtaxidevice->toSelect('taxi_device.*,car_profile.taxi_number,car_profile.license_plate,driver.*')
        ->toJoin(array('car_profile' => 'taxi_device.id_car=car_profile.id_car'))
        ->toJoin(array('driver'=>'taxi_device.nik=driver.nik'))
        ->result();
        echo $dt;
    }
}