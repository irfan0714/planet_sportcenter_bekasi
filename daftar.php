<div id="wrapper">
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<form id="form-daftar">
						<div class="row">
							<div class="col-4"></div>
							<div class="col-4">
								<h3>Daftar</h3>
								<br>

								<div class="alert alert-danger" role="alert" id="alert-error" style="display: none;"></div>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" class="form-control" name="nama_pelanggan" required="">
								</div>
								<div class="form-group">
									<label>No. Telepon</label>
									<input type="text" class="form-control" name="no_telp" maxlength="13" class="form-control" onKeyPress="return angkadanhuruf(event,'1234567890',this)" required="">
								</div>
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
								<button type="submit" class="btn-iso button" id="btn-daftar" style="margin-left: 55px;">Daftar</button>
								<a href="?p=login" class="pull-right">LOGIN</a>
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
		$("#form-daftar").submit(function(e){
			e.preventDefault();

			$.ajax({
				url : "proses.php?action=simpan-daftar",
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
						    content: 'Silahkan login. ',
						    buttons: {
						    	OK: function(){
									window.location = "?p=login";
						    	}
						    }
			        	});
					}else if(res.message == 'failed' && res.result == 'email sudah terdaftar'){
						$("#alert-error").show();
						$("#alert-error").html('Email sudah terdaftar.');
					}else{
						$("#alert-error").show();
						$("#alert-error").html('Error.');
					}
					$("#btn-daftar").html("Daftar");
				},
				error : function(e){
					$("#btn-daftar").html("Daftar");
					$.alert('Error! '+e);
				}
			});
		});
	});

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
