

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    <?php echo $this->lang->line('Manage')?>
      <small><?php echo $this->lang->line('Project Expenditure')?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home')?></a></li>
      <li class="active"><?php echo $this->lang->line('Project Expenditure')?></li>
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
            <h3 class="box-title"><?php echo $this->lang->line('Add Project Expenditure')?></h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('projectexpend/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="project_name"><?php echo $this->lang->line('Project Expenditure Name')?></label>
                  <input type="text" class="form-control" id="project_name" name="project_name" placeholder="<?php echo $this->lang->line('Enter Project Expenditure Name')?>" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="material"><?php echo $this->lang->line('Materials')?></label>
                  <select class="form-control select_group" id="material" name="material"  >
                    <option value="0"></option>
                    <?php foreach ($materials_data as $k => $v): ?>
                      <option value="<?php echo $v['idVatTuChi'] . '|' . $v['tongTien']?>"><?php echo $v['tenVatTu'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="ship"><?php echo $this->lang->line('Ship')?></label>
                  <input type="text" class="form-control" id="ship" name="ship" placeholder="<?php echo $this->lang->line('Enter Ship')?>" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="rent"><?php echo $this->lang->line('Outsource')?></label>
                  <input type="text" class="form-control" id="rent" name="rent" placeholder="<?php echo $this->lang->line('Enter Outsource')?>i" autocomplete="off" />
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save changes')?></button>
                <a href="<?php echo base_url('projectexpend/') ?>" class="btn btn-warning"><?php echo $this->lang->line('Back')?></a>
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
    $("#addProjectExpendNav").addClass('active');
     
  });
</script>