
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

date_default_timezone_set("Asia/Jakarta");

?>
<head>
    <link class="include" rel="stylesheet" type="text/css" href="lib/jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="lib/examples.min.css" />
    <link type="text/css" rel="stylesheet" href="lib/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="lib/syntaxhighlighter/styles/shThemejqPlot.min.css" />
    <script class="include" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>   
</head>

<!-- Example scripts go here -->
<div id="chart1" style="width:700px; height:300px"></div>

<script class="code" type="text/javascript">
    $(document).ready(function () {

	<?php
	
	$sql="select kode_perawatan from `$tblog`  order by id desc";
	$d=getField($conn,$sql);
	$kode_perawatan=$d["kode_perawatan"];
	
if(isset($_GET["id"])){	
	$kode_perawatan=$_GET["id"];
}

	$sql="select `detak_jantung` from `$tblog` order by `id` desc limit 0,50";	//where kode_perawatan='$kode_perawatan' 
	$arr=getData($conn,$sql);
	$gab="[";
	$no=0;
		foreach($arr as $d) {							
				$no++;
				$detak_jantung=$d["detak_jantung"];
				$gab.="[$no,$detak_jantung],";
		}
		$gab.="]";
		$gab=str_replace("],]","]]",$gab);
		
	?>
        var s1 = <?php echo $gab;?>;		
        var s2 = <?php echo $gab;?>;

        plot1 = $.jqplot("chart1", [s2, s1], {
            // Turns on animatino for all series in this plot.
            animate: true,
            // Will animate plot on calls to plot1.replot({resetAxes:true})
            animateReplot: true,
            cursor: {
                show: true,
                zoom: true,
                looseZoom: true,
                showTooltip: false
            },
            series:[
                {
                    pointLabels: {
                        show: true
                    },
                    renderer: $.jqplot.BarRenderer,
                    showHighlight: false,
                    yaxis: 'y2axis',
                    rendererOptions: {
                        // Speed up the animation a little bit.
                        // This is a number of milliseconds.  
                        // Default for bar series is 3000.  
                        animation: {
                            speed: 2500
                        },
                        barWidth: 15,
                        barPadding: -15,
                        barMargin: 0,
                        highlightMouseOver: false
                    }
                }, 
                {
                    rendererOptions: {
                        // speed up the animation a little bit.
                        // This is a number of milliseconds.
                        // Default for a line series is 2500.
                        animation: {
                            speed: 2000
                        }
                    }
                }
            ],
            axesDefaults: {
                pad: 0
            },
            axes: {
                // These options will set up the x axis like a category axis.
                xaxis: {
                    tickInterval: 1,
                    drawMajorGridlines: false,
                    drawMinorGridlines: true,
                    drawMajorTickMarks: false,
                    rendererOptions: {
                    tickInset: 0.5,
                    minorTicks: 1
                }
                },
                yaxis: {
                    tickOptions: {
                        formatString: "$%'d"
                    },
                    rendererOptions: {
                        forceTickAt0: true
                    }
                },
                y2axis: {
                    tickOptions: {
                        formatString: "$%'d"
                    },
                    rendererOptions: {
                        // align the ticks on the y2 axis with the y axis.
                        alignTicks: true,
                        forceTickAt0: true
                    }
                }
            },
            highlighter: {
                show: true, 
                showLabel: true, 
                tooltipAxes: 'y',
                sizeAdjust: 7.5 , tooltipLocation : 'ne'
            }
        });
      
    });

</script>
<!-- End example scripts -->
    <script class="include" type="text/javascript" src="lib/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="lib/syntaxhighlighter/scripts/shCore.min.js"></script>
    <script type="text/javascript" src="lib/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
	
	<?php
	echo $gab;
	
	
	
	
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
	
	
	
	
  