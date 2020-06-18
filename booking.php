<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<?php 
						error_reporting(0);

						if(isset($_GET['tgl']))
						{
							$tanggal = $_GET['tgl'];
						}
						else
						{
							$tanggal = date('d/m/Y');
						}
						$query1 = "SELECT * FROM jenis_lapangan";
						$exc_query1 = mysqli_query($con,$query1);

						$query2 = "SELECT * FROM jenis_lapangan WHERE id_jenis_lapangan = '$_GET[jns]' ";
						$exc_query2 = mysqli_query($con,$query2);
						$value2 = mysqli_fetch_array($exc_query2);

						$query3 = "SELECT * FROM lapangan WHERE id_jenis_lapangan = '$_GET[jns]' ";
						$exc_query3 = mysqli_query($con,$query3);
						$tot_rws3 = mysqli_num_rows($exc_query3);
						$lapangan = array();
						while ($value3 =mysqli_fetch_array($exc_query3)) 
						{
							$lapangan['id_lapangan'][] = $value3['id_lapangan'];
							$lapangan['nama_lapangan'][$value3['id_lapangan']] = $value3['nama_lapangan'];
						}
						
						$query4 = "SELECT * FROM waktu ORDER BY id_waktu ASC";
						$exc_query4 = mysqli_query($con,$query4);
						$waktu = array();
						while ($value4 =mysqli_fetch_array($exc_query4)) 
						{
							$waktu['id_waktu'][] = $value4['id_waktu'];
							$waktu['waktu'][$value4['id_waktu']] = $value4['waktu'];
						}

						$arr_hari = array('Sunday'=>1,'Monday'=>2,'Tuesday'=>3,'Wednesday'=>4,'Thursday'=>5,'Friday'=>6,'Saturday'=>7);
						$arr_tanggal = explode("/",$tanggal);
						$hari  = date("l", mktime(0,0,0,$arr_tanggal[1],$arr_tanggal[0],$arr_tanggal[2])); 
						$hari_ke = $arr_hari[$hari];
						$query5 = "SELECT * FROM harga WHERE id_hari = '$hari_ke' ";
						$exc_query5 = mysqli_query($con,$query5);
						$harga = array();
						while ($value5 =mysqli_fetch_array($exc_query5)) 
						{
							$harga['id_harga'][$value5['id_waktu']][$value5['id_lapangan']] = $value5['id_harga'];
							$harga['harga'][$value5['id_waktu']][$value5['id_lapangan']] = $value5['harga'];
						}

						$query6 = "SELECT * FROM hari WHERE id_hari = '$hari_ke' ";
						$exc_query6 = mysqli_query($con,$query6);
						$value6 =mysqli_fetch_array($exc_query6);
						$nama_hari = $value6['nama_hari']; 

						$id_session = session_id();
						$query7 = "SELECT * FROM keranjang 
								   INNER JOIN harga ON keranjang.id_harga = harga.id_harga 
								   INNER JOIN lapangan ON harga.id_lapangan = lapangan.id_lapangan
								   INNER JOIN hari ON harga.id_hari = hari.id_hari
								   INNER JOIN waktu ON harga.id_waktu = waktu.id_waktu
								   INNER JOIN jenis_lapangan ON jenis_lapangan.id_jenis_lapangan = lapangan.id_jenis_lapangan
								   WHERE keranjang.id_session = '$id_session' ";
						$exc_query7 = mysqli_query($con,$query7);

						$query8 = "DELETE FROM keranjang WHERE tgl_transaksi <> DATE(NOW()) ";
						$exc_query8 = mysqli_query($con,$query8);

				        $arr_tgl = explode("/",$tanggal);
				        $where9  = $arr_tgl[2]."-".$arr_tgl[1]."-".$arr_tgl[0];
						$query9 = "SELECT * FROM keranjang INNER JOIN harga ON keranjang.id_harga = harga.id_harga 
								   WHERE keranjang.tanggal = '$where9' "; 
						$exc_query9 = mysqli_query($con,$query9);						
						$keranjang = array();
						while ($value9 =mysqli_fetch_array($exc_query9)) 
						{
							$keranjang['id_keranjang'][$value9['id_waktu']][$value9['id_lapangan']] = $value9['id_keranjang'];
						}

						$query10 = "SELECT * FROM transaksi INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi
									WHERE transaksi_detail.tanggal = '$where9' AND transaksi.status <> 'BATAL' ";
						$exc_query10 = mysqli_query($con,$query10);		
						$transaksi = array();
						while ($value10 =mysqli_fetch_array($exc_query10)) 
						{
							$transaksi['id_transaksi'][$value10['id_waktu']][$value10['id_lapangan']] = $value10['id_transaksi'];
						}
						// dump($transaksi);

					?>
						
					<form>
						<div class="row">
							<div class="col-1"></div>
							<div class="col-10">
								<div class="row">
									<div class="col-12">
										<div class="post" id="booking">
											<h6>PILIH JENIS LAPANGAN</h6>
											<ul>
												<?php while ($value1 = mysqli_fetch_array($exc_query1)) {
													echo "<li><a href='?p=booking&jns=".$value1['id_jenis_lapangan']."'>".$value1['nama_jenis_lapangan']."</a></li>";
												} ?>
											</ul>
										</div>
									</div>
								</div>
								<div class="row" id="jadwal">
									<div class="col-12">
										<br><br>
										<h3>Jadwal &nbsp;&nbsp; Lapangan </h3>
										<ul>
											<li>Jenis Lapangan : <?php echo $value2['nama_jenis_lapangan'];  ?></li>
											<li>Deskripsi : <?php echo $value2['deskripsi'];  ?></li>
											<li>Tersedia : <?php echo $tot_rws3;  ?> lapangan</li>
										</ul>
										<div class="row">
											<div class="col-4">
												<input type="hidden" name="jenis_lapangan" id="jenis_lapangan" value="<?php echo $_GET['jns']; ?>">
												<div  class="form-group">
													<label>Pilih Tanggal</label>
													<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo $tanggal; ?>"  required="">
												</div>
											</div>
											<div class="col-8">
												<button type="button" class="btn btn-primary" style="margin-top: 27px;" id="tampilkan">Tampilkan</button>
											</div>
										</div>
										<br>
										<h6>Hari : <?php echo $nama_hari.", ".$tanggal; ?></h6>
										<div class="row">
											<div class="col-2">
												<table class="table table-bordered text-nowrap" style="width: 145px;">
													<tr>
														<th align="center">Waktu</th>
													</tr>
													<?php 
													for ($ii=0; $ii < count($waktu['id_waktu']); $ii++ ) {

														$print_waktu = $waktu['waktu'][$waktu['id_waktu'][$ii]];
														echo "<tr>";
														echo "<td>".$print_waktu."</td>";
														echo "</tr>";
													}

													?>
												</table>
											</div>
											<div class="col-10" >
												<div style="overflow-x:auto;">
													<table class="table table-bordered text-nowrap">
														<tr>
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
															echo "<tr>";
															for ($iii=0; $iii < count($lapangan['id_lapangan']); $iii++ ) {
																$id_harga = $harga['id_harga'][$waktu['id_waktu'][$ii]][$lapangan['id_lapangan'][$iii]];
																$nama_lapangan = $lapangan['nama_lapangan'][$lapangan['id_lapangan'][$iii]];
																$v_harga = $harga['harga'][$waktu['id_waktu'][$ii]][$lapangan['id_lapangan'][$iii]];

																$print_harga = "-";
																if(!empty($v_harga) || $v_harga != 0)
																{
																	$print_harga = "Rp.".number_format($v_harga,0,',','.').",-";
																}

																$pesan = "-";
																if(!empty($v_harga) || $v_harga != 0)
																{
																	if(isset($keranjang['id_keranjang'][$waktu['id_waktu'][$ii]][$lapangan['id_lapangan'][$iii]]) || isset($transaksi['id_transaksi'][$waktu['id_waktu'][$ii]][$lapangan['id_lapangan'][$iii]]))
																	{
																		$pesan = "<a href='javascript:void(0)' style='color:#007bff'>SUDAH DIPESAN</a>";
																	}
																	else
																	{
																		$pesan = "<a href='javascript:void(0)' onclick=\"pesan('$id_harga','$print_waktu','$nama_lapangan','$tanggal','$_GET[jns]')\">PESAN</a>";
																	}
																}

																echo "<td align='center'>".$pesan."</td>";
																echo "<td align='right' style='border-right:2px solid #007bff;'>".$print_harga."</td>";
															} 
															echo "</tr>";
														}

														?>
													</table>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								<div class="row" id="detail">
									<div class="col-12">
										<br><br>
										<h6>Detail Sewa Pesanan</h6>
										<div class="row">
											<div class="col-12" >
												<table class="table table-bordered text-nowrap">
													<tr>
														<th width="20">No.</th>															
														<th>Jenis Lapangan</th>															
														<th>Tanggal</th>															
														<th>Hari</th>															
														<th>Waktu</th>															
														<th>Lapangan</th>															
														<th>Harga</th>															
														<th>Action</th>															
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
														    	echo "<td><a href='javascript:void()' onclick=\"hapus('$value7[id_keranjang]','$value7[waktu]','$value7[nama_lapangan]','$tanggal','$value7[nama_jenis_lapangan]')\">HAPUS</a></td>";
														    	echo "</tr>";

														    	$total += $value7['harga'];
														    }
														    echo "<tr>";
														    echo "<td colspan='6' align='right'>TOTAL</td>";
														    echo "<td align='right'>Rp.".number_format($total,0,",",".").",-</td>";
														    echo "<td></td>";
														    echo "</tr>";
														}
														else
														{
															echo "<tr>";
														    	echo "<td colspan='8' align='center'>Pesanan masih kosong.</td>";
														    echo "</tr>";
														}
														
													?>
												</table>
											</div>
										</div>
										
									</div>
								</div>
								<div class="row">
									<div class="col-12 text-right">
									<?php  $link_checkout = (mysqli_num_rows($exc_query7) > 0)  ? "?p=checkout":"javascript:void(0)";?>
									<p class="links"><a href="<?php echo $link_checkout; ?>" class="button">Checkout</a></p>
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
		
		var date = new Date();
		date.setDate(date.getDate());

		$('#tanggal').datepicker({
			format: 'dd/mm/yyyy',
			todayHighlight: true,
			autoclose: true,
			startDate: date
		});

		$("#tampilkan").click(function(){
			jenis_lapangan = $("#jenis_lapangan").val();
			tanggal = $("#tanggal").val();

			window.location = "?p=booking&jns="+jenis_lapangan+"&tgl="+tanggal+"&div=#jadwal";
		});

	});

	function  pesan(id_harga,waktu,lapangan,tanggal,jns){
		text = "Pesan: <br>"+lapangan+" <br> Tanggal: "+tanggal+" <br> Waktu: "+waktu+"";
		$.confirm({
		    title: 'Confirm!',
		    icon: 'fa fa-question',
		    content: text,
		    type: 'green',
		    typeAnimated: true,
		    buttons: {
		        Ya: function () {
		        	$.ajax({
		        		url : 'proses.php?action=tambah-keranjang',
		        		type : 'POST',
		        		data : {id_harga : id_harga, tanggal : tanggal },
		        		success : function(response){
		        			$.confirm({
				        		title: 'Sukses!',
							    icon: 'fa fa-check',
							    content: 'Silahkan lakukan checkout untuk pembayaran (menu atas <i class="fa fa-shopping-bag"><i> )',
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
		            // $.alert('Batal!');
		        }
		    }
		});
	}

	function hapus(id_keranjang,waktu,lapangan,tanggal,jns){
		text = "Hapus: <br>"+lapangan+" <br> Tanggal: "+tanggal+" <br> Waktu: "+waktu+"";
		$.confirm({
		    title: 'Confirm!',
		    icon: 'fa fa-question',
		    content: text,
		    type: 'red',
		    typeAnimated: true,
		    buttons: {
		        Ya: function () {
		        	$.ajax({
		        		url : 'proses.php?action=hapus-keranjang&id='+id_keranjang,
		        		success : function(response){
		        			/*
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
				        	*/
				            location.reload();
		        		},
		        		error : function(e){
		        			$.alert('Error! '+e);
		        		}
		        	});
		        	
		        },
		        Tidak: function () {
		            $.alert('Batal!');
		        }
		    }
		});	
	}
</script>
