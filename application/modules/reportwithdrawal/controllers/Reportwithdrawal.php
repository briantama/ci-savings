<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportwithdrawal extends CI_Controller {

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


	//deposit
	function viewReportWithdrawal(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if (trim($uri) == "search") {

      //post file
      $withdrawalid  = (trim($_POST['withdrawalid']) != "") ? "AND A.WithdrawalID = '".$_POST['withdrawalid']."'" : "";
      $startdate     = (trim($_POST['startdate']) != "") ? "AND A.WithdrawalDate >= '".$_POST['startdate']."'" : "";
			$enddate       = (trim($_POST['enddate']) != "") ? "AND A.WithdrawalDate <= '".$_POST['enddate']."'" : "";
      $studentid     = (trim($_POST['studentid']) != "") ? "AND A.StudentID = '".$_POST['studentid']."'" : "";
      $classid       = (trim($_POST['classid']) != "") ? "AND A.ClassID = '".$_POST['classid']."'" : "";
			$statustype    = (trim($_POST['statustype']) != "All") ? "AND A.IsActive = '".$_POST['statustype']."'" : "";

      $qry = $this->db->query("
															
															SELECT A.WithdrawalID, A.WithdrawalDate, A.StudentID, A.TotalWithdrawal,
																		 A.LastUpdateBy, B.StudentName, C.ClassID, C.ClassName
															FROM   T_Withdrawal A
															INNER  JOIN M_Student B ON A.StudentID=B.StudentID
															INNER  JOIN M_Class C ON B.ClassID=C.ClassID
															WHERE  B.IsActive = 'Y'
																		 ".$withdrawalid."
																		 ".$startdate."
																		 ".$enddate."
																		 ".$studentid."
																		 ".$classid."
																		 ".$statustype."
															ORDER  BY A.StudentID, A.WithdrawalID, A.WithdrawalDate
																		 
														");
						
      
       if ($qry->num_rows() > 0) {
        $str = $qry->result();
        $data["StartDate"] = (trim($_POST['startdate']) != "") ? $_POST['startdate'] : date('Y-m-d');
        $data["EndDate"]   = (trim($_POST['enddate']) != "") ? $_POST['enddate'] : date('Y-m-d');
        $data["keys"]      = $str;
 


        $jeson['status']   = "ok";
        $jeson['id']       = $withdrawalid;
        $jeson['msg']      = "Successfuly";
        $jeson['content']  = $this->load->view('reportwithdrawal/Reportwithdrawal_search', $data, TRUE);
        header('Content-Type: text/html');
        echo json_encode($jeson);
        exit;

      }
      else{
        $str = "";
        //$this->jcode($str);
        $jeson['status']   = "failed";
        $jeson['id']       = $withdrawalid;
        $jeson['msg']      = "Record Not Found";
        $jeson['content']  = $str;
        header('Content-Type: text/html');
        echo json_encode($jeson);
        exit;
      }
			
    }
    else if(trim($uri) == "searchstudent"){
        $varbl =  $jdeco->query;
        if(trim($varbl))
        {
          $query = $this->db->query(" 

                                    SELECT  A.StudentID, A.StudentName, 
                                            IFNULL(SUM(B.TotalDeposit),0) -  IFNULL(SUM(B.TotalWithdrawal),0) AS DepositBalance
                                    FROM    M_Student A
                                    LEFT    JOIN (

                                              SELECT X.StudentID, IFNULL(SUM(X.TotalDeposit),0) AS TotalDeposit , 0 AS TotalWithdrawal
                                              FROM   T_Deposit X
                                              INNER  JOIN M_Student V ON X.StudentID=V.StudentID
                                              WHERE  X.IsActive ='Y'
                                              GROUP  BY X.StudentID

                                              UNION ALL 

                                              SELECT Y.StudentID,  0 AS TotalDeposit, IFNULL(SUM(Y.TotalWithdrawal),0) AS TotalWithdrawal
                                              FROM   T_Withdrawal Y 
                                              INNER  JOIN M_Student V ON Y.StudentID=V.StudentID
                                              WHERE  Y.IsActive ='Y'
                                              GROUP  BY Y.StudentID 

                                                ) B ON A.StudentID=B.StudentID

                                    WHERE   (A.StudentID LIKE '%".$varbl."%' OR A.StudentName LIKE '%".$varbl."%')
                                    GROUP   BY A.StudentID, A.StudentName
                                
                                ");
           if ($query->num_rows() > 0) {
            $arr = $query->result();
            foreach($arr as $key){
              $data[] = ["student" => $key->StudentID." - ".$key->StudentName, "keystudent" => $key->StudentID, "studentname" => $key->StudentName, "saldo" => $key->DepositBalance];
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
		else if(trim($uri) == "searchclass"){
        $varbl =  $jdeco->querycl;
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
      $this->load->model('Reportwithdrawal_model');
      $data['title']        = 'Print Report Withdrawal';
      $data['isi']          = 'reportwithdrawal/Reportwithdrawal_print';
      $data['keys']         = unserialize(urldecode($uri1));
      $data["StartDate"]    = $_GET['StartDate'];
      $data["EndDate"]      = $_GET['EndDate'];
      $this->load->view('reportwithdrawal/Reportwithdrawal_print',$data);
    }
    else if(trim($uri) == "export"){
      $this->load->model('Reportwithdrawal_model');
      $data['title']        = 'Export Report Withdrawal';
      $data['isi']          = 'reportwithdrawal/Reportwithdrawal_export';
      $data['keys']         = unserialize(urldecode($uri1));
      $data["StartDate"]    = $_GET['StartDate'];
      $data["EndDate"]      = $_GET['EndDate'];
      $data["filenm"]       = "report-saving-balance";
      $this->load->view('reportwithdrawal/Reportwithdrawal_export',$data);
    }
    else{
      $this->load->model('Reportwithdrawal_model');
      $data['title']        = 'Report Withdrawal';
      $data['isi']          = 'reportwithdrawal/Reportwithdraw_view';
      $data['rptwdh']      = $this->Reportwithdrawal_model->ViewGetReportWithdrawal()->result();
      $this->load->view('reportwithdrawal/Reportwithdrawal_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}