
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
if($_GET["pro"]=="ubah"){
	$kode_dokter=$_GET["kode"];
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
}
?>

<!-----xx--->

</head>
<body>
 
<div id="accordion">
  <h3>Input Data Dokter</h3>
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
<td colspan="2">
<input name="nama_dokter" type="text" id="nama_dokter" value="<?php echo $nama_dokter;?>" size="30" />
</td>
</tr>

<tr>
<td height="24"><label for="telepon">Telepon</label>
<td>:<td colspan="2">
<input name="telepon" type="text" id="telepon" value="<?php echo $telepon;?>" size="15" />
</td>
</tr>

<tr>
<td height="24"><label for="email">Email</label>
<td>:
<td>
<input name="email" type="text" id="email" value="<?php echo $email;?>" size="30" />
  <label for="kode_barang"></label></td>
</tr>

<tr>
<td height="24"><label for="username">Username</label>
<td>:<td colspan="2"><input name="username" type="text" id="username" value="<?php echo $username;?>" size="25" />
</td>
</tr>

<tr>
<td height="24"><label for="password">Password</label>
<td>:<td colspan="2"><input name="password" type="text" id="password" value="<?php echo $password;?>" size="25" />
</td>
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
        <input name="kode_dokter" type="hidden" id="kode_dokter" value="<?php echo $kode_dokter;?>" />
        <input name="kode_dokter0" type="hidden" id="kode_dokter0" value="<?php echo $kode_dokter0;?>" />
        <a href="?mnu=dokter"><input name="Batal" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>
<!-----xx--->
</div>
  <h3>Lihat Data</h3>
  <div>
 <!-----xx--->
Data dokter: 
<br>

<table width="100%" border="0" class="table table-hover table-striped table-bordered">
  <tr bgcolor="#CCCCCC">
    <th width="2%">No</th>
    <th width="8%">Kode</th>
    <th width="16%">Nama Dokter</th>
    <th width="12%">Telepon</th>
    <th width="16%">Email</th>
    <th width="12%">Username</th>
    <th width="11%">Password</th>
    <th width="15%">Status</th>
    <th width="8%">Menu</th>
  </tr>
<?php  
  $sql="select * from `$tbdokter` order by `kode_dokter` desc";
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
				$kode_dokter=$d["kode_dokter"];
				$nama_dokter=$d["nama_dokter"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$username=$d["username"];
				$status=$d["status"];
				$password=$d["password"];
					$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
				<td>$kode_dokter</td>
				<td>$nama_dokter</td>
				<td>$telepon</td>
				<td>$email</td>
				<td>$username</td>
				<td>$password</td>
				<td align='center'>$status</td>
				<td align='center'>
<a href='?mnu=dokter&pro=ubah&kode=$kode_dokter'><img src='ypathicon/u.png' alt='ubah'></a>
<a href='?mnu=dokter&pro=hapus&kode=$kode_dokter'><img src='ypathicon/h.png' alt='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $nama_dokter pada data dokter ?..\")'></a></td>
				</tr>";
			
			$no++;
			}//while
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data dokter belum tersedia...</blink></td></tr>";}
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=dokter'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	// Tampilkan link page 1,2,3 ...
	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=dokter'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	// Link kepage berikutnya (Next)
	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=dokter'>Next »</a></span>";
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
	$kode_dokter=strip_tags($_POST["kode_dokter"]);
	$kode_dokter0=strip_tags($_POST["kode_dokter0"]);
	$nama_dokter=strip_tags($_POST["nama_dokter"]);
	$telepon=strip_tags($_POST["telepon"]);
	$email=strip_tags($_POST["email"]);
	$username=strip_tags($_POST["username"]);
	$password=strip_tags($_POST["password"]);
	$status=strip_tags($_POST["status"]);
	
if($pro=="simpan"){
$sql=" INSERT INTO `$tbdokter` (
`kode_dokter` ,
`nama_dokter` ,
`telepon` ,
`email` ,
`username` ,
`password` ,
`status` 
) VALUES (
'$kode_dokter', 
'$nama_dokter', 
'$telepon',
'$email',
'$username',
'$password',
'$status'
)";
	
$simpan=process($conn,$sql);
		if($simpan) {echo "<script>alert('Data $kode_dokter berhasil disimpan !');document.location.href='?mnu=dokter';</script>";}
		else{echo"<script>alert('Data $kode_dokter gagal disimpan...');document.location.href='?mnu=dokter';</script>";}
	}
	else{
$sql="update `$tbdokter` set 
`nama_dokter`='$nama_dokter',
`telepon`='$telepon' ,
`email`='$email',
`status`='$status',
`username`='$username' ,
`password`='$password' 
where `kode_dokter`='$kode_dokter0'";
$ubah=process($conn,$sql);
	if($ubah) {echo "<script>alert('Data $kode_dokter berhasil diubah !');document.location.href='?mnu=dokter';</script>";}
	else{echo"<script>alert('Data $kode_dokter gagal diubah...');document.location.href='?mnu=dokter';</script>";}
	}//else simpan
}
?>

<?php
if($_GET["pro"]=="hapus"){
$kode_dokter=$_GET["kode"];
$sql="delete from `$tbdokter` where `kode_dokter`='$kode_dokter'";
$hapus=process($conn,$sql);
if($hapus) {echo "<script>alert('Data dokter $kode_dokter berhasil dihapus !');document.location.href='?mnu=dokter';</script>";}
else{echo"<script>alert('Data dokter $kode_dokter gagal dihapus...');document.location.href='?mnu=dokter';</script>";}
}
?>

