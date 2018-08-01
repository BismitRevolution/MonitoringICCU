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
if($_GET["pro"]=="ubah"){
	$kode_user=$_GET["kode"];
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
}
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
  <h3>Input Data Perawat</h3><div>
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
<td colspan="2">
<input name="nama_user" type="text" id="nama_user" value="<?php echo $nama_user;?>" size="30" /></td>
</tr>

<tr>
<td><label for="telepon">Telepon</label>
<td>:
<td colspan="2">
<input name="telepon" type="text" id="telepon" value="<?php echo $telepon;?>" size="30" /></td>
</tr>

<tr>
<td height="24">
<label for="username">Username</label>
<td>:<td colspan="2">
<input name="username" type="text" id="username" value="<?php echo $username;?>" size="15" />
</td>
</tr>

<tr>
<td height="24"><label for="password">Password</label>
<td>:
<td><input name="password" type="password" id="password" value="<?php echo $password;?>" size="30" />
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
<td colspan="2">	<input name="Simpan" type="submit" id="Simpan" value="Simpan" />
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="kode_user" type="hidden" id="kode_user" value="<?php echo $kode_user;?>" />
        <input name="kode_user0" type="hidden" id="kode_user0" value="<?php echo $kode_user0;?>" />
        <a href="?mnu=user"><input name="Batal" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>

<!-----xx--->
</div>
  <h3>Lihat Data</h3>
  <div>
 <!-----xx--->
 
Data perawat: 
<br>

<table width="100%" border="0" class="table table-hover table-striped table-bordered">
  <tr bgcolor="#CCCCCC">
    <th width="3%">No</th>
    <th width="10%">Kode</th>
    <th width="20%">Nama Perawat</th>
    <th width="20%">Telepon</th>
    <th width="10%">Username</th>
    <th width="30%">Password</th>
    <th width="10%">Status</th>
    <th width="10%">Menu</th>
  </tr>
<?php  
  $sql="select * from `$tbuser` order by `kode_user` desc";
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
				$kode_user=$d["kode_user"];
				$nama_user=$d["nama_user"];
				$telepon=$d["telepon"];
				$username=$d["username"];
				$password=$d["password"];
				$status=$d["status"];
					$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
				<td>$kode_user</td>
				<td>$nama_user</td>
				<td>$telepon</td>
				<td>$username</td>
				<td>$password</td>
				<td align='center'>$status</td>
				<td align='center'>
<a href='?mnu=user&pro=ubah&kode=$kode_user'><img src='ypathicon/u.png' alt='ubah'></a>
<a href='?mnu=user&pro=hapus&kode=$kode_user'><img src='ypathicon/h.png' alt='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $nama_user pada data user ?..\")'></a></td>
				</tr>";
			
			$no++;
			}//while
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data user belum tersedia...</blink></td></tr>";}
?>
</table>

<?php
//Langkah 3: Hitung total data dan page 
$jmldata = $jum;
if($jmldata>0){
	if($batas<1){$batas=1;}
	$jmlhal  = ceil($jmldata/$batas);
	echo "<div class=paging>";
	if($page > 1){
		$prev=$page-1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=user'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	// Tampilkan link page 1,2,3 ...
	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=user'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	// Link kepage berikutnya (Next)
	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=user'>Next »</a></span>";
	}
	else{ echo "<span class=disabled>Next »</span>";}
	echo "</div>";
	}//if jmldata

$jmldata = $jum;
	echo "<p align=center>Total Data <b>$jmldata</b> Item</p>";
?>

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
	
if($pro=="simpan"){
$sql=" INSERT INTO `$tbuser` (
`kode_user` ,
`nama_user` ,
`telepon` ,
`username` ,
`password` ,
`status` 
) VALUES (
'$kode_user', 
'$nama_user', 
'$telepon', 
'$username',
'$password',
'$status'
)";
	
$simpan=process($conn,$sql);
		if($simpan) {echo "<script>alert('Data $kode_user berhasil disimpan !');document.location.href='?mnu=user';</script>";}
		else{echo"<script>alert('Data $kode_user gagal disimpan...');document.location.href='?mnu=user';</script>";}
	}
	else{
$sql="update `$tbuser` set 
`nama_user`='$nama_user',
`telepon`='$telepon',
`username`='$username' ,
`password`='$password',
`status`='$status'
where `kode_user`='$kode_user0'";
$ubah=process($conn,$sql);
	if($ubah) {echo "<script>alert('Data $kode_user berhasil diubah !');document.location.href='?mnu=user';</script>";}
	else{echo"<script>alert('Data $kode_user gagal diubah...');document.location.href='?mnu=user';</script>";}
	}//else simpan
}
?>

<?php
if($_GET["pro"]=="hapus"){
$kode_user=$_GET["kode"];
$sql="delete from `$tbuser` where `kode_user`='$kode_user'";
$hapus=process($conn,$sql);
if($hapus) {echo "<script>alert('Data user $kode_user berhasil dihapus !');document.location.href='?mnu=user';</script>";}
else{echo"<script>alert('Data user $kode_user gagal dihapus...');document.location.href='?mnu=user';</script>";}
}
?>

