<?php
class news extends CI_Controller{
    
    var $folder =   "news";
    var $tables =   "";
    var $pk     =   "";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $data['desc'] = "";
        $data['info'] = "";
        $data['menu'] = "news";
        $data['judulHalaman'] = "News - Lestari Sadean Internasional";
		
		$sqlBlog = "SELECT * FROM tbl_blog ORDER BY blog_id desc Limit 10";
		$dataBlog = $this->db->query($sqlBlog)->result();
		$data['dataBlog'] = $dataBlog;
		
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
				
		$this->template->load('template', $this->folder.'/index',$data);
    }
	
	function readmore($id)
    {
        $data = $this->mcrud->getByID('tbl_blog',  'blog_id',$id)->row_array();
        echo json_encode($data);
    }
}