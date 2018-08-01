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
win=window.open('perawatan/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
  $sql="select `kode_perawatan` from `$tbperawatan` order by `kode_perawatan` desc";
$q=mysqli_query($conn, $sql);
  $jum=mysqli_num_rows($q);
  $th=date("y");
  $bl=date("m")+0;if($bl<10){$bl="0".$bl;}

  $kd="RWT".$th.$bl;//KEG1610001
  if($jum > 0){
   $d=mysqli_fetch_array($q);
   $idmax=$d["kode_perawatan"];
   
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
  $kode_perawatan=$idmax;
?>

<?php
if($_GET["pro"]=="ubah"){
	$kode_perawatan=$_GET["kode"];
	$sql="select * from `$tbperawatan` where `kode_perawatan`='$kode_perawatan'";
	$d=getField($conn,$sql);
				$kode_perawatan=$d["kode_perawatan"];
				$kode_perawatan0=$d["kode_perawatan"];
				$nama_perawatan=$d["nama_perawatan"];
				$kode_pasien=$d["kode_pasien"];
				$kode_dokter=$d["kode_dokter"];
				$uraian=$d["uraian"];
				$status=$d["status"];
				$pro="ubah";		
}
?>

<!-----xx--->
 
</head>
<body>
 
<div id="accordion">
  <h3>Input Data Perawatan</h3>
  <div>
<!-----xx--->

<form action="" method="post" enctype="multipart/form-data">
<table width="433" class="table table-hover table-striped table-bordered">


<tr>
<td width="136"><label for="kode_perawatan">Kode Perawatan</label>
<td width="10">:
<td width="274" colspan="2">
<input name="kode_perawatan" type="text" id="kode_perawatan" value="<?php echo $kode_perawatan;?>" size="15" />
</tr>

<tr>
<td><label for="nama_perawatan">Nama Perawatan</label>
<td>:
<td colspan="2">
<input name="nama_perawatan" type="text" id="nama_perawatan" value="<?php echo $nama_perawatan;?>" size="30" /></td>
</tr>

<tr>
<td height="24"><label for="kode_pasien">Pilih Pasien</label>
<td>:<td colspan="2">
  <select name="kode_pasien" id="kode_pasien">
    <option value="-">Pilih Pasien</option>
    <?php
      $s="select * from `tb_pasien` where status='Aktif'";
    $q=getData($conn,$s);
        foreach($q as $d){                         
                $kode_pasien0=$d["kode_pasien"];
                $nama_pasien=$d["nama_pasien"];
    echo"<option value='$kode_pasien0' ";if($kode_pasien0==$kode_pasien){echo"selected";} echo">$kode_pasien0 - $nama_pasien  </option>";
    }
    ?>
  </select></td>
</tr>

<tr>
<td height="24"><label for="kode_dokter">Pilih Dokter</label>
<td>:
<td>

 <select name="kode_dokter" id="kode_dokter">
    <option value="-">Pilih Dokter</option>
    <?php
      $s="select * from `tb_dokter`";
    $q=getData($conn,$s);
        foreach($q as $d){                         
                $kode_dokter0=$d["kode_dokter"];
                $nama_dokter=$d["nama_dokter"];
    echo"<option value='$kode_dokter0' ";if($kode_dokter0==$kode_dokter){echo"selected";} echo">$kode_dokter0 - $nama_dokter  </option>";
    }
    ?>
  </select>

</td>
</tr>

<tr>
<td height="24"><label for="uraian">Catatan</label>
<td>:<td colspan="2"><textarea name="uraian" cols="25" rows="4" id="uraian"><?php echo $uraian;?></textarea>
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
        <input name="kode_perawatan0" type="hidden" id="kode_perawatan0" value="<?php echo $kode_perawatan0;?>" />
        <a href="?mnu=perawatan"><input name="Batal" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>

<!-----xx--->
</div>
  <h3>Lihat Data</h3>
  <div>
 <!-----xx--->
 
Data perawatan: 
<br>

<table width="100%" border="0" class="table table-hover table-striped table-bordered">
  <tr bgcolor="#CCCCCC">
    <th width="2%">No</th>
    <th width="9%">Kode</th>
    <th width="18%">Nama Perawatan</th>
    <th width="14%">Pasien</th>
    <th width="22%">Dokter</th>
    <th width="13%">Catatan</th>
    <th width="16%">Status</th>
    <th width="6%">Menu</th>
  </tr>
<?php  
  $sql="select * from `$tbperawatan` order by `kode_perawatan` desc";
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
				$kode_perawatan=$d["kode_perawatan"];
				$nama_perawatan=$d["nama_perawatan"];
				$kode_pasien=getPasien($conn,$d["kode_pasien"]);
				$kode_dokter=getDokter($conn,$d["kode_dokter"]);
				$uraian=$d["uraian"];
				$status=$d["status"];
					$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
				<td>$kode_perawatan</td>
				<td>$nama_perawatan</td>
				<td>$kode_pasien</td>
				<td>$kode_dokter</td>
				<td>$uraian</td>
				<td align='center'>$status</td>
				<td align='center'>
<a href='?mnu=grafiklib&id=$kode_perawatan'><img src='ypathicon/icongrap.png' title='grafik'></a>				
<a href='?mnu=log&id=$kode_perawatan'><img src='ypathicon/iclog.jpg' title='Log'></a>
<a href='?mnu=perawatan&pro=ubah&kode=$kode_perawatan'><img src='ypathicon/u.png' title='ubah'></a>
				</tr>";
			
			$no++;
			}//while
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data perawatan belum tersedia...</blink></td></tr>";}
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=perawatan'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	// Tampilkan link page 1,2,3 ...
	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=perawatan'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	// Link kepage berikutnya (Next)
	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=perawatan'>Next »</a></span>";
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
	$kode_perawatan=strip_tags($_POST["kode_perawatan"]);
	$kode_perawatan0=strip_tags($_POST["kode_perawatan0"]);
	$nama_perawatan=strip_tags($_POST["nama_perawatan"]);
	$kode_pasien=strip_tags($_POST["kode_pasien"]);
	$kode_dokter=strip_tags($_POST["kode_dokter"]);
	$uraian=strip_tags($_POST["uraian"]);
	$status=strip_tags($_POST["status"]);
	
if($pro=="simpan"){
$sql=" INSERT INTO `$tbperawatan` (
`kode_perawatan` ,
`nama_perawatan` ,
`kode_pasien` ,
`kode_dokter` ,
`uraian` ,
`status` 
) VALUES (
'$kode_perawatan', 
'$nama_perawatan', 
'$kode_pasien',
'$kode_dokter',
'$uraian',
'$status'
)";
	
$simpan=process($conn,$sql);
		if($simpan) {echo "<script>alert('Data $kode_perawatan berhasil disimpan !');document.location.href='?mnu=perawatan';</script>";}
		else{echo"<script>alert('Data $kode_perawatan gagal disimpan...');document.location.href='?mnu=perawatan';</script>";}
	}
	else{
$sql="update `$tbperawatan` set 
`nama_perawatan`='$nama_perawatan',`kode_perawatan`='$kode_perawatan',
`kode_pasien`='$kode_pasien' ,
`kode_dokter`='$kode_dokter',
`status`='$status',
`uraian`='$uraian' 
where `kode_perawatan`='$kode_perawatan0'";
$ubah=process($conn,$sql);
	if($ubah) {echo "<script>alert('Data $kode_perawatan berhasil diubah !');document.location.href='?mnu=perawatan';</script>";}
	else{echo"<script>alert('Data $kode_perawatan gagal diubah...');document.location.href='?mnu=perawatan';</script>";}
	}//else simpan
}
?>

<?php
if($_GET["pro"]=="hapus"){
$kode_perawatan=$_GET["kode"];
$sql="delete from `$tbperawatan` where `kode_perawatan`='$kode_perawatan'";
$hapus=process($conn,$sql);
if($hapus) {echo "<script>alert('Data perawatan $kode_perawatan berhasil dihapus !');document.location.href='?mnu=perawatan';</script>";}
else{echo"<script>alert('Data perawatan $kode_perawatan gagal dihapus...');document.location.href='?mnu=perawatan';</script>";}
}
?>

