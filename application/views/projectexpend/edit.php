

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Quản Lý
      <small>Dự Án Chi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Trang Chủ</a></li>
      <li class="active">Dự Án Chi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

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
            <h3 class="box-title">Cập Nhật Dự Án Chi</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('projectexpend/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="project_name">Tên Dự Án</label>
                  <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Nhập tên dự án" value="<?php echo $projectexpend_data['tenDuAn']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="material">Vật Tư</label>
                  <select class="form-control select_group" id="material" name="material">
                    <?php foreach ($material as $k => $v): ?>
                      <option value="<?php echo $v['idVatTuChi'] ?>" <?php if($projectexpend_data['idVatTuChi'] == $v['idVatTuChi']) { echo "selected='selected'"; } ?> ><?php echo $v['tenVatTu'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="ship">Ship</label>
                  <input type="text" class="form-control" id="ship" name="ship" placeholder="Nhập Ship" value="<?php echo $projectexpend_data['ship']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="rent">Thuê Ngoài</label>
                  <input type="text" class="form-control" id="rent" name="rent" placeholder="Nhập thuê ngoài" value="<?php echo $projectexpend_data['thueNgoai']; ?>" autocomplete="off" />
                </div>


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('projectexpend/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
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
    $(".select_group").select2();
    $("#description").wysihtml5();

    $("#mainProjectExpendNav").addClass('active');
    $("#manageProjectExpendNav").addClass('active');
  
  });
</script>