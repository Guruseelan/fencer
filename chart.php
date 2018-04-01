<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<?php
    $dataPoints = array(
        array("y" => 100, "label" => "option1"),
        array("y" => 40.9, "label" => "option2"),
        array("y" => 50, "label" => "option3"),
        array("y" => 70, "label" => "option4"),
    );
?>

<script type="text/javascript">

   function cal()
   {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "theme2",
            animationEnabled: true,
	
            data: [
            {
                type: "bar",                
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart.render();
    }
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<script src="charts/canvasjs.min.js"></script>

<button onclick="cal()">ggg</button>
</body>
</html>