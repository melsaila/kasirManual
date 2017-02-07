<?php
require_once(APPPATH.'controllers/controls.php');
class Customers extends MY_Controller{
    public function index()
    {
        $d['taxixkey'] = 'keys';
        $this->load->view('vcustomer',$d);
    }
    public function insert()
    {
        $id_customer = $this->input->post("id_customer") != '' ? Controls::numerics($this->input->post('id_customer',TRUE)) : '0';
        $imei = $this->input->post("imei") != '' ? Controls::numerics($this->input->post('imei',TRUE)) : '0';
        $mobile_number = $this->input->post("mobile_number") != '' ? Controls::numerics($this->input->post('mobile_number',TRUE)) : '0';
        $name = $this->input->post("name") != '' ? Controls::alphanumeric($this->input->post('name',TRUE)) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);

        if($taxixkey == 'keys'){
            $this->load->model('Mcustomer');
            echo $this->Mcustomer->toInsert(array("id_customer" => $id_customer,"imei" => $imei,"mobile_number" => $mobile_number,"name" => $name))->result();
        }else{
            echo json_encode(array('total'=>0,'rows'=>'0'));
        }
    }
    public function update()
    {
        $id_customer = $this->input->post("id_customer") != '' ? Controls::numerics($this->input->post('id_customer',TRUE)) : '0';
        $imei = $this->input->post("imei") != '' ? Controls::numerics($this->input->post('imei',TRUE)) : '0';
        $mobile_number = $this->input->post("mobile_number") != '' ? Controls::numerics($this->input->post('mobile_number',TRUE)) : '0';
        $name = $this->input->post("name") != '' ? Controls::alphanumeric($this->input->post('name',TRUE)) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);

        if($taxixkey == 'keys'){
            $this->load->model('Mcustomer');
            echo $this->Mcustomer->toUpdate(array("id_customer" => $id_customer), array("imei" => $imei,"mobile_number" => $mobile_number,"name" => $name))->result();
        }else{
            echo json_encode(array('total'=>0,'rows'=>'0'));
        }
    }
    public function delete()
    {
        $id_customer = $this->input->post("id_customer") != '' ? Controls::numerics($this->input->post('id_customer',TRUE)) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);

        if($taxixkey == 'keys'){
            $this->load->model('Mcustomer');
            echo $this->Mcustomer->toDelete(array('id_customer'=>$id_customer))->result();
        }else{
            echo json_encode(array('result'=>'failed','message'=>'Restricted request'));
        }
    }
    public function selects()
    {
        $page = $this->input->post('page') != '' ? $this->input->post('page',TRUE) : '1';
        $rows = $this->input->post('rows') != '' ? $this->input->post('rows',TRUE) : '10';
        $orderby = $this->input->post('order') != '' ? $this->input->post('order',TRUE) : 'asc';
        $sortby = $this->input->post('sort') !='' ? $this->input->post('sort',TRUE) : 'id_terminal';
        $searchby = $this->input->post('search') != '' ? $this->input->post('search',TRUE) : '0';
        $keyword = $this->input->post('keyword') != '' ? $this->input->post('keyword',TRUE) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);

        if($taxixkey == 'keys'){
            $this->load->model('Mcustomer');
            echo $this->Mcustomer->toSelect()->result();
        }else{
            echo json_encode(array('total'=>0,'rows'=>'0'));
        }
    }
}
