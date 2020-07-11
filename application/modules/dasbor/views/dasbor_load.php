<?php

  //chart deposit
  $chartdepo = array(0);
  $qry = $this->db->query("
                            SELECT Z.MonthID, Z.MonthName, IFNULL(Y.TotalDeposit,0) AS TotalDeposit
                            FROM M_Months Z
                            LEFT JOIN (
                              SELECT MONTH(A.DepositDate) AS Bulan, IFNULL(SUM(A.TotalDeposit),0) AS TotalDeposit,
                                     A.LastUpdateBy, B.StudentName, C.ClassID, C.ClassName
                              FROM   T_Deposit A
                              INNER  JOIN M_Student B ON A.StudentID=B.StudentID
                              INNER  JOIN M_Class C ON B.ClassID=C.ClassID
                              WHERE  B.IsActive = 'Y'
                              GROUP  BY MONTH(A.DepositDate)
                              ORDER  BY MONTH(A.DepositDate)

                                ) Y ON Z.MonthID=Y.Bulan
                            ORDER BY Z.MonthID

                           ");
  if ($qry->num_rows() > 0) {
      $chartdepo = $qry->result();
      foreach ($chartdepo as $key) {
        $month[]   = $key->MonthName;
        $totdepo[] = $key->TotalDeposit;
      }
      
  }


  //chart withdrawal
  $chartwdh = array(0);
  $res = $this->db->query("
                            SELECT Z.MonthID, Z.MonthName, IFNULL(Y.TotalWithdrawal,0) AS TotalWithdrawal
                            FROM M_Months Z
                            LEFT JOIN (
                              SELECT MONTH(A.WithdrawalDate) AS Bulan, IFNULL(SUM(A.TotalWithdrawal),0) AS TotalWithdrawal,
                                     A.LastUpdateBy, B.StudentName, C.ClassID, C.ClassName
                              FROM   T_Withdrawal A
                              INNER  JOIN M_Student B ON A.StudentID=B.StudentID
                              INNER  JOIN M_Class C ON B.ClassID=C.ClassID
                              WHERE  B.IsActive = 'Y'
                              GROUP  BY MONTH(A.WithdrawalDate)
                              ORDER  BY MONTH(A.WithdrawalDate)

                                ) Y ON Z.MonthID=Y.Bulan
                            ORDER BY Z.MonthID

                           ");
  if ($res->num_rows() > 0) {
      $chartwdh = $res->result();
      foreach ($chartwdh as $key) {
        $monthwd[]   = $key->MonthName;
        $totwdh[]    = $key->TotalWithdrawal;
      }
      
  }




  //master data
  //student
  $totstd = 0;
  $stu = $this->db->query("

                          SELECT  COUNT(StudentID) as TotalStudent
                          FROM    M_Student 
                          WHERE   IsActive = 'Y'
                          ");
  if ($stu->num_rows() > 0) {
    $keystu = $stu->row();
    $totstd = $keystu->TotalStudent;
  }


//deposit
  $totdpo = 0;
  $dpo = $this->db->query("
                              SELECT IFNULL(SUM(A.TotalDeposit),0) AS TotalDeposit
                              FROM   T_Deposit A
                              INNER  JOIN M_Student B ON A.StudentID=B.StudentID
                              INNER  JOIN M_Class C ON B.ClassID=C.ClassID
                              WHERE  B.IsActive = 'Y'
                          ");
  if ($dpo->num_rows() > 0) {
    $keydpo = $dpo->row();
    $totdpo = $keydpo->TotalDeposit;
  }


  //withdrawal
  $totwhl = 0;
  $whl = $this->db->query("
                              SELECT IFNULL(SUM(A.TotalWithdrawal),0) AS TotalWithdrawal
                              FROM   T_Withdrawal A
                              INNER  JOIN M_Student B ON A.StudentID=B.StudentID
                              INNER  JOIN M_Class C ON B.ClassID=C.ClassID
                              WHERE  B.IsActive = 'Y'
                          ");
  if ($whl->num_rows() > 0) {
    $keywdh = $whl->row();
    $totwhl = $keywdh->TotalWithdrawal;
  }


?>



 <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fa fa-users fa-2x" style="color: #ffff;"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Data Student</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $totstd; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Deposit</h4>
                  </div>
                  <div class="card-body">
                    <?php echo number_format($totdpo); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Withdrawal</h4>
                  </div>
                  <div class="card-body">
                    <?php echo number_format($totwhl); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Saving Balance</h4>
                  </div>
                  <div class="card-body">
                    <?php echo number_format($totdpo - $totwhl); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
         

         <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Line Chart Deposit</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Bar Chart Withdrawal</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart2"></canvas>
                  </div>
                </div>
              </div>
            </div>
    
         
        </section>
      </div>



<script type="text/javascript">

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: <?php echo json_encode($month); ?>,
    datasets: [{
      label: 'Sales',
      data: [<?php echo join($totdepo,','); ?>],
      borderWidth: 2,
      backgroundColor: 'rgba(63,82,227,.8)',
      borderWidth: 0,
      borderColor: 'transparent',
      pointBorderWidth: 0,
      pointRadius: 3.5,
      pointBackgroundColor: 'transparent',
      pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          // display: false,
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: true,
          callback: function(value, index, values) {
            //return 'Rp' + value;
            return value
          }
        }
      }],
      xAxes: [{
        gridLines: {
          display: false,
          tickMarkLength: 15,
        }
      }]
    },
  }
});
  

var ctx = document.getElementById("myChart2").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($monthwd); ?>,
    datasets: [{
      label: 'Sales',
      data: [<?php echo join($totwdh,','); ?>],
      borderWidth: 2,
      backgroundColor: 'rgba(63,82,227,.8)',
      borderWidth: 0,
      borderColor: 'transparent',
      pointBorderWidth: 0,
      pointRadius: 3.5,
      pointBackgroundColor: 'transparent',
      pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          // display: false,
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: true,
          callback: function(value, index, values) {
            //return 'Rp' + value;
            return value
          }
        }
      }],
      xAxes: [{
        gridLines: {
          display: false,
          tickMarkLength: 15,
        }
      }]
    },
  }
});

</script>