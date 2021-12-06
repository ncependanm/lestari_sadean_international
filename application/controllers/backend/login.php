<?php
class login extends CI_Controller{
    
    var $folder =   "backend";
    var $tables =   "tbl_user";
    var $pk     =   "user_id";
    
    function __construct() {
        parent::__construct();
        $this->load->helper('captcha','string');
    }
    
    function index()
    {
        $data['desc'] = "";
        $data['info'] = "";
        $data['judulHalaman'] = "Login - Lestari Sadean Internasional";
		
		$this->load->view('backend/login',$data);
    }
		
	function auth()
	{
		$username   =  $this->input->post('user_username');
        $password   =  $this->input->post('user_password');
        $login=  $this->db->get_where('tbl_user',array('user_username'=>$username,'user_password'=>  md5($password)));
        if($login->num_rows()>0)
        {
            $r=  $login->row_array();
			$userId = $r['user_id'];
			$username = $r['user_username'];
			$nama = $r['user_nama'];
			
            $data=array('user_id' => $userId,
                            'user_username' => $username,
                            'user_nama' => $nama
			);
            $this->session->set_userdata($data);
			echo json_encode(array("status" => TRUE, "msg" => "Sukses"));
        } else {
			echo json_encode(array("status" => FALSE, "msg" => "Username atau password salah"));
		}
		
	}
	
	function logout()
    {
        $this->session->sess_destroy();
        redirect('backend/login');
    }
	
}