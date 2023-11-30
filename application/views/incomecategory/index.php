

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Income Category</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Income Category</li>
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
          
          <?php if(in_array('createIncomeCategory', $user_permission)): ?>
            <a href="<?php echo base_url('Incomecategory/create') ?>" class="btn btn-primary">Add Income Category</a>
            <br /> <br />
          <?php endif; ?>


          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Income Category</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="incomecategoryTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Income Category Name</th>
                  <th>Income Category Type</th>
                  <?php if(in_array('updateIncomeCategory', $user_permission) || in_array('deleteIncomeCategory', $user_permission)): ?>
                  <th>Action</th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php if($incomecategory_data): ?>                  
                    <?php foreach ($incomecategory_data as $k => $v): ?>
                      <tr>
                        <td><?php echo $v['incomecategory_info']['tenHangMucThu']; ?></td>
                        <td><?php echo $v['loai_hangthu']['tenLoaiHangMucThu']; ?></td>

                        <?php if(in_array('updateIncomeCategory', $user_permission) || in_array('deleteIncomeCategory', $user_permission)): ?>

                        <td>
                          <?php if(in_array('updateIncomeCategory', $user_permission)): ?>
                            <a href="<?php echo base_url('incomecategory/edit/'.$v['incomecategory_info']['idHangMucThu']) ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                          <?php endif; ?>
                          <?php if(in_array('deleteIncomeCategory', $user_permission)): ?>
                            <a href="<?php echo base_url('incomecategory/delete/'.$v['incomecategory_info']['idHangMucThu']) ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
                          <?php endif; ?>
                        </td>
                      <?php endif; ?>
                      </tr>
                    <?php endforeach ?>
                  <?php endif; ?>
                </tbody>
              </table>
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

  <script type="text/javascript">
    $(document).ready(function() {
      $('#incomecategoryTable').DataTable();

      $("#mainIncomeCategoryNav").addClass('active');
      $("#manageIncomeCategoryNav").addClass('active');
    });
  </script>
