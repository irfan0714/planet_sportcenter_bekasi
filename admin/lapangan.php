<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title" Lapangan</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="?p=dashboard">Master</a></li>
            <li class="active" Lapangan</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <?php if(isset($_GET['hl']) && $_GET['hl'] == 'add'){ ?>

                <h3 class="box-title">Add Lapangan</h3>
                <form id="myform">
                    <div class="form-group ">
                        <label>Pilih Jenis Lapangan</label>
                        <select name="jenis_lapangan" class="form-control input-sm" style="width: 30%;" required="">
                            <option value="">Pilih</option>
                            <?php 
                                $query3 = "SELECT * FROM jenis_lapangan";
                                $exc_query3 = mysqli_query($con,$query3);
                                while ( $value3 = mysqli_fetch_array($exc_query3)) {
                                    echo "<option value='".$value3['id_jenis_lapangan']."'>".$value3['nama_jenis_lapangan']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label>Nama Lapangan</label>
                        <input type="text" class="form-control input-sm " name="nama_lapangan" style="width: 30%;" required="">
                    </div>

                    <div class="form-group">
                        <a href="?p=lapangan" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-success" id="btn-simpan">Simpan</button>
                </form>
                <script type="text/javascript">

                    $(document).ready(function(){
                        $("#myform").submit(function(e){
                            e.preventDefault();

                            $.ajax({
                                url : "proses.php?action=simpan-lapangan",
                                type : "POST",
                                data : new FormData(this),
                                processData : false, 
                                contentType : false, 
                                beforeSend : function(){
                                    $("#btn-simpan").html("Proses ...");
                                },
                                success : function(response){
                                    res = JSON.parse(response);
                                    if(res.message == 'success'){
                                        $.confirm({
                                            title: 'Sukses!',
                                            icon: 'fa fa-check',
                                            content: 'Tersimpan. ',
                                            buttons: {
                                                OK: function(){
                                                    window.location = "?p=lapangan";
                                                }
                                            }
                                        });
                                    }
                                    $("#btn-simpan").html("Simpan");
                                },
                                error : function(e){
                                    $("#btn-simpan").html("Simpan");
                                    $.alert('Error! '+e);
                                }
                            });
                        });
                    });

                </script>

            <?php }else if(isset($_GET['hl']) && $_GET['hl'] == 'edit'){ ?>

                <?php 
                    $query2 = "SELECT * FROM lapangan WHERE id_lapangan = '$_GET[id]' ";
                    $exc_query2 = mysqli_query($con,$query2);
                    $value2 = mysqli_fetch_array($exc_query2);
                ?>
                <h3 class="box-title">Edit Jenis Lapangan</h3>
                <form id="myform">
                    <input type="hidden" class="form-control input-sm " name="id_lapangan" value="<?php echo $value2['id_lapangan']; ?>" style="width: 30%;" required="">
                    <div class="form-group ">
                        <label>Pilih Jenis Lapangan</label>
                        <select name="jenis_lapangan" class="form-control input-sm" style="width: 30%;" required="">
                            <option value="">Pilih</option>
                            <?php 
                                $query4 = "SELECT * FROM jenis_lapangan";
                                $exc_query4 = mysqli_query($con,$query4);
                                while ( $value4 = mysqli_fetch_array($exc_query4)) {
                                    $selected = ($value4['id_jenis_lapangan'] == $value2['id_jenis_lapangan'] ) ? "selected" : "";
                                    echo "<option value='".$value4['id_jenis_lapangan']."' ".$selected.">".$value4['nama_jenis_lapangan']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label>Nama Lapangan</label>
                        <input type="text" class="form-control input-sm " name="nama_lapangan" value="<?php echo $value2['nama_lapangan']; ?>" style="width: 30%;" required="">
                    </div>

                    <div class="form-group">
                        <a href="?p=lapangan" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-success" id="btn-simpan">Simpan</button>
                </form>
                <script type="text/javascript">

                    $(document).ready(function(){
                        $("#myform").submit(function(e){
                            e.preventDefault();

                            $.ajax({
                                url : "proses.php?action=update-lapangan",
                                type : "POST",
                                data : new FormData(this),
                                processData : false, 
                                contentType : false, 
                                beforeSend : function(){
                                    $("#btn-simpan").html("Proses ...");
                                },
                                success : function(response){
                                    res = JSON.parse(response);
                                    if(res.message == 'success'){
                                        $.confirm({
                                            title: 'Sukses!',
                                            icon: 'fa fa-check',
                                            content: 'Tersimpan. ',
                                            buttons: {
                                                OK: function(){
                                                    // window.location = "?p=lapangan";
                                                }
                                            }
                                        });
                                    }
                                    $("#btn-simpan").html("Simpan");
                                },
                                error : function(e){
                                    $("#btn-simpan").html("Simpan");
                                    $.alert('Error! '+e);
                                }
                            });
                        });
                    });

                </script>

            <?php }else{ ?>

                <h3 class="box-title">Data Lapangan</h3>
                <a href="?p=lapangan&hl=add" class="btn btn-primary">Add</a>
                <table class="table" >
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Lapangan</th>
                            <th>Jenis Lapangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query1 = " SELECT * FROM lapangan INNER JOIN jenis_lapangan ON lapangan.id_jenis_lapangan = jenis_lapangan.id_jenis_lapangan ORDER BY jenis_lapangan.nama_jenis_lapangan";
                            $exc_query1 = mysqli_query($con,$query1);
                            $no = 1;
                            while ( $value1 = mysqli_fetch_array($exc_query1)) 
                            {
                                echo "<tr>";
                                echo "<td>".$no++.".</td>";
                                echo "<td>".$value1['nama_lapangan']."</td>";
                                echo "<td>".$value1['nama_jenis_lapangan']."</td>";
                                echo "<td>
                                        <a href='?p=lapangan&hl=edit&id=".$value1['id_lapangan']."' class='btn btn-sm btn-primary' title='Edit'><i class='fa fa-edit'></i></a>
                                        <button class='btn btn-sm btn-danger' title='Hapus' onclick='hapus(\"$value1[id_lapangan]\",\"$value1[nama_lapangan]\")'><i class='fa fa-trash-o'></i></button>
                                        </td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>

            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    function hapus(id,nama){

        $.confirm({
            title: 'Confirm!',
            icon: 'fa fa-question',
            content: 'Yakin Hapus '+nama+'?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                Ya: function () {
                    $.ajax({
                        url : 'proses.php?action=hapus-lapangan&id='+id,
                        success : function(response){
                            var res = JSON.parse(response);
                            if(res.message == 'success'){
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
                            }else{
                                $.confirm({
                                    title: 'Warning!',
                                    icon: 'fa fa-times',
                                    content: 'Data tidak boleh di hapus, karena sudah ada transaksi.',
                                    buttons: {
                                        OK: function(){
                                            // location.reload();
                                        }
                                    }
                                });
                            }
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
