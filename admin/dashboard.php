<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Dashboard</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>

<?php 
    
    $query1 = "SELECT COUNT(id_transaksi) AS total FROM transaksi WHERE tgl_transaksi = DATE(NOW()) ";
    $exc_query1 = mysqli_query($con,$query1);
    $value1 = mysqli_fetch_array($exc_query1);
    $total_pensana_baru = $value1['total'];

    $query2 = "SELECT COUNT(id_transaksi) AS total FROM transaksi";
    $exc_query2 = mysqli_query($con,$query2);
    $value2 = mysqli_fetch_array($exc_query2);
    $total_pensanan = $value2['total'];

    $query3 = "SELECT SUM(transaksi_detail.harga) AS total FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi WHERE transaksi.status = 'SELESAI' "; 
    $exc_query3 = mysqli_query($con,$query3);
    $value3 = mysqli_fetch_array($exc_query3);
    $omset = $value3['total']; 
?>
<div class="row">
    <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Pesanan Baru</h3>
            <ul class="list-inline two-part">
                <li>
                    <div id="sparklinedash"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas></div>
                </li>
                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success"><?php echo $total_pensana_baru; ?></span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Total Pesanan</h3>
            <ul class="list-inline two-part">
                <li>
                    <div id="sparklinedash2"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas></div>
                </li>
                <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple"><?php echo $total_pensanan; ?></span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">Omset</h3>
            <ul class="list-inline two-part">
                <li>
                    <div id="sparklinedash3"><canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas></div>
                </li>
                <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info"><?php echo number_format($omset,0,".",","); ?></span></li>
            </ul>
        </div>
    </div>
</div>