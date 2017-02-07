<?php
require_once(APPPATH.'controllers/controls.php');
class Custrequests extends MY_Controller{
    public function index()
    {
        $d['taxixkey'] = 'keys';
        $this->load->view('vcustreq',$d);
    }
    public function insert(){}
    public function update(){}
    public function delete(){}
    public function selects(){
        $page = $this->input->post('page') != '' ? Controls::numerics($this->input->post('page',TRUE)) : '1';
        $rows = $this->input->post('rows') != '' ? Controls::numerics($this->input->post('rows',TRUE)) : '10';
        $orderby = $this->input->post('order') != '' ? $this->input->post('order',TRUE) : 'asc';
        $sortby = $this->input->post('sort') !='' ? $this->input->post('sort',TRUE) : 'id_terminal';
        $searchby = $this->input->post('search') != '' ? $this->input->post('search',TRUE) : '0';
        $keyword = $this->input->post('keyword') != '' ? $this->input->post('keyword',TRUE) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);
        $offset = ((intval($page) - 1) * intval($rows));

        if($taxixkey == 'keys'){
            $this->load->model('Mcustreq');
            $dro = json_decode($this->Mcustreq->toSelect()->result(),TRUE);
            $dt = json_decode($this->Mcustreq->toLimit($rows)->toOffset($offset)->result(),TRUE);
            $dt['total'] = $dro['total'];
            echo json_encode($dt);
        }else{
            echo json_encode(array('total'=>0,'rows'=>'0'));
        }
    }
}
