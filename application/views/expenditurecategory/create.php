

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $this->lang->line('Manage')?>
        <small><?php echo $this->lang->line('Expenditure Category')?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home')?></a></li>
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

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo $this->lang->line('Add Expenditure Category')?></h3>
            </div>
            <form role="form" action="<?php base_url('expenditurecategory/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="expendituretype"><?php echo $this->lang->line('Expenditure Category Type')?></label>
                  <select class="form-control" id="expendituretype" name="expendituretype">
                    <option value=""><?php echo $this->lang->line('Select Expenditure Category Type')?></option>
                    <?php foreach ($expendituretype_data as $k => $v): ?>
                      <option value="<?php echo $v['idLoaiHangMucChi'] ?>"><?php echo $v['tenLoaiHangMucChi'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="expenditurecategory_name"><?php echo $this->lang->line('Expenditure Category')?></label>
                  <input type="text" class="form-control" id="expenditurecategory_name" name="expenditurecategory_name" placeholder="<?php echo $this->lang->line('Expenditure Category Name')?>" autocomplete="off">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save changes')?>
</button>
                <a href="<?php echo base_url('expenditurecategory/') ?>" class="btn btn-warning"><?php echo $this->lang->line('Back')?></a>
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
    $("#expendituretype").select2();

    $("#mainExpenditureCategoryNav").addClass('active');
    $("#createExpenditureCategoryNav").addClass('active');
  
  });
</script>
