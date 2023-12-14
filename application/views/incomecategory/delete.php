

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php echo $this->lang->line('Manage')?>
        <small><?php echo $this->lang->line('Income Category')?> </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home')?>
</a></li>
        <li><a href="<?php echo base_url('incomecategory/') ?>"><?php echo $this->lang->line('Income Category')?> </a></li>
        <li class="active"><?php echo $this->lang->line('Delete')?></li>
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

          <h1><?php echo $this->lang->line('Do you really want to remove?')?></h1>

          <form action="<?php echo base_url('incomecategory/delete/'.$idHangMucThu) ?>" method="post">
            <input type="submit" class="btn btn-primary" name="confirm" value="<?php echo $this->lang->line('Confirm')?>">
            <a href="<?php echo base_url('incomecategory') ?>" class="btn btn-warning"><?php echo $this->lang->line('Cancel')?></a>
          </form>

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
    $("#mainIncomeCategoryNav").addClass('active');
    $("#manageIncomeCategoryNav").addClass('active');
  });
</script>