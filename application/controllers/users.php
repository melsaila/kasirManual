<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/controls.php');
class Users extends CI_Controller{
    public function index(){}
    public function dumm(){
        echo func_num_args();
    }
    public function datas(){
        $this->load->model('Mwuser');
        echo $this->Mwuser->toSelect('id,uname,created,last_login')->toWhere(array('status' => 1))->result();
    }
    public function insert(){
        $username = $this->input->post('username',TRUE);
        $pass = $this->input->post('passwd',TRUE);
        $prepare = array('uname' => $username, 'upass' => $this->encrypt->encode($pass, Controls::$_key), 'created' => Controls::gettimestamp());
        $this->load->model('Mwuser');
        echo $this->Mwuser->toInsert($datas)->result();
    }
    public function update(){
        $id = $this->input->post('userid', TRUE) != '' ? Controls::numerics($this->input->post('userid',TRUE)) : '0';
        $uname = $this->input->post('username', TRUE) != '' ? Controls::remove_special_chars($this->input->post('username',TRUE)) : '0';
        $pass = $this->input->post('passwd',TRUE);
    }
    public function resetp(){
        $id = $this->input->post('userid', TRUE) != '' ? Controls::numerics($this->input->post('userid',TRUE)) : '0';
        $pass = $this->input->post('passwd',TRUE);
        $conpass = $this->input->post('confpasswd',TRUE);

        if($pass != $confpasswd) {
            echo json_encode(array('result'=>'failed','message'=>'Password dan Konfirmasi password tidak sama'));
            return;
        }

        $prepare = array('upass' => $this->encrypt->encode($pass, Controls::$_key));

        $this->load->model('Mwuser');
        echo $this->Mwuser->toUpdate(array('id'=>$id), $prepare)->result();
    }
    public function remove(){
        $id = $this->input->post('userid', TRUE) != '' ? Controls::numerics($this->input->post('userid',TRUE)) : '0';
        $this->load->model('Mwuser');
        echo $this->Mwuser->toDelete(array('id'=>$id))->result();
    }
}
