<?php
session_start();
?>

<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Masukan Data Anda</div>
				<div class="panel-body">
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Masukan Nama" name="nama" type="nama" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Masukan Telepon" name="telepon" type="text" >
							</div>
							<div class="checkbox">
								
							</div>
							
                            <input type="submit" name="Kirim" id="Kirim" value="Kirim" class="btn btn-primary">
                            <a href="index.php?mnu=login" class="btn btn-danger">Batal</a> 
                            </fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	

<?php
if(isset($_POST["Kirim"])){
	$nama=$_POST["nama"];
	$telepon=$_POST["telepon"];
	
	
		$sql2="select * from `$tbuser` where `nama_user`='$nama' and `telepon`='$telepon' ";
		$sql3="select * from `$tbdokter` where `nama_dokter`='$nama' and `telepon`='$telepon'";
		
		
if(getJum($conn,$sql2)>0){
	$d=getField($conn,$sql2);
				$kode_user=$d["kode_user"];
				$nama_user=$d["nama_user"];
				$telepon=$d["telepon"];
				$username=$d["username"];
				$password=$d["password"];
				$status=$d["status"];
		
		
		echo "
			<div class='alert bg-success' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> 
			Yth ".$nama_user." Gunakan Username = ".$username." dan Password = ".$password." Untuk Login anda ...!
			<a href='#' class='pull-right'><em class='fa fa-lg fa-close'></em></a></div>	
			";
}

else if(getJum($conn,$sql3)>0){
	$d=getField($conn,$sql3);
					$kode_dokter=$d["kode_dokter"];
				$nama_dokter=$d["nama_dokter"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$username=$d["username"];
				$status=$d["status"];
				$password=$d["password"];
				
				echo "
			<div class='alert bg-success' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> 
			Yth ".$nama_dokter." Gunakan Username = ".$username." dan Password = ".$password." Untuk Login anda ...!
			<a href='#' class='pull-right'><em class='fa fa-lg fa-close'></em></a></div>	
			";
		
			
}
		else{
			
			echo "
			<div class='alert bg-danger' role='alert'><em class='fa fa-lg fa-warning'>&nbsp;</em> 
			Data tidak tersedia, silahkan cek Nama dan No telepon anda ...!
			<a href='#' class='pull-right'><em class='fa fa-lg fa-close'></em></a></div>	
			";
		}
}


?>