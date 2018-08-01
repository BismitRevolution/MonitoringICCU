<?php
$pro="simpan";
$tanggal=WKT(date("Y-m-d"));
?>
<link type="text/css" href="<?php echo "$PATH/base/";?>ui.all.css" rel="stylesheet" />   
<script type="text/javascript" src="<?php echo "$PATH/";?>jquery-1.3.2.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/ui.core.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo "$PATH/";?>ui/i18n/ui.datepicker-id.js"></script>
    
  <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tanggal").datepicker({
					dateFormat  : "dd MM yy",        
          changeMonth : true,
          changeYear  : true					
        });
      });
    </script>    

<script type="text/javascript"> 
function PRINT(){ 
win=window.open('dokter/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
  $sql="select `kode_dokter` from `$tbdokter` order by `kode_dokter` desc";
$q=mysqli_query($conn, $sql);
  $jum=mysqli_num_rows($q);
  $th=date("y");
  $bl=date("m")+0;if($bl<10){$bl="0".$bl;}

  $kd="DTR".$th.$bl;//KEG1610001
  if($jum > 0){
   $d=mysqli_fetch_array($q);
   $idmax=$d["kode_dokter"];
   
   $bul=substr($idmax,5,2);
   $tah=substr($idmax,3,2);
    if($bul==$bl && $tah==$th){
     $urut=substr($idmax,7,3)+1;
     if($urut<10){$idmax="$kd"."00".$urut;}
     else if($urut<100){$idmax="$kd"."0".$urut;}
     else{$idmax="$kd".$urut;}
    }//==
    else{
     $idmax="$kd"."001";
     }   
   }//jum>0
  else{$idmax="$kd"."001";}
  $kode_dokter=$idmax;
?>

<?php
	$kode_dokter=$_SESSION["cid"];
	$sql="select * from `$tbdokter` where `kode_dokter`='$kode_dokter'";
	$d=getField($conn,$sql);
				$kode_dokter=$d["kode_dokter"];
				$kode_dokter0=$d["kode_dokter"];
				$nama_dokter=$d["nama_dokter"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$username=$d["username"];
				$password=$d["password"];
				$status=$d["status"];
				$pro="ubah";		
?>

<!-----xx--->
 <link rel="stylesheet" href="jsacordeon/jquery-ui.css">
  <link rel="stylesheet" href="resources/demos/style.css">
<script src="jsacordeon/jquery-1.12.4.js"></script>
  <script src="jsacordeon/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
  } );
  </script>
</head>
<body>
 
<div id="accordion">
  <h3>Form Biodata</h3>
  <div>
<!-----xx--->

<form action="" method="post" enctype="multipart/form-data">
<table width="385" class="table table-hover table-striped table-bordered">


<tr>
<td width="144"><label for="kode_dokter">Kode Dokter</label>
<td width="10">:
<td width="218" colspan="2"><b><?php echo $kode_dokter;?></b>
</tr>

<tr>
<td><label for="nama_dokter">Nama Dokter</label>
<td>:
<td colspan="2"><input name="nama_dokter" type="text" id="nama_dokter" value="<?php echo $nama_dokter;?>" size="30" /></td>
</tr>

<tr>
<td height="24"><label for="telepon">Telepon</label>
<td>:<td colspan="2"><input name="telepon" type="text" id="telepon" value="<?php echo $telepon;?>" size="15" />
</td>
</tr>

<tr>
<td height="24"><label for="email">Email</label>
<td>:
<td><input name="email" type="text" id="email" value="<?php echo $email;?>" size="30" />
  <label for="kode_barang"></label></td>
</tr>

<tr>
<td height="24"><label for="username">Username</label>
<td>:<td colspan="2"><input name="username" type="text" id="username" value="<?php echo $username;?>" size="25" />
</td>
</tr>

<tr>
<td height="24"><label for="password">Password</label>
<td>:<td colspan="2"><input name="password" type="password" id="password" value="<?php echo $password;?>" size="25" />
</td>
</tr>
<tr>
<td><label for="status">Status</label>
<td>:<td colspan="2">

<?php echo $status; ?>
</td></tr>

<tr>
<td>
<td>
<td colspan="2">	<input name="Simpan" type="submit" id="Simpan" value="Simpan" />
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="kode_dokter" type="hidden" id="kode_dokter" value="<?php echo $kode_dokter;?>" />
        <input name="kode_dokter0" type="hidden" id="kode_dokter0" value="<?php echo $kode_dokter0;?>" />
        <a href="?mnu=profil_dokter"><input name="Batal" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>
<!-----xx--->

<!-----xx--->
  </div>
</div>
<!-----xx--->
<?php
if(isset($_POST["Simpan"])){
	$pro=strip_tags($_POST["pro"]);
	$kode_dokter=strip_tags($_POST["kode_dokter"]);
	$kode_dokter0=strip_tags($_POST["kode_dokter0"]);
	$nama_dokter=strip_tags($_POST["nama_dokter"]);
	$telepon=strip_tags($_POST["telepon"]);
	$email=strip_tags($_POST["email"]);
	$username=strip_tags($_POST["username"]);
	$password=strip_tags($_POST["password"]);

$sql="update `$tbdokter` set 
`nama_dokter`='$nama_dokter',
`telepon`='$telepon' ,
`email`='$email',
`username`='$username' ,
`password`='$password' 
where `kode_dokter`='$kode_dokter0'";
$ubah=process($conn,$sql);
	if($ubah) {echo "<script>alert('Data $kode_dokter berhasil diubah !');document.location.href='?mnu=profil_dokter';</script>";}
	else{echo"<script>alert('Data $kode_dokter gagal diubah...');document.location.href='?mnu=profil_dokter';</script>";}
	
}
?>
