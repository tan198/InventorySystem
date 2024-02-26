

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    <?php echo $this->lang->line('Manage');?>
      <small><?php echo $this->lang->line('Income');?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('Home');?> </a></li>
      <li class="active"><?php echo $this->lang->line('Income');?></li>
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

        <?php if(in_array('createIncome', $user_permission)): ?>
          <a href="<?php echo base_url('income/create') ?>" class="btn btn-primary"><?php echo $this->lang->line('Add Income');?></a>
          <a href="<?php echo base_url('income/exportexcel') ?>" class="btn btn-primary mb-2">Export</a>
          <br> <br>

        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?php echo $this->lang->line('Manage Income');?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-hover" >
              <thead>
              <tr>
              <th><?php echo $this->lang->line('Income Category')?></th>
                <th><?php echo $this->lang->line('Income Name')?></th>
                <th><?php echo $this->lang->line('Material Status')?></th>
                <th><?php echo $this->lang->line('Payment Type')?></th>
                <th><?php echo $this->lang->line('Receiver')?></th>
                <th><?php echo $this->lang->line('Date Income')?></th>
                <th><?php echo $this->lang->line('Amount')?></th>
                <th><?php echo $this->lang->line('Total Amount')?></th>
                
                <?php if(in_array('updateIncome', $user_permission) || in_array('deleteIncome', $user_permission)): ?>
                  <th><?php echo $this->lang->line('Action');?></th>
                <?php endif; ?>
              </tr>
              </thead>

              <tfoot>
                <tr>
                  <th colspan="7" style="text-align:right"><?php echo $this->lang->line('Total:');?></th>
                  <th></th>
                </tr>
              </tfoot>

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

<!-- Detail Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="detailModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('Income Details');?></h4>
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


<?php if(in_array('deleteIncome', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('Remove Income');?></h4>
      </div>

      <form role="form" action="<?php echo base_url('income/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p><?php echo $this->lang->line('Do you really want to remove?');?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Close');?></button>
          <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save changes');?></button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#mainIncometNav").addClass('active');
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    "serverSide": false,
    ajax: {
        "url": base_url + 'income/fetchIncomeData',
        "type": 'GET',
        "dataType": 'json',
        "dataSrc": 'data',
    },
    columns: [
        { data: 'idHangMuc' },
        { data: 'tenHangMuc' },
        { data: 'materialStatus' },
        { data: 'idTaiKhoan' },
        { data: 'nguoiThu' },
        { data: 'ngayThu' },
        { data: 'soTienThu' },
        { data: 'tongTien' },
        { data: 'action' },
    ],
    order: [[1,'asc']],
    'footerCallback': function(row, data, start, end, display) {
        var api = this.api(), data;

        var intVal = function(i) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '') * 1 :
                typeof i === 'number' ?
                    i : 0;
        };

        total = api
            .column(7)
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        pageTotal = api
            .column(7, { page: 'current' })
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        $(api.column(7).footer()).html(
            pageTotal.toLocaleString('en-US')
        );
    },
   
  });

  $('#manageTable tbody').on('click', 'tr td:not(:last-child)', function() {
    var data = manageTable.row(this).data();
      showDetailModal(data); // Custom function to display details
  });

});


//table details
function showDetailModal(data) {
    var modalBody = $('#detailModal .modal-body');
    modalBody.empty();

    modalBody.append('<p><strong><?php echo $this->lang->line('Name Income:');?></strong> ' + data.tenHangMuc + '</p>');
    modalBody.append('<p><strong><?php echo $this->lang->line('Material Status:');?></strong> ' + data.materialStatus + '</p>');

    showMaterialsData(data.idBangThu, function(tenVatTu) {
      console.log(data.idBangThu);
      if (tenVatTu) {
          modalBody.append('<p><strong><?php echo $this->lang->line('Material Name:');?><br></strong> ' + tenVatTu + '</p>');
      } else {
        modalBody.append('<p><strong><?php echo $this->lang->line('Material Name:');?></strong> <?php echo $this->lang->line('Not available');?></p>');
      }
    });
    shownote(data.idBangThu, function(ghiChu){
      
      if(ghiChu){
        modalBody.append('<p><strong><?php echo $this->lang->line('Note:');?></br></strong> ' + ghiChu + '</p>');
      }else{
        modalBody.append('<p><strong><?php echo $this->lang->line('Note:');?></strong> Not available</p>');
      }
    });

    $('#detailModal').modal('show');
}



function shownote(idBangThu, callback){
  $.ajax({
    url: base_url + 'income/getNoteIncomeData/' + idBangThu,
    type: 'GET',
    dataType: 'json',
    data: {idBangThu:idBangThu},
    success: function(response) {
      console.log(response.ghiChu);
      if (response.ghiChu !== undefined) {
        // Truyền trực tiếp note vào callback
        callback(response.ghiChu);
      } else {
          console.error('Error: Invalid response structure');
      }
    }
  });
}

function showMaterialsData(idBangThu, callback) {
    $.ajax({
        url: base_url + 'income/getMaterialName/'+ idBangThu,
        type: 'GET',
        dataType: 'json',
        data: { idBangThu:idBangThu }, 
        success: function(response) {
          console.log('ID sent to server:',idBangThu);
          console.log('Response from server:', response);
          if (response && response.tenVatTu !== undefined) {
            // Truyền trực tiếp tenVatTu vào callback
            callback(response.tenVatTu);
          } else {
              console.error('Error: Invalid response structure');
          }
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
        data: { idBangThu:id }, 
        dataType: 'json',
        success:function(response) {
          console.log(response);

          manageTable.ajax.reload(null, false);

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');
            //window.location.reload();
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
