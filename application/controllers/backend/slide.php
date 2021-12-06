<?php
class slide extends CI_Controller{
    
    var $folder =   "backend/slide";
    var $tables =   "tbl_slide";
    var $pk     =   "slide_id";
    var $title  =   "Data Slide";
    var $titleInputan  =   "Form Slide";
    
    function __construct() {
        parent::__construct();
		$this->load->model('slide_model','slideModel');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    
    function index()
    {    
        $data['judulHalaman'] = "Slide - Lestari Sadean Internasional";
        $data['menu'] = "gambar";
        $data['subMenu'] = "slide";
        $data['titleInputan'] = $this->titleInputan;
		
        $data['titlePage'] = 'Gambar';
        $data['titlePageSmall'] = 'Slide';
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$list = $this->slideModel->get_datatables();
		$data = array();
		$no = 0;
		foreach ($list as $p) {
			$row = array();
			$no++;
			$row[] = $no;
			$row[] = $p->slide_title;
			$row[] = $p->slide_ket;
			$row[] = '<img width="100%" src='. base_url() .$p->slide_img.'>';
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$p->slide_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<a class="btn btn-sm btn-danger" id="hapusData" href="javascript:void(0)" title="Hapus" data-id="'.$p->slide_id.'"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->slideModel->count_all(),
						"recordsFiltered" => $this->slideModel->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
		
	public function uploadFoto()
	{
		$id = $this->input->post('id');
		$title = $this->input->post('slide_title');
		$keterangan = $this->input->post('slide_ket');
		$ubah = $this->input->post('slide_ubah');
		if($id == 'add'){
			$fileName = $this->input->post('file', TRUE);

			$config['upload_path'] = './assets/images/slide/'; 
			$config['file_name'] = 'slide'.time();
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);
			$this->load->library('image_lib');
			$this->upload->initialize($config); 
				  
			if (!$this->upload->do_upload('file')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('msgUpload',$this->upload->display_errors()); 
				redirect('backend/slide'); 
			} else {
				$media = $this->upload->data();

				$configer =  array(
				  'image_library'   => 'gd2',
				  'source_image'    =>  $media['full_path'],
				  'maintain_ratio'  =>  TRUE,
				  'width'           =>  1550,
				  'height'          =>  700,
				);
				$this->image_lib->clear();
				$this->image_lib->initialize($configer);
				$this->image_lib->resize();
				
				$inputFileName = 'assets/images/slide/'.$media['file_name'];
				
				$data = array(
					'slide_title' => $title,
					'slide_ket' => $keterangan,
					'slide_img' => $inputFileName,
				);			
				$this->db->insert($this->tables,$data);			
				$this->session->set_flashdata('msgUpload','Sukses Upload Foto'); 
				redirect('backend/slide'); 
			}  			
		} else {
			
			if($ubah == 'Y'){
				$fileName = $this->input->post('file', TRUE);

				$config['upload_path'] = './assets/images/slide/'; 
				$config['file_name'] = 'slide'.time();
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['max_size'] = 2048;

				$this->load->library('upload', $config);
				$this->load->library('image_lib');
				$this->upload->initialize($config); 
					  
				if (!$this->upload->do_upload('file')) {
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('msgUpload',$this->upload->display_errors()); 
					redirect('backend/slide'); 
				} else {
					$media = $this->upload->data();

					$configer =  array(
					  'image_library'   => 'gd2',
					  'source_image'    =>  $media['full_path'],
					  'maintain_ratio'  =>  TRUE,
					  'width'           =>  1550,
					  'height'          =>  700,
					);
					$this->image_lib->clear();
					$this->image_lib->initialize($configer);
					$this->image_lib->resize();
					
					$inputFileName = 'assets/images/slide/'.$media['file_name'];
					
					$data = array(
						'slide_title' => $title,
						'slide_ket' => $keterangan,
						'slide_img' => $inputFileName,
					);			
					$this->mcrud->update($this->tables,$data, $this->pk,$id);
					$this->session->set_flashdata('msgUpload','Sukses Upload Foto'); 
					redirect('backend/slide'); 
				}
			} else {			
				$data = array(
					'slide_title' => $title,
					'slide_ket' => $keterangan,
				);			
				$this->mcrud->update($this->tables,$data, $this->pk,$id);
				$this->session->set_flashdata('msgUpload','Sukses Update'); 
				redirect('backend/slide'); 
			}
		}
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
	
	function prepareEdit($id)
    {
        $data = $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
        $dataTmp = $this->mcrud->getByID($this->tables,  $this->pk,$id)->result();
		$gambar = '';
		foreach($dataTmp as $d){
			$gambar = '<img width="100%" src='. base_url() .$d->slide_img.'>';	
		}
        echo json_encode(array("data" => $data , "gambar" => $gambar));
    }
}
