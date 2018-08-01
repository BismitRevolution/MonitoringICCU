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
win=window.open('user/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
  $sql="select `kode_user` from `$tbuser` order by `kode_user` desc";
$q=mysqli_query($conn, $sql);
  $jum=mysqli_num_rows($q);
  $th=date("y");
  $bl=date("m")+0;if($bl<10){$bl="0".$bl;}

  $kd="RWT".$th.$bl;//KEG1610001
  if($jum > 0){
   $d=mysqli_fetch_array($q);
   $idmax=$d["kode_user"];
   
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
  $kode_user=$idmax;
?>

<?php
	$kode_user=$_SESSION["cid"];
	$sql="select * from `$tbuser` where `kode_user`='$kode_user'";
	$d=getField($conn,$sql);
				$kode_user=$d["kode_user"];
				$kode_user0=$d["kode_user"];
				$nama_user=$d["nama_user"];
				$telepon=$d["telepon"];
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
<td width="98"><label for="kode_user">Kode Perawat</label>
<td width="10">:
<td width="264" colspan="2"><b><?php echo $kode_user;?></b>
</tr>

<tr>
<td><label for="nama_user">Nama Perawat</label>
<td>:
<td colspan="2"><input name="nama_user" type="text" id="nama_user" value="<?php echo $nama_user;?>" size="30" /></td>
</tr>

<tr>
<td><label for="telepon">Telepon</label>
<td>:
<td colspan="2"><input name="telepon" type="text" id="telepon" value="<?php echo $telepon;?>" size="30" /></td>
</tr>

<tr>
<td height="24"><label for="username">Username</label>
<td>:<td colspan="2"><input name="username" type="text" id="username" value="<?php echo $username;?>" size="15" />
</td>
</tr>

<tr>
<td height="24"><label for="password">Password</label>
<td>:
<td><input name="password" type="password" id="password" value="<?php echo $password;?>" size="15" />
  <label for="kode_barang"></label></td>
</tr>

<tr>
<td><label for="status">Status</label>
<td>:<td colspan="2">

<input type="radio" name="status" id="status"  checked="checked" value="Aktif" <?php if($status=="Aktif"){echo"checked";}?>/>Aktif 
<input type="radio" name="status" id="status" value="Tidak Aktif" <?php if($status=="Tidak Aktif"){echo"checked";}?>/>Tidak Aktif

</td></tr>

<tr>
<td>
<td>
<td colspan="2">	<input name="Simpan" type="submit" id="Simpan" value="Update Data" />
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="kode_user" type="hidden" id="kode_user" value="<?php echo $kode_user;?>" />
        <input name="kode_user0" type="hidden" id="kode_user0" value="<?php echo $kode_user0;?>" />
        <a href="?mnu=profil_user"><input name="Batal" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>

<!-----xx--->
  </div>
</div>
<!-----xx--->

<?php
if(isset($_POST["Simpan"])){
	$pro=strip_tags($_POST["pro"]);
	$kode_user=strip_tags($_POST["kode_user"]);
	$kode_user0=strip_tags($_POST["kode_user0"]);
	$nama_user=strip_tags($_POST["nama_user"]);
	$telepon=strip_tags($_POST["telepon"]);
	$username=strip_tags($_POST["username"]);
	$password=strip_tags($_POST["password"]);
	$status=strip_tags($_POST["status"]);
	

$sql="update `$tbuser` set 
`nama_user`='$nama_user',
`telepon`='$telepon' ,
`username`='$username' ,
`password`='$password',
`status`='$status'
where `kode_user`='$kode_user0'";
$ubah=process($conn,$sql);
	if($ubah) {echo "<script>alert('Data $kode_user berhasil diubah !');document.location.href='?mnu=profil_user';</script>";}
	else{echo"<script>alert('Data $kode_user gagal diubah...');document.location.href='?mnu=profil_user';</script>";}
	}//else simpan

?>
