<?php
class user extends CI_Controller{
    
    var $folder =   "backend/user";
    var $tables =   "tbl_user";
    var $pk     =   "user_id";
    var $title  =   "Data User";
    var $titleInputan  =   "Form User";
    
    function __construct() {
        parent::__construct();
		$this->load->model('user_model','userModel');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    
    function index()
    {    
        $data['judulHalaman'] = "User - Lestari Sadean Internasional";
        $data['menu'] = "master";
        $data['subMenu'] = "user";
        $data['titleInputan'] = $this->titleInputan;
		
        $data['titlePage'] = 'Master';
        $data['titlePageSmall'] = 'User';
		
		$this->template->load('backend/template', $this->folder.'/index',$data);
    }
	
	public function loadTable()
	{	
		$list = $this->userModel->get_datatables();
		$data = array();
		$no = 0;
		$thn_ajaran_status = '';
		$thn_ajaran_reg_status = '';
		
		foreach ($list as $user) {
			$row = array();
			$no++;
			$row[] = $no;
			$row[] = $user->user_nama;
			$row[] = $user->user_username;
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit('."'".$user->user_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
					<a class="btn btn-sm btn-danger" id="hapusData" href="javascript:void(0)" title="Hapus" data-id="'.$user->user_id.'"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->userModel->count_all(),
						"recordsFiltered" => $this->userModel->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
		
	function save()
	{
		$username = ($this->input->post('user_username'));
		$sql = "SELECT * FROM tbl_user WHERE user_username = '" . $username . "'";
		$jmlUser = $this->db->query($sql)->num_rows();
		
		if($jmlUser == 0){
			$data = array(
				'user_username' => $username,
				'user_password' => MD5($this->input->post('user_password')),
				'user_nama' => strtoupper($this->input->post('user_nama'))
			);
			$this->db->insert($this->tables,$data);
			echo json_encode(array("status" => TRUE, "msg" => "Data Sukses"));
		} else {
			echo json_encode(array("status" => FALSE, "msg" => "Username Sudah Digunakan"));
		}
	}
	
	function prepareEdit($id)
    {
        $data = $this->mcrud->getByID($this->tables,  $this->pk,$id)->row_array();
        echo json_encode($data);
    }
	
    function update()
	{
		$id = $this->input->post('id');
		$username = ($this->input->post('user_username'));
		$sql = "SELECT * FROM tbl_user WHERE user_username = '" . $username . "' AND user_id not in ('". $id ."')";
		$jmlUser = $this->db->query($sql)->num_rows();
		
		if($jmlUser == 0){
			$indPass = $this->input->post('change_pass');
			$pass;
			if($indPass == 'Y'){
				$pass = MD5($this->input->post('user_password'));
			} else {
				$pass = $this->input->post('user_password');
			}
			$data = array(
				'user_username' => ($this->input->post('user_username')),
				'user_password' => $pass,
				'user_nama' => strtoupper($this->input->post('user_nama'))
			);
			$this->mcrud->update($this->tables,$data, $this->pk,$id);
			echo json_encode(array("status" => TRUE, "msg" => "Data Sukses"));
		} else {
			echo json_encode(array("status" => FALSE, "msg" => "Username Sudah Digunakan"));			
		}
	}
	
	public function upload(){
		  $fileName = $this->input->post('file', TRUE);

		  $config['upload_path'] = './assets/upload/'; 
		  $config['file_name'] = $fileName;
		  $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
		  $config['max_size'] = 10000;

		  $this->load->library('upload', $config);
		  $this->upload->initialize($config); 
		  
		  if (!$this->upload->do_upload('file')) {
		   $error = array('error' => $this->upload->display_errors());
		   $this->session->set_flashdata('msg','Ada kesalah dalam upload'); 
		   redirect('backend/unit'); 
		  } else {
		   $media = $this->upload->data();
		   $inputFileName = 'assets/upload/'.$media['file_name'];
		   
		   try {
			$inputFileType = IOFactory::identify($inputFileName);
			$objReader = IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		   } catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		   }

		   $sheet = $objPHPExcel->getSheet(0);
		   $highestRow = $sheet->getHighestRow();
		   $highestColumn = $sheet->getHighestColumn();

		   for ($row = 2; $row <= $highestRow; $row++){  
			 $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
			   NULL,
			   TRUE,
			   FALSE);
			 $data = array(
			 "unit_code"=> $rowData[0][0],
			 "unit_desc"=> $rowData[0][1]
			);
			$this->db->insert($this->tables,$data);
		   } 
		   redirect('backend/unit'); 
		  }  
	} 
	
	function getStore()
    {
		$sql = "SELECT * FROM tbl_store";
		$data = $this->db->query($sql)->result();
		echo "<option value=''>Pilih Salah Satu</option>";
		$tmp1;
        foreach ($data as $r)
        {
            echo "<option value='$r->store_id'>".  strtoupper($r->store_code).' - ' . strtoupper($r->store_name) ."</option>";
        }
    }
	
	function getPriv()
    {
		$sql = "SELECT * FROM tbl_user_priv";
		$data = $this->db->query($sql)->result();
		echo "<option value=''>Pilih Salah Satu</option>";
		$tmp1;
        foreach ($data as $r)
        {
            echo "<option value='$r->user_priv_id'>".  strtoupper($r->user_priv_desc)."</option>";
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

}
