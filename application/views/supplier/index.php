

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    <?php echo $this->lang->line('Manage')?>
      <small><?php echo $this->lang->line('Supplier')?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home')?></a></li>
      <li class="active"><?php echo $this->lang->line('Supplier')?></li>
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

        <?php if(in_array('createSupplier', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"><?php echo $this->lang->line('Add Supplier')?></button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?php echo $this->lang->line('Manage Supplier')?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th><?php echo $this->lang->line('Supplier Name')?></th>
                <th><?php echo $this->lang->line('Tax Code')?></th>
                <th><?php echo $this->lang->line('Address')?></th>
                <th><?php echo $this->lang->line('Phone')?></th>
                <th><?php echo $this->lang->line('Action')?></th>
                <?php if(in_array('updateSupplier', $user_permission) || in_array('deleteSupplier', $user_permission)): ?>
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

<?php if(in_array('createSupplier', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('Add Supplier')?></h4>
      </div>

      <form role="form" action="<?php echo base_url('supplier/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="name"><?php echo $this->lang->line('Supplier Name')?><span class="text-danger"> *</span></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo $this->lang->line('Enter Supplier Name')?>" autocomplete="off">
          </div>
        

			<div class="form-group">
				<label for="tcode"><?php echo $this->lang->line('Tax Code')?></label>
				<input type="text" class="form-control" id="tcode" name="tcode" placeholder="<?php echo $this->lang->line('Enter Tax Code')?>" autocomplete="off">
			</div>
        

			<div class="form-group">
				<label for="address"><?php echo $this->lang->line('Address')?><span class="text-danger"> *</span></label>
				<input type="text" class="form-control" id="address" name="address" placeholder="<?php echo $this->lang->line('Enter Address')?>" autocomplete="off">
			</div>

			<div class="form-group">
				<label for="phone"><?php echo $this->lang->line('Phone')?><span class="text-danger"> *</span></label>
				<input type="text" class="form-control" id="Phone" name="phone" placeholder="<?php echo $this->lang->line('Enter Phone')?>" autocomplete="off">
			</div>

			<div class="form-group">
				<label for="note"><?php echo $this->lang->line('Note')?></label>
				<textarea type="text" class="form-control" id="note" name="note" placeholder="<?php echo $this->lang->line('Enter Note')?>" autocomplete="off"></textarea>
			</div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Close')?></button>
          <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save changes')?></button>
        </div>

      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateSupplier', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('Edit Supplier')?></h4>
      </div>

      <form role="form" action="<?php echo base_url('supplier/update') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_name"><?php echo $this->lang->line('Supplier Name')?></label>
            <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="<?php echo $this->lang->line('Enter Supplier Name')?>" autocomplete="off">
          </div>

		  
		  <div class="form-group">
            <label for="edit_tcode"><?php echo $this->lang->line('Tax Code')?></label>
            <input type="text" class="form-control" id="edit_tcode" name="edit_tcode" placeholder="<?php echo $this->lang->line('Enter Tax Code')?>" autocomplete="off">
          </div>

			<div class="form-group">
				<label for="edit_address"><?php echo $this->lang->line('Address')?></label>
				<input type="text" class="form-control" id="edit_address" name="edit_address" placeholder="<?php echo $this->lang->line('Enter Address')?>" autocomplete="off">
			</div>

      <div class="form-group">
				<label for="edit_phone"><?php echo $this->lang->line('Phone')?></label>
				<input type="text" class="form-control" id="edit_phone" name="edit_phone" placeholder="<?php echo $this->lang->line('Enter Phone')?>" autocomplete="off">
			</div>

      <div class="form-group">
				<label for="edit_note"><?php echo $this->lang->line('Note')?></label>
				<textarea type="text" class="form-control" id="edit_note" name="edit_note" placeholder="<?php echo $this->lang->line('Enter Note')?>" autocomplete="off"></textarea>
			</div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Close')?></button>
          <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save changes')?></button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<div class="modal fade" tabindex="-1" role="dialog" id="detailModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('Supplier Details');?></h4>
      </div>
      <div class="modal-body">
        <!-- Details content will be displayed here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Close');?></button>
      </div>
    </div>
  </div>
</div>

<?php if(in_array('deleteSupplier', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('Remove Supplier')?></h4>
      </div>

      <form role="form" action="<?php echo base_url('supplier/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p><?php echo $this->lang->line('Do you really want to remove?')?></p>
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
var modalBody = $('#detailModal .modal-body');

$(document).ready(function() {
  $("#supplierNav").addClass('active');
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchSupplierData',
    'columns': [
        {data:'name'},
        {data:'taxcode'},
        {data:'address'},
        {data:'phone'},
        {data:'action'},
      ],
    'order': [[1, 'asc']],
  });

  $('#manageTable tbody').on('click', 'tr td:not(:last-child)', function(){
    var data =manageTable.row(this).data();
    showDetailModal(data);
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

function showDetailModal(data){
  //var modalBody = $('#detailModal modal-body');
  modalBody.empty();

  modalBody.append('<p><strong><?php echo $this->lang->line('Supplier Name');?>:</strong> ' + data.name + '</p>');

  showNote(data.id, function(note){
    console.log(data.id);
    if(note){
      modalBody.append('<p><strong><?php echo $this->lang->line('Note:');?></strong> <br>' + note +'</p>');
    }else{
      modalBody.append('<p<strong><?php echo $this->lang->line('Note:');?></strong> Not available </p>');
    }
  });
  $('#detailModal').modal('show');
}

function showNote(id, callback){
  $.ajax({
    url: 'getNoteSupplierData/' + id,
    type: 'GET',
    dataType:'json',
    data: {id:id},
    success:function(response){
      console.log(id);
      if(response.note !== undefined){
        callback(response.note);
      }else{
        console.error('Error: Invalid response structure');
      }
    }
  });
}

// edit function
function editFunc(id)
{ 
  $.ajax({
    url: 'fetchSupplierDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {
      $("#edit_name").val(response.name);
	  $("#edit_tcode").val(response.taxcode);
	  $("#edit_address").val(response.address);
	  $("#edit_phone").val(response.phone);
	  $("#edit_note").val(response.note);
	  
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
        data: { id:id }, 
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
