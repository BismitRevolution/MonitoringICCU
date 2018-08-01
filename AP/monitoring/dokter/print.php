<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
?>


<h3><center>Laporan data dokter:</h3>
 

<table width="100%" border="0">
  <tr>
    <th width="5%">no</td>
    <th width="10%">kode_dokter</td>
    <th width="25%">nama_dokter</td>
    <th width="25%">telepon</td>
    <th width="20%">email</td>
    <th width="10%">username</td>
    <th width="10%">password</td>
    <th width="5%">status</td>
  </tr>
<?php  
  $sql="select * from `$tbdokter` order by `kode_dokter` desc";
  $jum=getJum($conn,$sql);
  $no=0;
		if($jum > 0){
	$arr=getData($conn,$sql);
		foreach($arr as $d) {								
		$no++;
				$kode_dokter=$d["kode_dokter"];
				$nama_dokter=$d["nama_dokter"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$username=$d["username"];
				$password=$d["password"];
				$status=$d["status"];
						
if($no %2==1){
echo"<tr bgcolor='#999999'>
				<td>$no</td>
				<td>$kode_dokter</td>
				<td>$nama_dokter</td>
				<td>$telepon</td>
				<td>$email</td>
				<td>$username</td>
				<td>$password</td>
				<td>$status</td>
				</tr>";
				}//no==1
else if($no %2==0){
echo"<tr bgcolor='#cccccc'>
				<td>$no</td>
				<td>$kode_dokter</td>
				<td>$nama_dokter</td>
				<td>$telepon</td>
				<td>$email</td>
				<td>$username</td>
				<td>$password</td>
				<td>$status</td>
				</tr>";
				}
			}//while
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data dokter belum tersedia...</blink></td></tr>";}
		
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

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

