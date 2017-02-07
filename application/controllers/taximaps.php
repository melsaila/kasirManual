<?php
class Taximaps extends CI_Controller{
    public function index()
    {
        
        $this->load->view('vmaps');
    }
    public function taxis()
    {
        $this->load->model('Mtaxidevice');
        // $txi = json_decode($this->Mtaxidevice->toSelect(array('driver.*','taxi_device.latitude','taxi_device.longitude','taxi_device.device_taxi_status,car_profile.taxi_number,car_profile.license_plate'))
        //     ->toJoin(array('driver'=>'taxi_device.nik=driver.nik'))
        //     ->toJoin(array('car_profile' => 'taxi_device.id_car=car_profile.id_car'))
        //     ->toSearch('taxi_device.device_taxi_status','IS NOT NULL')
        //     ->toSearch('taxi_device.latitude','IS NOT NULL')
        //     ->toSearch('taxi_device.longitude','IS NOT NULL')
        //     ->result(),true);
        // echo json_encode($txi['rows']);
        $txi = json_decode($this->Mtaxidevice->toSelect(array('driver.*', 'positions.latitude', 'positions.longitude', 'car_profile.taxi_number', 'car_profile.license_plate'))
            ->toJoin(array('devices'=>'device_detail.uniqueid=devices.uniqueid'))
            ->toJoin(array('positions'=>'devices.latestposition_id=positions.id'))
            ->toJoin(array('driver'=>'device_detail.id_car=driver.id_car'))
            ->toJoin(array('car_profile' => 'device_detail.id_car=car_profile.id_car'))
            ->toSearch('positions.latitude','IS NOT NULL')
            ->toSearch('positions.longitude','IS NOT NULL')
            ->result(),true);
        echo json_encode($txi['rows']);
    }
    public function getLatLongkonsumen(){
        $this->load->model('Mcustreq');  
        echo json_encode($this->Mcustreq->getLatLongKonsumen());

    }
    public function maps()
    {
        $this->load->view('vmapss');
    }
}
