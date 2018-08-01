<?php
session_start();
$id="";
if(isset($_GET["id"])){
	$id=$_GET["id"];
	
	 $sqlx="select * from `tb_perawatan` where `kode_perawatan`='$kode_perawatan'";
	$dx=getField($conn,$sqlx);
		$kode_pasien=$dx["kode_pasien"];
		
			 $sqlp="select * from `tb_pasien` where `kode_pasien`='$kode_pasien'";
	$dp=getField($conn,$sqlp);
		$nama_pasien=$dp["nama_pasien"];
	
	
}
$_SESSION["ck"]=$id;
?>
<!DOCTYPE html>
<html>
<body>
    
    <script>
        
    
    function changeImage() {
        var image = document.getElementById('myImage');
        image.src = "http://localhost/monitoring/myGrafik/indexgrafik.php?" + new Date().getTime();
    }
    
    
    function countdown() {
    // your code goes here
    var count = 2;
    var timerId = setInterval(function() {
        count--;
       // console.log(count);
       document.getElementById("cdown").innerHTML = count.toString();
 
        if(count == 0) {
            changeImage();
            count = 2;
        }
    }, 1000);
}
 
countdown();
 
    </script>
    <p>Pasien :<?php echo $nama_pasien;	 ?><br> The graph will update in : <span id="cdown" style="color:blue; font-size:20px"></span></p><br>
    <textarea name="textarea" cols="30" rows="4" readonly id="textarea">Peringatan untuk segera menangani Pasien jika:
Detak jantung diatas 100 bpm
Detak jantung dibawah 60 bpm</textarea>
    <br>
    <br>
    <br>
    <img id="myImage" src="http://localhost/monitoring/myGrafik/indexgrafik.php?" width="800" height="500" />

  

</body>
</html>