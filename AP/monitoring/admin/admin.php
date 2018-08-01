<?php

$tanggal=WKT(date("Y-m-d"));
$pro="simpan";
$gambar0="avatar.jpg";
$status="Aktif";
//$PATH="ypathcss";
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
win=window.open('admin/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
  $sql="select `kode_admin` from `$tbadmin` order by `kode_admin` desc";
  $q=mysqli_query($conn, $sql);
  $jum=mysqli_num_rows($q);
  $th=date("y");
  $bl=date("m")+0;if($bl<10){$bl="0".$bl;}

  $kd="ADM".$th.$bl;//KEG1610001
  if($jum > 0){
   $d=mysqli_fetch_array($q);
   $idmax=$d["kode_admin"];
   
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
  $kode_admin=$idmax;
?>
<?php
if($_GET["pro"]=="ubah"){
	$kode_admin=$_GET["kode"];
	$sql="select * from `$tbadmin` where `kode_admin`='$kode_admin'";
	$d=getField($conn,$sql);
				$kode_admin=$d["kode_admin"];
				$username=$d["username"];
				$password=$d["password"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$status=$d["status"];
				$gambar=$d["gambar"];
				$gambar0=$d["gambar"];
				$pro="ubah";		
}
?>

<!-----xx--->

</head>
<body>
 
<div id="accordion">
  <h3> Input Data Admin</h3>
  <div>
    <!-----xx--->
    
    <form action="" method="post" enctype="multipart/form-data">
<table width="40%" class="table table-hover table-striped table-bordered" >
<tr>
<td width="106"><label for="kode_admin">Kode Admin</label>
<td width="10">:
<td colspan="2"><b><?php echo $kode_admin;?></b></tr>
<tr>
<td><label for="username">Username</label>
<td>:<td width="275"><input name="username" type="text" id="username" value="<?php echo $username;?>" size="20" />
</td>
<td width="112" rowspan="4">
<center>
<?php 
echo"<a href='#' onclick='buka(\"admin/zoom.php?id=$kode_admin\")'>
<img src='$YPATH/$gambar0' width='77' height='80' />
</a>
";
?>
</center>
</td>
</tr>

<tr>
<td height="24"><label for="password">Password</label>
<td>:<td><input name="password" type="password" id="password" value="<?php echo $password;?>" size="20" /></td>
</tr>


<tr>
<td height="24"><label for="telepon">Telepon</label>
<td>:<td><input name="telepon" type="text" id="telepon" value="<?php echo $telepon;?>" size="15" />
</td>
</tr>

<tr>
<td height="24"><label for="email">Email</label>
<td>:<td><input name="email" type="text" id="email" value="<?php echo $email;?>" size="25" />
</td>
</tr>

<tr>
<td><label for="status">Status</label>
<td>:<td colspan="2">
<input type="radio" name="status" id="status"  checked="checked" value="Aktif" <?php if($status=="Aktif"){echo"checked";}?>/>Aktif 
<input type="radio" name="status" id="status" value="Tidak Aktif" <?php if($status=="Tidak Aktif"){echo"checked";}?>/>Tidak Aktif
</td></tr>

<tr>
  <td height="24">Gambar
    <td>:<td colspan="2"><label for="gambar"></label>
        <input name="gambar" type="file" id="gambar" size="20" /> 
      => <a href='#' onclick='buka("admin/zoom.php?id=<?php echo $kode_admin;?>")'><?php echo $gambar0;?></a></td>
</tr>

<tr>
<td>
<td>
<td colspan="2"><input name="Simpan" type="submit" id="Simpan" value="Simpan" />
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="gambar0" type="hidden" id="gambar0" value="<?php echo $gambar0;?>" />
        <input name="kode_admin" type="hidden" id="kode_admin" value="<?php echo $kode_admin;?>" />
        <input name="kode_admin0" type="hidden" id="kode_admin0" value="<?php echo $kode_admin0;?>" />
        <a href="?mnu=admin"><input name="Batal" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>
<!-----xx--->
</div>
  <h3>Lihat Data</h3>
  <div>
 <!-----xx--->
<br />
Data Admin: 

<br>

<table width="100%" border="0" class="table table-hover table-striped table-bordered">
  <tr bgcolor="#CCCCCC">
    <th width="3%">No</td>
    <th width="10%">Kode Admin</td>
    <th width="20%">Username</td>
    <th width="30%">Email</td>
    <th width="20%">Telepon</td>
    <th width="10%">Gambar</td>
    <th width="15%">Menu</td>
  </tr>
<?php  
  $sql="select * from `$tbadmin` order by `kode_admin` desc";
  $jum=getJum($conn,$sql);
		if($jum > 0){
//--------------------------------------------------------------------------------------------
$batas   = 10;
$page = $_GET['page'];
if(empty($page)){$posawal  = 0;$page = 1;}
else{$posawal = ($page-1) * $batas;}

$sql2 = $sql." LIMIT $posawal,$batas";
$no = $posawal+1;
//--------------------------------------------------------------------------------------------									
	$arr=getData($conn,$sql2);
		foreach($arr as $d) {						
				$kode_admin=$d["kode_admin"];
				$username=$d["username"];
				$password=$d["password"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$status=$d["status"];
				$gambar=$d["gambar"];
				$gambar0=$d["gambar"];
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
				<td>$kode_admin</td>
				<td>$username</td>
				<td>$email</td>
				<td>$telepon</td>
				<td><div align='center'>";
echo"<a href='#' onclick='buka(\"admin/zoom.php?id=$kode_admin\")'>
<img src='$YPATH/$gambar' width='40' height='40' /></a></div>";
				echo"</td>
				<td><div align='center'>
<a href='?mnu=admin&pro=ubah&kode=$kode_admin'><img src='ypathicon/u.png' alt='ubah'></a>
<a href='?mnu=admin&pro=hapus&kode=$kode_admin'><img src='ypathicon/h.png' alt='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $nama pada data admin ?..\")'></a></div></td>
				</tr>";
				
			$no++;
			}//while
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data admin belum tersedia...</blink></td></tr>";}
?>
</table>

<?php
$jmldata = $jum;
if($jmldata>0){
	if($batas<1){$batas=1;}
	$jmlhal  = ceil($jmldata/$batas);
	echo "<div class=paging>";
	if($page > 1){
		$prev=$page-1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=admin'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=admin'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=admin'>Next »</a></span>";
	}
	else{ echo "<span class=disabled>Next »</span>";}
	echo "</div>";
	}//if jmldata

$jmldata = $jum;
echo "<p align=center>Total data <b>$jmldata</b> item</p>";
?>
<!-----xx--->
  </div>
</div>
<!-----xx--->
<?php
if(isset($_POST["Simpan"])){
	$pro=strip_tags($_POST["pro"]);
	$kode_admin=strip_tags($_POST["kode_admin"]);
	$kode_admin0=strip_tags($_POST["kode_admin"]);
	$username=strip_tags($_POST["username"]);
	$password=strip_tags($_POST["password"]);
	$telepon=strip_tags($_POST["telepon"]);
	$email=strip_tags($_POST["email"]);
	$status=strip_tags($_POST["status"]);
	
	$gambar0=strip_tags($_POST["gambar0"]);
	if ($_FILES["gambar"] != "") {
		@copy($_FILES["gambar"]["tmp_name"],"$YPATH/".$_FILES["gambar"]["name"]);
		$gambar=$_FILES["gambar"]["name"];
		} 
	else {$gambar=$gambar0;}
	if(strlen($gambar)<1){$gambar=$gambar0;}
	
if($pro=="simpan"){
$sql=" INSERT INTO `$tbadmin` (
`kode_admin` ,
`username` ,
`password` ,
`telepon` ,
`email` ,
`status` ,
`gambar` 
) VALUES (
'$kode_admin', 
'$username',
'$password', 
'$telepon',
'$email',
'$status', 
'$gambar'
)";
	
$simpan=process($conn,$sql);
	if($simpan) {echo "<script>alert('Data $kode_admin berhasil disimpan !');document.location.href='?mnu=admin';</script>";}
		else{echo"<script>alert('Data $kode_admin gagal disimpan...');document.location.href='?mnu=admin';</script>";}
	}
	else{
	$sql="update `$tbadmin` set `username`='$username',`password`='$password',`telepon`='$telepon' ,`email`='$email',`status`='$status',
	`gambar`='$gambar'  where `kode_admin`='$kode_admin0'";
	$ubah=process($conn,$sql);
		if($ubah) {echo "<script>alert('Data $kode_admin berhasil diubah !');document.location.href='?mnu=admin';</script>";}
		else{echo"<script>alert('Data $kode_admin gagal diubah...');document.location.href='?mnu=admin';</script>";}
	}//else simpan
}
?>

<?php
if($_GET["pro"]=="hapus"){
$kode_admin=$_GET["kode"];
$sql="delete from `$tbadmin` where `kode_admin`='$kode_admin'";
$hapus=process($conn,$sql);
	if($hapus) {echo "<script>alert('Data $kode_admin berhasil dihapus !');document.location.href='?mnu=admin';</script>";}
	else{echo"<script>alert('Data $kode_admin gagal dihapus...');document.location.href='?mnu=admin';</script>";}
}
?>

