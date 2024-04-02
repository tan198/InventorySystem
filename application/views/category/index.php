

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('Manage')?>
        <small><?php echo $this->lang->line('Category')?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $this->lang->line('Category')?></li>
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
          
          <?php if(in_array('createCategory', $user_permission)): ?>
            <a href="<?php echo base_url('category/create') ?>" class="btn btn-primary"><?php echo $this->lang->line('Add Category')?></a>
            <br /> <br />
          <?php endif; ?>


          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $this->lang->line('Manage Category')?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="categoryTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo $this->lang->line('Category Name')?></th>
                  <?php if(in_array('updateCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
                  <th><?php echo $this->lang->line('Action')?></th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php if($category_data): ?>                  
                    <?php foreach ($category_data as $k => $v): ?>
                      <tr>
                        <td><?php echo $v['category_info']['loaiHangMuc']; ?></td>

                        <?php if(in_array('updateCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>

                        <td>
                          <?php if(in_array('updateCategory', $user_permission)): ?>
                            <a href="<?php echo base_url('category/edit/'.$v['category_info']['idHangMuc']) ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                          <?php endif; ?>
                          <?php if(in_array('deleteCategory', $user_permission)): ?>
                            <a href="<?php echo base_url('category/delete/'.$v['category_info']['idHangMuc']) ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
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
      $('#categoryTable').DataTable();

      $("#mainCategoryNav").addClass('active');
      $("#manageCategoryNav").addClass('active');
    });
  </script>
