<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/controls.php');
class Reportinglogsukses extends MY_Controller{
    public function index()
    {
        $d['taxixkey'] = 'keys';
        $this->load->view('vreportingsukses',$d);
    }
    public function selects()
    {
        $page = $this->input->post('page') != '' ? $this->input->post('page',TRUE) : '1';
        $rows = $this->input->post('rows') != '' ? $this->input->post('rows',TRUE) : '10';
        $orderby = $this->input->post('order') != '' ? $this->input->post('order',TRUE) : 'asc';
        $sortby = $this->input->post('sort') !='' ? $this->input->post('sort',TRUE) : 'id_req';
        $searchby = $this->input->post('search') != '' ? Controls::alphanumeric($this->input->post('search',TRUE)) : '0';
        $keyword = $this->input->post('keyword') != '' ? Controls::alphanumeric($this->input->post('keyword',TRUE)) : '0';
        $offset = ((intval($page) - 1) * intval($rows));
        $taxixkey = $this->input->post('taxixkey',TRUE);

        /* Create multiple instance's class model */
        $this->load->model('Mlogorder');
        /*$x = new $this->Mlogorder();
        $y = new $this->Mlogorder();

        $drow = json_decode($x->toJoin(array('customer_request' => 'customer_request.id_req_taxi=log_order.custreq_id_req_taxi'))->result(),TRUE);
        $dt = json_decode($y->toSelect(array("id_car","id_log_order","extension","id_temp_order","timecreate","custreq_id_req_taxi","id_req_taxi","addrs_pickup","addrs_clue","customer_random_id","latitude","longitude","name","phone_number","rc","time_req","time_rsp","id_customer","id_taxi"))->toJoin(array('customer_request' => 'customer_request.id_req_taxi=log_order.custreq_id_req_taxi'))->toWhere(array('customer_request.rc'=>'SC00'))->toOrderby('log_order.id_log_order','DESC')->toLimit($rows)->toOffset($offset)->result(),TRUE);
        $rowsColoumn =  json_decode($y->toSelect(array("id_car","id_log_order","extension","id_temp_order","timecreate","custreq_id_req_taxi","id_req_taxi","addrs_pickup","addrs_clue","customer_random_id","latitude","longitude","name","phone_number","rc","time_req","time_rsp","id_customer","id_taxi"))->toJoin(array('customer_request' => 'customer_request.id_req_taxi=log_order.custreq_id_req_taxi'))->toWhere(array('customer_request.rc'=>'SC00'))->toOrderby('log_order.id_log_order','DESC')->result(),TRUE);

        $dt['total'] = $drow['total'];
        $temp = array();
        foreach ($dt['rows'] as $ke) {
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
                "rc" => sprintf('%s%s%s', '<i>', self::_maprc($ke["rc"]), '</i>'),

                "time_req" => Controls::format_date2($ke["time_req"],"datentime"),
                "time_rsp" => Controls::format_date2($ke["time_rsp"], "datentime"),
                "id_customer" => $ke["id_customer"],
                "taxi_number"=>$this->Mlogorder->getKodeTaksi($ke['id_car'])->taxi_number
                ));
        }*/
        //echo json_encode(array('total' => $rowsColoumn['total'], 'rows' => $temp));
        //echo ($this->Mlogorder->area_read($page, $rows, $sortby, $orderby, $searchby, $keyword, 'SC00'));
        echo json_encode($this->Mlogorder->area_read($page, $rows, $sortby, $orderby, $searchby, $keyword, 'R08'));
        //print_r($this->Mlogorder->area_read($page, $rows, $sortby, $orderby, $searchby, $keyword, 'SC00'));
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