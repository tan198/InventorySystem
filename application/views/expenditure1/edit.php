

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Expenditure 1</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home abc</a></li>
      <li class="active">Expenditure 1</li>
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
            <h3 class="box-title">Edit Expenditure 1</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('expenditure1/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="expenditurecategory">Expenditure Category 1</label>
                  <select class="form-control select_group" id="expenditurecategory" name="expenditurecategory">
                    <?php foreach ($expenditurecategory as $k => $v): ?>
                      <option value="<?php echo $v['idHangMucChi'] ?>" <?php if($expenditure_data['expenditures']['idHangMucChi'] == $v['idHangMucChi']) { echo "selected='selected'"; } ?> ><?php echo $v['tenHangMucChi'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="name_expenditure">Name Expenditure Catagory</label>
                  <input type="text" class="form-control" id="name_expenditure" name="name_expenditure" value="<?php echo $expenditure_data['expenditures']['tenHangMuc'] ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="fund">Fund Name</label>
                  <select class="form-control select_group" id="fund" name="fund">
                    <?php foreach ($fund as $k => $v): ?>
                      <option value="<?php echo $v['idTaiKhoan'] ?>" <?php if($expenditure_data['expenditures']['idTaiKhoan'] == $v['idTaiKhoan']) { echo "selected='selected'"; } ?> ><?php echo $v['tenTaiKhoan'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group ">
                  <label for="material_status">Material</label>
                  <div class="radio form-check-inline" id= "material_status">
                    <label>
                      <input type="radio" name="material_status" class="material_status" id="Yes" value="1" <?php
                          if($expenditure_data['expenditures']['materialStatus'] == 1) {echo "checked";}
                      ?>>
                      Yes
                    </label>
                    <label>
                      <input type="radio" name="material_status"class="material_status" id="No" value="0" <?php
                          if($expenditure_data['expenditures']['materialStatus'] == 0) {echo "checked";}
                      ?>>
                      No
                    </label>
                  </div>
                </div>

                <table class="table table-bordered" id="material_info_table" style="display: none;">
                  <thead>
                    <tr>
                      <th width="25%">Material Name</th>
                      <th width="25%">Quantity</th>
                      <th width="25%">Rate</th>
                      <th width="20%">Amount</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                  </thead>
                  <tbody>

                    <?php if(isset($expenditure_data['material_item'])): ?>
                      <?php $x = 1; ?>
                      <?php foreach ($expenditure_data['material_item'] as $key => $val): ?>
                      <tr id="row_<?php echo $x; ?>">
                        <td>
                          <select class="form-control select_group material" data-row-id="row_1" id="material_1" name="material[]" style="width:100%;" onchange="getMaterialData(1)">
                            <option value=""></option>
                            <?php foreach ($material as $k => $v):?>
                              <option value="<?php echo $v['idVatTuChi']?>" <?php if($val['idVatTuChi'] == $v['idVatTuChi']){echo "selected='selected'";}?>><?php echo $v['tenVatTu'] ?></option>
                              <?php endforeach ?>
                          </select>
                        </td>
                        <td>
                          <input type="text" name="quantity[]" id="quantity_<?php echo $x; ?>" class="form-control" onkeyup="getTotal(<?php echo $x; ?>)" value="<?php echo $val['soLuong'] ?>" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="rate[]" id="rate_<?php echo $x; ?>" class="form-control" disabled value="<?php echo $val['rate'] ?>" autocomplete="off">
                          <input type="hidden" name="rate_value[]" id="rate_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['rate'] ?>" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="amount[]" id ="amount_<?php echo $x; ?>" class="form-control" disabled value="<?php echo $val['tongTien'] ?>" autocomplete ="off">
                          <input type="hidden" name="amount_value[]" id="amount_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['tongTien'] ?>" autocomplete="off">
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                      </tr>
                      <?php $x++; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
                <div class="form-group">
                  <label for="payer_name" class="col-sm-5 control-label">Payer</label>
                  <input type="text" class="form-control" id="payer_name" name="payer_name" placeholder="Enter payer name" value="<?php echo $expenditure_data['expenditures']['nguoiChi'] ?>" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="date_expenditure">Date Expenditure</label>
                  <input type="date" class="form-control" id="date_expenditure" name="date_expenditure" placeholder="Enter date expenditure" value="<?php echo $expenditure_data['expenditures']['ngayChi'] ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="tamount">Amount</label>
                  <input type="text" class="form-control" id="tamount" name="tamount" placeholder="Enter amount" value="<?php echo $expenditure_data['expenditures']['soTien'] ?>" autocomplete="off" onkeyup="subAmount()" />
                </div>

                <div class="form-group">
                  <label for="amountt">Total Amount</label>
                  <input type="text" name ="amountt" id="amountt" class="form-control" value="<?php echo $expenditure_data['expenditures']['tongTien'] ?>" disabled autocomplete="off">
                  <input type="hidden" name= "amountt_value" id="amountt_value" class="form-control" value="<?php echo $expenditure_data['expenditures']['tongTien'] ?>" autocomplete="off">
                </div>
            </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('expenditure1/') ?>" class="btn btn-warning">Back</a>
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
    var base_url = "<?php echo base_url(); ?>";
    $(".select_group").select2();
    $("#description").wysihtml5();

    $("#mainExpenditureNav").addClass('active');
    $("#manageExpenditureNav").addClass('active');
    //show table checked yes
    var table = $("#material_info_table");
    var count_table_tbody_tr = $("#material_info_table tbody tr").length;
    var row_id =count_table_tbody_tr + 1;

    $("input[name='material_status']").change(function() {
      if ($(this).val() == 1) {
        $("#material_info_table").show();
      } else {
        $("#material_info_table").hide();
        $('#material_info_table input[type="text"]').val('');
        $('#material_1').val('').change();
        $('#material_'+row_id).val('').change();
        
      }
    });

    // Initial check on page load
    if ($("input[name='material_status']:checked").val() == 1) {
      $("#material_info_table").show();
    } else {
      $("#material_info_table").hide();
      $('#material_1').val('').change();
      $('#material_'+row_id).val('').change();
      removeRow(row_id);
    }

  $("#add_row").unbind('click').bind('click',function(){
      var table = $("#material_info_table");
      var count_table_tbody_tr = $("#material_info_table tbody tr").length;
      var row_id =count_table_tbody_tr + 1;

      $.ajax({
        url: base_url + '/expenditure1/getTableMaterialRow/',
        type: 'post',
        dataType: 'json',
        success:function(response){
          var html = '<tr id="row_' + row_id +'">' +
            '<td>'+
            '<select class="form-control select_group material" data-row-id="'+row_id+'" id = "material_'+row_id+'"name="material[]" style="width:100%" onchange="getMaterialData('+row_id+')">'+
                '<option value=""></option>';
                $.each(response, function(index,value) {
                    html += '<option value="'+value.idVatTuChi+'">'+value.tenVatTu+'</option>';
                  });
                
                html += '</select>'+
              '</td>'+
              '<td><input type="number" name="quantity[]" id="quantity_' + row_id +'" class="form-control"onkeyup="getTotal('+row_id+')"></td>'+
              '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" disabled><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
              '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
              '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
              '</tr>';
            if(count_table_tbody_tr >=1){
              $("#material_info_table tbody tr:last").after(html);
            }else{
              $("#material_info_table tbody").html(html);
            }

            $(".material").select2();
            }
          });
          return false;
    });
    
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
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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


  function getTotal(row = null){
    if(row){
      var total = Number($("#rate_value_" + row).val()) * Number($("#quantity_" + row).val());
      total =total.toFixed(2);
      $("#amount_"+row).val(total);
      $("#amount_value_" + row).val(total);
      subAmount();
    }else{
      alert('no row !! pleae refresh the page');
    }
  }

  function getMaterialData(row_id){
    var base_url = "<?php echo base_url(); ?>";
    var material_id = $('#material_'+row_id).val();
    if(material_id ==""){
      $("#rate_" + row_id).val("");
      $("#rate_value_" + row_id).val("");
      $("quantity_" + row_id).val("");
      $("#amount_" + row_id).val("");
      $("#amount_value_" + row_id).val("");
    }else{
      $.ajax({
        url:base_url + 'expenditure1/getMaterialValueById',
        type: 'post',
        data:{idVatTuChi:material_id},
        dataType:'json',
        success:function(response){
          $("#rate_" + row_id).val(response.giaTien);
          $("#rate_value_" + row_id).val(response.giaTien);
          $("quantity_" + row_id).val(1);
          $("quantity_value_" + row_id).val(1);

          var total =Number(response.giaTien) * 1;
          total=total.toFixed(2);
          $("#amount_" + row_id).val(total);
          $("#amount_value_" + row_id).val(total);

          
          subAmount();
        }
      });
    }
  }

  function subAmount(){
    var tableMaterialLength = $("#material_info_table tbody tr").length;
    var totalSubAmount= 0;
    for(x = 0; x < tableMaterialLength; x++){
      var tr = $("#material_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count =count.substring(4);
      totalSubAmount = Number(totalSubAmount) +Number($("#amount_" + count).val());
    }

    totalSubAmount =totalSubAmount.toFixed(2);
    var amount = $("#tamount").val();
    var totalAmount = (Number(amount) + Number(totalSubAmount));
    totalAmount = totalAmount.toFixed(2);

  
      $("#amountt").val(totalAmount);
      $("#amountt_value").val(totalAmount);
    
  }

  function removeRow(tr_id)
  {
    $("#material_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>