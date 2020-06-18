<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<form id="form-login">
						<div class="row">
							<div class="col-4"></div>
							<div class="col-4">
								<h3>Login</h3>
								<br>

								<div class="alert alert-danger" role="alert" id="alert-error" style="display: none;"></div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" name="email" required="">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" class="form-control" name="password" required="">
								</div>	
							</div>
							<div class="col-4"></div>
						</div>
						<div class="row">
							<div class="col-4"></div>
							<div class="col-4 text-center">
								<button type="submit" class="btn-iso button" id="btn-login" style="margin-left: 55px">Login</button>
								<a href="?p=daftar" class="pull-right">DAFTAR</a>
							</div>
							<div class="col-4"></div>
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

</script>
