<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mclass extends CI_Controller {

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index() {
		$data=array('title'=>'Apps Savings - Halaman Administrator',
      					 'isi' =>'dasbor/dasbor_view'
      						);
		$this->load->view('layout/wrapper',$data);	
	}


	//galeri widget
	function viewClass(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){
      $limit = ($uri1 != "ALL") ? "LIMIT ". $uri1 : "";
      $qry   = $this->db->query("SELECT * FROM M_Class ".$limit." ");
      if ($qry->num_rows() > 0) {
        $res = $qry->result();
        $this->jcode($res);
      }
      else
      {
        $str = '';
        $this->jcode($str);
      }
      exit();
    }
    else if (trim($uri) == "save") {

      //post file
      $classid     = htmlspecialchars($_POST['classid']);
      $classname   = htmlspecialchars($_POST['classname']);
      $desc        = htmlspecialchars(ucwords(strtolower($_POST['desc'])));

      $res = $this->db->query("SELECT ClassID FROM M_Class WHERE ClassID = '".$classid."'");
          if ($res->num_rows() == 0) {
						
            $this->db->query("INSERT INTO M_Class
																		( ClassID, ClassName, Description,
                                      IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate ) 
															VALUES 
																		( '".$classid."', '".$classname."', '".$desc."',
                                      'Y', '".$usernm."', '".$datetm."', '".$usernm."',  '".$datetm."')	
														");
						$msg = "Save";
          }
					else {
						$this->db->query("UPDATE 	M_Class
																			SET			ClassName               = '".$classname."',
                                              Description             = '".$desc."',
																							IsActive 								= 'Y',
																							LastUpdateDate      		= '".$datetm."',
																							LastUpdateBy        		= '".$usernm."'
																			WHERE 	ClassID  			          = '".$classid."'
														");
						$msg = "Update";
          }
        
      
      $jeson['status']   = "ok";
      $jeson['id']       = $classid;
      $jeson['msg']      = "Successfuly ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }
    else if(trim($uri) == "print"){
      $this->load->model('Class_model');
      $data['title']        = 'Print Data Class';
      $data['isi']          = 'mclass/Class_print';
      $data['dataclass']    = $this->Class_model->ViewGetClass()->result();
      $this->load->view('mclass/Class_print',$data);
    }
    else if(trim($uri) == "export"){
      $this->load->model('Class_model');
      $data['title']        = 'Ecxport Data Class';
      $data['isi']          = 'mclass/Class_export';
      $data['filenm']       = 'master-class';
      $data['dataclass']    = $this->Class_model->ViewGetClass()->result();
      $this->load->view('mclass/Class_export',$data);
    }
    else if (trim($uri) == "delete") {

      //post file
      $classid     = $_POST['ClassID'];

        $this->db->query("UPDATE  M_Class 
                          SET     IsActive        = 'N',
                                  LastUpdateDate  = '".$datetm."',
                                  LastUpdateBy    = '".$usernm."' 
                          WHERE   ClassID         = '".$classid."'
                        ");

        $ret_arr['status']  = "ok";
        $ret_arr['caption'] = "Delete Success !!!";
        $this->jcode($ret_arr);
        exit();
    }
    else{
      $this->load->model('Class_model');
      $data['title']        = 'Data Class';
      $data['isi']          = 'mclass/Class_view';
      $data['dataclass']    = $this->Class_model->ViewGetClass()->result();
      $this->load->view('mclass/Class_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}