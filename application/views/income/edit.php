

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $this->lang->line('Manage')?>
      <small><?php echo $this->lang->line('Income')?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('Home')?></a></li>
      <li class="active"><?php echo $this->lang->line('Income')?></li>
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
            <h3 class="box-title"><?php echo $this->lang->line('Edit Income')?></h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('income/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="incomecategory"><?php echo $this->lang->line('Income Category')?></label>
                  <select class="form-control select_group" id="incomecategory" name="incomecategory">
                    <?php foreach ($incomecategory as $k => $v): ?>
                      <option value="<?php echo $v['idHangMuc'] ?>" <?php if($income_data['incomes']['idHangMuc'] == $v['idHangMuc']) { echo "selected='selected'"; } ?> ><?php echo $v['loaiHangMuc'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="name_income"><?php echo $this->lang->line('Name Income Category')?></label>
                  <input type="text" class="form-control" id="name_income" name="name_income" value="<?php echo $income_data['incomes']['tenHangMuc'] ?>" autocomplete="off" />
                </div>
                
                <div class="form-group">
                  <label for="note_income"><?php echo $this->lang->line('Note');?></label>
                  <textarea type="text" class="form-control" id="note_income" name="note_income" autocomplete="off" ><?php echo $income_data['incomes']['ghiChu'] ?></textarea>
                </div>

                <div class="form-group">
                  <label for="fund"><?php echo $this->lang->line('Fund Name')?></label>
                  <select class="form-control select_group" id="fund" name="fund">
                    <?php foreach ($fund as $k => $v): ?>
                      <option value="<?php echo $v['idTaiKhoan'] ?>" <?php if($income_data['incomes']['idTaiKhoan'] == $v['idTaiKhoan']) { echo "selected='selected'"; } ?> ><?php echo $v['tenTaiKhoan'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group ">
                  <label for="material_status"><?php echo $this->lang->line('Material')?></label>
                  <div class="radio form-check-inline" id= "material_status">
                    <label>
                      <input type="radio" name="material_status" class="material_status" id="Yes" value="1" <?php
                          if($income_data['incomes']['materialStatus'] == 1) {echo "checked";}
                      ?>>
                      Yes
                    </label>
                    <label>
                      <input type="radio" name="material_status"class="material_status" id="No" value="0" <?php
                          if($income_data['incomes']['materialStatus'] == 0) {echo "checked";}
                      ?>>
                      No
                    </label>
                  </div>
                </div>

                <table class="table table-bordered" id="material_info_table" style="display: none;">
                  <thead>
                    <tr>
                      <th width="25%"><?php echo $this->lang->line('Material Name')?></th>
                      <th width="15%"><?php echo $this->lang->line('Type Materials')?></th>
                      <th width="20%"><?php echo $this->lang->line('Quantity')?></th>
                      <th width="20%"><?php echo $this->lang->line('Rate')?></th>
                      <th width="20%"><?php echo $this->lang->line('Amount')?></th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                  </thead>
                  <tbody>

                    <?php if(isset($income_data['materialic_item'])): ?>
                      <?php $x = 1; ?>
                      <?php foreach ($income_data['materialic_item'] as $key => $val): ?>
                      <tr id="row_<?php echo $x; ?>">
                        <td>
                          <select class="form-control select_group material" data-row-id="row_<?php echo $x; ?>" id="material_<?php echo $x; ?>" name="material[]" style="width:100%;" onchange="getMaterialData(1)">
                            <option value=""></option>
                            <?php foreach ($material as $k => $v):?>
                              <option value="<?php echo $v['idVatTu']?>" <?php if($val['idVatTu'] == $v['idVatTu']){echo "selected='selected'";}?>><?php echo $v['tenVatTu'] ?></option>
                              <?php endforeach ?>
                          </select>
                        </td>
                        
                        <td>
                          <?php foreach ($material as $k => $v): ?>
                            <?php foreach ($tmaterial as $k1 => $v1): ?>
                              <?php if ($val['idVatTu'] == $v['idVatTu'] && $v['loaiVatTu'] == $v1['id']): ?>
                                <input type="text" name="type_material_<?php echo $x; ?>" id="type_material_<?php echo $x; ?>" class="form-control" value="<?php echo $v1['name']; ?>" disabled autocomplete="off">
                                <input type="hidden" name="type_material_id_<?php echo $x; ?>" id="type_material_id_<?php echo $x; ?>"  class="form-control" value="<?php echo $v1['name']; ?>" autocomplete="off">
                              <?php endif; ?>
                            <?php endforeach; ?>
                          <?php endforeach; ?>
                        </td>

                        <td>
                          <input type="text" name="quantity[]" id="quantity_<?php echo $x; ?>" class="form-control" onkeyup="getTotal(<?php echo $x; ?>)" value="<?php echo $val['soLuong'] ?>" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="rate[]" id="rate_<?php echo $x; ?>" class="form-control" disabled value="<?php echo $val['giaTien'] ?>" autocomplete="off">
                          <input type="hidden" name="rate_value[]" id="rate_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['giaTien'] ?>" autocomplete="off">
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
                  <label for="receiver_name"><?php echo $this->lang->line('Receiver')?></label>
                  <input type="text" class="form-control" id="receiver_name" name="receiver_name" placeholder="Enter receiver name" value="<?php echo $income_data['incomes']['nguoiThu'] ?>" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="date_income"><?php echo $this->lang->line('Date Income')?></label>
                  <input type="date" class="form-control" id="date_income" name="date_income" placeholder="Enter date income" value="<?php echo $income_data['incomes']['ngayThu'] ?>" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="tamount"><?php echo $this->lang->line('Amount')?></label>
                  <input type="text" class="form-control" id="tamount" name="tamount" placeholder="Enter amount" value="<?php echo $income_data['incomes']['soTienThu'] ?>" autocomplete="off" onkeyup="subAmount()" />
                </div>

                <div class="form-group">
                  <label for="amountt"><?php echo $this->lang->line('Total Amount')?></label>
                  <input type="text" name ="amountt" id="amountt" class="form-control" value="<?php echo $income_data['incomes']['tongTien'] ?>" disabled autocomplete="off">
                  <input type="hidden" name= "amountt_value" id="amountt_value" class="form-control" value="<?php echo $income_data['incomes']['tongTien'] ?>" autocomplete="off">
                </div>
            </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save Changes')?></button>
                <a href="<?php echo base_url('income/') ?>" class="btn btn-warning"><?php echo $this->lang->line('Back')?></a>
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

    $("#mainIncomeNav").addClass('active');
    $("#manageIncomeNav").addClass('active');
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
        $('#material_'+row_id).val('').change();
        removeRow(row_id);
      }
    });

    // Initial check on page load
    if ($("input[name='material_status']:checked").val() == 1) {
      $("#material_info_table").show();
    } else {
      $("#material_info_table").hide();
      //removeRow(row_id);
    }

  $("#add_row").unbind('click').bind('click',function(){
      var table = $("#material_info_table");
      var count_table_tbody_tr = $("#material_info_table tbody tr").length;
      var row_id =count_table_tbody_tr + 1;

      $.ajax({
        url: base_url + '/income/getTableMaterialRow/',
        type: 'post',
        dataType: 'json',
        success:function(response){
          console.log(response)
          var html = '<tr id="row_' + row_id +'">' +
            '<td>'+
            '<select class="form-control select_group material" data-row-id="'+row_id+'" id = "material_'+row_id+'"name="material[]" style="width:100%" onchange="getMaterialData('+row_id+')">'+
                '<option value=""></option>';
                $.each(response, function(index,value) {
                    html += '<option value="'+value.idVatTu+'">'+value.tenVatTu+'</option>';
                  });
                
                html += '</select>'+
              '</td>'+
              '<td><input type="text" name="type_material[]" id="type_material_'+row_id+'" class="form-control" disabled><input type="hidden" name="type_material_value[]" id="type_material_value_'+row_id+'" class="form-control"></td>'+
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
      $("#type_material_" + row_id).val("");
      $("quantity_" + row_id).val("");
      $("#amount_" + row_id).val("");
      $("#amount_value_" + row_id).val("");
    }else{
      $.ajax({
        url:base_url + 'income/getMaterialValueById',
        type: 'post',
        data:{idVatTu:material_id},
        dataType:'json',
        success:function(response){
          console.log(response);
          $("#rate_" + row_id).val(response.giaTien);
          $("#rate_value_" + row_id).val(response.giaTien);
          $("quantity_" + row_id).val(1);
          $("quantity_value_" + row_id).val(1);

          var total =Number(response.giaTien) * 1;
          total=total.toFixed(2);
          $("#amount_" + row_id).val(total);
          $("#amount_value_" + row_id).val(total);

          var name = " ";
          <?php foreach($tmaterial as $k => $v): ?>
            if(response.loaiVatTu == <?php echo $v['id']; ?>){
              name = "<?php echo $v['name'];?>"
            }
          <?php endforeach; ?>
          $("#type_material_" + row_id).val(name);
          $("#type_material_value_" + row_id).val(name);
          
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

  function removeRow(tr_id) {
  console.log(tr_id);
  $("#material_info_table tbody tr#row_" + tr_id).remove();
  subAmount(); // Gọi hàm tính lại tổng tiền sau khi xoá hàng
}
</script>