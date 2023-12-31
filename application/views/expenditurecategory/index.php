

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('Manage')?>
        <small><?php echo $this->lang->line('Expenditure Category')?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $this->lang->line('Expenditure Category')?></li>
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
          
          <?php if(in_array('createExpenditureCategory', $user_permission)): ?>
            <a href="<?php echo base_url('expenditurecategory/create') ?>" class="btn btn-primary"><?php echo $this->lang->line('Add Expenditure Category')?></a>
            <br /> <br />
          <?php endif; ?>


          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $this->lang->line('Manage Expenditure Category')?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="expenditurecategoryTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo $this->lang->line('Expenditure Category Name')?></th>
                  <th><?php echo $this->lang->line('Expenditure Category Type')?></th>
                  <?php if(in_array('updateExpenditureCategory', $user_permission) || in_array('deleteExpenditureCategory', $user_permission)): ?>
                  <th><?php echo $this->lang->line('Action')?></th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php if($expenditurecategory_data): ?>                  
                    <?php foreach ($expenditurecategory_data as $k => $v): ?>
                      <tr>
                        <td><?php echo $v['expenditurecategory_info']['tenHangMucChi']; ?></td>
                        <td><?php echo $v['loai_hangchi']['tenLoaiHangMucChi']; ?></td>

                        <?php if(in_array('updateExpenditureCategory', $user_permission) || in_array('deleteExpenditureCategory', $user_permission)): ?>

                        <td>
                          <?php if(in_array('updateExpenditureCategory', $user_permission)): ?>
                            <a href="<?php echo base_url('expenditurecategory/edit/'.$v['expenditurecategory_info']['idHangMucChi']) ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                          <?php endif; ?>
                          <?php if(in_array('deleteExpenditureCategory', $user_permission)): ?>
                            <a href="<?php echo base_url('expenditurecategory/delete/'.$v['expenditurecategory_info']['idHangMucChi']) ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
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
      $('#expenditurecategoryTable').DataTable();

      $("#mainExpenditureCategoryNav").addClass('active');
      $("#manageExpenditureCategoryNav").addClass('active');
    });
  </script>
