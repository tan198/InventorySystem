

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php echo $this->lang->line('Users')?>
        <small><?php echo $this->lang->line('Profile')?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home')?></a></li>
        <li class="active"><?php echo $this->lang->line('Profile')?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12 col-xs-12">

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="container">
                <div class="row">
                  <!--nav tabs-->

                  <div class="col-12">
                    <div class="form-group">
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="nav-item active text-dark"><a style="margin-right:0;width:100px;text-align: center;" role="tab" aria-controls="tab-profile" href="#tab-profile" data-toggle="tab" data-target="#tab-profile" >Profile</a></li>
                        <li role="presentation" class="nav-item"><a  style="margin-right:0;width:100px;text-align: center;" role="tab" aria-controls="tab-salary" href="#tab-salary" data-toggle="tab" data-target="#tab-salary"> Info Salary</a></li>
                        <li role="presentation" class="nav-item"><a  style="margin-right:0;width:100px;text-align: center;" role="tab" aria-controls="tab-work" href="#tab-work" data-toggle="tab" data-target="#tab-work"> Info Work</a></li>

                      </ul>
                    </div>

                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane fade in active" id="tab-profile" >
                        <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                          <div class="col-lg-12">
                            <div class="d-flex">
                              <div class="form-group col-md-4 p-2">
                                <label for="fullname"><?php echo $this->lang->line('Full Name')?></label>
                                <p><?php echo $user_data['firstname'].' '. $user_data['lastname'];?></p>
                              </div>
                              <div class="form-group col-md-4 p-2">
                                <label for="dobirth" >Date of birth</label>
                                <p><?php echo $user_data['dateobirth']; ?></p>
                              </div>
                              <div class="form-group col-md-4 p-2">
                                <label for="gender"><?php echo $this->lang->line('Gender')?></label>
                                <p ><?php echo ($user_data['gender'] == 1) ? 'Male' : 'Gender'; ?></p>
                              </div>
                              <div class="form-group col-md-4 p-2">
                                <label for="phone"><?php echo $this->lang->line('Phone')?></label>
                                <p><?php echo $user_data['phone']; ?></p>
                              </div>
                              <div class="form-group col-md-4 p-2">
                                <label for="address"><?php echo $this->lang->line('Address')?></label>
                                <p><?php echo ($user_data['address'] != null) ? $user_data['address'] : '___'; ?></p>
                              </div>
                              <div class="form-group col-md-4 p-2">
                                <label for="address1"><?php echo $this->lang->line('Address')?>1</label>
                                <p><?php echo ($user_data['address1'] != null) ? $user_data['address1'] : '___'; ?></p>
                              </div>

                              <div class="form-group col-md-4 p-2">
                                <label for="email"><?php echo $this->lang->line('email')?>Email</label>
                                <p><?php echo ($user_data['email'] != null) ? $user_data['email'] : '___'; ?></p>
                              </div>
                              <div class="form-group col-md-4 p-2">
                                <label for="cardid"><?php echo $this->lang->line('No.')?></label>
                                <p><?php echo ($user_data['cardID'] != null) ? $user_data['cardID'] : '___'; ?></p>
                              </div>

                              <div class="form-group col-md-4 p-2">
                                <label for="username"><?php echo $this->lang->line('Username')?></label>
                                <p><?php echo ($user_data['username'] != null) ? $user_data['username'] : '___'; ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="tab-salary" role="tabpanel">
                      <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
                          <div class="col-lg-12">
                            <div class="d-flex">
                                <div class="form-group col-md-4 p-2">
                                  <label for="salary"><?php echo $this->lang->line('Cash Salary')?></label>
                                  <p><?php echo ($user_data['salary'] != null) ? $user_data['salary']: '___' ;?></p>
                                </div>
                                <div class="form-group col-md-4 p-2">
                                  <label for="netpay" ><?php echo $this->lang->line('Net Pay')?></label>
                                  <p>__</p>
                                </div>
                                <div class="form-group col-md-4 p-2">
                                  <label for="netgross"><?php echo $this->lang->line('Net Gross')?></label>
                                  <p >___</p>
                                </div>
                                <div class="form-group col-md-4 p-2">
                                  <label for="taxincome"><?php echo $this->lang->line('Taxable Income')?></label>
                                  <p>___</p>
                                </div>
                                <div class="form-group col-md-4 p-2">
                                  <label for="insurance"><?php echo $this->lang->line('Insurance Salary')?></label>
                                  <p>___</p>
                                </div>
                                <div class="form-group col-md-4 p-2">
                                  <label for="netsalary"><?php echo $this->lang->line('Net Salary')?></label>
                                  <p>__</p>
                                </div>

                                <div class="form-group col-md-4 p-2">
                                  <label for="total"><?php echo $this->lang->line('Total')?></label>
                                  <p>__</p>
                                </div>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
  $(document).ready(function() {
    
   $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
    e.target
    e.relatedTarget
   }); 
  });
</script>
 
