<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<?php 

						$query6 = "	SELECT * FROM transaksi 
									INNER JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan 
									WHERE transaksi.id_transaksi = '$_GET[id]' ";
						$exc_query6 = mysqli_query($con,$query6);
						$value6 = mysqli_fetch_array($exc_query6);

						$query7 = "	SELECT * FROM transaksi
								   	INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi 
								   	INNER JOIN lapangan ON transaksi_detail.id_lapangan = lapangan.id_lapangan
								   	INNER JOIN hari ON transaksi_detail.id_hari = hari.id_hari
								   	INNER JOIN waktu ON transaksi_detail.id_waktu = waktu.id_waktu
								   	INNER JOIN jenis_lapangan ON jenis_lapangan.id_jenis_lapangan = lapangan.id_jenis_lapangan
								   	WHERE transaksi.id_transaksi = '$_GET[id]' "; 
						$exc_query7 = mysqli_query($con,$query7);

						$query8 = "SELECT * FROM bank";
						$exc_query8 = mysqli_query($con,$query8);

					?>
					<form>
						<div class="row">
							<div class="col-1"></div>
							<div class="col-10">
								<h3>Pembayaran </h3>
								<br>
								<h6>No. Transaksi : <?php echo $_GET['id'] ?></h6>
								<div class="row">
									<div class="col-12">
										<p>Silahkan melakukan pembayaran melalui transfer ke No. Rekening berikut:</p>
										<ul>
											<?php 
												while ( $value8 = mysqli_fetch_array($exc_query8)) {
													echo "<li>".$value8['nama_bank']." &nbsp;&nbsp;".$value8['no_rekening']." &nbsp;&nbsp;".$value8['nama_rekening']."</li>";
												}
											?>
										</ul>
										<p>*) Setelah melakukan pembayaran silahkan <a href="?p=akun&hl=konfirmasi-pembayaran&id=<?php echo $_GET['id']; ?>">upload bukti pembayaran</a>.</p>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<BR>
										<h6>Data Pemesan</h6>
										<table class="table table-bordered text-nowrap">
											<tr>
												<td width="150">Nama</td>
												<td><?php echo $value6['nama_pelanggan']; ?></td>
											</tr>
											<tr>
												<td>No. Telepon</td>
												<td><?php echo $value6['no_telp']; ?></td>
											</tr>
											<tr>
												<td>Email</td>
												<td><?php echo $value6['email']; ?></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
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
									</div>
								</div>
								<div class="row">
									<div class="col-12 text-right">
										<!-- <button type="button"  class="btn-iso button" id="catak">Cetak</button> -->
									</div>
								</div>
							</div>
							<div class="col-1"></div>
						</div>
						<br><br>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function(){
		var back = "<?php if(isset($_GET['back'])){echo $_GET['back'];}?>"; console.log(back);
		$("#form-login").submit(function(e){
			e.preventDefault();

			$.ajax({
				url : "proses.php?action=cek-login",
				type : "POST",
				data : new FormData(this),
	            processData : false, 
	            contentType : false, 
				beforeSend : function(){
					$("#btn-login").html("Loading ...");
				},
				success : function(response){
					res = JSON.parse(response);
					if(res.message == 'success'){
						if(back != ''){
							window.location = "?p="+back;
						}else{
							window.location = "?p=akun&hl=profil";
						}
					}else if(res.message == 'failed' && res.result == 'email not found'){
						$("#alert-error").show();
						$("#alert-error").html('Email belum terdaftar.');
					}else{
						$("#alert-error").show();
						$("#alert-error").html('Email atau password salah.');
					}
					$("#btn-login").html("Login");
				},
				error : function(e){
					$("#btn-login").html("Login");
					alert("error "+e);
				}
			});
		});
	});

	$("#bayar").click(function(){
		$.ajax({
			url : "proses.php?action=simpan-transaksi",
			beforeSend : function(){
				$("#bayar").html("Proses ...");
			},
			success : function(response){
				res = JSON.parse(response);
				if(res.message == 'success'){
					
				}else{
					$("#alert-error").show();
					$("#alert-error").html('Email atau password salah.');
				}
				$("#bayar").html("Bayar");
			},
			error : function(e){
				$("#bayar").html("Bayar");
				alert("error "+e);
			}
		});
	});

</script>

