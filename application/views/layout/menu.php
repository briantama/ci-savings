  <?php

  $title  = "No Name";
  $setrv  = "SV";
  $res    = $this->db->query("
                          SELECT  SetupTitle, SetupImageDasbor, SetupImage
                          FROM    M_Setupprofile
                          ");
  if ($res->num_rows() > 0) {
    $settl  = $res->row();
    $setrv  = substr($settl->SetupTitle, 0,2);
    if($settl->SetupImageDasbor == "N"){
      $title = $settl->SetupTitle;
    }
    else{
      if(file_exists("./upload/profile/".$settl->SetupImage)){
        $imgurl = base_url()."upload/profile/".$settl->SetupImage;
        $title  = '<div class="clearfix mb-2"></div>';
        $title .= "<img src='".$imgurl."' alt='logo' width='50' height='50' class='img-responsive'>&nbsp;";
        $title .= $settl->SetupTitle;
        $title .= '<div class="clearfix mb-3"></div>';
      }
      else{
        $imgurl = base_url()."upload/profile/default.jpeg";
        $title  = '<div class="clearfix mb-2"></div>';
        $title .= "<img src='".$imgurl."' alt='logo' width='50' height='50' class='img-responsive'>&nbsp;";
        $title .= $settl->SetupTitle;
        $title .= '<div class="clearfix mb-3"></div>';
      }
    }
  }


  //image user
    $img = "";
    $query = $this->db->query(" SELECT  AdminImage 
                                FROM    M_User
                                WHERE   UserName ='".$this->session->userdata('nama')."'
                                      ");
    if ($query->num_rows() > 0) {
      $arr = $query->first_row();
      $img = $arr->AdminImage;
               //echo $doc;
    }

      $urlimg = (trim($img) == "") ? "default.jpeg" : $img;
      $locate = "./upload/user/".$urlimg;
      if(file_exists($locate)){
        $image = base_url()."upload/user/".$urlimg;
      }
      else{
        $image = base_url()."upload/user/default.jpeg";
      }
  

  ?>

  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
              <div class="search-header">
                Histories
              </div>
              <div class="search-item">
                <a href="#">How to hack NASA using CSS</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">Kodinger.com</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">#Stisla</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-header">
                Result
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="<?php echo base_url(); ?>/stisla-master/assets/img/products/product-3-50.png" alt="product">
                  oPhone S9 Limited Edition
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="<?php echo base_url(); ?>/stisla-master/assets/img/products/product-2-50.png" alt="product">
                  Drone X2 New Gen-7
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="<?php echo base_url(); ?>/stisla-master/assets/img/products/product-1-50.png" alt="product">
                  Headphone Blitz
                </a>
              </div>
              <div class="search-header">
                Projects
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-danger text-white mr-3">
                    <i class="fas fa-code"></i>
                  </div>
                  Stisla Admin Template
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-primary text-white mr-3">
                    <i class="fas fa-laptop"></i>
                  </div>
                  Create a new Homepage Design
                </a>
              </div>
            </div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          
          
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> 
            <img alt="image" src="<?php echo $image; ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?php echo $this->session->userdata('nama');?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <div class="dropdown-title">Logged in 5 min ago</div> -->
              <a onclick="callpage('profile/viewProfile', '', '');" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
             <!-- <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>-->
              <a onclick="callpage('user/viewUser', '', '');" class="dropdown-item has-icon">
                <i class="fas fa-users"></i> Users
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url('login/logout'); ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#"><?php echo $title; ?></a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="#"><?php echo $setrv; ?></a>
          </div>
          <ul class="sidebar-menu">
              <li style="cursor: pointer;" class="menu-header" onclick="callpage('dasbor', '', '');"></i> Dashboard </li>
              <li class="menu-header">Master</li>
             
              <li id="m-student"><a style="cursor: pointer;" class="nav-link" onclick="callpage('student/viewStudent', 'm-student', '');"><i class="far fa-square"></i> <span>Master Student</span></a></li>
              <li id="m-class"><a style="cursor: pointer;" class="nav-link" onclick="callpage('mclass/viewClass', 'm-class', '');"><i class="far fa-square"></i> <span>Master Class</span></a></li>
             
              <li class="menu-header">Transaction</li>
              <li id="t-deposit"><a style="cursor: pointer;" class="nav-link" onclick="callpage('deposit/viewDeposit', 't-deposit', '');"><i class="far fa-square"></i> <span>Deposit</span></a></li>
              <li id="t-withdrawal"><a style="cursor: pointer;" class="nav-link" onclick="callpage('withdrawal/viewWithdrawal', 't-withdrawal', '');"><i class="far fa-square"></i> <span>Withdrawal</span></a></li>
              
              
              <li class="menu-header">Report</li>
              <li id="r-deposit"><a style="cursor: pointer;" class="nav-link" onclick="callpage('reportdeposit/viewReportDeposit', 'r-deposit', '');"><i class="far fa-square"></i> <span>Deposit</span></a></li>
              <li id="r-withdrawal"><a style="cursor: pointer;" class="nav-link" onclick="callpage('reportwithdrawal/viewReportWithdrawal', 'r-withdrawal', '');"><i class="far fa-square"></i> <span>Withdrawal</span></a></li>
              <li id="r-saving"><a style="cursor: pointer;" class="nav-link" onclick="callpage('reportsaving/viewReportSaving', 'r-saving', '');"><i class="far fa-square"></i> <span>Savings Balance Detail</span></a></li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-cog"></i> <span>Setup</span></a>
                <ul class="dropdown-menu">
                  <li id="s-setup"><a style="cursor: pointer;" onclick="callpage('setupprofile/viewSetupprofile', 's-setup', '');">Setup Company</a></li>
                  <li id="s-logo"><a style="cursor: pointer;" onclick="callpage('logo/viewLogo', 's-logo', '');">Setup Logo</a></li>
                </ul>
              </li>
            
            </ul>

        </aside>
      </div>

     
   