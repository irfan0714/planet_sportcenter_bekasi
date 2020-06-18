<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<h6><?php echo $_SESSION['nama']; ?></h6>
					<br>
					<?php 
						if(empty($_SESSION)){
							echo "<script>";
							echo "window.location = '?p=beranda';";
							echo "</script>";
							die();
						}

						$query6 = "SELECT * FROM pelanggan WHERE id_pelanggan = '$_SESSION[id]' ";
						$exc_query6 = mysqli_query($con,$query6);
						$value6 = mysqli_fetch_array($exc_query6);
					?>
					<div class="row">
						<div class="col-3" style="border-right: 1px solid #f6b30040;">
							<ul>
								<li <?php if($_GET['hl'] == 'profil'){echo 'class="underline"';} ?> ><a href="?p=akun&hl=profil">Profil</a></li>
								<li <?php if($_GET['hl'] == 'pesanan'){echo 'class="underline"';} ?> ><a href="?p=akun&hl=pesanan">Pesanan</a></li>
								<li <?php if($_GET['hl'] == 'konfirmasi-pembayaran'){echo 'class="underline"';} ?> ><a href="?p=akun&hl=konfirmasi-pembayaran">Konfirmasi Bayar</a></li>
								<li><a href="?p=booking&jns=1">Pesan Lapangan</a></li>
								<li onclick="logout()" style="cursor:pointer;">Logout</li>
							</ul>
						</div>
						<div class="col-9">
							<?php if($_GET['hl'] == 'profil'){ ?>
								<div class="row">
									<div class="col-3"></div>
									<div class="col-6">
										<h6>Profil</h6>
										<form id="form-profil">
											<input type="hidden" name="id_pelanggan" value="<?php echo $value6['id_pelanggan']; ?>">
											<div class="form-group">
												<label>Nama</label>
												<input type="text" name="nama_pelanggan" value="<?php echo $value6['nama_pelanggan']; ?>" class="form-control">
											</div>
											<div class="form-group">
												<label>No.Telepon</label>
												<input type="text" name="no_telp" value="<?php echo $value6['no_telp']; ?>" maxlength="13" class="form-control" onKeyPress="return angkadanhuruf(event,'1234567890',this)">
											</div>
											<div class="form-group">
												<label>Email</label>
												<input type="email" name="email" value="<?php echo $value6['email']; ?>" class="form-control">
											</div>
											<div class="form-group">
												<label>Password</label>
												<input type="password" name="password" value="<?php echo $value6['password']; ?>" class="form-control">
											</div>

											<div class="form-group text-center">
												<button type="submit" class="btn-iso button" id="btn-simpan">Simpan</button>
											</div>
										</form>
									</div>
									<div class="col-3"></div>
								</div>
								<script type="text/javascript">
									$(document).ready(function(){

										$("#form-profil").submit(function(e){
											e.preventDefault();

											$.ajax({
												url : "proses.php?action=simpan-profil",
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
														    content: 'Tersimpan.',
														    buttons: {
														    	OK: function(){
														           
														    	}
														    }
											        	});
													}else{
														$.alert('Error! '+e);
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

							<?php }else if($_GET['hl'] == 'pesanan'){ ?>

								<h6>Pesanan</h6>
								<div style="overflow-x:auto;">
									<table class="table table-bordered text-nowrap">
										<tr>
											<th width="20">No.</th>															
											<th>No. Pesanan</th>															
											<th>Tanggal</th>															
											<th>Hari</th>															
											<th>Waktu</th>															
											<th>Lapangan</th>															
											<th>Status</th>															
											<th>Harga</th>															
											<th>Action</th>															
										</tr>
									<?php 
										$query7 = "	SELECT * FROM transaksi 
													INNER JOIN transaksi_detail ON transaksi.id_transaksi = transaksi_detail.id_transaksi 
													INNER JOIN lapangan ON transaksi_detail.id_lapangan = lapangan.id_lapangan
													INNER JOIN waktu ON transaksi_detail.id_waktu = waktu.id_waktu 
													INNER JOIN hari ON transaksi_detail.id_hari = hari.id_hari 
													WHERE transaksi.id_pelanggan = '$_SESSION[id]' "; 
										$exc_query7 = mysqli_query($con,$query7);
										$no =1;

										$total =0;
										$rowspan = 0;
										$id_trans = '';
										while ( $value7 = mysqli_fetch_array($exc_query7)) {

											if($id_trans != '' && $id_trans != $value7['id_transaksi'])
											{
												echo "<tr>";
												echo "<td colspan='7' align='right'>TOTAL</td>";
												echo "<td>".number_format($total,0,",",".")."</td>";
												echo "</tr>";
												$total =0;
											}

											echo "<tr>";
											echo "<td>".$no++.".</td>";
											echo "<td>".$value7['id_transaksi']."</td>";
											echo "<td>".date('d/m/Y',strtotime($value7['tanggal']))."</td>";
											echo "<td>".$value7['nama_hari']."</td>";
											echo "<td>".$value7['waktu']."</td>";
											echo "<td>".$value7['nama_lapangan']."</td>";
											echo "<td>".$value7['status']."</td>";
											echo "<td align='right'>".number_format($value7['harga'],0,",",".")."</td>";
											if ($id_trans != $value7['id_transaksi']) {
												echo "<td align='center' ><a href='javascript:void();' onclick='batal(\"".$value7['id_transaksi']."\")'>BATAL </a></td>";

											}
											echo "</tr>";

											$id_trans = $value7['id_transaksi'];
											$total += $value7['harga'];
										}

										echo "<tr>";
										echo "<td colspan='7' align='right'>TOTAL</td>";
										echo "<td>".number_format($total,0,",",".")."</td>";
										echo "</tr>";

									?>
									</table>
								</div>
								<script type="text/javascript">
									function batal(id_transaksi){
										text = "Batal: <br>No. Transaksi : "+id_transaksi+" <br>";
										$.confirm({
										    title: 'Confirm!',
										    icon: 'fa fa-question',
										    content: text,
										    type: 'red',
										    typeAnimated: true,
										    buttons: {
										        Ya: function () {
										        	$.ajax({
										        		url : 'proses.php?action=batal-transaksi&id='+id_transaksi,
										        		success : function(response){
												            location.reload();
										        		},
										        		error : function(e){
										        			$.alert('Error! '+e);
										        		}
										        	});
										        },
										        Tidak: function () {
										            // $.alert('Tidak!');
										        }
										    }
										});	
									}
								</script>
								

							<?php }else if($_GET['hl'] == 'konfirmasi-pembayaran'){ ?>

								<div class="row">
									<div class="col-3"></div>
									<div class="col-6">
										<h6>Konfirmasi Pembayaran</h6>
										<form id="form-konfirmasi-bayar">
											<div class="form-group">
												<label>No. Transaksi</label>
												<input type="text" name="no_transaksi" class="form-control" value="<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>" required="">
											</div>
											<div class="form-group">
												<label>Nama Bank</label>
												<input type="text" name="bank" class="form-control" required="">
											</div>
											<div class="form-group">
												<label>No. Rekening</label>
												<input type="text" name="no_rekening" class="form-control"  onKeyPress="return angkadanhuruf(event,'1234567890',this)" required="">
											</div>
											<div class="form-group">
												<label>Jumlah Transfer</label>
												<input type="text" name="jumlah_transfer" class="form-control"  onKeyPress="return angkadanhuruf(event,'1234567890',this)" required="">
											</div>
											<div class="form-group">
												<label>Upload</label>
												<input type="file" name="file" value="<?php echo $value6['password']; ?>" class="form-control" required="">
											</div>

											<div class="form-group text-center">
												<button class="btn-iso button" id=";bn-simpan">Kirim</button>
											</div>
										</form>
									</div>
									<div class="col-3"></div>
								</div>
								<script type="text/javascript">
									$(document).ready(function(){

										$("#form-konfirmasi-bayar").submit(function(e){
											e.preventDefault();

											$.ajax({
												url : "proses.php?action=simpan-konfirmasi-bayar",
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
														    content: 'Terkirim.',
														    buttons: {
														    	OK: function(){
														           
														    	}
														    }
											        	});
													}else{
														$.alert('Error! '+e);
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



							<?php } ?>

							
							
						</div>
					</div>
					<br><br>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

		function logout(){
			$.ajax({
				url : 'proses.php?action=logout',
				success : function(){
					window.location = '?p=beranda';
				},
				error : function(){
					$.alert('Error! '+e);
				}
			});
		}

		function angkadanhuruf(e, goods, field)
		{
			var angka, karakterangka;
			angka = getkey(e);
			if (angka == null) return true;
			 
			karakterangka = String.fromCharCode(angka);
			karakterangka = karakterangka.toLowerCase();
			goods = goods.toLowerCase();
			 
			if (goods.indexOf(karakterangka) != -1)
			    return true;
			if ( angka==null || angka==0 || angka==8 || angka==9 || angka==27 )
			   return true;
			    
			if (angka == 13) {
			    var i;
			    for (i = 0; i < field.form.elements.length; i++)
			        if (field == field.form.elements[i])
			            break;
			    i = (i + 1) % field.form.elements.length;
			    field.form.elements[i].focus();
			    return false;
			    };
			return false;
		}

		function getkey(e)
		{
			if (window.event)
			   return window.event.keyCode;
			else if (e)
			   return e.which;
			else
			   return null;
		}

</script>
