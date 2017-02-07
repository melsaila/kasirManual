<?php
class MY_Controller extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('login') === FALSE){
            redirect('login/timeout', 'refresh');
        }
    }
    public function generatekey()
	{
		$_k = $this->session->userdata('session_id');
		$_salt = str_split(Controls::numerics($this->session->userdata('waktulogin')));
		$k = str_split($_k);
		$i = 0;
		$temp = array();
		$x = 0;
		foreach ($k as $v) {
			if(is_numeric($v)){
				array_push($temp, $v);
			}else{
				if($i % 2 == 0){
					$_s = isset($_salt[$x]) ? $_salt[$x] : round(sqrt($i));
					array_push($temp, sprintf("%s%s",strtoupper($v), $_s));
				}else{
					$_s = isset($_salt[$x]) ? $_salt[$x] : round($i/$x);
					array_push($temp, sprintf("%s%s",$v,$_s));
				}
			}
			$i+=1;
			$x+=1;
		}
		return implode("",$temp);
	}
	public function validatekey($key)
	{
		if($key == $this->generatekey()){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}