

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Quản lý
      <small>Vật Tư Chi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
      <li class="active">Vật tư chi</li>
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

        <?php if(in_array('createMaterials', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Thêm Vật Tư Chi</button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Quản lý vật tư chi</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Tên Vật Tư</th>
				        <th>Số Lượng</th>
				        <th>Giá Tiền</th>
				        <th>Tổng Tiền</th>
                <th>Action</th>
                <?php if(in_array('updateMaterials', $user_permission) || in_array('deleteMaterials', $user_permission)): ?>
                <?php endif; ?>
              </tr>
              </thead>

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

<?php if(in_array('createMaterials', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thêm Vật Tư Chi</h4>
      </div>

      <form role="form" action="<?php echo base_url('materials/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="materials_name">Tên Vật Tư</label>
            <input type="text" class="form-control" id="materials_name" name="materials_name" placeholder="Nhập tên vật tư chi" autocomplete="off">
          </div>
        

			<div class="form-group">
				<label for="quantity">Số Lượng</label>
				<input type="text" class="form-control" id="quantity" name="quantity" placeholder="Nhập số lượng vật tư chi" autocomplete="off">
			</div>
        

			<div class="form-group">
				<label for="amount">Giá tiền</label>
				<input type="text" class="form-control" id="amount" name="amount" placeholder="Nhập giá tiền vật tư" autocomplete="off">
			</div>

			<div class="form-group">
				<label for="total">Tổng Tiền</label>
				<input type="text" class="form-control" id="total" name="total" disabled autocomplete="off">
				<input type="hidden" class="form-control" id="hiddenTotal" name="hiddenTotal" autocomplete="off">
			</div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateMaterials', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cập nhật vật tư chi</h4>
      </div>

      <form role="form" action="<?php echo base_url('materials/update') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_materials_name">Tên Vật Tư</label>
            <input type="text" class="form-control" id="edit_materials_name" name="edit_materials_name" placeholder="Nhập tên vật tư chi" autocomplete="off">
          </div>

		  
		  <div class="form-group">
            <label for="edit_quantity">Số Lượng</label>
            <input type="text" class="form-control" id="edit_quantity" name="edit_quantity" placeholder="Nhập số lượng vật tư chi" autocomplete="off">
          </div>

			<div class="form-group">
				<label for="edit_amount">Giá tiền</label>
				<input type="text" class="form-control" id="edit_amount" name="edit_amount" placeholder="Nhập giá tiền vật tư" autocomplete="off">
			</div>

			<div class="form-group">
				<label for="total">Tổng Tiền</label>
				<input type="text" class="form-control" id="edit_total" name="edit_total" disabled autocomplete="off">
				
				<input type="hidden" class="form-control" id="edit_hiddenTotal" name="edit_hiddenTotal"  autocomplete="off">
			</div>
        </div>

		

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteMaterials', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Xoá Vật Tư Chi</h4>
      </div>

      <form role="form" action="<?php echo base_url('materials/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Bạn có muốn xoá nó không</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<script type="text/javascript">
var manageTable;

$(document).ready(function() {
  $("#materialsNav").addClass('active');
  $("#quantity, #amount").on("input", function() {
    toTal();
  });
  
  $("#edit_quantity, #edit_amount").on("input", function() {
			total1();
		});
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchMaterialsData',
    'order': []
  });

  // submit the create from 
  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);
	

    // remove the text-danger
    $(".text-danger").remove();

	
    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success:function(response) {
		
        manageTable.ajax.reload(null, false); 
        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');


          // hide the modal
          $("#addModal").modal('hide');

          // reset the form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');
		  	
		  

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      }
    }); 
    return false;
  });

});

function toTal(){
	$("#quantity, #amount").on("input",function(){
		var quantityValue = parseFloat($("#quantity").val()) || 0;
    	var amountValue = parseFloat($("#amount").val()) || 0;
		var totalValue = quantityValue * amountValue;
		$("#total").val(totalValue.toFixed(2));
        $("#hiddenTotal").val(totalValue.toFixed(2));
	});
}

function total1(){
	$("#edit_quantity, #edit_amount").on("input",function(){
		var quantityValue1 = parseFloat($("#edit_quantity").val()) || 0;
    	var amountValue1 = parseFloat($("#edit_amount").val()) || 0;
		var totalValue1 = quantityValue1 * amountValue1;
		$("#edit_total").val(totalValue1.toFixed(2));
        $("#edit_hiddenTotal").val(totalValue1.toFixed(2));
		
	});
}


// edit function
function editFunc(id)
{ 
  $.ajax({
    url: 'fetchMaterialsDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      $("#edit_materials_name").val(response.tenVatTu);
	  $("#edit_quantity").val(response.soLuong);
	  $("#edit_amount").val(response.giaTien);
	  $("#edit_total").val(response.tongTien);
	  
      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);
		
        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
              $("#editModal").modal('hide');
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        }); 

        return false;
      });
    }
  });
}

// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { idVatTuChi:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}


</script>