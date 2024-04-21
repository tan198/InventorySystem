<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo $this->lang->line('Manage');?>
			<small><?php echo $this->lang->line('Refund')?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"><?php echo $this->lang->line("Home")?></i></a></li>
			<li class="active"><?php echo $this->lang->line('Refund')?></li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div id="messages"></div>

				<?php if($this->session->flashdata('successs')):?>
					<div class="alert alert-success alert-dimissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<?php echo $this->session->flashdata('success');?>
					</div>
				<?php elseif($this->session->flashdata('error')):?>
					<div class="alert alert-error alert-dismissible" role="alter">
						<button type="button" class="close" data-dismiss="alert" aira-label="Close"><span aria-hidden="true">&times;</span></button>
						<?php echo $this->session->flashdata('error');?>
					</div>
				<?php endif; ?>

				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><?php echo $this->lang->line('Add Refund')?></h3>
					</div>

					<form role="form" action="<?php base_url('refund/create')?>" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<?php echo validation_errors(); ?>

							<div class="form-group">
								<label for="payer_name"><?php echo $this->lang->line('Payer')?><span class="text-danger"> *</span></label>
								<select name="payer_name" id="payer_name" class="form-control select_group">
									<?php foreach($users as $k => $v): ?>
										<option value="<?php echo $v['id']?>"><?php echo $v['firstname'] .' '. $v['lastname']?></option>
									<?php endforeach ?>
								</select>
							</div>

							<div class="form-group">
								<label for="note"><?php echo $this->lang->line('Note')?><span class="text-danger"> *</span></label>
								<textarea type="text" name="note" id="note" class="form-control" placeholder="" autocomplete="off"></textarea>
							</div>

							<div class="form-group">
								<label for="receiver_name"><?php echo $this->lang->line('Receiver') ?><span class="text-danger"> *</span></label>
								<select name="receiver_name" id="receiver_name" class="form-control select_group">
									<?php foreach($users as $k => $v): ?>
										<option value="<?php echo $v['id']?>"><?php echo $v['firstname'] .' '. $v['lastname']?></option>
									<?php endforeach?>
								</select>
							</div>

							<div class="form-group col-md-6">
								<label for="fund"><?php echo $this->lang->line('Fund Name')?><span class="text-danger"> *</span></label>
								<select name="fund" id="fund" class="form-control select_group">
									<option value=""></option>
									<?php foreach($fund as $k => $v): ?>
										<option value="<?php echo $v['idTaiKhoan'] ?>"> <?php echo $v['tenTaiKhoan'] ?></option>
									<?php endforeach?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="payment"><?php echo $this->lang->line('Type Payment')?></label>
								<input type="text" name="payment" id="payment" class="form-control" disabled autocomplete="off">
								<input type="hidden" name="payment" id="payment" class="form-control" autocomplete="off">
							</div>

							<div class="form-group">
								<label for="date_refund"><?php echo $this->lang->line('Date')?><span class="text-danger"> *</span></label>
								<input class="form-control" type="date" name="date_refund" id="date_refund" autocomplete ="off"/>
							</div>

							<div class="form-group">
								<label for="amount"><?php echo $this->lang->line('Amount')?><span class="text-danger"> *</span></label>
								<input type="number" name="amount" pattern="^\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" id="amount" class="form-control" autocomplete="off" />
							</div>
						</div>

						<div class="box-footer">
							<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save Changes'); ?></button>
							<a href="<?php echo base_url('income/')?>" class="btn btn-warning"><?php echo $this->lang->line('Back')?></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>

<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
	$(document).ready(function(){
		$(".select_group").select2();
		$("#mainIncomeNav").addClass('active');

		$("#fund").change(function(){
			var selected = $(this).val();
			$.ajax({
				url: base_url + 'refund/getPaymentById/'+ selected,
				type: 'GET',
				//data: {idTaiKhoan: selected},
				success: function(data){
					var decodedData = JSON.parse(data);
					$("#payment").val(decodedData.loaiThanhToan);
				}
			})
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
	})
</script>