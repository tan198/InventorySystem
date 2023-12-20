

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    <?php echo $this->lang->line('Manage')?>
      <small><?php echo $this->lang->line('Debts')?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home')?></a></li>
      <li class="active"><?php echo $this->lang->line('Debts')?></li>
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

        <?php if(in_array('createDebts', $user_permission)): ?>
          <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"><?php echo $this->lang->line('Add Debts')?></button>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?php echo $this->lang->line('Manage Debts')?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th><?php echo $this->lang->line('Debt Unit')?></th>
                <th><?php echo $this->lang->line('Amount')?></th>
                <th><?php echo $this->lang->line('Payment Period')?></th>
                <th><?php echo $this->lang->line('Action')?></th>
                <?php if(in_array('updateDebts', $user_permission) || in_array('deleteDebts', $user_permission)): ?>
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

<?php if(in_array('createDebts', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('Add Debts')?></h4>
      </div>

      <form role="form" action="<?php echo base_url('debts/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="debt_unit"><?php echo $this->lang->line('Debt Unit')?></label>
            <input type="text" class="form-control" id="debt_unit" name="debt_unit" placeholder="<?php echo $this->lang->line('Enter Debt Unit Name ')?>" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="amount"><?php echo $this->lang->line('Amount')?></label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="<?php echo $this->lang->line('Enter Amount ')?>" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="payment_period"><?php echo $this->lang->line('Payment Period')?></label>
            <input type="date" class="form-control" id="payment_period" name="payment_period" placeholder="<?php echo $this->lang->line('Enter Payment Period ')?>" autocomplete="off">
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

<?php if(in_array('updateDebts', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('Edit Debts')?></h4>
      </div>

      <form role="form" action="<?php echo base_url('debts/update') ?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="edit_debt_unit"><?php echo $this->lang->line('Debts Unit')?></label>
            <input type="text" class="form-control" id="edit_debt_unit" name="edit_debt_unit" placeholder="<?php echo $this->lang->line('Enter Debts Unit Name ')?>" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="edit_amount"><?php echo $this->lang->line('Amount')?></label>
            <input type="text" class="form-control" id="edit_amount" name="edit_amount" placeholder="<?php echo $this->lang->line('Enter Amount ')?>" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="edit_payment_period"><?php echo $this->lang->line('Payment Period')?></label>
            <input type="text" class="form-control" id="edit_payment_period" name="edit_payment_period" placeholder="<?php echo $this->lang->line('Enter Payment Period ')?>" autocomplete="off">
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

<?php if(in_array('deleteDebts', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('Remove Debts')?></h4>
      </div>

      <form role="form" action="<?php echo base_url('debts/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p><?php echo $this->lang->line('Do you really want to remove?')?></p>
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


<script type="text/javascript">
var manageTable;

$(document).ready(function() {
  $("#debtsNav").addClass('active');
  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': 'fetchDebtsData',
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

// edit function
function editFunc(id)
{ 
  $.ajax({
    url: 'fetchDebtsDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_lending_unit").val(response.donViChoMuon);
      $("#edit_amount").val(response.soTien);
      $("#edit_repayment_period").val(response.thoiHanTra);

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
        data: { idChoMuonChi:id }, 
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
