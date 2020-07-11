<div id="transWithdrawal"> 
 <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?php echo $title; ?> </h1>

            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Components</a></div>
              <div class="breadcrumb-item"><?php echo $title; ?></div>
            </div>
          </div>

          <div class="section-body">
                      <!-- notif-->
                      <div class="shownotifmsg" v-if="errorMessage">
                        <div class="col-md-3 alert alert-danger alert-dismissible show fade">
                          <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                            </button>
                            <i class="fa fa-times"></i> {{ errorMessage }}
                          </div>
                        </div>
                      </div>

                      <div class="col-md-3 shownotifmsg" v-if="successMessage">
                         <div class="alert alert-success alert-dismissible show fade">
                          <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                            </button>
                            <i class="fa fa-check"></i> {{ successMessage }}
                          </div>
                        </div>
                      </div>

                      <!-- end notif-->
            <!-- <h2 class="section-title">Table</h2>
            <p class="section-lead">Example of some Bootstrap table components.</p> -->

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <!-- <div class="card-header">
                    <h4></h4>
                  </div> -->
                  <div class="card-body">

                    <div class="float-left">
                      <div class="buttons">
                      <a href="#" @click="showPopupWithdrawal();" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i> Add</a>
                      <a href="<?php echo base_url(); ?>/withdrawal/viewWithdrawal/print" target="_blank" class="btn btn-icon icon-left btn-secondary"><i class="fa fa-print"></i> print</a>
                      <a href="<?php echo base_url(); ?>/withdrawal/viewWithdrawal/export" class="btn btn-icon icon-left btn-success"><i class="fa fa-file-excel"></i> Excel</a>
                      </div>
                    </div>

                      <div class="float-right">
                      <form>
                        <div class="input-group">

                           <select class="form-control" id="searchRecord" name="searchRecord" v-model="searchRecord" @change="selectRecord();">
                            <option value="10">10 Record</option>
                            <option value="1">50 Record</option>
                            <option value="100">100 Record</option>
                            <option value="500">500 Record</option>
                            <option value="ALL">All</option>
                          </select>

                        <div>&nbsp;</div>

                          <input type="text"id="searchQuery" class="form-control" v-model="searchQuery" placeholder="Search WithdrawalID">
                          <div class="input-group-append">
                            <a href="#" class="btn btn-primary"><i class="fas fa-search"></i></a>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="clearfix mb-3"></div>

                    <div class="table-responsive">

                    <div v-if="withdrawal">
                      <table class="table table-striped" id="sortable-table">
                        <thead>
                          <tr>
                            <th>Action</th>
                            <th>WithdrawalID</th>
                            <th>WithdrawalDate</th>
                            <th>StudentID</th>
                            <th>TotalWithdrawal</th>
                            <th>IsActive</th>
                            <th>EntryBy</th>
                            <th>EntryDate</th>
                            <th>LastUpdateBy</th>
                            <th>LastUpdateDate</th>
                          </tr>
                        </thead>
                        <tbody>

                          <tr v-for="row in filteredResources">
                            <td nowrap> 
                            <a data-toggle="modal" data-target="#getmodalWithdrawal"class="btn btn-warning" @click="selectEditWithdrawal(row)" title="Edit"><i class="fa fa-edit"></i> </a> 
                            <a data-toggle="modal" data-target="#getmodalcnfWithdrawal" @click="selectWithdrawal(row);" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i> </a> 
                            </td>
                            <td>{{row.WithdrawalID}}</td>
                            <td>{{row.WithdrawalDate}}</td>
                            <td>{{row.StudentID}}</td>
                            <td>{{row.TotalWithdrawal}}</td>
                            <td>{{row.IsActive}}</td>
                            <td>{{row.EntryBy}}</td>
                            <td>{{row.EntryDate}}</td>
                            <td>{{row.LastUpdateBy}}</td>
                            <td>{{row.LastUpdateDate}}</td>
                          </tr>
                      
                        </tbody>
                      </table>
                      </div>
                        
                      <div v-else>
                        <table class="table table-striped" id="sortable-table">
                        <thead>
                          <tr>
                            <th>Action</th>
                            <th>WithdrawalID</th>
                            <th>WithdrawalDate</th>
                            <th>StudentID</th>
                            <th>TotalWithdrawal</th>
                            <th>IsActive</th>
                            <th>EntryBy</th>
                            <th>EntryDate</th>
                            <th>LastUpdateBy</th>
                            <th>LastUpdateDate</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td colspan="10" style="text-align: center;">No Record Data</td>
                          </tr>
                        </tbody>
                        </table>
                      </div>



                    </div>
                  </div>
                </div>
              </div>
            </div>
          
           
          </div>
        </section>
      </div>


<!-- form class-->
<div class="modal fade" tabindex="-1" role="dialog" id="getmodalWithdrawal">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Form Withdrawal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                 <!-- notif-->
                      <div v-if="validateformWithdrawal">
                        <div class="alert alert-danger alert-dismissible show fade">
                          <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                            </button>
                            <i class="fa fa-times"></i> {{ validateformWithdrawal }}
                          </div>
                        </div>
                      </div>
                  <!-- end notif-->

                <form>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
                        <td>Withdrawal ID *</td>
                        <td><input type="text" ref="withdrawalid" id="withdrawalid" name="withdrawalid" class="form-control" v-model="formWithdrawal.withdrawalid">
                          <!-- status class-->
                          <div v-if="statusWithdrawal"><font color="red"><i style="font-size: 10px;">{{statusWithdrawal}}</i></font></div>
                        </td>
                      </tr>
                       <tr>
                        <td>Withdrawal Date *</td>
                        <td>
                        <vuejs-datepicker style="position: inherit;" :bootstrap-styling="true" :format="customFormatter" ref="withdrawaldate" id="withdrawaldate" name="withdrawaldate" v-model="formWithdrawal.withdrawaldate"></vuejs-datepicker>
                         <!--<input type="text" ref=withdrawaldate" id="withdrawaldate" name="withdrawaldate" class="form-control" v-model="formWithdrawal.withdrawaldate">-->
                        </td>
                      </tr>
                      <tr>
                        <td>Student ID *</td>
                        <td><input type="text" ref="studentid" id="studentid" name="studentid" class="form-control" v-model="formWithdrawal.studentid" @keyup="getData()" autocomplete="off">

                          <!-- show search -->
                           <div class="panel-footer" v-if="search_data.length">
                            <ul class="list-group">
                              <a href="#" class="list-group-item" v-for="data1 in search_data" @click="getName(data1.keystudent, data1.saldo)">{{ data1.student }}</a>
                            </ul>
                          </div>

                        </td>
                      </tr>
                      <tr>
                        <td>Deposit Balance *</td>
                        <td><input type="text" ref="balance" id="balance" name="balance" class="form-control" readonly="readonly" v-model="formWithdrawal.balance"></td>
                      </tr>
                      <tr>
                        <td>Withdrawal Entred *</td>
                        <td><input type="text" ref="entered" id="entered" name="entered" class="form-control" v-model="formWithdrawal.entered" autocomplete="off" @change="calcWithdrawal()"></td>
                      </tr>
                      <tr>
                        <td>Total Deposit *</td>
                        <td><input type="text" ref="total" id="total" name="total" class="form-control" readonly="readonly" v-model="formWithdrawal.total"></td>
                      </tr>
                      <!--  <tr>
                        <td>Description</td>
                        <td><textarea id="desc" name="desc" class="form-control" v-model="formWithdrawal.desc"></textarea></td>
                      </tr> -->
                    </table>
                  </div>
                </form>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-primary" @click="addWithdrawal();"><i class="fa fa-check"></i> Save changes</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
              </div>
            </div>
          </div>
        </div>

<!-- form popup delete class-->
<div class="modal fade" tabindex="-1" role="dialog" id="getmodalcnfWithdrawal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Really ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <center>
                    <p>Are you sure you want to delete?</p>
                    <h3>{{clickedWithdrawal.WithdrawalID}}</h3>
                </center>
              </div>
              <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-primary" @click="deleteWithdrawal();"><i class="fa fa-check"></i> Yes</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
              </div>
            </div>
          </div>
        </div>




</div><!-- end call js -->
 <script src="<?php echo base_url(); ?>stisla-master/assets/vuejs/vue-withdrawal.js"></script>