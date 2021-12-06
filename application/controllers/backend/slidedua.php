<?php
class slidedua extends CI_Controller{
    
    var $folder =   "backend/slidedua";
    var $tables =   "tbl_slide_dua";
    var $pk     =   "slide_dua_id";
    var $title  =   "Data Slide Ke Dua";
    var $titleInputan  =   "Form Slide Ke Dua";
    
    function __construct() {
        parent::__construct();
		$this->load->model('slidedua_model','slideduaModel');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    
    function index()
    {    
        $data['judulHalaman'] = "Slide Ke Dua - Lestari Sadean Internasional";
        $data['menu'] = "gambar";
        $data['subMenu'] = "slidedua";
        $data['titleInputan'] = $this->titleInputan;
		
        $data['titlePage'] = 'Gambar';
        $data['titlePageSmall'] = 'Slide Ke Dua';
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$list = $this->slideduaModel->get_datatables();
		$data = array();
		$no = 0;
		foreach ($list as $p) {
			$row = array();
			$no++;
			$row[] = $no;
			$row[] = '<img width="100%" src='. base_url() .$p->slide_dua_img_src.'>';
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$p->slide_dua_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<a class="btn btn-sm btn-danger" id="hapusData" href="javascript:void(0)" title="Hapus" data-id="'.$p->slide_dua_id.'"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->slideduaModel->count_all(),
						"recordsFiltered" => $this->slideduaModel->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
		
	public function uploadFoto()
	{
		$id = $this->input->post('id');
		$ubah = $this->input->post('slide_ubah');
		if($id == 'add'){
			$fileName = $this->input->post('file', TRUE);

			$config['upload_path'] = './assets/images/slidedua/'; 
			$config['file_name'] = 'slidedua'.time();
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);
			$this->load->library('image_lib');
			$this->upload->initialize($config); 
				  
			if (!$this->upload->do_upload('file')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('msgUpload',$this->upload->display_errors()); 
				redirect('backend/slidedua'); 
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
				
				$inputFileName = 'assets/images/slidedua/'.$media['file_name'];
				
				$data = array(
					'slide_dua_img_src' => $inputFileName,
				);			
				$this->db->insert($this->tables,$data);			
				$this->session->set_flashdata('msgUpload','Sukses Upload Foto'); 
				redirect('backend/slidedua'); 
			}  			
		} else {
			
			if($ubah == 'Y'){
				$fileName = $this->input->post('file', TRUE);

				$config['upload_path'] = './assets/images/slidedua/'; 
				$config['file_name'] = 'slidedua'.time();
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['max_size'] = 2048;

				$this->load->library('upload', $config);
				$this->load->library('image_lib');
				$this->upload->initialize($config); 
					  
				if (!$this->upload->do_upload('file')) {
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('msgUpload',$this->upload->display_errors()); 
					redirect('backend/slidedua'); 
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
					
					$inputFileName = 'assets/images/slidedua/'.$media['file_name'];
					
					$data = array(
						'slide_dua_img_src' => $inputFileName,
					);					
					$this->mcrud->update($this->tables,$data, $this->pk,$id);
					$this->session->set_flashdata('msgUpload','Sukses Upload Foto'); 
					redirect('backend/slidedua'); 
				}
			} else {			
				$data = array(
					'slide_title' => $title,
					'slide_ket' => $keterangan,
				);			
				$this->mcrud->update($this->tables,$data, $this->pk,$id);
				$this->session->set_flashdata('msgUpload','Sukses Update'); 
				redirect('backend/slidedua'); 
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
			$gambar = '<img width="100%" src='. base_url() .$d->slide_dua_img_src.'>';	
		}
        echo json_encode(array("data" => $data , "gambar" => $gambar));
    }
}
