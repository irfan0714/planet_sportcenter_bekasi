<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">User</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li>Master</li>
            <li class="active">User</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <?php if(isset($_GET['hl']) && $_GET['hl'] == 'add'){ ?>

                <h3 class="box-title">Add User</h3>
                <form id="myform">
                    <div class="form-group ">
                        <label>Nama</label>
                        <input type="text" class="form-control input-sm " name="nama" style="width: 30%;" required="">
                    </div>
                    <div class="form-group ">
                        <label>Username</label>
                        <input type="text" class="form-control input-sm " name="username" style="width: 30%;" required="">
                    </div>
                    <div class="form-group ">
                        <label>Password</label>
                        <input type="text" class="form-control input-sm " name="password" style="width: 30%;" required="">
                    </div>

                    <div class="form-group">
                        <a href="?p=user" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-success" id="btn-simpan">Simpan</button>
                </form>
                <script type="text/javascript">

                    $(document).ready(function(){
                        $("#myform").submit(function(e){
                            e.preventDefault();

                            $.ajax({
                                url : "proses.php?action=simpan-user",
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
                                                    window.location = "?p=user";
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
                    $query2 = "SELECT * FROM user WHERE id_user = '$_GET[id]' ";
                    $exc_query2 = mysqli_query($con,$query2);
                    $value2 = mysqli_fetch_array($exc_query2);
                ?>
                <h3 class="box-title">Edit Jenis Lapangan</h3>
                <form id="myform">
                    <div class="form-group ">
                        <label>Nama</label>
                        <input type="hidden" class="form-control input-sm " name="id_user" value="<?php echo $value2['id_user']; ?>">
                        <input type="text" class="form-control input-sm " name="nama" value="<?php echo $value2['nama']; ?>" style="width: 30%;" required="">
                    </div>

                    <div class="form-group ">
                        <label>Username</label>
                        <input type="text" class="form-control input-sm " name="username" value="<?php echo $value2['username']; ?>" style="width: 30%;" required="">
                    </div>
                    <div class="form-group ">
                        <label>Password</label>
                        <input type="text" class="form-control input-sm " name="password" value="<?php echo $value2['password']; ?>" style="width: 30%;" required="">
                    </div>
                    <div class="form-group">
                        <a href="?p=user" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-success" id="btn-simpan">Simpan</button>
                </form>
                <script type="text/javascript">

                    $(document).ready(function(){
                        $("#myform").submit(function(e){
                            e.preventDefault();

                            $.ajax({
                                url : "proses.php?action=update-user",
                                type : "POST",
                                data : new FormData(this),
                                processData : false, 
                                contentType : false, 
                                beforeSend : function(){
                                    $("#btn-daftar").html("Proses ...");
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

                <h3 class="box-title">Data User</h3>
                <a href="?p=user&hl=add" class="btn btn-primary">Add</a>
                <table class="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query1 = " SELECT * FROM user";
                            $exc_query1 = mysqli_query($con,$query1);
                            $no = 1;
                            while ( $value1 = mysqli_fetch_array($exc_query1)) 
                            {
                                echo "<tr>";
                                echo "<td>".$no++.".</td>";
                                echo "<td>".$value1['nama']."</td>";
                                echo "<td>".$value1['username']."</td>";
                                echo "<td>
                                        <a href='?p=user&hl=edit&id=".$value1['id_user']."' class='btn btn-sm btn-primary' title='Edit'><i class='fa fa-edit'></i></a>
                                        <button class='btn btn-sm btn-danger' title='Hapus' onclick='hapus(\"$value1[id_user]\",\"$value1[username]\")'><i class='fa fa-trash-o'></i></button>
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
                        url : 'proses.php?action=hapus-user&id='+id,
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
