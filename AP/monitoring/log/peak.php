<?php
$pro="simpan";
$tanggal=WKT(date("Y-m-d"));
$jam=date("H:i:s");
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
win=window.open('log/print.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, note=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>


<?php
	$kode_perawatan=$_GET["id"];
	


	$sql="select * from `$tbperawatan` where `kode_perawatan`='$kode_perawatan'";
	$d=getField($conn,$sql);
				$kode_perawatan=$d["kode_perawatan"];
				$kode_perawatan0=$d["kode_perawatan"];
				$nama_perawatan=$d["nama_perawatan"];
				$kode_pasien=getPasien($conn,$d["kode_pasien"]);
				$kode_dokter=getDokter($conn,$d["kode_dokter"]);
				$uraian=$d["uraian"];
				$status=$d["status"];

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
  <h3> Data Log</h3>
  <div>
<!-----xx--->

<table width="433" class="table table-hover table-striped table-bordered">


<tr>
<td width="136"><label for="kode_perawatan">Kode Perawatan</label>
<td width="10">:
<td width="274" colspan="2"><b><?php echo $kode_perawatan;?></b>
</tr>

<tr>
<td><label for="nama_perawatan">Nama Perawatan</label>
<td>:
<td colspan="2"><?php echo $nama_perawatan;?></td>
</tr>

<tr>
<td height="24"><label for="kode_pasien">Pilih Pasien</label>
<td>:<td colspan="2">
 
 <?php echo $kode_pasien; ?>
 </td>
</tr>

<tr>
<td height="24"><label for="kode_dokter">Pilih Dokter</label>
<td>:
<td>
<?php echo $kode_dokter; ?>

</td>
</tr>

<tr>
<td height="24"><label for="uraian">Catatan</label>
<td>:<td colspan="2"><?php echo $uraian;?>
</td>
</tr>

<tr>
<td><label for="status">Status</label>
<td>:<td colspan="2">

<?php echo $status; ?>
</td></tr>

</table>

<!-----xx--->
</div>
  <h3>Lihat Data</h3>
  <div>
 <!-----xx--->
 
Data perawatan: 
<br>

<table width="100%" border="0" class="table table-hover table-striped table-bordered">
  <tr bgcolor="#CCCCCC">
    <th width="5%">No</th>
    <th width="16%">Tanggal</th>
    <th width="16%">Jam</th>
    <th width="21%">Detak Jantung</th>
    <th width="30%">Note</th>
  </tr>
<?php  
  $sql="select * from `$tblog` where kode_perawatan='$kode_perawatan' and not peak='0' order by `id` desc";
  $jum=getJum($conn,$sql);
		if($jum > 0){
	//--------------------------------------------------------------------------------------------
	$batas   = 100;
	$page = $_GET['page'];
	if(empty($page)){$posawal  = 0;$page = 1;}
	else{$posawal = ($page-1) * $batas;}
	
	$sql2 = $sql." LIMIT $posawal,$batas";
	$no = $posawal+1;
	//--------------------------------------------------------------------------------------------									
	$arr=getData($conn,$sql2);
		foreach($arr as $d) {							
				$id=$d["id"];
				$kode_perawatan=getPerawatan($conn,$d["kode_perawatan"]);
				$tanggal=WKT($d["tanggal"]);
				$jam=$d["jam"];
				$detak_jantung=$d["detak_jantung"];
				$note=$d["note"];
				
				$peak=$d["peak"];
				
				$ket="<font color='red'>!</font>";
				if($peak==0){$ket="<font color='green'>-</font>";}
				
				
					$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
				<td>$tanggal</td>
				<td>$jam</td>
				<td>$detak_jantung</td>
				<td>$ket</td>
			
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=peak&id=$kode_perawatan'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	// Tampilkan link page 1,2,3 ...
	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=peak&id=$kode_perawatan'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	// Link kepage berikutnya (Next)
	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=peak&id=$kode_perawatan'>Next »</a></span>";
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
	$id=strip_tags($_POST["id"]);
	$id0=strip_tags($_POST["id0"]);
	$kode_perawatan=strip_tags($_POST["kode_perawatan"]);
	$tanggal=BAL(strip_tags($_POST["tanggal"]));
	$jam=strip_tags($_POST["jam"]);
	$detak_jantung=strip_tags($_POST["detak_jantung"]);
	$note=strip_tags($_POST["note"]);
	
if($pro=="simpan"){
$sql=" INSERT INTO `$tblog` (
`id` ,
`kode_perawatan` ,
`tanggal` ,
`jam` ,
`detak_jantung` ,
`note` 
) VALUES (

'', 
'$kode_perawatan', 
'$tanggal',
'$jam',
'$detak_jantung',
'$note'
)";
	
$simpan=process($conn,$sql);
		if($simpan) {echo "<script>alert('Data $id berhasil disimpan !');document.location.href='?mnu=peak&id=$kode_perawatan';</script>";}
		else{echo"<script>alert('Data $id gagal disimpan...');document.location.href='?mnu=peak&id=$kode_perawatan';</script>";}
	}
	else{
$sql="update `$tblog` set 
`kode_perawatan`='$kode_perawatan',
`tanggal`='$tanggal' ,
`jam`='$jam',
`note`='$note',
`detak_jantung`='$detak_jantung' ,
where `id`='$id0'";
$ubah=process($conn,$sql);
	if($ubah) {echo "<script>alert('Data $id berhasil diubah !');document.location.href='?mnu=peak&id=$kode_perawatan';</script>";}
	else{echo"<script>alert('Data $id gagal diubah...');document.location.href='?mnu=peak&id=$kode_perawatan';</script>";}
	}//else simpan
}
?>

<?php
if($_GET["pro"]=="hapus"){
$id=$_GET["kode"];
$sql="delete from `$tblog` where `id`='$id'";
$hapus=process($conn,$sql);
if($hapus) {echo "<script>alert('Data perawatan $id berhasil dihapus !');document.location.href='?mnu=peak&id=$kode_perawatan';</script>";}
else{echo"<script>alert('Data perawatan $id gagal dihapus...');document.location.href='?mnu=peak&id=$kode_perawatan';</script>";}
}


		$kode_perawatan=$_GET["id"];
		echo $sql="update `$tblog` set note='1' ";//where `kode_perawatan`='$kode_perawatan'"; 
		$up=process($conn,$sql);

	
?>

