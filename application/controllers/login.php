<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/controls.php');
class Login extends CI_Controller{
    public function index(){
        if($this->session->userdata('login') === TRUE){
            //redirect('home','refresh');
            $d['taksikey'] = 'taksikey';
			$this->load->view('vlogin',$d);
        }else{
            $d['taksikey'] = 'taksikey';
            $this->load->view('vlogin',$d);
        }
    }
    public function start() {
        $this->load->view('startpage');
    }
    public function dologin(){
        $user = $this->input->post('username',TRUE);
        $pass = $this->input->post('passwd',TRUE);
		
	
		$this->session->set_userdata('cek',$user);
		
		
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('passwd', 'Password', 'required');
		

        if($this->form_validation->run() === FALSE){
            redirect('login','refresh');
        }else{
            $validation = self::_checkuser($user, $pass);
            if($validation['result'] === TRUE){
                $this->load->model('Mwuser');
                $this->Mwuser->toUpdate(array('id'=>$validation['data']['id']), array('last_login' => Controls::gettimestamp()))->result();
                self::_setsession($validation['data']);
                redirect('home','refresh');
            }else{
                $d['username'] = $user;
                $d['taksikey'] = 'taksikey';
                $d['message'] = 'Username dan/atau password salah';
                $this->load->view('vlogin',$d);
            }
        }
    }
    public function dologout(){
        $this->session->sess_destroy();
        redirect("http://103.30.123.69/webdriver/manual/","refresh");
    }
    private function _checkuser($username, $password){
        $this->load->model('Mwuser');
        $y = new $this->Mwuser();
        $datauser = json_decode($y->toSelect('password,last_login,username_company,id')->toWhere(array('username_company'=>$username,'password'=>$password,'status'=>1))->result(),TRUE);
        if(intval($datauser['total']) == 1){
			//$valid = array('result' => self::_validitypass($datauser['rows'][0]['password'], $password), 'data' => array('last_login' => Controls::format_date($datauser['rows'][0]['last_login']), 'username_company' => $datauser['rows'][0]['username_company'], 'id' => $datauser['rows'][0]['id'], 'login'=>TRUE));
			$valid = array('result' => TRUE, 'data' => array('last_login' => Controls::format_date($datauser['rows'][0]['last_login']), 'username_company' => $datauser['rows'][0]['username_company'], 'id' => $datauser['rows'][0]['id'], 'login'=>TRUE));
	   }else{
            $valid = array('result'=>FALSE);
        }
        return $valid;
    }
	
    private function _validitypass($dp,$gp){
        $check = $this->encrypt->decode($dp, Controls::$_key);
        return (bool)($check === $gp ? TRUE : FALSE);
    }
	
    private function _setsession($data){
        $this->session->set_userdata($data);
    }
    public function timeout(){
        $this->load->view('vredirect');
    }
}