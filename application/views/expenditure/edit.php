

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $this->lang->line('Manage')?>
      <small><?php echo $this->lang->line('Expenditure')?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home')?></a></li>
      <li class="active"><?php echo $this->lang->line('Expenditure')?></li>
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
            <h3 class="box-title"><?php echo $this->lang->line('Edit Expenditure')?></h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('expenditure/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="expenditurecategory"><?php echo $this->lang->line('Expenditure Category')?></label>
                  <select class="form-control select_group" id="expenditurecategory" name="expenditurecategory">
                    <?php foreach ($expenditurecategory as $k => $v): ?>
                      <option value="<?php echo $v['idHangMucChi'] ?>" <?php if($expenditure_data['idHangMucChi'] == $v['idHangMucChi']) { echo "selected='selected'"; } ?> ><?php echo $v['tenHangMucChi'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="fund"><?php echo $this->lang->line('Payment Type')?></label>
                  <select class="form-control select_group" id="fund" name="fund">
                    <?php foreach ($fund as $k => $v): ?>
                      <option value="<?php echo $v['idTaiKhoan'] ?>" <?php if($expenditure_data['idTaiKhoan'] == $v['idTaiKhoan']) { echo "selected='selected'"; } ?> ><?php echo $v['tenTaiKhoan'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="payer_name">Payer</label>
                  <input type="text" class="form-control" id="<?php echo $this->lang->line('Payer')?>_name" name="payer_name" placeholder="Enter payer name" value="<?php echo $expenditure_data['nguoiChi']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="date_expenditure"><?php echo $this->lang->line('Date Expenditure')?></label>
                  <input type="date" class="form-control" id="date_expenditure" name="date_expenditure" placeholder="Enter date expenditure" value="<?php echo $expenditure_data['ngayChi']; ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="amount"><?php echo $this->lang->line('Amount')?></label>
                  <input type="text"  pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" class="form-control" id="amount" name="amount" placeholder="Enter amount" value="<?php echo $expenditure_data['soTien']; ?>" autocomplete="off" />
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save changes')?></button>
                <a href="<?php echo base_url('expenditure/') ?>" class="btn btn-warning"><?php echo $this->lang->line('Back')?></a>
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

    $("#mainExpenditureNav").addClass('active');
    $("#<?php echo $this->lang->line('Manage')?>ExpenditureNav").addClass('active');
    
    $("input[data-type='currency']").on({
      keyup: function() {
        formatCurrency($(this));
      },
      blur: function() { 
        formatCurrency($(this), "blur");
      }
    });

    function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val =  left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    //input_val =  input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}
  });
</script>