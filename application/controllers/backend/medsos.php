<?php
class medsos extends CI_Controller{
    
    var $folder =   "backend/medsos";
    var $tables =   "tbl_medsos";
    var $pk     =   "medsos_id";
    var $title  =   "Data Media Sosial";
    var $titleInputan  =   "Form Media Sosial";
    
    function __construct() {
        parent::__construct();
		$this->load->model('medsos_model','medsosModel');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    
    function index()
    {    
        $data['judulHalaman'] = "Media Sosial - Lestari Sadean Internasional";
        $data['menu'] = "master";
        $data['subMenu'] = "medsos";
        $data['titleInputan'] = $this->titleInputan;
		
        $data['titlePage'] = 'Master';
        $data['titlePageSmall'] = 'Media Sosial';
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$list = $this->medsosModel->get_datatables();
		$data = array();
		$no = 0;
		$thn_ajaran_status = '';
		$thn_ajaran_reg_status = '';
		
		foreach ($list as $p) {
			$row = array();
			$no++;
			$row[] = $no;
			$row[] = $p->medsos_nama;
			$row[] = $p->medsos_url;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$p->medsos_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->medsosModel->count_all(),
						"recordsFiltered" => $this->medsosModel->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	function prepareEdit($id)
    {
        $data = $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
        echo json_encode($data);
    }
	
    function update()
	{
		$id = $this->input->post('id');
		$data = array(
			'medsos_nama' => ($this->input->post('medsos_nama')),
			'medsos_url' => ($this->input->post('medsos_url')),
		);
		$this->mcrud->update($this->tables,$data, $this->pk,$id);
		echo json_encode(array("status" => TRUE, "msg" => "Data Sukses"));
	}
}
