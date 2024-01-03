
<style>
  .dataTable .row-details{
    margin-top: 3px;
    display: inline-block;
    cursor: pointer;
    width:14px;
    height: 14px;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Expenditure</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Expenditure</li>
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

        <?php if(in_array('createExpenditure1', $user_permission)): ?>
          <a href="<?php echo base_url('expenditure1/create') ?>" class="btn btn-primary">Add Expenditure1</a>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Expenditure1</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Expenditure Category</th>
                <th>Expenditure Name</th>
                <th>Material Status</th>
                <!--<th>Material</th>-->
                <th>Fund Name</th>
                <th>Payer</th>
                <th>Date Expenditure</th>
                <th>Amount</th>
                <th>Total Amount</th>
                
                <?php if(in_array('updateExpenditure1', $user_permission) || in_array('deleteExpenditure1', $user_permission)): ?>
                  <th>Action</th>
                <?php endif; ?>
                <th></th>
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

<?php if(in_array('deleteExpenditure1', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Expenditure</h4>
      </div>

      <form role="form" action="<?php echo base_url('expenditure1/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
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
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#mainExpenditure1tNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    ajax: base_url + 'expenditure1/fetchExpenditureData1',
    order: [],
    deferRender: true, 
    columnDefs: [
      //{
      //  targets: -1, // First column
      //  render: function(data, type, row, meta) {
      //    return '<i class="row-details fa fa-plus"></i>';
      //  }
      //},
      {
        //targets: -2,
        //className: 'dt-control'
      }
    ],
    'language': {
      
    },

    'footerCallback':function(row,data,start,end,display){
      var api = this.api(),data;

      var intVal =function(i){
        return typeof i === 'string' ?
        i.replace(/[\$,]/g, '')*1 :
        typeof i === 'number' ?
          i : 0;
      };

      total = api
      .column( 7 )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      pageTotal = api
      .column( 7, { page: 'current'} )
      .data()
      .reduce( function (a, b) {
        return intVal(a) + intVal(b);
      }, 0 );

      $( api.column( 7 ).footer() ).html(
      pageTotal.toLocaleString('en-US')
    );
  } 
  });

});

//table details

function format(d) {
    return (
        '<dl>' +
        '<dt>Full name:</dt>' +
        '<dd>' +
        d.tenVatTu
    );
}
manageTable = ("#manageTable").DataTable({
  ajax: 'expenditure1/fetchDataExpenditureDetails',
  data: { idBangChi:idBangChi }, 
  dataType: 'json',
  columnDefs: [
      {
        targets: -1, // First column
        render: function(data, type, row, meta) {
          return '<i class="row-details fa fa-plus"></i>';
        }
      },
      //{
      //  //targets: -2,
      //  //className: 'dt-control'
      //}
    ],
  columns: [
    {
      className: 'dt-control',
      orderable: false,
      data: null,
      defaultContent: ''
    },
    {data: 'tenVatTu'}
  ],
  'order': [[1,'asc']]
});

('$manageTable tbody').on('click', 'td.dt-control',function(){
    var tr = $(this).closest('tr');
    var row = manageTable.row(tr);
 
    if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
    }
    else {
        // Open this row
        row.child(format(row.data())).show();
    }
})

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

function rowDetails(id){

}


</script>
