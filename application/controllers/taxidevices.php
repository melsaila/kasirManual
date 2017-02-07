<?php
require_once(APPPATH.'controllers/controls.php');
class Taxidevices extends CI_Controller{
    public function index()
    {
        $d['taxixkey'] = 'keys';
        $this->load->view('vtaxidevices', $d);
    }
    public function inserttaxi(){
        $nik = date('myHis');
        $policeno = $this->input->post('nomor_polisi') != '' ? Controls::alphanumeric($this->input->post('nomor_polisi',TRUE)) : '0';
        $taxino = $this->input->post('taxi_number') != '' ? Controls::alphanumeric($this->input->post('taxi_number',TRUE)) : '0';
        $imei = $this->input->post('imei') != '' ? Controls::numerics($this->input->post('imei',TRUE)) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);

        if($taxixkey == 'keys'){
            if($imei == '0'){
                $this->load->model('Mdriver');
                echo $this->Mdriver->toInsert(array('nomor_polisi'=>$policeno, 'taxi_number'=>$taxino, 'nik'=>$nik))->result();
                return;
            }else{
                self::updatetaxi($imei, array('nomor_polisi'=>$policeno, 'taxi_number'=>$taxino));
            }
        }
    }
    public function addtaxidevice(){
        $imei = $this->input->post('imei') != '' ? Controls::numerics($this->input->post('imei',TRUE)) : '0'; // move imei to taxi and than remove imei row
        $nik = $this->input->post('nik') != '' ? Controls::numerics($this->input->post('nik',TRUE)) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);

        if($taxixkey == 'keys'){
            $this->load->model('Mdriver');
            $imei = json_decode($this->Mdriver->toSelect(array('imei','nik'))->toWhere(array('nik' => $imei))->result(),TRUE);
            $imeinik = $imei['rows'][0]['nik'];
            $imei = $imei['rows'][0]['imei'];
            $upd = json_decode($this->Mdriver->toUpdate(array('nik'=>$nik), array('imei'=>$imei))->result(),TRUE);
            if($upd['result'] == 'success'){
                $delimei = json_decode($this->Mdriver->toDelete(array('nik'=>$imeinik))->result(),TRUE);
                if($delimei['result'] == 'success'){
                    echo json_encode(array('result'=>'success','message'=>'Update success data is updated'));
                }else{
                    echo json_encode(array('result'=>'failed','message'=>'Update failed. Data cannot save'));
                }
            }else{
                echo json_encode(array('result'=>'failed','message'=>'Update failed. Data cannot save'));
            }
        }else{
            echo json_encode(array('result'=>'failed','message'=>'Restricted request'));
        }
    }
    private function updatetaxi($nik, $arr){
        $this->load->model('Mdriver');
        echo $this->Mdriver->toUpdate(array('nik'=>$nik), $arr)->result();
    }
    public function delimeitaxi(){
        $nik = $this->input->post('nik') != '' ? Controls::numerics($this->input->post('nik',TRUE)) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);
        if($taxixkey == 'keys'){
            $this->load->model('Mdriver');
            echo $this->Mdriver->toUpdate(array('nik'=>$nik),array('imei'=>NULL))->result();
        }else{
            echo json_encode(array('result'=>'failed','message'=>'Update failed. Data cannot save'));
        }
    }
    public function insertdevice(){
        $nik = date('myHis');
        $imei = $this->input->post('imei') != '' ? Controls::numerics($this->input->post('imei',TRUE)) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);
        if($taxixkey == 'keys'){
            $this->load->model('Mdriver');
            echo $this->Mdriver->toInsert(array('nik'=>$nik,'imei'=>$imei))->result();
        }else{
            echo json_encode(array('result'=>'failed','message'=>'Restricted request'));
        }
    }
    public function deltaxi(){
        $nik = $this->input->post('nik') != '' ? Controls::numerics($this->input->post('nik',TRUE)) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);
        if($taxixkey == 'keys'){
            $this->load->model('Mdriver');
            // echo $this->Mdriver->toDelete(array('nik'=>$nik));
            $upd = json_decode($this->Mdriver->toUpdate(array('nik'=>$nik), array('nomor_polisi'=>NULL, 'taxi_number'=>NULL))->result(),TRUE);
            if($upd['result'] == 'success'){
                echo json_encode(array('result'=>'success','message'=>'Delete success. Data updated'));
            }else{
                echo json_encode(array('result'=>'failed','message'=>'Delete failed. Data cannot save'));
            }
        }else{
            echo json_encode(array('result'=>'failed','message'=>'Restricted request'));
        }
    }
    public function selects(){
        $page = $this->input->post('page') != '' ? $this->input->post('page',TRUE) : '1';
        $rows = $this->input->post('rows') != '' ? $this->input->post('rows',TRUE) : '10';
        $orderby = $this->input->post('order') != '' ? $this->input->post('order',TRUE) : 'asc';
        $sortby = $this->input->post('sort') !='' ? $this->input->post('sort',TRUE) : 'id_terminal';
        $searchby = $this->input->post('search') != '' ? $this->input->post('search',TRUE) : '0';
        $keyword = $this->input->post('keyword') != '' ? $this->input->post('keyword',TRUE) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);

        $this->load->model('Mdriver');
        if($taxixkey == 'keys'){
            echo $this->Mdriver->result();
        }elseif($searchby != '0' || $keyword != '0'){
            echo $this->Mdriver->toWhere(array($searchby => $keyword))->result();
        }else{
            echo json_encode(array('total' => 0,'rows' => '0'));
        }
    }
    public function orphanimei()
    {
        $this->load->model('Mdriver');
        $imei = json_decode($this->Mdriver->toSelect(array('nik','imei'))->toSearch('name','is null')->toSearch('nomor_polisi','is null')->toSearch('taxi_number','is null')->result(),TRUE);
        $arrimei = array();
        if($imei['total'] == 1){
            array_push($arrimei, array('nik'=> $imei['rows'][0]['nik'], 'imei' => $imei['rows'][0]['imei']));
        }elseif($imei['total'] > 0){
            foreach ($imei['rows'] as $key) {
                array_push($arrimei, array('nik' => $key['nik'], 'imei' => $key['imei']));
            }
        }else{
            $arrimei = array();
        }
        echo json_encode($arrimei);
    }
}
