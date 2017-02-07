<?php
require_once(APPPATH.'controllers/controls.php');
class Taxirequests extends MY_Controller{
    public function index()
    {
        $d['taxixkey'] = 'keys';
        $this->load->view('vtaxireq',$d);
    }
    public function selects(){
        $page = $this->input->post('page') != '' ? Controls::numerics($this->input->post('page',TRUE)) : '1';
        $rows = $this->input->post('rows') != '' ? Controls::numerics($this->input->post('rows',TRUE)) : '10';
        $orderby = $this->input->post('order') != '' ? $this->input->post('order',TRUE) : 'asc';
        $sortby = $this->input->post('sort') !='' ? $this->input->post('sort',TRUE) : 'id_terminal';
        $searchby = $this->input->post('search') != '' ? $this->input->post('search',TRUE) : '0';
        $keyword = $this->input->post('keyword') != '' ? $this->input->post('keyword',TRUE) : '0';
        $offset = ((intval($page) - 1) * intval($rows));
        $taxixkey = $this->input->post('taxixkey',TRUE);

        if($taxixkey == 'keys'){
            $this->load->model('Mtaxireq');
            $drow = json_decode($this->Mtaxireq->toSelect()->result(),TRUE);
            $dt = json_decode($this->Mtaxireq->toSelect()->toJoin(array('taxi_device'=>'taxi_device.id_taxi=taxi_request.id_taxi_device'))->toLimit($rows)->toOffset($offset)->result(),TRUE);
            $dt['total'] = $drow['total'];
            echo json_encode($dt);
        }else{
            echo json_encode(array('total' => 0, 'rows' => '0'));
        }
    }
}
