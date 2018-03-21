<?php include "config.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Supermarine Spitfire Dastabase - Details</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head> 
<body> 
<div id="main">
<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
	$id = $_GET['id'];
	$checkid = mysqli_query($link, "SELECT * FROM production WHERE id = '".$id."'");
	$row = mysqli_fetch_array($checkid);
	$serial = $row['serial'];
	$number = $row['number'];
	$code = $row['code'];
	$fflight = $row['first_flight'];
	$pilot = $row['pilot'];
	$history = $row['history'];
	$image = $row['image'];

	$checkmark = mysqli_query($link, "SELECT marks.mark, marks.base, marks.variant1, marks.variant2 FROM production INNER JOIN marks ON production.mark = marks.mark where production.id = '".$id."'");
				$marksrow = mysqli_fetch_array($checkmark);
				$mark = $marksrow['mark'];
				$base = $marksrow['base'];
				$var1 = $marksrow['variant1'];	
				$var2 = $marksrow['variant2'];

	$checkengine = mysqli_query($link, "SELECT engines.name, engines.manufacturer, engines.take_off_power, engines.combat_power, engines.notes FROM production INNER JOIN engines ON production.engine = engines.variant where production.id = '".$id."'");
				$enginerow = mysqli_fetch_array($checkengine);
				$engine = $enginerow['name'];
				$manf = $enginerow['manufacturer'];
				$topower = utf8_encode($enginerow['take_off_power']);
				$cpower = utf8_encode($enginerow['combat_power']);
				$engnotes = utf8_encode($enginerow['notes']);

	$checkfactory = mysqli_query($link, "SELECT factories.description FROM production INNER JOIN factories ON production.factory = factories.factory where production.id = '".$id."'");
				$factoryrow = mysqli_fetch_array($checkfactory);
				$factory = $factoryrow['description'];

	$checksquadron = mysqli_query($link, "SELECT squadrons.name FROM production INNER JOIN squadrons ON production.squadron = squadrons.id where production.id = '".$id."'");
				$squadronrow = mysqli_fetch_array($checksquadron);
				$squadron = $squadronrow['name'];

	$checkmaintenance = mysqli_query($link, "SELECT maintenance.name, maintenance.airfield, maintenance.equipment, maintenance.notes FROM production INNER JOIN maintenance ON production.maintenance_unit = maintenance.id where production.id = '".$id."'");
				$maintenancerow = mysqli_fetch_array($checkmaintenance);
				$maintenanceunit = $maintenancerow['name'];
				$maintenanceafld = $maintenancerow['airfield'];
				$maintenanceequip = $maintenancerow['equipment'];
				$maintenancenotes = $maintenancerow['notes'];

     ?> 
	<img src="images/supermarine.png" alt="logo" style="width:30%;height:30%;">
	<!-- <p>Southampton, Eng.</p><p>TELEPHONE: WOOLSTON 37 (2 LINES).  CABLES and TELEGRAMS: "SUPERMARINE" SOUTHAMPTON.</p><br/> -->
    	<h1>Supermarine Spitfire Database</h1>
	<p><code><?=$_SESSION['Username']?></code> is logged into session <code><?=$_SESSION['LoggedIn']?></code>. <a href=logout.php>Logout</a>.</p>
         

	<p><br /><br /></p>

	
<?php
		echo "<h3>Details for Supermarine Spitfire $serial:</h3><br/><p><a href=search.php>Search again</a>.</p><br/><img src=\"images/$image\" alt=\"image\" style=\"width:600px;height:auto;\">";
		echo "</h1><table style=\"width:100%\"><tr><th>Serial:</th><th>Number:</th><th>Code:</th><th>First Flight:</th></tr>";
		echo "<tr><td>$serial</td><td>$number</td><td>$code</td><td>$fflight</td></tr>";		
		echo "<p><br/></p>";
	
		echo "</h1><table style=\"width:100%\"><tr><th>Mark:</th><th>Base:</th><th>Variant:</th></tr>";
		echo "<tr><td>$mark</td><td>$base</td><td>$var1 $var2</td></tr>";	
		echo "<p><br/></p>";

		echo "</h1><table style=\"width:100%\"><tr><th>Engine:</th><th>Manufacturer:</th><th>Specifications:</th><th>Notes:</th></tr>";
		echo "<tr><td>$engine</td><td>$manf</td><td>$topower $cpower</td><td>$engnotes</td></tr>";	
		echo "<p><br/></p>";

		echo "</h1><table style=\"width:100%\"><tr><th>Factory:</th></tr>";
		echo "<tr><td>$factory</td></tr>";	
		echo "<p><br/></p>";

		echo "</h1><table style=\"width:100%\"><tr><th>Squadron:</th><th>Pilot:</th></tr>";
		echo "<tr><td>$squadron</td><td>$pilot</td></tr>";	
		echo "<p><br/></p>";

		echo "</h1><table style=\"width:100%\"><tr><th>Maintenance Unit:</th><th>Airfield:</th><th>Equipment:</th><th>Notes:</th></tr>";
		echo "<tr><td>$maintenanceunit</td><td>$maintenanceafld</td><td>$maintenanceequip</td><td>$maintenancenotes</td></tr>";	
		echo "<p><br/></p>";

		echo "</h1><table style=\"width:100%\"><tr><th>History:</th></tr>";
		echo "<tr><td>$history</td></tr>";	
		echo "<p><br/></p>";


	
}
else
{
    	?>

		<p>Not logged in. <a href=index.php>Login</a>.</p>

   <?php
}

?>

</div>
</body>
</html>
