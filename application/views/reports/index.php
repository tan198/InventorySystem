<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $this->lang->line('Reports')?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('Home')?></a></li>
            <li class="active"><?php echo $this->lang->line('Reports')?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12 col-xs-12">
                <form class="form-inline" action="<?php echo base_url('reports/') ?>" method="POST">
                    <div class="form-group">
                        <label for="date"><?php echo $this->lang->line('Year')?></label>
                        <select class="form-control" name="select_year" id="select_year">
                            <?php foreach ($report_years as $key => $value): ?>
                                <option value="<?php echo $value ?>" <?php if($value == $selected_year) { echo "selected"; } ?>><?php echo $value; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default"><?php echo $this->lang->line('Submit')?></button>
                </form>
            </div>

            <br><br>

            <div class="col-md-6 col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $this->lang->line('Total Parking - Report Expenditure')?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="chart1">
                            <canvas id="barChart1" style="height:350px"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $this->lang->line('Total Expenditure - Report Data')?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="datatables" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('Month - Year')?></th>
                                    <th><?php echo $this->lang->line('Amount')?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $k => $v): ?>
                                    <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo $company_currency .' ' . $v; ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tbody>
                                <tr>
                                    <th><?php echo $this->lang->line('Total Amount')?></th>
                                    <th><?php echo $company_currency .' ' . array_sum($results); ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- col-md-12 -->

            <div class="col-md-6 col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $this->lang->line('Total Parking - Report Income')?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="chart2">
                            <canvas id="barChart2" style="height:250px"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $this->lang->line('Total Income - Report Data')?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="datatables" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('Month - Year')?></th>
                                    <th><?php echo $this->lang->line('Amount')?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $k => $v): ?>
                                    <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo $company_currency .' ' . $v; ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tbody>
                                <tr>
                                    <th><?php echo $this->lang->line('Total Amount')?></th>
                                    <th><?php echo $company_currency .' ' . array_sum($income); ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function() {
        $("#reportNav").addClass('active');
    });

    // Dữ liệu cho biểu đồ barChart1
    var report_data = <?php echo '[' . implode(',', $results) . ']'; ?>;

    // Dữ liệu cho biểu đồ barChart1
    var report_advances = <?php echo '[' . implode(',' ,$advances) . ']'?>;
    var report_material = <?php echo '[' . implode(',' ,$buymaterial) . ']'?>;
    var report_other_expenditure = <?php echo '[' . implode(',' ,$other_expenditure) . ']'?>;

    // Dữ liệu cho biểu đồ barChart2
    var report_refund = <?php echo '[' . implode(',' ,$refund) . ']'?>;
    var report_material_income = <?php echo '[' . implode(',' ,$material_income) . ']'?>;
    var report_other_income = <?php echo '[' . implode(',' ,$other_income) . ']'?>;
    var report_income = <?php echo '[' . implode(',' ,$income) . ']'?>;

       // Cấu hình cho biểu đồ barChart1
       var data1 = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Advances',
            data: report_advances,
            backgroundColor: 'rgb(255, 120, 120)'
        },{
            label: 'Buy Material',
            data: report_material,
            backgroundColor: 'rgb(255, 159, 64)'
        },{
            label: 'Other Expenditrure',
            data: report_other_expenditure,
            backgroundColor: 'rgba(255, 205, 86)'
        }]
    };

    var config1 = {
        type: 'bar',
        data: data1,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Khởi tạo biểu đồ barChart1
    var ctx1 = document.getElementById('barChart1').getContext('2d');
    var myChart1 = new Chart(ctx1, config1);

    // Cấu hình cho biểu đồ barChart2
    var data2 = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Refund',
            data: report_refund,
            backgroundColor: 'rgb(255, 120, 120)'
        },{
            label: 'Material Income',
            data: report_material_income,
            backgroundColor: 'rgb(255, 159, 64)'
        },{
            label: 'Other Income',
            data: report_other_income,
            backgroundColor: 'rgba(255, 205, 86)'
        }]
    };

    var config2 = {
        type: 'bar',
        data: data2,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Khởi tạo biểu đồ barChart2
    var ctx2 = document.getElementById('barChart2').getContext('2d');
    var myChart2 = new Chart(ctx2, config2);
</script>
