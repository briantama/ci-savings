<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {

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


	
	function viewStudent(){

    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){
      $limit = ($uri1 != "ALL") ? "LIMIT ". $uri1 : "";
      $qry = $this->db->query("SELECT * FROM M_Student ".$limit." ");
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
      $studentid   = $_POST['studentid'];
      $studentnm   = $_POST['studentname'];
      $classid     = $_POST['classid'];
      $gender      = $_POST['gender'];
      $dateof      = $_POST['dateof'];
      $email       = $_POST['email'];
      $adress      = $_POST['adress'];
      $joindate    = $_POST['joindate'];

      $res = $this->db->query("SELECT StudentID FROM M_Student WHERE StudentID = '".$studentid."'");
        if ($res->num_rows() == 0) {
						
            $this->db->query("INSERT INTO M_Student
									( StudentID, classID, StudentName, Gender, DateOfBirth, Email, Adress, JoinDate, 
									    IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate  ) 
							VALUES 
									( '".$studentid."', '".$classid."', '".$studentnm."', '".$gender."', '".$dateof."', 
                    '".$email."', '".$adress."',  '".$joindate."', 
                    'Y', '".$usernm."', '".$datetm."', '".$usernm."',  '".$datetm."')	
							");
			$msg = "Save";
        }
		else 
		{
			$this->db->query("	UPDATE 	M_Student
								SET		classID               = '".$classid."',
                                        StudentName           = '".$studentnm."',
                                        Gender                = '".$gender."',
                                        DateOfBirth           = '".$dateof."',
                                        Email                 = '".$email."',
                                        Adress                = '".$adress."',
                                        JoinDate              = '".$joindate."',
										IsActive 		      = 'Y',
										LastUpdateDate        = '".$datetm."',
										LastUpdateBy          = '".$usernm."'
								WHERE 	StudentID  			  = '".$studentid."'
							");
			$msg = "Update";
          }
        
      
      $jeson['status']   = "ok";
      $jeson['id']       = $studentid;
      $jeson['msg']      = "Successfuly ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }
		else if(trim($uri) == "searchclass"){
        $varbl =  $jdeco->query;
        if(trim($varbl))
        {
          $query = $this->db->query(" 

                                    SELECT   ClassID, ClassName, Description, IsActive
																		FROM     M_Class
																		WHERE    IsActive ='Y'
																						 AND (ClassID LIKE '%".$varbl."%' OR ClassName LIKE '%".$varbl."%')
                                ");
           if ($query->num_rows() > 0) {
            $arr = $query->result();
            foreach($arr as $key){
              $data[] = ["classid" => $key->ClassID." - ".$key->ClassName, "keyclassid" => $key->ClassID, "classname" => $key->ClassName];
            }
           }
           else{
            $data = array();
           }

           $this->jcode($data);
           exit;
        }
        else
        {
           $data = array();
           $this->jcode($data);
           exit;
        }

    }
    else if(trim($uri) == "print"){
      $this->load->model('Student_model');
      $data['title']        = 'Print Data Student';
      $data['isi']          = 'student/Student_print';
      $data['studentdt']    = $this->Student_model->ViewGetStudent()->result();
      $this->load->view('student/Student_print',$data);
    }
    else if(trim($uri) == "export"){
      $this->load->model('Student_model');
      $data['title']        = 'Export Data Student';
      $data['isi']          = 'student/Student_export';
      $data['filenm']       = 'master-student';
      $data['studentdt']    = $this->Student_model->ViewGetStudent()->result();
      $this->load->view('student/Student_export',$data);
    }
    else if (trim($uri) == "delete") {

      //post file
      $studentid  = $_POST['StudentID'];

        $this->db->query("UPDATE  M_Student 
                          SET     IsActive        = 'N',
                                  LastUpdateDate  = '".$datetm."',
                                  LastUpdateBy    = '".$usernm."' 
                          WHERE   StudentID       = '".$studentid."'
                        ");

        $ret_arr['status']  = "ok";
        $ret_arr['caption'] = "Delete Success !!!";
        $this->jcode($ret_arr);
        exit();
    }
    else{
      $this->load->model('Student_model');
      $data['title']        = 'Data Student';
      $data['isi']          = 'student/Student_view';
      $data['studentdt']    = $this->Student_model->ViewGetStudent()->result();
      $this->load->view('student/Student_view',$data);
    }
}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}