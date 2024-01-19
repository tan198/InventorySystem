

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    <?php echo $this->lang->line('Manage');?>
      <small><?php echo $this->lang->line('Expenditure');?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('Home');?> </a></li>
      <li class="active"><?php echo $this->lang->line('Expenditure');?></li>
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

        <?php if(in_array('createExpenditure', $user_permission)): ?>
          <a href="<?php echo base_url('expenditure/create') ?>" class="btn btn-primary"><?php echo $this->lang->line('Add Expenditure');?></a>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?php echo $this->lang->line('Manage Expenditure');?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th><?php echo $this->lang->line('Expenditure Category');?></th>
                <th><?php echo $this->lang->line('Expenditure Name');?></th>
                <th><?php echo $this->lang->line('Material Status');?></th>
                <!--<th>Material</th>-->
                <th><?php echo $this->lang->line('Fund Name');?></th>
                <th><?php echo $this->lang->line('Payer');?></th>
                <th><?php echo $this->lang->line('Date Expenditure');?></th>
                <th><?php echo $this->lang->line('Amount');?></th>
                <th><?php echo $this->lang->line('Total Amount');?></th>
                
                <?php if(in_array('updateExpenditure', $user_permission) || in_array('deleteExpenditure', $user_permission)): ?>
                  <th><?php echo $this->lang->line('Action');?></th>
                <?php endif; ?>
              </tr>
              </thead>

              <tfoot>
                <tr>
                  <th colspan="7" style="text-align:right">Total:</th>
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
        <h4 class="modal-title"><?php echo $this->lang->line('Expenditure Details');?></h4>
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


<?php if(in_array('deleteExpenditure', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $this->lang->line('Remove Expenditure');?></h4>
      </div>

      <form role="form" action="<?php echo base_url('expenditure/remove') ?>" method="post" id="removeForm">
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



  $("#mainExpendituretNav").addClass('active');
  // initialize the datatable 
  var manageTable = $('#manageTable').DataTable({
    "processing": true,
    "serverSide": false,
    "ajax": {
        "url": base_url + 'expenditure/fetchExpenditureData',
        "type": 'GET',
        "dataType": 'json',
        
        "dataSrc": 'data',
    },
    columns: [
        { data: 'idHangMucChi' },
        { data: 'tenHangMuc' },
        { data: 'materialStatus' },
        { data: 'idTaiKhoan' },
        { data: 'nguoiChi' },
        { data: 'ngayChi' },
        { data: 'soTien' },
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
    }
});

$('#manageTable tbody').on('click', 'tr', function() {
    var data = manageTable.row(this).data();
    showDetailModal(data); // Custom function to display details
});

});

//table details
function showDetailModal(data) {
    var modalBody = $('#detailModal .modal-body');
    modalBody.empty();

    modalBody.append('<p><strong><?php echo $this->lang->line('Expenditure Name:');?></strong> ' + data.tenHangMuc + '</p>');
    modalBody.append('<p><strong><?php echo $this->lang->line('Material Status:');?></strong> ' + data.materialStatus + '</p>');
    console.log(data);
    console.log('ID from DataTable:', data.idBangChi);
    console.log(data.ghiChu);
    showMaterialsData(data.idBangChi, function(tenVatTu) {
        if (tenVatTu) {
            modalBody.append('<p><strong><?php echo $this->lang->line('Material Name:');?></strong> ' + tenVatTu + '</p>');
        } else {
            modalBody.append('<p><strong><?php echo $this->lang->line('Material Name:');?></strong> Not available</p>');
        }
    });
    console.log('123');
    shownote(data.idBangChi, function(ghiChu){
      
      if(ghiChu){
        console.log('abc');
        modalBody.append('<p><strong><?php echo $this->lang->line('Note:');?></strong> ' + data.ghiChu + '</p>');
      }else{
        modalBody.append('<p><strong><?php echo $this->lang->line('Note:');?></strong> Not available</p>');
      }
    });

    $('#detailModal').modal('show');
}

var base_url = "<?php echo base_url(); ?>";

function shownote(idBangChi, callback){
  $.ajax({
    url: base_url + 'expenditure/getExpenditureData/' + idBangChi,
    type: 'GET',
    dataType: 'json',
    data: {idBangChi:idBangChi},
    success: function(response) {
      console.log('ID sent to server:',idBangChi);
      console.log('Response from server:', response);
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

function showMaterialsData(idBangChi, callback) {
    $.ajax({
        url: base_url + 'expenditure/getMaterialName/'+ idBangChi,
        type: 'GET',
        dataType: 'json',
        data: { idBangChi:idBangChi }, 
        success: function(response) {
          //console.log('ID sent to server:',idBangChi);
          //console.log('Response from server:', response);
          if (response.tenVatTu !== undefined) {
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
        data: { idBangChi:id }, 
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
