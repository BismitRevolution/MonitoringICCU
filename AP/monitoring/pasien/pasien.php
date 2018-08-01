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
win=window.open('pasien/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
  $sql="select `kode_pasien` from `$tbpasien` order by `kode_pasien` desc";
$q=mysqli_query($conn, $sql);
  $jum=mysqli_num_rows($q);
  $th=date("y");
  $bl=date("m")+0;if($bl<10){$bl="0".$bl;}

  $kd="PSN".$th.$bl;//KEG1610001
  if($jum > 0){
   $d=mysqli_fetch_array($q);
   $idmax=$d["kode_pasien"];
   
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
  $kode_pasien=$idmax;
?>

<?php
if($_GET["pro"]=="ubah"){
	$kode_pasien=$_GET["kode"];
	$sql="select * from `$tbpasien` where `kode_pasien`='$kode_pasien'";
	$d=getField($conn,$sql);
				$kode_pasien=$d["kode_pasien"];
				$kode_pasien0=$d["kode_pasien"];
				$nama_pasien=$d["nama_pasien"];
				$jenis_kelamin=$d["jenis_kelamin"];
				$alamat=$d["alamat"];
				$telepon=$d["telepon"];
				$catatan=$d["catatan"];
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
  <h3>Input Data Pasien</h3>
  <div>
<!-----xx--->

<form action="" method="post" enctype="multipart/form-data">
<table width="385" class="table table-hover table-striped table-bordered">


<tr>
<td width="137"><label for="kode_pasien">Kode pasien</label>
<td width="10">:
<td width="225" colspan="2"><b><?php echo $kode_pasien;?></b>
</tr>

<tr>
<td><label for="nama_pasien">Nama pasien</label>
<td>:
<td colspan="2"><input name="nama_pasien" type="text" id="nama_pasien" value="<?php echo $nama_pasien;?>" size="30" /></td>
</tr>

<tr>
<td height="24"><label for="jenis_kelamin">Jenis Kelamin</label>
<td>:<td colspan="2">
<input type="radio" name="jenis_kelamin" id="jenis_kelamin"  checked="checked" value="Perempuan" <?php if($jenis_kelamin=="Perempuan"){echo"checked";}?>/>Perempuan
<input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-laki" <?php if($jenis_kelamin=="Laki-laki"){echo"checked";}?>/>Laki-laki
</td>
</tr>

<tr>
<td height="24"><label for="alamat">Alamat</label>
<td>:
<td><textarea name="alamat" cols="30" rows="3" id="alamat"><?php echo $alamat;?></textarea>
  <label for="kode_pasienbarang"></label></td>
</tr>

<tr>
<td height="24"><label for="telepon">Telepon</label>
<td>:<td colspan="2"><input name="telepon" type="text" id="telepon" value="<?php echo $telepon;?>" size="25" />
</td>
</tr>

<tr>
<td height="24"><label for="catatan">Catatan</label>
<td>:<td colspan="2"><textarea name="catatan" cols="25" id="catatan"><?php echo $catatan;?></textarea>
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
        <input name="kode_pasien" type="hidden" id="kode_pasien" value="<?php echo $kode_pasien;?>" />
        <input name="kode_pasien0" type="hidden" id="kode_pasien0" value="<?php echo $kode_pasien0;?>" />
        <a href="?mnu=pasien"><input name="Batal" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>

<!-----xx--->
</div>
  <h3>Lihat Data</h3>
  <div>
 <!-----xx--->
 
Data pasien: 
<br>

<table width="100%" border="0" class="table table-hover table-striped table-bordered">
  <tr bgcolor="#CCCCCC">
    <th width="2%">No</th>
    <th width="8%">Kode Pasien</th>
    <th width="16%">Nama pasien</th>
    <th width="12%">jenis Kelamin</th>
    <th width="16%">alamat</th>
    <th width="12%">telepon</th>
    <th width="11%">catatan</th>
    <th width="15%">Status</th>
    <th width="8%">Menu</th>
  </tr>
<?php  
  $sql="select * from `$tbpasien` order by `kode_pasien` desc";
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
				$kode_pasien=$d["kode_pasien"];
				$nama_pasien=$d["nama_pasien"];
				$jenis_kelamin=$d["jenis_kelamin"];
				$alamat=$d["alamat"];
				$telepon=$d["telepon"];
				$status=$d["status"];
				$catatan=$d["catatan"];
					$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
				<td>$kode_pasien</td>
				<td>$nama_pasien</td>
				<td>$jenis_kelamin</td>
				<td>$alamat</td>
				<td>$telepon</td>
				<td>$catatan</td>
				<td>$status</td>
				<td align='center'>
<a href='?mnu=pasien&pro=ubah&kode=$kode_pasien'><img src='ypathicon/u.png' alt='ubah'></a>
<a href='?mnu=pasien&pro=hapus&kode=$kode_pasien'><img src='ypathicon/h.png' alt='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $nama_pasien pada data pasien ?..\")'></a></td>
				</tr>";
			
			$no++;
			}//while
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data pasien belum tersedia...</blink></td></tr>";}
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=pasien'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	// Tampilkan link page 1,2,3 ...
	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=pasien'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	// Link kepage berikutnya (Next)
	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=pasien'>Next »</a></span>";
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
	$kode_pasien=strip_tags($_POST["kode_pasien"]);
	$kode_pasien0=strip_tags($_POST["kode_pasien0"]);
	$nama_pasien=strip_tags($_POST["nama_pasien"]);
	$jenis_kelamin=strip_tags($_POST["jenis_kelamin"]);
	$alamat=strip_tags($_POST["alamat"]);
	$telepon=strip_tags($_POST["telepon"]);
	$catatan=strip_tags($_POST["catatan"]);
	$status=strip_tags($_POST["status"]);
	
if($pro=="simpan"){
$sql=" INSERT INTO `$tbpasien` (
`kode_pasien` ,
`nama_pasien` ,
`jenis_kelamin` ,
`alamat` ,
`telepon` ,
`catatan` ,
`status` 
) VALUES (
'$kode_pasien', 
'$nama_pasien', 
'$jenis_kelamin',
'$alamat',
'$telepon',
'$catatan',
'$status'
)";
	
$simpan=process($conn,$sql);
		if($simpan) {echo "<script>alert('Data $kode_pasien berhasil disimpan !');document.location.href='?mnu=pasien';</script>";}
		else{echo"<script>alert('Data $kode_pasien gagal disimpan...');document.location.href='?mnu=pasien';</script>";}
	}
	else{
$sql="update `$tbpasien` set 
`nama_pasien`='$nama_pasien',
`jenis_kelamin`='$jenis_kelamin' ,
`alamat`='$alamat',
`status`='$status',
`telepon`='$telepon' ,
`catatan`='$catatan' 
where `kode_pasien`='$kode_pasien0'";
$ubah=process($conn,$sql);
	if($ubah) {echo "<script>alert('Data $kode_pasien berhasil diubah !');document.location.href='?mnu=pasien';</script>";}
	else{echo"<script>alert('Data $kode_pasien gagal diubah...');document.location.href='?mnu=pasien';</script>";}
	}//else simpan
}
?>

<?php
if($_GET["pro"]=="hapus"){
$kode_pasien=$_GET["kode"];
$sql="delete from `$tbpasien` where `kode_pasien`='$kode_pasien'";
$hapus=process($conn,$sql);
if($hapus) {echo "<script>alert('Data pasien $kode_pasien berhasil dihapus !');document.location.href='?mnu=pasien';</script>";}
else{echo"<script>alert('Data pasien $kode_pasien gagal dihapus...');document.location.href='?mnu=pasien';</script>";}
}
?>

