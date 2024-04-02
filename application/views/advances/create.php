<div class="content-wrapper">
	<section class="content-header">
		<h1>
			<?php echo $this->lang->line('Manage');?>
			<small><?php echo $this->lang->line('Advances')?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"><?php echo $this->lang->line("Home")?></i></a></li>
			<li class="active"><?php echo $this->lang->line('Advances')?></li>
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
						<h3 class="box-title"><?php echo $this->lang->line('Add Advances')?></h3>
					</div>

					<form role="form" action="<?php base_url('advances/create')?>" method="post" enctype="multipart/form-data">
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
								<label for="date_advances"><?php echo $this->lang->line('Date')?><span class="text-danger"> *</span></label>
								<input class="form-control" type="date" name="date_advances" id="date_advances" autocomplete ="off"/>
							</div>

							<div class="form-group">
								<label for="amount"><?php echo $this->lang->line('Amount')?><span class="text-danger"> *</span></label>
								<input type="number" name="amount" id="amount" class="form-control" autocomplete="off" />
							</div>
						</div>

						<div class="box-footer">
							<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Save Changes'); ?></button>
							<a href="<?php echo base_url('expenditure/')?>" class="btn btn-warning"><?php echo $this->lang->line('Back')?></a>
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
		$("#mainExpenditureNav").addClass('active');

		$("#fund").change(function(){
			var selected = $(this).val();
			$.ajax({
				url: base_url + 'advances/getPaymentById/'+ selected,
				type: 'GET',
				//data: {idTaiKhoan: selected},
				success: function(data){
					var decodedData = JSON.parse(data);
					$("#payment").val(decodedData.loaiThanhToan);
				}
			})
		})
	})
</script>