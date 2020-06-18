<div id="banner">
	<a href="#" class="img-style"><img src="images/banner.jpg" width="1000" height="350" alt="" /></a>
	<p class="links" ><a href="#booking" class="button">Cara Pesan</a></p>
</div>
<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post" id="booking">
					<h6>PILIH JENIS LAPANGAN</h6>
						<div class="row">
							<div class="col-1">
							</div>
							<?php 
								$query1 = "SELECT * FROM jenis_lapangan";
								$exc_query1 = mysqli_query($con,$query1);
								while ( $value1 = mysqli_fetch_array($exc_query1)) 
								{
							?>
								<div class="col-5" style="cursor: pointer;">
									<img src="images/sports.png" width="100"> &nbsp;&nbsp;&nbsp;<a href="?p=booking&jns=<?php echo $value1['id_jenis_lapangan']; ?>"><?php echo $value1['nama_jenis_lapangan']; ?></a>
								</div>
							<?php } ?>
							<div class="col-1">
							</div>
						</div>
					</div>
					<div class="post" id="cara-booking">
						<h2 class="title"><a href="#">Cara Pesan Lapangan </a></h2>
						<br>						
						<div class="entry">
							<ul>
								<li>Silahkan klik pada jenis lapangan yang dinginkan</li>
								<li>Setelah diklik, anda akan dialihkan pada halaman yang menampilkan jumlah ketersediaan lapangan pada tempat yang anda pilih</li>
								<li>Klik "Pesan" pada tempat dan waktu yang diinginkan</li>
								<li>Setelah selesai, klik checkout pada detail sewa pesanan anda (terdapat pada bagian bawah atau pada menu atas icon <i class="fa fa-shopping-bag"></i> )</li>
								<li>Silahkan masukan login jika sudah memiliki akun, klik daftar jika sudah memiliki akun</li>
								<li>Lakukan pembayaran melalui transfer bank, setelah itu lakukan konfirmasi pembayaran</li>
								<li>Operator kami akan segera memproses pesanan anda begitu mendapatkan konfirmasi pembayaran</li>
								<li>Lapangan Badminton sudah selesai dipesan.</li>
							</ul>
							<p class="links"><a href="?p=booking&jns=1" class="button">Pesan</a></p>
						</div>
					</div>
					<!-- <div class="post" id="photos">
						<h2 class="title"><a href="#">Photos</a></h2>
						<br>
						<div class="entry">
							      <img src="./images/img04.jpg"  class="img-thumbnail" width="197" style="margin-bottom:20px;margin-right:30px;">
							      <img src="./images/img04.jpg"  class="img-thumbnail" width="197" style="margin-bottom:20px;margin-right:30px;">
							      <img src="./images/img04.jpg"  class="img-thumbnail" width="197" style="margin-bottom:20px;margin-right:30px;">
							      <img src="./images/img04.jpg"  class="img-thumbnail" width="196" style="margin-bottom:20px;margin-right:30px;">
						</div>
					</div> -->
					<div class="post" id="about">
						<h2 class="title"><a href="#">About</a></h2>
						<br>
						<div class="entry">
							<p><?php echo profil('about'); ?></p>
							
						</div>
					</div>
					<div class="post" id="contact">
						<h2 class="title"><a href="#">Contact</a></h2>
						<br>
						<div class="entry">
							<p>Admin <?php echo profil('nama_profil'); ?></p>
							<p>No. Telp :  <?php echo profil('no_telp'); ?></p>
							<p>No. Whatsapp :  <?php echo profil('no_hp'); ?></p>
							<p>Alamat :  <?php echo profil('alamat'); ?></p>
						</div>
					</div>
					<div style="clear: both;">&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
</div>