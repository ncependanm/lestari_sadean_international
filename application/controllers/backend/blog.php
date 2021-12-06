<?php
class blog extends CI_Controller{
    
    var $folder =   "backend/blog";
    var $tables =   "tbl_blog";
    var $pk     =   "blog_id";
    var $title  =   "Data Blog";
    var $titleInputan  =   "Form Blog";
    
    function __construct() {
        parent::__construct();
		$this->load->model('blog_model','blogModel');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    
    function index()
    {    
        $data['judulHalaman'] = "Blog - Lestari Sadean Internasional";
        $data['menu'] = "blog";
        $data['subMenu'] = "";
		
        $data['titlePage'] = 'Blog';
        $data['titlePageSmall'] = '';
        $data['titleInputan'] = $this->titleInputan;
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$list = $this->blogModel->get_datatables();
		$data = array();
		$no = 0;
		$thn_ajaran_status = '';
		$thn_ajaran_reg_status = '';
		
		foreach ($list as $p) {
			$row = array();
			$no++;
			$row[] = $no;
			$row[] = $p->blog_judul;
			$row[] = $p->blog_isi;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$p->blog_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<a class="btn btn-sm btn-danger" id="hapusData" href="javascript:void(0)" title="Hapus" data-id="'.$p->blog_id.'"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->blogModel->count_all(),
						"recordsFiltered" => $this->blogModel->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
		
	function save()
	{
		$tgl = date('d-M-Y h:i:s');
		$postBy = $this->session->userdata('user_nama');
		$judul = $this->input->post('blog_judul');
		$data = array(
			'blog_judul' => ($judul),
			'blog_tgl' => ($tgl),
			'blog_postby' => ($postBy),
			'blog_isi' => (str_replace('&nbsp;',' ',$this->input->post('editor')))
		);
		$this->db->insert($this->tables,$data);
		$sqlDataBlog = "SELECT * FROM tbl_blog WHERE blog_tgl = '" . $tgl . "' AND blog_judul = '" . $judul . "' AND blog_postby = '" . $postBy . "'";
		$dataBlog = $this->db->query($sqlDataBlog)->result();
		$id = '';
		foreach($dataBlog as $b){
			$id = $b->blog_id;
		}
		echo json_encode(array("status" => TRUE, "msg" => "Data Sukses", "id" => $id));
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
			'blog_judul' => ($this->input->post('blog_judul')),
			'blog_isi' => (str_replace('&nbsp;',' ',$this->input->post('editor')))
		);
		$this->mcrud->update($this->tables,$data, $this->pk,$id);
		echo json_encode(array("status" => TRUE, "msg" => "Data Sukses", "id" => $id));
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
