<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Pesanan</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="?p=dashboard">Dashboard</a></li>
            <li class="active">Pesanan</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <?php if(isset($_GET['hl']) && $_GET['hl'] == 'detail'){ ?>
                <?php 

                    $query6 = " SELECT * FROM transaksi 
                                INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan 
                                LEFT JOIN bayar ON transaksi.id_bayar = bayar.id_bayar
                                WHERE transaksi.id_transaksi = '$_GET[id]' "; 
                    $exc_query6 = mysqli_query($con,$query6);
                    $value6 = mysqli_fetch_array($exc_query6);

                    $query7 = " SELECT * FROM transaksi
                                INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi 
                                INNER JOIN lapangan ON transaksi_detail.id_lapangan = lapangan.id_lapangan
                                INNER JOIN hari ON transaksi_detail.id_hari = hari.id_hari
                                INNER JOIN waktu ON transaksi_detail.id_waktu = waktu.id_waktu
                                INNER JOIN jenis_lapangan ON jenis_lapangan.id_jenis_lapangan = lapangan.id_jenis_lapangan
                                WHERE transaksi.id_transaksi = '$_GET[id]' "; 
                    $exc_query7 = mysqli_query($con,$query7);

                ?>

                <h3 class="box-title">Detail Pesanan</h3> <a href='?p=pesanan' class="btn btn-primary pull-right">Kembali</a>
                <h5>No. Transaksi : <?php echo $_GET['id']; ?></h5>
                <h5>Status : <?php echo $value6['status']; ?></h5>
                <br>
                <h6>Data Pemesan</h6>
                <table class="table table-bordered text-nowrap" width="90%">
                    <tr>
                        <td width="150">Nama</td>
                        <td width="400"><?php echo $value6['nama_pelanggan']; ?></td>
                        <td rowspan="6">
                            <table class="table">
                                <tr>
                                    <td>
                                        <?php if($value6['status'] == 'SELESAI'){ ?>
                                            <button class="btn btn-warning btn-block" disabled="">Sudah Verifikasi</button>
                                        <?php }else{ ?>
                                            <button class="btn btn-warning btn-block" onclick="verifikasi('<?php echo$value6['id_transaksi']; ?>')" <?php if(empty($value6['file'])){echo "disabled";} ?>>Verifikasi Bayar</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <?php 
                                            if(!empty($value6['file']))
                                            { 
                                                echo '<a href="../images/'.$value6['file'].'" download="'.$value6['file'].'" title="Klik untuk download">';
                                                echo '<img src="../images/'.$value6['file'].'" class="img-thumbnail">';
                                                echo '</a>';
                                            }
                                            else
                                            {
                                                echo '<img src="../images/kosong.png" class="img-thumbnail">';
                                            }
                                        ?>
                                        
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>No. Telepon</td>
                        <td><?php echo $value6['no_telp']; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $value6['email']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" >&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                </table>
                <br>
                <h6>Detail Sewa Pesanan</h6>
                <table class="table table-bordered text-nowrap">
                    <tr>
                        <th width="20">No.</th>                                                         
                        <th>Jenis Lapangan</th>                                                         
                        <th>Tanggal</th>                                                            
                        <th>Hari</th>                                                           
                        <th>Waktu</th>                                                          
                        <th>Lapangan</th>                                                           
                        <th>Harga</th>                                                          
                    </tr>
                    <?php 
                        $no =1;
                        if(mysqli_num_rows($exc_query7) > 0)
                        {   
                            $total = 0;
                            while ( $value7 = mysqli_fetch_assoc($exc_query7))
                            { 
                                $tanggal = date('d/m/Y',strtotime($value7['tanggal']));
                                echo "<tr>";
                                echo "<td>".$no++.".</td>";
                                echo "<td>".$value7['nama_jenis_lapangan']."</td>";
                                echo "<td>".$tanggal."</td>";
                                echo "<td>".$value7['nama_hari']."</td>";
                                echo "<td>".$value7['waktu']."</td>";
                                echo "<td>".$value7['nama_lapangan']."</td>";
                                echo "<td align='right'>Rp.".number_format($value7['harga'],0,",",".").",-</td>";
                                echo "</tr>";

                                $total += $value7['harga'];
                            }
                            echo "<tr>";
                            echo "<td colspan='6' align='right'><b>TOTAL PEMBAYARAN</b></td>";
                            echo "<td align='right'><b>Rp.".number_format($total,0,",",".").",-</b></td>";
                            echo "</tr>";
                        }
                        else
                        {
                            echo "<tr>";
                                echo "<td colspan='7' align='center'>Pesanan masih kosong.</td>";
                            echo "</tr>";
                        }
                        
                    ?>
                </table>
                <script type="text/javascript">
                    function verifikasi(id_transaksi){

                        $.confirm({
                            title: 'Confirm!',
                            icon: 'fa fa-question',
                            content: 'Yakin verifikasi bayar',
                            type: 'green',
                            typeAnimated: true,
                            buttons: {
                                Ya: function () {
                                    $.ajax({
                                        url : 'proses.php?action=verifikasi-bayar&id='+id_transaksi,
                                        success : function(response){
                                            $.confirm({
                                                title: 'Sukses!',
                                                icon: 'fa fa-check',
                                                content: 'Terverifikasi.',
                                                buttons: {
                                                    OK: function(){
                                                        location.reload();
                                                    }
                                                }
                                            });
                                        },
                                        error : function(e){
                                            $.alert('Error! '+e);
                                        }
                                    });
                                    
                                },
                                Tidak: function () {
                                }
                            }
                        }); 
                    }
                </script>

            <?php }else{ ?>

                <h3 class="box-title">Data Pesanan</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Transaksi</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>No. Telepon</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query1 = " SELECT * FROM transaksi 
                                            INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
                                            ORDER BY transaksi.tgl_transaksi DESC";
                                $exc_query1 = mysqli_query($con,$query1);
                                $no = 1;
                                while ( $value1 = mysqli_fetch_array($exc_query1)) 
                                {
                                    echo "<tr>";
                                    echo "<td>".$no++.".</td>";
                                    echo "<td>".$value1['id_transaksi']."</td>";
                                    echo "<td>".date('d/m/Y',strtotime($value1['tgl_transaksi']))."</td>";
                                    echo "<td>".$value1['nama_pelanggan']."</td>";
                                    echo "<td>".$value1['no_telp']."</td>";
                                    echo "<td>".$value1['status']."</td>";
                                    echo "<td><a href='?p=pesanan&hl=detail&id=$value1[id_transaksi]' class='btn btn-sm btn-primary' title='Detail'><i class='fa fa-file-archive-o'></i></a></td>";
                                    echo "</tr>";

                                }
                            ?>
                        </tbody>
                    </table>
                </div>

            <?php } ?>
            
        </div>
    </div>
</div>
