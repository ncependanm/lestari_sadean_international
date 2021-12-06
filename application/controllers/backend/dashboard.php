<?php
class dashboard extends CI_Controller{
    
    var $folder =   "backend/dashboard";
    
    function __construct() {
        parent::__construct();
    }
    
    function index()
    {    
        $data['judulHalaman'] = "Dashboard - Lestari Sadean Internasional";
        $data['menu'] = "dashboard";
        $data['subMenu'] = "";
        $data['subMenuB'] = "";
		
        $data['titlePage'] = 'Dashboard';
        $data['titlePageSmall'] = '';
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
}
