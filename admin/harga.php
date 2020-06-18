<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Harga</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li>Master</li>
            <li class="active">Harga</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Setting Harga</h3>
                <?php 
                    error_reporting(0);

                    $jenis_lapangan = "";
                    if(isset($_POST['jenis_lapangan']))
                    {
                        $jenis_lapangan = $_POST['jenis_lapangan'];
                    }

                    $hari = "";
                    if(isset($_POST['hari']))
                    {
                        $hari = $_POST['hari'];
                    }

                    $query1 = "SELECT * FROM waktu ORDER BY id_waktu ASC";
                    $exc_query1 = mysqli_query($con,$query1);
                    $waktu = array();
                    while ($value1 =mysqli_fetch_array($exc_query1)) 
                    {
                        $waktu['id_waktu'][] = $value1['id_waktu'];
                        $waktu['waktu'][$value1['id_waktu']] = $value1['waktu'];
                    }

                    $query2 = "SELECT * FROM lapangan WHERE id_jenis_lapangan = '$jenis_lapangan' ";
                    $exc_query2 = mysqli_query($con,$query2);
                    $lapangan = array();
                    while ($value2 =mysqli_fetch_array($exc_query2)) 
                    {
                        $lapangan['id_lapangan'][] = $value2['id_lapangan'];
                        $lapangan['nama_lapangan'][$value2['id_lapangan']] = $value2['nama_lapangan'];
                    }

                    $query5 = "SELECT * FROM harga WHERE id_hari = '$hari' "; 
                    $exc_query5 = mysqli_query($con,$query5);
                    $harga = array();
                    while ($value5 =mysqli_fetch_array($exc_query5)) 
                    {
                        $harga['id_harga'][$value5['id_waktu']][$value5['id_lapangan']] = $value5['id_harga'];
                        $harga['harga'][$value5['id_waktu']][$value5['id_lapangan']] = $value5['harga'];
                    }

                    $query6 = "SELECT * FROM hari WHERE id_hari = '$hari' ";
                    $exc_query6 = mysqli_query($con,$query6);
                    $value6 =mysqli_fetch_array($exc_query6);
                    $nama_hari = $value6['nama_hari'];

                    $query7 = "SELECT * FROM jenis_lapangan WHERE id_jenis_lapangan = '$jenis_lapangan' ";
                    $exc_query7 = mysqli_query($con,$query7);
                    $value7 =mysqli_fetch_array($exc_query7);
                    $nama_jenis_lapangan = $value7['nama_jenis_lapangan']; 

                    // dump($harga);
                        
                ?>
                <form method="POST" action="?p=harga">
                <table style="width: 70%;">
                    <tr>
                        <td>
                            <select name="jenis_lapangan" class="form-control input-sm"  required="">
                                <option value="">Pilih Jenis Lapangan</option>
                                <?php 
                                    $query3 = "SELECT * FROM jenis_lapangan";
                                    $exc_query3 = mysqli_query($con,$query3);
                                    while ( $value3 = mysqli_fetch_array($exc_query3)) {
                                        $selected = ($value3['id_jenis_lapangan'] == $jenis_lapangan ) ? "selected" : "";
                                        echo "<option value='".$value3['id_jenis_lapangan']."' ".$selected.">".$value3['nama_jenis_lapangan']."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>&nbsp;</td>
                        <td>
                            <select name="hari" class="form-control input-sm"  required="">
                                <option value="">Pilih Hari</option>
                                <?php 
                                    $query4 = "SELECT * FROM hari";
                                    $exc_query4 = mysqli_query($con,$query4);
                                    while ( $value4 = mysqli_fetch_array($exc_query4)) {
                                        $selected = ($value4['id_hari'] == $hari ) ? "selected" : "";
                                        echo "<option value='".$value4['id_hari']."' ".$selected.">".$value4['nama_hari']."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>&nbsp;&nbsp;</td>
                        <td><button type="submit" class="btn btn-sm btn-primary">Tampilkan</button></td>
                    </tr>
                </table>
                </form>

                <br>
            <?php if(isset($_POST['jenis_lapangan']) && isset($_POST['jenis_lapangan']) ){ ?>

                <h5>Jenis Lapangan : <?php echo $nama_jenis_lapangan; ?></h5>
                <h5>Hari : <?php echo $nama_hari; ?></h5>
                <div style="overflow-x:auto;">
                    <table class="table table-bordered text-nowrap">
                        <tr>
                            <th align="center">Waktu</th>
                            <?php 
                            for ($i=0; $i < count($lapangan['id_lapangan']); $i++ ) {
                                echo "<th>".$lapangan['nama_lapangan'][$lapangan['id_lapangan'][$i]]."</th>";
                                echo "<th style='border-right:2px solid #007bff;'>Harga</th>";
                            } 
                            ?>
                        </tr>
                        <?php 
                        for ($ii=0; $ii < count($waktu['id_waktu']); $ii++ ) {
                            $print_waktu = $waktu['waktu'][$waktu['id_waktu'][$ii]];
                            $id_waktu = $waktu['id_waktu'][$ii];
                            echo "<tr>";
                            echo "<td>".$print_waktu."</td>";
                            for ($iii=0; $iii < count($lapangan['id_lapangan']); $iii++ ) {
                                $id_harga = $harga['id_harga'][$waktu['id_waktu'][$ii]][$lapangan['id_lapangan'][$iii]];
                                $nama_lapangan = $lapangan['nama_lapangan'][$lapangan['id_lapangan'][$iii]];
                                $v_harga = $harga['harga'][$waktu['id_waktu'][$ii]][$lapangan['id_lapangan'][$iii]];
                                $id_lapangan = $lapangan['id_lapangan'][$iii];

                                $print_harga = "-";
                                if(!empty($v_harga) || $v_harga != 0)
                                {
                                    $print_harga = "Rp.".number_format($v_harga,0,',','.').",-";
                                }

                                $setting = "onclick = \"setting('$nama_lapangan','$print_waktu','$v_harga','$id_lapangan','$id_waktu','$hari')\" ";
                                echo "<td align='center'><a href='javascript:void(0)' ".$setting.">SETTING</a></td>";
                                echo "<td align='right' style='border-right:2px solid #007bff;'>".$print_harga."</td>";
                            } 
                            echo "</tr>";
                        }

                        ?>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    function setting(nama_lapangan,waktu,harga,id_lapangan,id_waktu,id_hari){
        $.confirm({
            title: 'Setting Harga?',
            icon: 'fa fa-gear',
            content: '' +
            '<form action="" class="formName">' +
            '<div class="form-group">' +
            '<p>'+nama_lapangan+'</p>' +
            '<p>'+waktu+'</p>' +
            '<input type="hidden" id="lapangan" value="'+id_lapangan+'" />' +
            '<input type="hidden" id="waktu" value="'+id_waktu+'" />' +
            '<input type="hidden" id="hari" value="'+id_hari+'" />' +
            '<input type="text" placeholder="masukan harga ..." id="harga" class="name form-control text-right" value="'+harga+'" required />' +
            '</div>' +
            '</form>',
            buttons: {
                formSubmit: {
                    text: 'Simpan',
                    btnClass: 'btn-blue',
                    action: function () {
                        var lapangan = this.$content.find('#lapangan').val();
                        var waktu = this.$content.find('#waktu').val();
                        var hari = this.$content.find('#hari').val();
                        var harga = this.$content.find('#harga').val();
                        console.log(lapangan+" "+waktu+" "+hari+" "+harga);
                        $.ajax({
                            url : 'proses.php?action=simpan-harga',
                            type : 'POST',
                            data : {lapangan : lapangan, waktu : waktu, hari : hari, harga : harga },
                            success : function(response){
                                $.confirm({
                                    title: 'Sukses!',
                                    icon: 'fa fa-check',
                                    content: 'Tersimpan',
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
                    }
                },
                Batal: function () {
                    //close
                },
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    }
</script>
