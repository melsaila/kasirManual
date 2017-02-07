<?php
class Cars extends MY_Controller{
    public function index(){
        $d['taxixkey'] = 'keys';
        $this->load->view('vcars', $d);
    }
    public function insert(){
        $car_status = $this->input->post('kode',TRUE);
        $license_plate = $this->input->post('license_plate',TRUE);
        $product_year = $this->input->post('product_year',TRUE);
        $taxi_number = $this->input->post('taxi_number',TRUE);
        $typical_car = $this->input->post('typical_car',TRUE);
        $prepared = array(
            'car_status' => $car_status,
            'policenumber' => $license_plate,
            'product_year' => $product_year,
            'taxinumber' => $taxi_number,
            'typical_car' => $typical_car);
        $this->load->model('Mcar');
        echo $this->Mcar->toInsert($prepared)->result();
    }
    public function update(){
        $car_status = $this->input->post("car_status")!= "" ? $this->input->post("car_status",TRUE) : "";
        $license_plate = $this->input->post("policenumber")!= "" ? $this->input->post("policenumber",TRUE) : "";
        $product_year = $this->input->post("product_year")!= "" ? $this->input->post("product_year",TRUE) : "";
        $taxi_number = $this->input->post("taxinumber")!= "" ? $this->input->post("taxinumber",TRUE) : "";
        $typical_car = $this->input->post("typical_car")!= "" ? $this->input->post("typical_car",TRUE) : "";
        $prepared = array(
            'car_status' => $car_status,
            'policenumber' => $license_plate,
            'product_year' => $product_year,
            'taxinumber' => $taxi_number,
            'typical_car' => $typical_car);
        $this->load->model('Mcar');
        echo $this->Mcar->toUpdate(array('taxinumber' => $taxi_number), $prepared)->result();
    }
    public function delete(){
        $id_car = $this->input->post("id_car");
        $this->load->model('Mcar');
        echo $this->Mcar->toDelete(array('id_car'=>$id_car))->result();
    }
    public function selects(){
        $page = $this->input->post('page') != '' ? $this->input->post('page',TRUE) : '1';
        $rows = $this->input->post('rows') != '' ? $this->input->post('rows',TRUE) : '10';
        $orderby = $this->input->post('order') != '' ? $this->input->post('order',TRUE) : 'asc';
        $sortby = $this->input->post('sort') !='' ? $this->input->post('sort',TRUE) : 'taxinumber';
        $searchby = $this->input->post('search') != '' ? Controls::alphanumeric($this->input->post('search',TRUE)): '0';
        $keyword = $this->input->post('keyword') != '' ? Controls::alphanumeric($this->input->post('keyword',TRUE)) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);
        $offset = ((intval($page) - 1) * intval($rows));

        if($taxixkey == 'keys'){
            $this->load->model('Mcar');
            /*$a = new Mcar();
            $b = new Mcar();
            if($keyword != '0' && $searchby != '0'){
                $dtrow = json_decode(
                    $b->toSelect()
                    ->toOrderBy($keyword, $searchby)
                    ->result(),TRUE);
                $list = json_decode(
                    $a->toSelect()
                    ->toOrderBy($keyword, $searchby)
                    ->toLimit($rows)
                    ->toOffset($offset)
                    ->result(),TRUE);
            }else{
                $dtrow = json_decode(
                    $b->toSelect()
                    ->result(),TRUE);
                $list = json_decode(
                    $a->toSelect()
                    ->toLimit($rows)
                    ->toOffset($offset)
                    ->result(),TRUE);
            }
            $select = array();
            foreach ($list['rows'] as $k) {
                $select[]=$k;
            }*/

            //echo json_encode($select);
            echo ($this->Mcar->area_read($page, $rows, $sortby, $orderby, $searchby, $keyword));
        }else{
            echo json_encode(array('total' => 0, 'rows' => '0'));
        }
    }
    public function getcar(){
        $sql = "SELECT id_car, taxi_number, license_plate FROM car_profile WHERE id_car NOT IN (SELECT id_car FROM taxi_device WHERE id_car IS NOT NULL)";
        $query = $this->db->query($sql);
        $datacar = array();
        if($query->num_rows() > 0){
            foreach ($query->result() as $e) {
                $datacar[] = $e;
            }
            echo json_encode($datacar);
        }else{
            echo json_encode($datacar);
        }
    }
}