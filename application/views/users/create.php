

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php echo $this->lang->line('Manage')?>
        <small><?php echo $this->lang->line('Users')?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home')?></a></li>
        <li class="active"><?php echo $this->lang->line('Users')?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $this->lang->line('Add Users')?></h3>
            </div>
            <form role="form" action="<?php base_url('users/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-row">

                <div class="form-group col-md-6">
                  <label for="fname"><?php echo $this->lang->line('First name')?></label>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="<?php echo $this->lang->line('First name')?>" autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="lname"><?php echo $this->lang->line('Last name')?></label>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="<?php echo $this->lang->line('Last name')?>" autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="dobirth"><?php echo $this->lang->line('Date of birth')?></label>
                  <input type="date" class="form-control" id="dobirth" name="dobirth" placeholder="<?php echo $this->lang->line('Date of birth')?>" autocomplete="off">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="phone"><?php echo $this->lang->line('Phone')?></label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="<?php echo $this->lang->line('Phone')?>" autocomplete="off">
                </div>

                <div class="form-group col-md-6" style="margin-bottom: 0;">
                  <div class="form-group col-md-12">
                      <label for="gender"><?php echo $this->lang->line('Gender')?></label>
                      <div class="radio">
                        <label style="margin-right: 50%;margin-left: 40px;">
                          <input type="radio" name="gender" id="male" value="1">
                          <?php echo $this->lang->line('Male')?>
                        </label>
                        <label>
                          <input type="radio" name="gender" id="female" value="2">
                          <?php echo $this->lang->line('Female')?>
                        </label>
                      </div>
                    </div>

                  <div class="form-group col-md-12" style="margin-top: 16px;margin-bottom: 16px;" >
                    <label for="address"><?php echo $this->lang->line('Address')?> 1</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="<?php echo $this->lang->line('Address')?>" autocomplete="off">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="address1"><?php echo $this->lang->line('Address')?> 2</label>
                    <input type="text" class="form-control" id="address1" name="address1" placeholder="<?php echo $this->lang->line('Address')?>" autocomplete="off">
                  </div>
                  
                </div>
                
                <div class="form-group col-md-6">
                  <label for="citizenidentitycard"><?php echo $this->lang->line('Citizen Identity Card')?>:</label>
                  <br>
                  <div class="form-group col-md-12">
                    <label for="number"><?php echo  $this->lang->line('No.')?></label>
                    <input type="text" class="form-control" id="number" name="number" placeholder="<?php echo $this->lang->line('No.')?>" autocomplete="off">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="dateID"><?php echo  $this->lang->line('Date of issuance of ID')?></label>
                    <input type="date" class="form-control" id="dateID" name="dateID" placeholder="<?php echo $this->lang->line('Date of issuance of ID')?>" autocomplete="off">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="placeID"><?php echo  $this->lang->line('Place of issue of identity card')?></label>
                    <input type="text" class="form-control" id="placeID" name="placeID" placeholder="<?php echo $this->lang->line('Place of issue of identity card')?>" autocomplete="off">
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <label for="department"><?php echo $this->lang->line('Department')?></label>
                  <select class="form-control select_group" name="department" id="department">
                    <option value="">Select Department</option>
                    <?php foreach($department_data as $key => $value): ?>
                      <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                    <?php endforeach?>
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="imsupevisor"><?php echo $this->lang->line('Supevisior')?></label>
                  <select class="form-control select_group" name="imsupevisor" id="imsupevisor">
                    <option value="">Select Supervisor</option>
                    <?php foreach($user_data as $key => $value): ?>
                      <option value="<?php echo $value['id'] ?>"><?php echo $value['firstname'] . " " . $value['lastname'] ?></option>
                    <?php endforeach?>
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="position"><?php echo $this->lang->line('Position')?></label>
                  <select class="form-control select_group" name="position" id="position">
                    <option value="">Select Position</option>
                    <?php foreach($position_data as $key => $value): ?>
                      <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                    <?php endforeach?>
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="contract"><?php echo $this->lang->line('Type Contract')?></label>
                  <input type = "text" class="form-control" id="contract" name="contract"placeholder="<?php echo $this->lang->line('Type Contract')?>"autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="tcode"><?php echo $this->lang->line('Tax Code')?></label>
                  <input type = "text" class="form-control" id="tcode" name="tcode"placeholder="<?php echo $this->lang->line('Tax Code')?>"autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="salary"><?php echo $this->lang->line('Salary')?></label>
                  <input type = "text" class="form-control" id="salary" name="salary"placeholder="<?php echo $this->lang->line('Salary')?>"autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="baccount"><?php echo $this->lang->line('Bank Account')?></label>
                  <input type = "text" class="form-control" id="baccount" name="baccount"placeholder="<?php echo $this->lang->line('Bank Account')?>"autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="bank"><?php echo $this->lang->line('Bank')?></label>
                  <input type = "text" class="form-control" id="bank" name="bank"placeholder="<?php echo $this->lang->line('Bank')?>"autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="workdate"><?php echo $this->lang->line('First Date Of Work')?></label>
                  <input type = "date" class="form-control" id="workdate" name="workdate"placeholder="<?php echo $this->lang->line('First Date Of Work')?>"autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="cterm"><?php echo $this->lang->line('Contract Term')?></label>
                  <input type = "date" class="form-control" id="cterm" name="cterm"placeholder="<?php echo $this->lang->line('Contract Term')?>"autocomplete="off">
                </div>

                  <div class="form-group col-md-12">
                    <label for="groups"><?php echo $this->lang->line('Groups')?></label>
                    <select class="form-control" id="groups" name="groups">
                      <option value=""><?php echo $this->lang->line('Select Groups')?></option>
                      <?php foreach ($group_data as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['group_name'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>


                <div class="form-group col-md-6">
                  <label for="username"><?php echo $this->lang->line('Username')?></label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="<?php echo $this->lang->line('Username')?>" autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="email"><?php echo $this->lang->line('Email')?></label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $this->lang->line('Email')?>" autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="password"><?php echo $this->lang->line('Password')?></label>
                  <input type="text" class="form-control" id="password" name="password" placeholder="<?php echo $this->lang->line('Password')?>" autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="cpassword"><?php echo $this->lang->line('Confirm password')?></label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="<?php echo $this->lang->line('Confirm password')?>" autocomplete="off">
                </div>

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save changes')?></button>
                <a href="<?php echo base_url('users/') ?>" class="btn btn-warning"><?php echo $this->lang->line('Back')?></a>
              </div>
            </form>
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

<script type="text/javascript">
  $(document).ready(function() {
    $("#groups").select2();

    $("#mainUserNav").addClass('active');
    $("#createUserNav").addClass('active');
  
  });
</script>
