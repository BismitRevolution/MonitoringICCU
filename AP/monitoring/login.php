<?php
session_start();
?>
<br />
<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading"><font color = "#2490e2"> Masukan Data Anda</font></div>
				<div class="panel-body">
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="user" type="user" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="pass" type="password" >
							</div>
							<div class="checkbox">
								<label>
									<a href="?mnu=forgotpassword" >Lupa Password..?</a>
								</label>
							</div>
							
                            <input type="submit" name="Login" id="Login" value="Login" class="btn btn-primary">
                            <a href="index.php?mnu=home" class="btn btn-danger">Batal</a> 
                            </fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	

<?php
if(isset($_POST["Login"])){
	$usr=$_POST["user"];
	$pas=$_POST["pass"];
	
	
		$sql2="select * from `$tbuser` where `username`='$usr' and `password`='$pas' and `status`='Aktif'";
		$sql3="select * from `$tbdokter` where `username`='$usr' and `password`='$pas' and `status`='Aktif'";
		$sql1="select * from `$tbadmin` where `username`='$usr' and `password`='$pas' and `status`='Aktif'";
		
if(getJum($conn,$sql2)>0){
	$d=getField($conn,$sql2);
				$kode=$d["kode_user"];
				$nama=$d["nama_user"];
				   $_SESSION["cid"]=$kode;
				   $_SESSION["cnama"]=$nama;
				   $_SESSION["cstatus"]="Perawat";
		echo "<script>alert('".$_SESSION["cstatus"]." ".$_SESSION["cnama"]." (".$_SESSION["cid"].") berhasil Login!');
		document.location.href='index.php?mnu=home';</script>";
			
}

else if(getJum($conn,$sql3)>0){
	$d=getField($conn,$sql3);
				$kode=$d["kode_dokter"];
				$nama=$d["nama_dokter"];
				   $_SESSION["cid"]=$kode;
				   $_SESSION["cnama"]=$nama;
				   $_SESSION["cstatus"]="Dokter";
		echo "<script>alert(' ".$_SESSION["cstatus"]." ".$_SESSION["cnama"]." (".$_SESSION["cid"].") berhasil Login!');
		document.location.href='index.php?mnu=home';</script>";
			
}

else if(getJum($conn,$sql1)>0){
			$d=getField($conn,$sql1);
				$kode=$d["kode_admin"];
				$nama=$d["username"];
				   $_SESSION["cid"]=$kode;
				   $_SESSION["cnama"]=$nama;
				   $_SESSION["cstatus"]="Administrator";
		echo "<script>alert(' ".$_SESSION["cstatus"]." ".$_SESSION["cnama"]." (".$_SESSION["cid"].") berhasil Login!');
		document.location.href='index.php?mnu=home';</script>";
		}
		else{
			session_destroy();
			echo "<script>alert(' Login GAGAL !,Silakan cek data Anda kembali...');
			document.location.href='index.php?mnu=login';</script>";
		}
}


?>