<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Waktu</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li>Master</li>
            <li class="active">Waktu</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Data Waktu</h3>
            <table class="table table-bordered" style="width: 30%;">
                <thead>
                    <tr>
                        <th width="30">No.</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $query1 = " SELECT * FROM waktu";
                        $exc_query1 = mysqli_query($con,$query1);
                        $no = 1;
                        while ( $value1 = mysqli_fetch_array($exc_query1)) 
                        {
                            echo "<tr>";
                            echo "<td>".$no++.".</td>";
                            echo "<td>".$value1['waktu']."</td>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
