<?php
class kategori extends CI_Controller{
    
    var $folder =   "backend/kategori";
    var $tables =   "tbl_kategori";
    var $pk     =   "kategori_id";
    var $title  =   "Data Kategori";
    var $titleInputan  =   "Form Kategori";
    
    function __construct() {
        parent::__construct();
		$this->load->model('kategori_model','kategoriModel');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    
    function index()
    {    
        $data['judulHalaman'] = "Kategori - Lestari Sadean Internasional";
        $data['menu'] = "master";
        $data['subMenu'] = "kategori";
        $data['titleInputan'] = $this->titleInputan;
		
        $data['titlePage'] = 'Master';
        $data['titlePageSmall'] = 'Kategori';
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$list = $this->kategoriModel->get_datatables();
		$data = array();
		$no = 0;
		
		foreach ($list as $p) {
			$row = array();
			$no++;
			$row[] = $no;
			$row[] = $p->kategori_nama;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$p->kategori_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<a class="btn btn-sm btn-danger" id="hapusData" href="javascript:void(0)" title="Hapus" data-id="'.$p->kategori_id.'"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kategoriModel->count_all(),
						"recordsFiltered" => $this->kategoriModel->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
		
	function save()
	{
		$data = array(
			'kategori_nama' => $this->input->post('kategori_nama'),
		);
		$this->db->insert($this->tables,$data);
		echo json_encode(array("status" => TRUE, "msg" => "Data Sukses"));
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
			'kategori_nama' => $this->input->post('kategori_nama'),
		);
		$this->mcrud->update($this->tables,$data, $this->pk,$id);
		echo json_encode(array("status" => TRUE, "msg" => "Data Sukses"));
	}
	
    function delete($id)
    {
        $chekid = $this->db->get_where($this->tables,array($this->pk=>$id));
        if($chekid>0)
        {
            $this->mcrud->delete($this->tables,  $this->pk,  $id);
        }
        echo json_encode(array("status" => TRUE));
    }
}
