

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php echo $this->lang->line('User')?>
        <small><?php echo $this->lang->line('Setting')?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home')?></a></li>
        <li class="active"><?php echo $this->lang->line('Setting')?></li>
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
              <h3 class="box-title"><?php echo $this->lang->line('Update Information')?>
</h3>
            </div>
            <!-- /.box-header -->
            <form role="form" action="<?php base_url('users/setting') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group col-md-6">
                  <label for="username"><?php echo $this->lang->line('Username')?></label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="<?php echo $this->lang->line('Username')?>" value="<?php echo $user_data['username'] ?>" autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="email"><?php echo $this->lang->line('Email')?></label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $this->lang->line('Email')?>" value="<?php echo $user_data['email'] ?>" autocomplete="off">
                </div>                

                <div class="form-group col-md-6">
                  <label for="fname"><?php echo $this->lang->line('First name')?></label>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="<?php echo $this->lang->line('First name')?>" value="<?php echo $user_data['firstname'] ?>" autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="lname"><?php echo $this->lang->line('Last name')?></label>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="<?php echo $this->lang->line('Last name')?>" value="<?php echo $user_data['lastname'] ?>" autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="address"><?php echo $this->lang->line('Address')?>1</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="<?php echo $this->lang->line('Address') ?>" value="<?php echo $user_data['address'] ?>" autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="address1"><?php echo $this->lang->line('Address')?>2</label>
                  <input type="text" class="form-control" id="address1" name="address1" placeholder="<?php echo $this->lang->line('Address') ?>" value="<?php echo $user_data['address1'] ?>" autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                  <label for="phone"><?php echo $this->lang->line('Phone')?></label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="<?php echo $this->lang->line('Phone')?>" value="<?php echo $user_data['phone'] ?>" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="gender"><?php echo $this->lang->line('Gender')?></label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="male" value="1" <?php if($user_data['gender'] == 1) {
                        echo "checked";
                      } ?>>
                      <?php echo $this->lang->line('Male')?>
                    </label>
                    <label>
                      <input type="radio" name="gender" id="female" value="2" <?php if($user_data['gender'] == 2) {
                        echo "checked";
                      } ?>>
                      <?php echo $this->lang->line('Female')?>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->lang->line('Leave the password field empty if you do not want to change.')?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="password"><?php echo $this->lang->line('Password')?></label>
                  <input type="text" class="form-control" id="password" name="password" placeholder="<?php echo $this->lang->line('Password')?>" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="cpassword"><?php echo $this->lang->line('Confirm password')?></label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="<?php echo $this->lang->line('Confirm password')?>" autocomplete="off">
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
       
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
