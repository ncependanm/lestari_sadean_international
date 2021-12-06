<?php
class product extends CI_Controller{
    
    var $folder =   "backend/product";
    var $tables =   "tbl_galery";
    var $pk     =   "galery_id";
    var $title  =   "Data Product";
    var $titleInputan  =   "Form Product";
    
    function __construct() {
        parent::__construct();
		$this->load->model('product_model','productModel');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    
    function index()
    {    
        $data['judulHalaman'] = "Product - Lestari Sadean Internasional";
        $data['menu'] = "gambar";
        $data['subMenu'] = "product";
        $data['titleInputan'] = $this->titleInputan;
		
		$sqlKategori = "SELECT * FROM tbl_kategori";
		$dataKategori = $this->db->query($sqlKategori)->result();
		$data['dataKategori'] = $dataKategori;
		
        $data['titlePage'] = 'Gambar';
        $data['titlePageSmall'] = 'Product';
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$list = $this->productModel->get_datatables();
		$data = array();
		$no = 0;
		foreach ($list as $p) {
			$row = array();
			$no++;
			$row[] = $no;
			$row[] = $p->kategori_nama;
			$row[] = $p->galery_ket;
			$row[] = '<img width="100%" src='. base_url() .$p->galery_img_src.'>';
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$p->galery_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<a class="btn btn-sm btn-danger" id="hapusData" href="javascript:void(0)" title="Hapus" data-id="'.$p->galery_id.'"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->productModel->count_all(),
						"recordsFiltered" => $this->productModel->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
		
	public function uploadFoto()
	{
		$id = $this->input->post('id');
		$keterangan = $this->input->post('galery_ket');
		$kategori = $this->input->post('galery_kategori');
		$ubah = $this->input->post('galery_ubah');
		if($id == 'add'){
			$fileName = $this->input->post('file', TRUE);

			$config['upload_path'] = './assets/images/product/'; 
			$config['file_name'] = 'product'.time();
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);
			$this->load->library('image_lib');
			$this->upload->initialize($config); 
				  
			if (!$this->upload->do_upload('file')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('msgUpload',$this->upload->display_errors()); 
				redirect('backend/product'); 
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
				
				$inputFileName = 'assets/images/product/'.$media['file_name'];
				
				$data = array(
					'galery_ket' => $keterangan,
					'galery_kategori' => $kategori,
					'galery_img_src' => $inputFileName,
				);			
				$this->db->insert($this->tables,$data);			
				$this->session->set_flashdata('msgUpload','Sukses Upload Foto'); 
				redirect('backend/product'); 
			}  			
		} else {
			
			if($ubah == 'Y'){
				$fileName = $this->input->post('file', TRUE);

				$config['upload_path'] = './assets/images/product/'; 
				$config['file_name'] = 'product'.time();
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['max_size'] = 2048;

				$this->load->library('upload', $config);
				$this->load->library('image_lib');
				$this->upload->initialize($config); 
					  
				if (!$this->upload->do_upload('file')) {
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('msgUpload',$this->upload->display_errors()); 
					redirect('backend/product'); 
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
					
					$inputFileName = 'assets/images/product/'.$media['file_name'];
					
					$data = array(
						'galery_ket' => $keterangan,
						'galery_kategori' => $kategori,
						'galery_img_src' => $inputFileName,
					);			
					$this->mcrud->update($this->tables,$data, $this->pk,$id);
					$this->session->set_flashdata('msgUpload','Sukses Upload Foto'); 
					redirect('backend/product'); 
				}
			} else {			
				$data = array(
					'galery_ket' => $keterangan,
						'galery_kategori' => $kategori,
				);			
				$this->mcrud->update($this->tables,$data, $this->pk,$id);
				$this->session->set_flashdata('msgUpload','Sukses Update'); 
				redirect('backend/product'); 
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
			$gambar = '<img width="100%" src='. base_url() .$d->galery_img_src.'>';	
		}
        echo json_encode(array("data" => $data , "gambar" => $gambar));
    }
}
