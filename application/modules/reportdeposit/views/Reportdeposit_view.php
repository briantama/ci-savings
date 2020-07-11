<div id="reportDeposit"> 
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
            <!-- <h2 class="section-title">Table</h2>
            <p class="section-lead">Example of some Bootstrap table components.</p> -->

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>

                      <!-- notif-->
                      <div class="col-md-3 shownotifmsg" v-if="errorMessage">
                         <div class="alert alert-danger alert-dismissible show fade">
                          <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                            </button>
                            <i class="fa fa-times"></i> {{ errorMessage }}
                          </div>
                        </div>
                      </div>

                    
                      <!-- end notif-->
                      
                       <!-- notif-->
                      <div v-if="validateformRptDeposit">
                        <div class="alert alert-danger alert-dismissible show fade">
                          <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                              <span>&times;</span>
                            </button>
                            <i class="fa fa-times"></i> {{ validateformRptDeposit}}
                          </div>
                        </div>
                      </div>
                     <!-- end notif-->

                      <div class="buttons">
                     <!-- content button -->
                      </div>
                    </h4>
                    <div class="card-header-action">
                      <!--<form>
                        <div class="input-group">
                          <input type="text" class="form-control" v-model="searchQuery" placeholder="Search">
                          <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>-->
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped" id="sortable-table">
                        <thead>
                          <tr>
                           <td>Deposit ID</td>
                           <td><input type="text" ref=depositid" id="depositid" name="depositid" class="form-control" v-model="formReportDeposit.depositid"></td>
                           <td>Student ID</td>
                           <td><input type="text" ref=studentid" id="studentid" name="studentid" class="form-control" v-model="formReportDeposit.studentid" @keyup="getDataStudent()" autocomplete="off">
                            <!-- show search -->
                           <div class="panel-footer" v-if="search_data.length">
                            <ul class="list-group">
                              <a href="#" class="list-group-item" v-for="data1 in search_data" @click="getNameStudent(data1.keystudent)">{{ data1.student }}</a>
                            </ul>
                          </div>
                           </td>
                          </tr>
                          <tr>
                           <td>Start Date</td>
                           <td>
                            <vuejs-datepicker style="position: inherit;" :bootstrap-styling="true" :format="customFormatter" ref="startdate" id="startdate" name="startdate" v-model="formReportDeposit.startdate"></vuejs-datepicker>
                            <!--<input type="text" ref=startdate" id="startdate" name="startdate" class="form-control" v-model="formReportDeposit.startdate" autocomplete="off">-->
                           </td>
                           <td>End Date</td>
                           <td>
                            <vuejs-datepicker style="position: inherit;" :bootstrap-styling="true" :format="customFormatter" ref="enddate" id="enddate" name="enddate" v-model="formReportDeposit.enddate"></vuejs-datepicker>
                            <!--<input type="text" ref=enddate" id="enddate" name="enddate" class="form-control" v-model="formReportDeposit.enddate" autocomplete="off">-->
                           </td>
                          </tr>
                          <tr>
                           <td>Class ID</td>
                           <td><input type="text" ref=classid" id="classid" name="classid" class="form-control" v-model="formReportDeposit.classid" @keyup="getDataClass()" autocomplete="off">
                             <!-- show search -->
                           <div class="panel-footer" v-if="search_datacl.length">
                            <ul class="list-group">
                              <a href="#" class="list-group-item" v-for="data1 in search_datacl" @click="getNameClass(data1.keyclassid)">{{ data1.classid }}</a>
                            </ul>
                          </div>
                           </td>
                           <td>Status Type</td>
                           <td><select type="text" ref=statustype" id="statustype" name="statustype" class="form-control" v-model="formReportDeposit.statustype">
                                 <option value="All">All</option>
                                 <option value="Y">Active</option>
                                 <option value="N">Delete</option>
                               </select>
                           </td>
                          </tr>
                          <tr>
                           <td colspan="4">
                            <button type="button" class="btn btn-primary" @click="searchDeposit();"><i class="fa fa-check"></i> Search</button>
                            <button type="button" class="btn btn-warning" @click="resetFormRptDeposit();"><i class="fa fa-times"></i> Reset</button>
                           </td>
                          </tr>
                        </thead>
                      </table>
                    </div>
                    
                    <hr>
                    <!-- show content search -->
                    <div class="table-responsive">
                     <div v-if="showContentDeposit" v-html="showContentDeposit">{{showContentDeposit}}</div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          
           
          </div>
        </section>
      </div>


</div><!-- end call js -->
 <script src="<?php echo base_url(); ?>stisla-master/assets/vuejs/vue-reportdeposit.js"></script>