<?php
class product extends CI_Controller{
    
    var $folder =   "product";
    var $tables =   "";
    var $pk     =   "";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $data['desc'] = "";
        $data['info'] = "";
        $data['menu'] = "product";
        $data['judulHalaman'] = "Our Product - Lestari Sadean Internasional";
		
		$sqlKategori = "SELECT * FROM tbl_kategori";
		$dataKategori = $this->db->query($sqlKategori)->result();
		$data['dataKategori'] = $dataKategori;
		
		$sqlGalery = "SELECT * FROM tbl_galery LIMIT 12";
		$dataGalery = $this->db->query($sqlGalery)->result();
		$data['dataGalery'] = $dataGalery;
		
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