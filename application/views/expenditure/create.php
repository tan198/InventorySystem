

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php echo $this->lang->line('Manage')?>
        <small><?php echo $this->lang->line('Expenditure')?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('Home')?> </a></li>
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
              <h3 class="box-title"><?php echo $this->lang->line('Add Expenditure')?></h3>
            </div>
            <!-- /.box-header -->
            <form role="form" action="<?php base_url('expenditure/create') ?>" method="post" enctype="multipart/form-data">
                <div class="box-body">

                  <?php echo validation_errors(); ?>

                  <div class="form-group">
                    <label for="expenditurecategory"><?php echo $this->lang->line('Expenditure Category')?><span class="text-danger"> *</span></label>
                    <select class="form-control select_group" id="expenditurecategory" name="expenditurecategory">
                      <option value=""><?php echo $this->lang->line('Select Category')?></option>
                      <?php foreach ($category as $k => $v): ?>
                        <option value="<?php echo $v['idHangMuc'] ?>"><?php echo $v['loaiHangMuc'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="name_expenditure"><?php echo $this->lang->line('Name Expenditure Catagory')?><span class="text-danger">*</span></label>
                    <select name="name_expenditure" id="name_expenditure" class="form-control select_group name_expenditure">
                      <option value=""><?php echo $this->lang->line('Select Name Expenditure')?></option>
                      <?php foreach ($namecate as $k => $v): ?>
                        <option value="<?php echo $v['id']?>" ><?php echo $v['name'] ?> </option>
                      <?php endforeach;?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="note_expenditure"><?php echo $this->lang->line('Note')?></label>
                    <textarea type="text" class="form-control" id="note_expenditure" name="note_expenditure" placeholder="" autocomplete="off"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="fund"><?php echo $this->lang->line('Fund Name')?><span class="text-danger"> *</span></label>
                    <select class="form-control select_group" id="fund" name="fund">
                      <?php foreach ($fund as $k => $v): ?>
                        <option value="<?php echo $v['idTaiKhoan'] ?>"><?php echo $v['tenTaiKhoan'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="form-group ">
                    <label for="material_status"><?php echo $this->lang->line('Material')?><span class="text-danger">*</span></label>
                    <div class="radio form-check-inline" id= "material_status">
                      <label>
                        <input type="radio" name="material_status" class="material_status" id="Yes" value="1">
                        Yes
                      </label>
                      <label>
                        <input type="radio" name="material_status"class="material_status" id="No" value="0">
                        No
                      </label>
                    </div>
                  </div>

                  <table class="table table-bordered" id="material_info_table" style="display: none;">
                    <thead>
                      <tr>
                        <th width="25%"><?php echo $this->lang->line('Material Name')?><span class="text-danger"> *</span></th>
                        <th width="15%"><?php echo $this->lang->line('Type Materials')?><span class="text-danger"> *</span></th>
                        <th width="20%"><?php echo $this->lang->line('Quantity')?><span class="text-danger"> *</span></th>
                        <th width="20%"><?php echo $this->lang->line('Rate')?><span class="text-danger"> *</span></th>
                        <th width="20%"><?php echo $this->lang->line('Amount')?></th>
                        <th style="width:10%"><button type="button" id="add_row1" class="btn btn-default" ><i class="fa fa-plus"></i></button></th>
                    </thead>
                    <tbody>
                      <tr id='row_1'>
                        <td>
                        <input type="text" name="material_name[]" id="material_name_1" onchange="createMaterialData(1)" class="form-control" >
                        </td>
                        <td>
                          <select name="type_material[]" id="type_material_1" class="form-control select_group" style="width:100%;">
                            <?php foreach ($tmaterial as $k  => $v) :?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                        <td>
                          <input type="text" name="quantity[]" id="quantity_1"  pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" onkeyup="getTotal(1)" class="form-control">
                        </td>
                        <td>
                          <input type="text" name="rate[]" id="rate_1" class="form-control"  pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency"  onkeyup="getTotal(1)"  autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="amount" id ="amount_1" class="form-control" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" disabled autocomplete ="off">
                          <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" autocomplete="off">
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                    </tbody>
                  </table>

                  <div class="form-group">
                    <label for="supplier"><?php echo $this->lang->line('Supplier')?><span class="text-danger"> *</span></label>
                    <select class="form-control select_group" name="supplier" id="supplier">
                      <option value=""><?php echo $this->lang->line('Select Suplier') ?></option>
                      <?php foreach ($supplier as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['name']?></option>
                      <?php endforeach?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="date_expenditure"><?php echo $this->lang->line('Date Expenditure')?><span class="text-danger"> *</span></label>
                    <input type="date" class="form-control" id="date_expenditure" name="date_expenditure" placeholder="Enter date expenditure" autocomplete="off" />
                  </div>

                  <div class="form-group">
                    <label for="tamount"><?php echo $this->lang->line('Ship')?><span class="text-danger"> *</span></label>
                    <input type="text"  pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" class="form-control" id="tamount" name="tamount" placeholder="Enter amount" autocomplete="off" value="0" onkeyup="subAmount()" />
                  </div>

                  <div class="form-group">
                    <label for="amountt"><?php echo $this->lang->line('Total Amount')?></label>
                    <input type="text"  pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" name ="amountt" id="amountt" class="form-control" disabled autocomplete="off">
                    <input type="hidden"  pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" name= "amountt_value" id="amountt_value" class="form-control" autocomplete="off">
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save Changes')?></button>
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
    var base_url = "<?php echo base_url(); ?>";
    $(document).ready(function() {
      var base_url = "<?php echo base_url(); ?>";
      //create table and show/hide table
      var table = $("#material_info_table");
      var count_table_tbody_tr = $("#material_info_table tbody tr").length;
      var row_id =count_table_tbody_tr + 1;
      $(".select_group").select2();
      //$("#description").wysihtml5();

      $("#mainExpenditureNav").addClass('active');
      $("#addExpenditureNav").addClass('active');

      $('input[name="material_status"]').on('change', function(){
        if(this.value == 1){
          $("#material_info_table").show();
          }else{
            $("#material_info_table").hide();
            $('#material_info_table input[type="text"]').val('');
            $('#material_' + row_id).val('').change();
            removeRow(row_id);
          }
      });


      $("#expenditurecategory").change(function(){
        var category = $(this).val();
        $.ajax({
        url: base_url + '/namecate/getListName/' + category,
        type: 'GET',
        dataType: 'json',
        success: function(data){
            // Xóa tất cả các option hiện có trong select box name_expenditure
            $('#name_expenditure').empty();
            
            // Thêm các option mới dựa trên dữ liệu nhận được từ ajax response
            $.each(data, function(index, value){
              
                $('#name_expenditure').append('<option value="' + value.id+ '">' + value.name + '</option>');
            });
            $(".name_expenditure").select2();
          }

        });
      });

      
        $("#add_row1").unbind('click').bind('click',function(){
            var table = $("#material_info_table");
            var count_table_tbody_tr = $("#material_info_table tbody tr").length;
            var row_id =count_table_tbody_tr + 1;

            var html = '<tr id="row_' + row_id +'">' +
                '<td><input type="text" name="material_name[]" id="material_name_' + row_id +'" class="form-control" ></td>'+
                '<td>'+
                '<select class="form-control select_group type_material" data-row-id="'+row_id+'" id = "type_material_'+row_id+'"name="type_material[]" style="width:100%">'+
                  '<option value=""></option>';
                  <?php foreach ($tmaterial as $k => $v): ?> 
                    html += '<option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>'
                    <?php endforeach?>;
                
                html += '</select>'+
              '</td>'+
                '<td><input type="number" name="quantity[]" id="quantity_' + row_id +'" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" class="form-control"></td>'+
                '<td><input type="text" name="rate[]" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" id="rate_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                '<td><input type="text" name="amount[]" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" id="amount_value_'+row_id+'" class="form-control"></td>'+
                '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                '</tr>';
              if(count_table_tbody_tr >=1){
                $("#material_info_table tbody tr:last").after(html);
              }else{
                $("#material_info_table tbody").html(html);
              }
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

    function getTotal(row = null){
      if(row){
        var total = parseFloat(($("#rate_" + row).val()).replace(/,/g,"")) * parseFloat(($("#quantity_" + row).val()).replace(/,/g,""));
        total =total.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        $("#amount_"+row).val(total);
        $("#amount_value_" + row).val(total);
        subAmount();
      }else{
        alert('no row !! pleae refresh the page');
      }
    }

    function subAmount(){
      var tableMaterialLength = $("#material_info_table tbody tr").length;
      var totalSubAmount= 0;
      for(x = 0; x < tableMaterialLength; x++){
        var tr = $("#material_info_table tbody tr")[x];
        var count = $(tr).attr('id');
        count =count.substring(4);
        totalSubAmount = parseFloat(totalSubAmount) + parseFloat(($("#amount_" + count).val()).replace(/,/g , ''));
      }

      totalSubAmount =totalSubAmount.toFixed(2);
      var amount = parseFloat($("#tamount").val().replace(/,/g,""));
      var totalAmount = (Number(amount) + Number(totalSubAmount));
      totalAmount = totalAmount.toLocaleString(undefined,{ minimumFractionDigits: 2, maximumFractionDigits: 2 });
    
        $("#amountt").val(totalAmount);
        $("#amountt_value").val(totalAmount);
      
    }

    function removeRow(tr_id)
    {
      $("#material_info_table tbody tr#row_"+tr_id).remove();
      subAmount();
      var tamount_value = $("#tamount").val();
      
      $("#amountt_value").val(tamount_value);
    }

    
  </script>