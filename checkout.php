<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<?php 
						if(empty($_SESSION)){
							echo "<script>";
							echo "	$.confirm({
						        		title: 'Warning!',
									    icon: 'fa fa-times',
									    content: 'Silahkan lakukan login terlebih dahulu.',
									    buttons: {
									    	OK: function(){
									            window.location = '?p=login&back=checkout';
									    	}
									    }
						        	});
						         ";
							echo "</script>";
							die();
						}

						$query6 = "SELECT * FROM pelanggan WHERE id_pelanggan = '$_SESSION[id]' ";
						$exc_query6 = mysqli_query($con,$query6);
						$value6 = mysqli_fetch_array($exc_query6);

						$id_session = session_id();
						$query7 = "SELECT * FROM keranjang 
								   INNER JOIN harga ON keranjang.id_harga = harga.id_harga 
								   INNER JOIN lapangan ON harga.id_lapangan = lapangan.id_lapangan
								   INNER JOIN hari ON harga.id_hari = hari.id_hari
								   INNER JOIN waktu ON harga.id_waktu = waktu.id_waktu
								   INNER JOIN jenis_lapangan ON jenis_lapangan.id_jenis_lapangan = lapangan.id_jenis_lapangan
								   WHERE keranjang.id_session = '$id_session' ";
						$exc_query7 = mysqli_query($con,$query7);
					?>
					<form>
						<div class="row">
							<div class="col-1"></div>
							<div class="col-10">
								<h3>Checkout </h3>
								<br>
								<div class="row">
									<div class="col-12">
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
													while ( $value7 = mysqli_fetch_array($exc_query7))
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
												    echo "<td colspan='6' align='right'>TOTAL</td>";
												    echo "<td align='right'>Rp.".number_format($total,0,",",".").",-</td>";
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
										<button type="button"  class="btn-iso button" id="bayar">Bayar</button>
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

		$("#bayar").click(function(){
			$.ajax({
				url : "proses.php?action=simpan-transaksi",
				beforeSend : function(){
					$("#bayar").html("Proses ...");
				},
				success : function(response){
					res = JSON.parse(response);
					if(res.message == 'success'){
						window.location = "?p=billing&id="+res.result;
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
	});

</script>

