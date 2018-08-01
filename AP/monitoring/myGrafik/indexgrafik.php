<?php // content="text/plain; charset=utf-8"
 session_start();
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once ('jpgraph.php');
require_once ('jpgraph_line.php');
require_once ('jpgraph_error.php');
 
$y_axis = array();
/*
for($i=0; $i<40; $i++) {
	$m=rand(0,100);
	echo $m."<br>";
        $y_axis[] = $m; 	
//DB
    }
 */
 
 $DBServer = 'localhost';
$DBUser   = 'root';
$DBPass   = '';
$DBName   = 'MonitoringDetakJantung';

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}

  $sql="select `detak_jantung` from `tb_log` where kode_perawatan='".$_SESSION["ck"]."' order by id desc limit 0,40";// where kode_perawatan='$kode_perawatan'";// order by `id` desc limit 0,50";						
if(isset($_GET["id"])){
$kode_perawatan=$_GET["id"];
   $sql="select `detak_jantung` from `tb_log` where kode_perawatan='$kode_perawatan' order by id desc limit 0,40";// where kode_perawatan='$kode_perawatan'";// order by `id` desc limit 0,50";
   
  					
}
	$arr=getData($conn,$sql);
		foreach($arr as $d) {		
				$detak_jantung=$d["detak_jantung"];
				$y_axis[] =$detak_jantung;
				
	}//loop
		
		
		
$graph = new Graph(800,500);
$graph->img->SetMargin(40,40,40,40);  
$graph->img->SetAntiAliasing();
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->title->Set("Detak Jantung (bpm) ");
$graph->title->SetFont(FF_FONT1,FS_BOLD);
 
 
 
$p1 = new LinePlot($y_axis);
$p1->mark->SetType(MARK_FILLEDCIRCLE);
$p1->mark->SetFillColor("red");
$p1->mark->SetWidth(4);
$p1->SetColor("blue");
$p1->SetCenter();
$graph->Add($p1);
 
$graph->Stroke();
 
?>

<?php
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

?>