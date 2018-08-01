
<?php

//PRW001@2018-09-09@10:09:00@1000@2000@200@!PRW001@2018-09-09@10:09:00@1002@2002@200@!PRW001@2018-09-09@10:10:00@1030@2030@200@!
include "konmysqli.php";

$pro="simpan";
date_default_timezone_set('Asia/Jakarta');

  $sql="select * from `tb_log` where sts='0' order by `id` asc limit 0,10";
  $jum=getJum($conn,$sql);
 	if($jum > 0){
		$gab="";
		$arr=getData($conn,$sql);
		foreach($arr as $d) {								
				$id=$d["id"];
				$kode_perawatan=$d["kode_perawatan"];
				$tanggal=$d["tanggal"];
				$jam=$d["jam"];
				$detak_jantung=$d["detak_jantung"];
				$detak_jantung2=$d["detak_jantung2"];
				$peak=$d["peak"];
				
				$gab.="$kode_perawatan@$tanggal@$jam@$detak_jantung@$detak_jantung2@$peak@!";

				
				$sqlx="update `tb_log` set sts='1' where `id`='$id'";
				$up=process($conn,$sqlx);

				}//while
				echo $gab;
			//$homepage = file_get_contents("http://192.168.1.28/monitoring/auto.php?data=".$gab);
$homepage = file_get_contents("http://monitoringiccu.com/auto.php?data=".$gab);


		}//if
		
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

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

function getData($conn,$sql){
	$rs=$conn->query($sql);
	$rs->data_seek(0);
	$arr = $rs->fetch_all(MYSQLI_ASSOC);
	
	$rs->free();
	return $arr;
}
		
?>

</table>

