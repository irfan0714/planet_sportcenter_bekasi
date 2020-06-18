<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Laporan</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li>Laporan</li>
            <li class="active">Laporan Penjualan</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">DATA LAPORAN PENJUALAN</h3>
            <?php 
                $tanggal1 = date('d/m/Y');
                if(isset($_POST['tanggal1']))
                {
                    $tanggal1 = $_POST['tanggal1'];
                }

                $tanggal2 = date('d/m/Y');
                if(isset($_POST['tanggal2']))
                {
                    $tanggal2 = $_POST['tanggal2'];
                }

                $arr_tgl1 = explode("/",$tanggal1);
                $tgl1  = $arr_tgl1[2]."-".$arr_tgl1[1]."-".$arr_tgl1[0];

                $arr_tgl2 = explode("/",$tanggal2);
                $tgl2  = $arr_tgl2[2]."-".$arr_tgl2[1]."-".$arr_tgl2[0];

                $query1 = " SELECT
                              transaksi.id_transaksi,
                              transaksi.tgl_transaksi,
                              pelanggan.nama_pelanggan,
                              SUM(transaksi_detail.harga) as total
                            FROM
                              transaksi
                            INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi
                            INNER JOIN  pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
                            WHERE transaksi.tgl_transaksi BETWEEN '$tgl1' AND '$tgl2'
                            AND transaksi.status = 'SELESAI'
                            GROUP BY transaksi.id_transaksi";  

                $exc_query1 = mysqli_query($con,$query1);
                
            ?>
            <form method="POST" action="?p=laporan">
                <table>
                    <tr>
                        <td><input type="" class="form-control input-sm" name="tanggal1" id="tanggal1" value="<?php echo $tanggal1; ?>"></td>
                        <td>&nbsp; - &nbsp;</td>
                        <td><input type="" class="form-control input-sm" name="tanggal2" id="tanggal2" value="<?php echo $tanggal2; ?>"></td>
                        <td>&nbsp;&nbsp;</td>
                        <td><button class="btn btn-sm btn-primary">Cari</button></td>
                    </tr>
                </table>
            </form>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. Transaksi</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th class="text-right">Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        $total = 0;
                        while ( $value1 = mysqli_fetch_array($exc_query1)) 
                        {
                            echo "<tr>";
                            echo "<td>".$no++.".</td>";
                            echo "<td>".$value1['id_transaksi']."</td>";
                            echo "<td>".date('d/m/Y',strtotime($value1['tgl_transaksi']))."</td>";
                            echo "<td>".$value1['nama_pelanggan']."</td>";
                            echo "<td align='right'>".number_format($value1['total'],0,",",".")."</td>";
                            echo "<td></td>";
                            echo "</tr>";

                            $total += $value1['total'];
                        }

                        echo "<tr>";
                        echo "<td colspan='4' align='right'>TOTAL</td>";
                        echo "<td align='right'>".number_format($total,0,",",".")."</td>";
                        echo "</tr>";
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var date = new Date();
        date.setDate(date.getDate());
        $('#tanggal1').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            autoclose: true,
        });

        $('#tanggal2').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            autoclose: true,
        });

        $('#tanggal1').datepicker().on('changeDate', function(e) {
            validasi_tanggal();
        });

        $('#tanggal2').datepicker().on('changeDate', function(e) {
            validasi_tanggal();
        });

    });

    function validasi_tanggal(){
        var string_date1 = $('#tanggal1').val();
        var arr1 = string_date1.split('/');
        var start = parseInt(arr1[2]+arr1[1]+arr1[0]);

        var string_date2 = $('#tanggal2').val();
        var arr2 = string_date2.split('/');
        var end = parseInt(arr2[2]+arr2[1]+arr2[0]);

        if(end < start){
            $.confirm({
                title: 'Warning!',
                icon: 'fa fa-times',
                content: 'Tanggal yang anda pilih salah',
                buttons: {
                    OK: function(){
                        // $('#tanggal1').val(string_date1);
                        // $('#tanggal2').val(string_date1);

                    }
                }
            });
        }
    }
</script>