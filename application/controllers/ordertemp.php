<?php
require_once(APPPATH.'controllers/controls.php');
class Ordertemp extends MY_Controller{
    public function index()
    {
        $d['taxixkey'] = 'keys';
        $this->load->view('vordertemp',$d);
    }
    public function selects()
    {
        $page = $this->input->post('page') != '' ? $this->input->post('page',TRUE) : '1';
        $rows = $this->input->post('rows') != '' ? $this->input->post('rows',TRUE) : '10';
        $orderby = $this->input->post('order') != '' ? $this->input->post('order',TRUE) : 'asc';
        $sortby = $this->input->post('sort') !='' ? $this->input->post('sort',TRUE) : 'id_terminal';
        $searchby = $this->input->post('search') != '' ? $this->input->post('search',TRUE) : '0';
        $keyword = $this->input->post('keyword') != '' ? $this->input->post('keyword',TRUE) : '0';
        $offset = ((intval($page) - 1) * intval($rows));
        $taxixkey = $this->input->post('taxixkey',TRUE);

        $this->load->model('Mtempordr');
        $x = new $this->Mtempordr();
        $y = new $this->Mtempordr();

        $drow = json_decode($x->toSelect()->result(),TRUE);
        $dt = json_decode($y->toJoin(array('customer_request' => 'temp_order.id_req_taxi=customer_request.id_req_taxi'))->toJoin(array('taxi_device' => 'temp_order.id_taxi_device=taxi_device.id_taxi'))->toLimit($rows)->toOffset($offset)->result(),TRUE);
        $dt['total'] = $drow['total'];
        echo json_encode($dt);
    }
}
