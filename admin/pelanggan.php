<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Pelanggan</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="?p=dashboard">Dashboard</a></li>
            <li class="active">Pelanggan</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">DATA PELANGGAN</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>No. Telepon</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query1 = " SELECT * FROM pelanggan";
                        $exc_query1 = mysqli_query($con,$query1);
                        $no = 1;
                        while ( $value1 = mysqli_fetch_array($exc_query1)) 
                        {
                            echo "<tr>";
                            echo "<td>".$no++.".</td>";
                            echo "<td>".$value1['nama_pelanggan']."</td>";
                            echo "<td>".$value1['no_telp']."</td>";
                            echo "<td>".$value1['email']."</td>";
                            echo "<td><button class='btn btn-sm btn-danger' title='Hapus' onclick='hapus(\"$value1[id_pelanggan]\",\"$value1[nama_pelanggan]\")'><i class='fa fa-trash-o'></i></button></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    function hapus(id_pelanggan,nama_pelanggan){

        $.confirm({
            title: 'Confirm!',
            icon: 'fa fa-question',
            content: 'Yakin Hapus '+nama_pelanggan+'?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                Ya: function () {
                    $.ajax({
                        url : 'proses.php?action=hapus-pelanggan&id='+id_pelanggan,
                        success : function(response){
                            $.confirm({
                                title: 'Sukses!',
                                icon: 'fa fa-check',
                                content: 'Terhapus.',
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