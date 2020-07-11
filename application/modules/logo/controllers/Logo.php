<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logo extends CI_Controller {

  function __construct(){
    parent::__construct();
  
    if($this->session->userdata('status') != "login"){
      redirect(base_url("login"));
    }
  }

  public function index() {
    $data=array('title'=>'Bryn Savings - Halaman Administrator',
                'isi' =>'dasbor/dasbor_view'
                  );
    $this->load->view('layout/wrapper',$data);  
  }


  public function viewLogo() {

    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
   
    //get library
    $datetm     = date('Y-m-d H:i:s');
    $usernm     = $this->session->userdata('nama');


    if (trim($uri) == "save") 
    {
     
      $status = "";
      $msg    = "";
      $file_element_name = 'file';
      if ($status != "error") {
        $config['upload_path']   = './upload/logo/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 1024;
        $config['encrypt_name']  = FALSE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload($file_element_name)) {

          $status = 'ok';
          $msg    = $this->upload->display_errors('', '');

          
          $data = $this->upload->data();
          $image_path = $data['full_path'];
          if(file_exists($image_path)) {
            $status = "ok";
            $msg    = "Upload gambar berhasil";
          } else {
            $status = "ok";
            $msg    = "Terjadi kesalahan. Ulangi lagi.";
          }
          $ambil_gambar = $this->db->query("SELECT SetupImageLogo, SetupprofileID FROM M_Setupprofile WHERE SetupprofileID ='".$_POST["setupid"]."'");
          if ($usernm != "") 
          {

            if($ambil_gambar->num_rows() > 0){
              $ambil_gambar = $ambil_gambar->row();
              if($ambil_gambar->SetupImageLogo != ""){
                if(file_exists("./upload/logo/".$ambil_gambar->SetupImageLogo)){
                  unlink("./upload/logo/".$ambil_gambar->SetupImageLogo);
                }
              }
            }
            
            $this->db->query("UPDATE  M_Setupprofile
                                      SET     SetupImageLogo     = '".$data['file_name']."',
                                              LastUpdateDate     = '".$datetm."',
                                              LastUpdateBy       = '".$usernm."'
                                      WHERE   SetupprofileID     = '".$_POST["setupid"]."'
                            ");
          } 
        }

      }

      $jeson['status']   = $status;
      $jeson['id']       = $_POST["setupid"];
      $jeson['msg']      = "Logo Image ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      $jeson['filenm']   = $data['file_name'];
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }

    // if (trim($uri) == "save") {
    //   $status = "";
    //   $msg    = "";
    //   $file_element_name = 'file';

    //   //post file
    //   $stpid       = $_POST['setupid'];
    //   if ($status != "error") {
    //     $config['upload_path']   = './upload/logo/';
    //     $config['allowed_types'] = 'gif|jpg|png';
    //     $config['max_size']      = 1024;
    //     $config['encrypt_name']  = FALSE;

    //     $this->load->library('upload', $config);
    //     if ($this->upload->do_upload($file_element_name)) {

    //       $status = 'ok';
    //       $msg    = $this->upload->display_errors('', '');
        
    //       $data = $this->upload->data();
    //       $image_path = $data['full_path'];
    //       if(file_exists($image_path)) {
    //         $status = "ok";
    //         $msg    = "Upload gambar berhasil";
    //       } else {
    //         $status = "ok";
    //         $msg    = "Terjadi kesalahan. Ulangi lagi.";
    //       }

    //       $ambil_gambar = $this->db->query("SELECT SetupImageLogo, SetupprofileID FROM M_Setupprofile WHERE SetupprofileID = ".$_POST['setupid']."");
    //       if ($ambil_gambar->num_rows() > 0) {
    //         $ambil_gambar = $ambil_gambar->row();
    //         if($ambil_gambar->SetupImageLogo != ""){
    //           if(file_exists("./upload/logo/".$ambil_gambar->SetupImageLogo)){
    //             unlink("./upload/logo/".$ambil_gambar->SetupImageLogo);
    //           }
    //         }

    //         $this->db->query("
    //                             UPDATE  M_Setupprofile
    //                             SET     SetupImageLogo     = '".$data['file_name']."', 
    //                                     LastUpdateDate     = '".$datetm."',
    //                                     LastUpdateBy       = '".$usernm."'
    //                             WHERE   SetupprofileID     = ".$stpid."
    //                         ");

    //       } 
    //       else 
    //       {
    //            $this->db->query("INSERT INTO M_Setupprofile
    //                                 ( SetupImageLogo ) 
    //                           VALUES 
    //                                 ( '".$data['file_name']."' ) 
    //                         ");
      
    //       }
    //     }
    //   }
      
    //   $jeson['status']   = $status;
    //   $jeson['id']       = $stpid;
    //   $jeson['msg']      = "Setup Logo Save ".$msg;
    //   $jeson['notif']    = "Successfuly Saved !!!";
    //   $jeson['filenm']   = $data['filename'];
    //   header('Content-Type: text/html');
    //   echo json_encode($jeson);
    //   exit;
    // }
    //show data profile
    else if(trim($uri) == "view"){
      $qry = $this->db->query("SELECT * FROM M_Setupprofile");
      if ($qry->num_rows() > 0) {
        $res = $qry->result();
        $this->jcode($res);
      }
      else
      {
        $str = "";
        $this->jcode($str);
      }
      exit();
    }
    else
    {
     
      $this->load->model('Logo_model');
      $data['title']        = 'Setup logo';
      $data['isi']          = 'logo/Logo_view';
      $data['datastp']      = $this->Logo_model->getLogo()->result();
      $this->load->view('logo/Logo_view',$data);

    }

  }

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}