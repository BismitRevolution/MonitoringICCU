<?php
if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE);  
  ?>
<?php
session_start();
//error_reporting(0);
require_once"konmysqli.php";

$mnu=$_GET["mnu"];
date_default_timezone_set("Asia/Jakarta");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Monitoring Detak Jantung</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
		
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Monitoring </span>Detak Jantung</a>
                <?php
if(isset($_SESSION["cid"])){	?>
                
				<?php
				
	$sql="select distinct(kode_perawatan) from `$tblog` where note='0'";
   $jum=getJum($conn,$sql);
	$ada=0;
	$LOOP="";
	if($jum > 0){
	$arr=getData($conn,$sql);
		foreach($arr as $d) {							
				$kode_perawatan=$d["kode_perawatan"];
				
				$sqld="select peak from `$tblog` where note='0' and kode_perawatan='$kode_perawatan'";
   				$jumd=getJum($conn,$sqld);
   
				   $sqlb="select * from `$tblog` where `kode_perawatan`='$kode_perawatan' order by id desc";
					$db=getField($conn,$sqlb);
								$tanggal=WKT($db["tanggal"]);
								$jam=$db["jam"];
				
				$LOOP.="
					<li>
								<div class='dropdown-messages-box'><a href='index.php?mnu=peak&id=$kode_perawatan' class='pull-left'>
									<img alt='image' class='img-circle' src='http://placehold.it/40/30a5ff/fff'>
									</a>
									<div class='message-body'><small class='pull-right'>$kode_perawatan</small>
										<a href='index.php?mnu=peak&id=$kode_perawatan'><strong>Ada $jumd Warning</strong>.</a>
									<br /><small class='text-muted'>$tanggal $jam wib</small></div>
								</div>
							</li>
							<li class='divider'></li>
				";
		}
	}
	
				?>
                
                
                <ul class="nav navbar-top-links navbar-right">
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-envelope"></em><span class="label label-danger"><?php echo $jum;?></span>
					</a>
						
                        
                        <ul class="dropdown-menu dropdown-messages">
						<?php
						echo"$LOOP";
						
						?>
						
						</ul>
					</li>
                    
                    
                    
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-bell"></em><span class="label label-info">5</span>
					</a>
						<ul class="dropdown-menu dropdown-alerts">
							<li><a href="#">
								<div><em class="fa fa-envelope"></em> 1 New Message
									<span class="pull-right text-muted small">3 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-heart"></em> 12 New Likes
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-user"></em> 5 New Followers
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
						</ul>
					</li>
				</ul>
                
                <?php }else {}?>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
            
            	<?php
if(isset($_SESSION["cid"])){	?>
				<div class="profile-usertitle-name"><?php echo $_SESSION["cnama"]; ?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span><?php echo $_SESSION["cstatus"]; ?></div>
                <?php } else {?>
                <div class="profile-usertitle-name">Silahkan Login</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>:)</div>
                <?php } ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		
		<ul class="nav menu">
        
<?php 
if($_SESSION["cstatus"]=="Administrator"){ echo "
  	  <li><a href='index.php?mnu=home'><em class='fa fa-dashboard'>&nbsp;</em>Home</a></li>
      <li><a href='index.php?mnu=admin'><em class='fa fa-calendar'>&nbsp;</em>Admin</a></li>
	  <li><a href='index.php?mnu=dokter'><em class='fa fa-bar-chart'>&nbsp;</em> Dokter</a></li>
	  <li><a href='index.php?mnu=pasien'><em class='fa fa-toggle-off'>&nbsp;</em>Pasien</a></li>
	  <li><a href='index.php?mnu=perawatan'><em class='fa fa-clone'>&nbsp;</em>Perawatan</a></li>
	  <li><a href='index.php?mnu=user'><em class='fa fa-navicon'>&nbsp;</em>User</a></li>
	  <li><a href='index.php?mnu=logout'><em class='fa fa-power-off'>&nbsp;</em> Logout</a></li>
";}

else if($_SESSION["cstatus"]=="Perawat"){ echo "

  	  <li><a href='index.php?mnu=home'><em class='fa fa-dashboard'>&nbsp;</em>Home</a></li>
	  <li><a href='index.php?mnu=profil_user'><em class='fa fa-navicon'>&nbsp;</em>Profil</a></li>
	  <li><a href='index.php?mnu=ppasien'><em class='fa fa-toggle-off'>&nbsp;</em>Pasien</a></li>
	  <li><a href='index.php?mnu=perawatan'><em class='fa fa-clone'>&nbsp;</em>Perawatan</a></li>
	  <li><a href='index.php?mnu=logout'><em class='fa fa-power-off'>&nbsp;</em> Logout</a></li>

";}

else if($_SESSION["cstatus"]=="Dokter"){ echo "

 	  <li><a href='index.php?mnu=home'><em class='fa fa-dashboard'>&nbsp;</em>Home</a></li>
	  <li><a href='index.php?mnu=profil_dokter'><em class='fa fa-bar-chart'>&nbsp;</em>Profil Dokter</a></li>
	  <li><a href='index.php?mnu=dperawatan'><em class='fa fa-clone'>&nbsp;</em>Perawatan</a></li>
	  <li><a href='index.php?mnu=logout'><em class='fa fa-power-off'>&nbsp;</em> Logout</a></li>
";}

else{
	 echo"<li><a href='index.php?mnu=home'><em class='fa fa-dashboard'>&nbsp;</em>Home</a></li>";
	 echo"<li><a href='index.php?mnu=login'><em class='fa fa-power-off'>&nbsp;</em>Login</a></li>";	 
	}
      ?>
			
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Home</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"></h1>
			</div>
		</div><!--/.row-->
		
		
		
        <?php //if ($mnu=="" || $mnu=="home"){require_once "grafik.php";} ?>
        
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><marquee>Monitoring Detak Jantung</marquee></div>
					<div class="panel-body">
						<div class="col-md-12">
			
            <div class="banner-info">
				<h1><span>INTENSIVE CARDIAC CARE UNIT</h1>
            
            <?php 
					if($mnu=="admin"){require_once"admin/admin.php";}
					else if($mnu=="dokter"){require_once"dokter/dokter.php";}
					else if($mnu=="profil_dokter"){require_once"dokter/profil_dokter.php";}
					else if($mnu=="perawatan"){require_once"perawatan/perawatan.php";}
					else if($mnu=="dperawatan"){require_once"perawatan/dperawatan.php";}
					else if($mnu=="user"){require_once"user/user.php";}
					else if($mnu=="profil_user"){require_once"user/profil_user.php";}
					else if($mnu=="pasien"){require_once"pasien/pasien.php";}
					else if($mnu=="ppasien"){require_once"pasien/ppasien.php";}
					else if($mnu=="log"){require_once"log/log.php";}
					else if($mnu=="plog"){require_once"log/plog.php";}
					else if($mnu=="dlog"){require_once"log/dlog.php";}
					else if($mnu=="login"){require_once"login.php";}
					else if($mnu=="grafiklib"){require_once"myGrafik/index.php";}
					else if($mnu=="grafiksingle"){require_once"grafiksingle.php";}

					else if($mnu=="logout"){require_once"logout.php";}
					else if($mnu=="forgotpassword"){require_once"forgotpassword.php";}
					
					else {require_once"home.php";}
			?>
            			</div>
            		</div>
            	</div>
            </div>
            </div>
		
		
		<div class="row"><!--/.col-->
			<!--/.col-->
			<div class="col-sm-12">
				<p class="back-link">Rumah Sakit <a href="#">PNJ</a></p>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	 <?php
	 if($mnu=="grafiklib"||$mnu=="grafiksingle"||$mnu=="grafik"){}
	 else{?>
	 <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery-1.11.1.min.js"></script>
     
    
	
    
	<?php
	 }
	 ?>
	
	 <script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>	
</body>
</html>


<?php function RP($rupiah){return number_format($rupiah,"2",",",".");}?>
<?php
function WKT($sekarang){
$tanggal = substr($sekarang,8,2)+0;
$bulan = substr($sekarang,5,2);
$tahun = substr($sekarang,0,4);

$judul_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei","Juni", "Juli", "Agustus", "September","Oktober", "November", "Desember");
$wk=$tanggal." ".$judul_bln[(int)$bulan]." ".$tahun;
return $wk;
}
?>
<?php
function WKTP($sekarang){
$tanggal = substr($sekarang,8,2)+0;
$bulan = substr($sekarang,5,2);
$tahun = substr($sekarang,2,2);

$judul_bln=array(1=> "Jan", "Feb", "Mar", "Apr", "Mei","Jun", "Jul", "Agu", "Sep","Okt", "Nov", "Des");
$wk=$tanggal." ".$judul_bln[(int)$bulan]."'".$tahun;
return $wk;
}
?>
<?php
function BAL($tanggal){
	$arr=split(" ",$tanggal);
	if($arr[1]=="Januari"){$bul="01";}
	else if($arr[1]=="Februari"){$bul="02";}
	else if($arr[1]=="Maret"){$bul="03";}
	else if($arr[1]=="April"){$bul="04";}
	else if($arr[1]=="Mei"){$bul="05";}
	else if($arr[1]=="Juni"){$bul="06";}
	else if($arr[1]=="Juli"){$bul="07";}
	else if($arr[1]=="Agustus"){$bul="08";}
	else if($arr[1]=="September"){$bul="09";}
	else if($arr[1]=="Oktober"){$bul="10";}
	else if($arr[1]=="November"){$bul="11";}
	else if($arr[1]=="Nopember"){$bul="11";}
	else if($arr[1]=="Desember"){$bul="12";}
return "$arr[2]-$bul-$arr[0]";	
}
?>

<?php
function BALP($tanggal){
	$arr=split(" ",$tanggal);
	if($arr[1]=="Jan"){$bul="01";}
	else if($arr[1]=="Feb"){$bul="02";}
	else if($arr[1]=="Mar"){$bul="03";}
	else if($arr[1]=="Apr"){$bul="04";}
	else if($arr[1]=="Mei"){$bul="05";}
	else if($arr[1]=="Jun"){$bul="06";}
	else if($arr[1]=="Jul"){$bul="07";}
	else if($arr[1]=="Agu"){$bul="08";}
	else if($arr[1]=="Sep"){$bul="09";}
	else if($arr[1]=="Okt"){$bul="10";}
	else if($arr[1]=="Nov"){$bul="11";}
	else if($arr[1]=="Nop"){$bul="11";}
	else if($arr[1]=="Des"){$bul="12";}
return "$arr[2]-$bul-$arr[0]";	
}
?>


<?php
function process($conn,$sql){
$s=false;
$conn->autocommit(FALSE);
try {
  $rs = $conn->query($sql);
  if($rs){
	    $conn->commit();
	    $last_inserted_id = $conn->insert_id;
 		$affected_rows = $conn->affected_rows;
  		$s=true;
  }
} 
catch (Exception $e) {
	echo 'fail: ' . $e->getMessage();
  	$conn->rollback();
}
$conn->autocommit(TRUE);
return $s;
}

function getJum($conn,$sql){
  $rs=$conn->query($sql);
  $jum= $rs->num_rows;
	$rs->free();
	return $jum;
}

function getField($conn,$sql){
	$rs=$conn->query($sql);
	$rs->data_seek(0);
	$d= $rs->fetch_assoc();
	$rs->free();
	return $d;
}

function getData($conn,$sql){
	$rs=$conn->query($sql);
	$rs->data_seek(0);
	$arr = $rs->fetch_all(MYSQLI_ASSOC);
	//foreach($arr as $row) {
	//  echo $row['nama_kelas'] . '*<br>';
	//}
	
	$rs->free();
	return $arr;
}

function getPerawatan($conn,$kode){
$field="nama_perawatan";
$sql="SELECT `$field` FROM `tb_perawatan` where `kode_perawatan`='$kode'";
$rs=$conn->query($sql);	
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
    return $kode ." - ".$row[$field];
	}
	
	function getPasien($conn,$kode){
$field="nama_pasien";
$sql="SELECT `$field` FROM `tb_pasien` where `kode_pasien`='$kode'";
$rs=$conn->query($sql);	
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
    return $kode ." - ".$row[$field];
	}
	
	function getDokter($conn,$kode){
$field="nama_dokter";
$sql="SELECT `$field` FROM `tb_dokter` where `kode_dokter`='$kode'";
$rs=$conn->query($sql);	
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
    return $kode ." - ".$row[$field];
	}
?>
