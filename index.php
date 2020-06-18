<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="icon" type="image/png" sizes="16x16" href="./admin/plugins/images/favicon.png">
<title>Planet Sport Center Bekasi</title>
<link href="http://fonts.googleapis.com/css?family=Arvo|Open+Sans:400,300,700" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/jquery.toast.min.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" media="screen" />	
<link href="css/jquery-confirm.min.css" rel="stylesheet" type="text/css" media="screen" />	

<script src="./js/jquery-3.2.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/jquery.toast.min.js"></script> 
<script src="./js/bootstrap-datepicker.min.js"></script>
<script src="./js/jquery-confirm.min.js"></script>

<body>
	<?php 
		session_start();
		include "koneksi.php";

		$id_session = session_id();
		$query1 = "SELECT COUNT(id_session) AS total_pesanan FROM keranjang WHERE id_session = '$id_session' ";
		$exc_query1 = mysqli_query($con,$query1);
		$value1 = mysqli_fetch_array($exc_query1); 
		$total_pesanan = $value1['total_pesanan'] <> 0 ? "<div class='badge badge-primary'>".$value1['total_pesanan']."</div>":"";

	?>

<div class="preloader">
  <div class="loading">
    <!-- <img src="poi.gif" width="80"> -->
    <p>Loading ...</p>
  </div>
</div>
<div id="menu-wrapper">
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="?p=beranda/#beranda"><i class="fa fa-whatsapp"></i> <?php echo profil('no_hp'); ?></a></li>
			<li><a href="?p=beranda/#beranda">Beranda</a></li>
			<!-- <li><a href="?p=beranda/#photos">Photos</a></li> -->
			<li><a href="?p=beranda/#about">About</a></li>
			<li><a href="?p=beranda/#contact">Contact</a></li>
			<li>
				<?php if(!empty($_SESSION)){ ?>
					<a href="?p=akun&hl=profil" id="logout">Akun</a>
				<?php }else{ ?>
					<a href="?p=login">Login</a>
				<?php } ?>
			</li>
			<li>
				<a href="?p=booking&jns=1#detail"><i class="fa fa-shopping-bag "></i> <?php echo $total_pesanan; ?> </a>
			</li>
		</ul>
	</div>
	<!-- end #menu -->
</div>
<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="#">Planet <span>SportCenter Bekasi</span></a></h1>
			<p>Sewa Lapangan Badminton</p>
		</div>
	</div>
</div>
<?php 
	if(isset($_GET['p']))
	{
		if($_GET['p'] == 'booking')
		{
			include "booking.php";
		}
		else if($_GET['p'] == 'checkout')
		{
			include "checkout.php";
		}
		else if($_GET['p'] == 'billing')
		{
			include "billing.php";
		}
		else if($_GET['p'] == 'login')
		{
			include "login.php";
		}
		else if($_GET['p'] == 'daftar')
		{
			include "daftar.php";
		}
		else if($_GET['p'] == 'akun')
		{
			include "akun.php";
		}
		else
		{
			include "beranda.php";
		}
	}
	else{
		include "beranda.php";
	}
	
?>
<div id="footer">
	<p>&copy; 2020 planetsportcenterbekasi.com</p>
</div>
<!-- end #footer -->
<script type="text/javascript">
	$(document).ready(function(){

		setTimeout(function(){
			$(".preloader").hide();
		},500);
			
	});
</script>
</body>
</html>
