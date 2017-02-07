<?php
require_once(APPPATH.'controllers/controls.php');
class Drivers extends MY_Controller{
    public function index()
    {
        //$this->load->Model('Mdriver');
        //$d['taxi_nomber']=$this->Mdriver->getAllNoTaksi();
		$this->load->Model('Mcar');
		
		$this->load->Model('Mdriver');
        $d['taxiId']=$this->Mdriver->getTaxiUseless();
		
		$this->load->Model('Mdriver');
        $d['idimei']=$this->Mdriver->getImei();
		
        $d['taxixkey'] = 'keys';
        $this->load->view('vdrivers',$d);
    }
    public function insert()
    {
		$idcom = $this->session->userdata('cek');
		//urlpicture belum ada
        $nik = $this->input->post("nik") != "" ? Controls::alphanumeric($this->input->post("nik",TRUE)) : "0";
		$fullname = $this->input->post("fullname") != "" ? Controls::alphanumeric($this->input->post("fullname",TRUE)) : "0";
		$phone = $this->input->post("phone") != "" ? Controls::numerics($this->input->post("phone",TRUE)) : "0";
		$addrs = $this->input->post("addrs") != "" ? Controls::alphanumeric($this->input->post("addrs",TRUE)) : "0";
		$email = $this->input->post("email") != "" ? Controls::alphanumeric($this->input->post("email",TRUE)) : "0";
		$username = $this->input->post("username") != "" ? Controls::alphanumeric($this->input->post("username",TRUE)) : "0";
		$status = "R30";
		$imei = $this->input->post("imei") != "" ? Controls::alphanumeric($this->input->post("imei",TRUE)) : "0";
		$taxi_number = $this->input->post("kode") != "" ? Controls::alphanumeric($this->input->post("kode",TRUE)) : "0";
		$driverstatus = "ST04";
        
        //$birthday = Controls::validdate($this->input->post("birthday",TRUE)) ? $this->input->post("birthday",TRUE) : "0";
        //$marital = $this->input->post("marital") != "" ? $this->input->post("marital",TRUE) : "0";
        //$sex = $this->input->post("sex") != "" ? $this->input->post("sex",TRUE) : "0";
        //$kodeTaksi = $this->input->post("taxi_number");
        $taxixkey = $this->input->post('taxixkey',TRUE);

        if($taxixkey == 'keys'){
            $this->load->model('Mdriver');
            $x = new $this->Mdriver();
            $y = new $this->Mdriver();
            $newdriver = json_decode($x->toInsert(array("nik" => $nik,"driverstatus" => $addrs,"phone" => $phone,
														"statuslogin" => $status,"imei_taxi"=>$imei,
														"address"=>$addrs,"email"=>$email,
														"fullname"=>$fullname,"username"=>$username,
														"taxi_number"=>$taxi_number))->result(),TRUE);
            if($newdriver['result'] == 'success'){
				
				echo $this->load->model('Mcar');
				echo $this->Mcar->toUpdate(array('taxinumber' => $taxi_number),array("car_status" => 'ST10'))->result();
                echo json_encode(array('result'=>'success','message'=>'Insert success. Data updated'));
				
		}else{
                echo json_encode(array('result'=>'failed','message'=>'Insert failed. Data cannot save'));
            }
        }else{
            echo json_encode(array('result' => 'failed', 'message' => 'Restricted request'));
        }
		
    }
	
    public function update(){
		$nik = $this->input->post("nik") != "" ? Controls::alphanumeric($this->input->post("nik",TRUE)) : "0";
		$phone = $this->input->post("phone") != "" ? Controls::numerics($this->input->post("phone",TRUE)) : "0";
		$addrs = $this->input->post("address") != "" ? Controls::alphanumeric($this->input->post("address",TRUE)) : "0";
		$email = $this->input->post("email") != "" ? Controls::alphanumeric($this->input->post("email",TRUE)) : "0";
		
        // $nik = $this->input->post("nik") != "" ? Controls::alphanumeric($this->input->post("nik",TRUE)) : "0";
        // $addrs = $this->input->post("addrs") != "" ? Controls::alphanumeric($this->input->post("addrs",TRUE)) : "0";
        // $name = $this->input->post("name") != "" ? Controls::alphanumeric($this->input->post("name",TRUE)) : "0";
        // $phone = $this->input->post("phone") != "" ? Controls::numerics($this->input->post("phone",TRUE)) : "0";
        // $birthday = Controls::validdate($this->input->post("birthday",TRUE)) ? $this->input->post("birthday",TRUE) : Controls::ConvertBulanToAngka($this->input->post("birthday"));
        // $marital = $this->input->post("marital");
        // $sex = $this->input->post("sex") != "" ? $this->input->post("sex",TRUE) : "0";
        // $id_car = $this->input->post("taxi_number");
        //$this->load->model('Mcar');
        //$car = new $this->Mcar();
        //$find_car = json_decode($car->toWhere(array('taxi_number' => $id_car))->result(), TRUE);
		
        // if($find_car['total'] == '0'){
            // $car_id = $id_car;
        // }else{
            // $car_id = $find_car['rows'][0]['id_car'];
        // }
        // $taxixkey = $this->input->post('taxixkey',TRUE);
		
        // if($taxixkey == 'keys'){
            // $this->load->model('Mdriver');
            // echo $this->Mdriver->toUpdate(array('nik' => $nik),array("addrs" => $addrs, "name" => $name, "phone" => $phone, "birthday" => $birthday, "marital" => $marital, "sex" => $sex, "id_car"=>$car_id))->result();
        // }else{
            // echo json_encode(array('result' => 'failed', 'message' => 'Restricted request'));
        // }
		
		$this->load->model('Mdriver');
		$driver = new $this->Mdriver();
		$find_driver = json_decode($driver->toWhere(array('nik' => $nik))->result(), TRUE);
		
		if($find_driver['total'] == '0'){
            $driver_id = $nik;
        }else{
            $driver_id = $find_driver['rows'][0]['nik'];
        }
        $taxixkey = $this->input->post('taxixkey',TRUE);
		
        if($taxixkey == 'keys'){
            $this->load->model('Mdriver');
            echo $this->Mdriver->toUpdate(array('nik' => $nik),array("phone" => $phone,"address" => $addrs, "email" => $email))->result();
        }else{
            echo json_encode(array('result' => 'failed', 'message' => 'Restricted request'));
        }
    }
	
    public function delete(){
        $nik = $this->input->post('nik') != '' ? Controls::alphanumeric($this->input->post('nik',TRUE)) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);
        if($taxixkey == 'keys'){
            $this->load->model('Mdriver');
            echo $this->Mdriver->toDelete(array('nik'=>$nik))->result();
        }else{
            echo json_encode(array('result' => 'failed','message'=>'Restricted request'));
        }
    }
    public function selects(){
        $page = $this->input->post('page') != '' ? $this->input->post('page',TRUE) : '1';
        $rows = $this->input->post('rows') != '' ? $this->input->post('rows',TRUE) : '10';
        $orderby = $this->input->post('order') != '' ? $this->input->post('order',TRUE) : 'asc';
        $sortby = $this->input->post('sort') !='' ? $this->input->post('sort',TRUE) : 'nik';
        $searchby = $this->input->post('search') != '' ? Controls::alphanumeric($this->input->post('search',TRUE)) : '0';
        $keyword = $this->input->post('keyword') != '' ? Controls::alphanumeric($this->input->post('keyword',TRUE)) : '0';
        $taxixkey = $this->input->post('taxixkey',TRUE);

        if($taxixkey == 'keys'){
            $this->load->model('Mdriver');
            $data = json_decode($this->Mdriver->toSelect()->result(),TRUE);
            foreach ($data['rows'] as $k) {
                //$select[] = array('nik' => $k['nik'],$k['active_date_since'],'addrs'=>$k['addrs'],'birthday'=> Controls::format_date3($k['birthday'],'datetime'),'driver_status'=>$k['driver_status'],'marital'=>$k['marital'],'name'=>$k['name'],'phone'=>$k['phone'],'sex'=>$k['sex'], 'taxi_number'=>$this->Mdriver->getNoTaksi($k['id_car'])->taxi_number);
				$select[] = array(
							'nik' => $k['nik'],'driverstatus'=>$k['driverstatus'],
							'phone'=> $k['phone'],'statuslogin'=>$k['statuslogin'],
							'idcom'=>$k['idcom'],'address'=>$k['address'],
							'email'=>$k['email'],'fullname'=>$k['fullname'],
							'username'=>$k['username'],'urlpicture'=>$k['urlpicture']);
            }
            echo ($this->Mdriver->area_read($page, $rows, $sortby, $orderby, $searchby, $keyword));
            //echo json_encode($select);
        }else{
            echo json_encode(array('total' => 0, 'rows' => '0'));
        }
    }
    public function datas()
    {
        $page = $this->input->post('page') != '' ? $this->input->post('page') : '1';
        $rows = $this->input->post('rows') != '' ? $this->input->post('rows') : '10';
        $sort = $this->input->post('sort') != '' ? $this->input->post('sort') : 'kode_area';
        $order = $this->input->post('order') != '' ? $this->input->post('order') : 'asc';
        $keyword = $this->input->post('keyword') != '' ? Controls::alphanumeric($this->input->post('keyword',TRUE)) : '0';
        $searchby = $this->input->post('search') != '' ? Controls::alphanumeric($this->input->post('search',TRUE)) : '0';
        $sskey = $this->input->post('taxixkey',TRUE);
        if(parent::validatekey($sskey) === TRUE){
            $this->load->model('Mdriver');
            echo $this->Mdriver->area_read($page, $rows, $sort, $order, $searchby, $keyword);
        }else{
            echo json_encode(array('total' => '0','rows' => '0'));
        }
    }
    public function gettaxi()
    {
        $this->load->model('Mdriver');
        echo $this->Mdriver->toSelect(array('nik', 'nomor_polisi','taxi_number','imei'))->toSearch('imei','is not null')->toSearch('taxi_number','is not null')->toSearch('nomor_polisi','is not null')->toSearch('name','is null')->result();
    }

    public function getEditTaxi()
    {
        $this->load->model('Mdriver');
        echo $this->Mdriver->getAllNoTaksi()->result;
    }
	
	public function getCompany()
	{
		$this->load->model('Mdriver');
		echo $this->Mdriver->getIdComp()->result;
	}
	
	public function getImeiTaxi()
	{
		$this->load->model('Mdriver');
		echo $this->Mdriver->getImei()->result;
	}
		
    public function getsopir(){
        $sql = "SELECT * FROM driver WHERE nik NOT IN(SELECT nik FROM taxi_device WHERE nik IS NOT NULL)";
        $query = $this->db->query($sql);
        $sopir = array();
        if($query->num_rows() > 0){
            foreach ($query->result() as $ue) {
                $sopir[] = $ue;
            }
            echo json_encode($sopir);
        }else{
            echo json_encode($sopir);
        }
    }
    public function getIDTaxi($string){
        $sql = "select id_car from car_profile where taxi_number='$string'";
        $query = $this->db->query($sql);
        return $query->row();
    }
}
