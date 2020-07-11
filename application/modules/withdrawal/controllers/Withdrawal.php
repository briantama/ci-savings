<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Withdrawal extends CI_Controller {

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
	function viewWithdrawal(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){
      $limit = ($uri1 != "ALL") ? "LIMIT ". $uri1 : "";
      $qry = $this->db->query("SELECT * FROM T_Withdrawal ".$limit." ");
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
      $withdrawalid  = $_POST['withdrawalid'];
      $withdrawaldt  = $_POST['withdrawaldate'];
      $studentid     = $_POST['studentid'];
      $total         = $_POST['entered'];
      $desc          = '';

      $res = $this->db->query("SELECT WithdrawalID FROM T_Withdrawal WHERE WithdrawalID = '".$withdrawalid."'");
          if ($res->num_rows() == 0) {
						
            $this->db->query("INSERT INTO T_Withdrawal
																		( WithdrawalID, WithdrawalDate, StudentID, TotalWithdrawal, Description, 
                                      IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate ) 
															VALUES 
																		( '".$withdrawalid."', '".$withdrawaldt."', '".$studentid."', ".$total.", '',
                                      'Y', '".$usernm."', '".$datetm."', '".$usernm."',  '".$datetm."')	
														");
						$msg = "Save";
          }
					else {
						$this->db->query("UPDATE 	T_Withdrawal
																			SET			WithdrawalDate          = '".$withdrawaldt."',
                                              StudentID               = '".$studentid."',
                                              Description             = '".$desc."',
                                              TotalWithdrawal         = ".$total.",
																							IsActive 								= 'Y',
																							LastUpdateDate      		= '".$datetm."',
																							LastUpdateBy        		= '".$usernm."'
																			WHERE 	WithdrawalID  		      = '".$withdrawalid."'
														");
						$msg = "Update";
          }
        
      
      $jeson['status']   = "ok";
      $jeson['id']       = $withdrawalid;
      $jeson['msg']      = "Successfuly ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
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
    //get number id supplier
    else if(trim($uri) == "getnumber"){
      $xdate = date('ym');
      $qry = $this->db->query("SELECT  CONCAT('WTL-".$xdate."-',LPAD(COALESCE(MAX(RIGHT(WithdrawalID, 6)), '000000')+1,6,0)) AS GetID
                               FROM    T_Withdrawal");
      if ($qry->num_rows() > 0) {
        $res = $qry->row();
        echo json_encode($res);
      }
      else{
        $str["GetID"]  = "";
        $this->jcode($str);
      }
      exit();
    }
    else if(trim($uri) == "print"){
      $this->load->model('Withdrawal_model');
      $data['title']        = 'Print Data Withdrawal';
      $data['isi']          = 'withdrawal/Withdrawal_print';
      $data['datawdh']      = $this->Withdrawal_model->ViewGetWithdrawal()->result();
      $this->load->view('withdrawal/Withdrawal_print',$data);
    }
    else if(trim($uri) == "export"){
      $this->load->model('Withdrawal_model');
      $data['title']        = 'Export Data Withdrawal';
      $data['isi']          = 'withdrawal/Withdrawal_export';
      $data['filenm']       = 'withdrawal-transaction';
      $data['datawdh']      = $this->Withdrawal_model->ViewGetWithdrawal()->result();
      $this->load->view('withdrawal/Withdrawal_export',$data);
    }
    else if (trim($uri) == "delete") {

      //post file
      $WithdrawalID  = $_POST['WithdrawalID'];

        $this->db->query("UPDATE  T_Withdrawal 
                          SET     IsActive        = 'N',
                                  LastUpdateDate  = '".$datetm."',
                                  LastUpdateBy    = '".$usernm."' 
                          WHERE   WithdrawalID    = '".$WithdrawalID."'
                        ");

        $ret_arr['status']  = "ok";
        $ret_arr['caption'] = "Delete Success !!!";
        $this->jcode($ret_arr);
        exit();
    }
    else{
      $this->load->model('Withdrawal_model');
      $data['title']        = 'Data Withdrawal';
      $data['isi']          = 'withdrawal/Withdrawal_view';
      $data['datawdh']      = $this->Withdrawal_model->ViewGetWithdrawal()->result();
      $this->load->view('withdrawal/Withdrawal_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}