<?php
class home extends CI_Controller{
    
    var $folder =   "home";
    var $tables =   "";
    var $pk     =   "";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $data['desc'] = "";
        $data['info'] = "";
        $data['menu'] = "home";
        $data['judulHalaman'] = "Home - Lestari Sadean Internasional";
		
		$sqlSlide = "SELECT * FROM tbl_slide";
		$dataSlide = $this->db->query($sqlSlide)->result();
		$data['dataSlide'] = $dataSlide;
		
		$sqlSlideDua = "SELECT * FROM tbl_slide_dua";
		$dataSlideDua = $this->db->query($sqlSlideDua)->result();
		$data['dataSlideDua'] = $dataSlideDua;
		
		$sqlDataMedsos = "SELECT * FROM tbl_medsos";
		$dataMedsos = $this->db->query($sqlDataMedsos)->result();
		$urlFB = '';
		$urlIG = '';
		foreach($dataMedsos as $m){
			if($m->medsos_nama == 'Facebook'){
				$urlFB = $m->medsos_url;
			} else {
				$urlIG = $m->medsos_url;				
			}
		}
		$data['urlFB'] = $urlFB;
		$data['urlIG'] = $urlIG;
		
		$sqlGalery = "SELECT * FROM tbl_galery LIMIT 12";
		$dataGalery = $this->db->query($sqlGalery)->result();
		$data['dataGalery'] = $dataGalery;
				
		$this->template->load('template', $this->folder.'/index',$data);
    }
	
	function kirimEmail()
	{
		
		//$emailTujuan = 'mail@minaretseven.com';
		$emailTujuan = 'minaretseven.media@gmail.com';
		$email = $this->input->post('email');
		$name = $this->input->post('name');
		$subject = $this->input->post('subject') . ' Dari (' . $name . ' - ' .$email . ')';
		$message = $this->input->post('message');
		if ($this->mcrud->sendMail($emailTujuan, $subject, $message))
		{
			echo json_encode(array("status" => TRUE, "msg" => "Data Sukses"));			
		} else {
			echo json_encode(array("status" => TRUE, "msg" => "Data Sukses"));
		}
	}	
}