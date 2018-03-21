<?php include "config.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Supermarine Spitfire Dastabase - Search</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head> 
<body> 
<div id="main">
<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
     ?> 
    <img src="images/supermarine.png" alt="logo" id="logo" style="width:30%;height:30%;">
        <h1>Supermarine Spitfire Database</h1>
    <p><code><?=$_SESSION['Username']?></code> is logged into session <code><?=$_SESSION['LoggedIn']?></code>. <a href=logout.php>Logout</a>.</p>
          
 
    <p><br /><br /></p>
    <form method="post" action="search.php" name="infoform" id="infoform">
    <fieldset>
        <label for = "search_key">Search key:<input type="text" name="search_key" id="search_key" /><br />
        <input type="submit" name="search" id="search" value="Search" />
        </fieldset>
        </form>
 
 
<?php
//}
 
    if(!empty($_POST['search_key']))
    {
        $search = mysqli_real_escape_string($link, htmlspecialchars($_POST['search_key'] , ENT_QUOTES, "utf-8"));
 
        $checkserial = mysqli_query($link, "SELECT * FROM production WHERE serial = '".$search."'"); 
        $checkmark = mysqli_query($link, "SELECT * FROM production WHERE mark = '".$search."'"); 
        $checknumber = mysqli_query($link, "SELECT * FROM production WHERE number = '".$search."'");
         
        $header="<h3><br/>Search results for \"$search\":</h3><table style=\"width:100%\">
                <tr><th>Serial:</th><th>Number:</th><th>Mark:</th><th>Engine:   </th><th>Factory:</th><th>Details:</th></tr>";
 
            if(mysqli_num_rows($checkserial) == 1)
        {
            $row = mysqli_fetch_array($checkserial);
            $id = $row['id'];
                $serial = $row['serial'];
            $mark = $row['mark'];
            $number = $row['number'];
            $checkengine = mysqli_query($link, "SELECT engines.name FROM production INNER JOIN engines ON production.engine = engines.variant where production.id = '".$id."'");
                $enginerow = mysqli_fetch_array($checkengine);
                $engine = $enginerow['name'];
            $checkfactory = mysqli_query($link, "SELECT factories.description FROM production INNER JOIN factories ON production.factory = factories.factory where production.id = '".$id."'");
                $factoryrow = mysqli_fetch_array($checkfactory);
                $factory = $factoryrow['description'];
 
                echo $header;
            echo "<tr><td>$serial</td><td>$number</td><td>$mark</td><td>$engine</td><td>$factory</td><td><form method=\"get\" action=\"details.php\"><input type=\"hidden\" name=\"id\" value=\"$id\"><input type=\"submit\" value=\"Click here for full details\"></form></td></tr>";      
            echo "</table>";
        }
        else if(mysqli_num_rows($checkmark) > 0)
        {
            echo $header;
            while($row = mysqli_fetch_array($checkmark))
            {
                $id = $row['id'];
                    $serial = $row['serial'];
                $mark = $row['mark'];
                $number = $row['number'];
                $checkengine = mysqli_query($link, "SELECT engines.name FROM production INNER JOIN engines ON production.engine = engines.variant where production.id = '".$id."'");
                    $enginerow = mysqli_fetch_array($checkengine);
                    $engine = $enginerow['name'];
                $checkfactory = mysqli_query($link, "SELECT factories.description FROM production INNER JOIN factories ON production.factory = factories.factory where production.id = '".$id."'");
                    $factoryrow = mysqli_fetch_array($checkfactory);
                    $factory = $factoryrow['description'];
                 
                echo "<tr><td>$serial</td><td>$number</td><td>$mark</td><td>$engine</td><td>$factory</td><td><form method=\"get\" action=\"details.php\"><input type=\"hidden\" name=\"id\" value=\"$id\"><input type=\"submit\" value=\"Click here for full details\"></form></td></tr>";      
            }
            echo "</table>";
        }
        else if(mysqli_num_rows($checknumber) == 1)
        {
            $row = mysqli_fetch_array($checknumber);
            echo $header;
            $id = $row['id'];
                $serial = $row['serial'];
            $mark = $row['mark'];
            $number = $row['number'];
            $checkengine = mysqli_query($link, "SELECT engines.name FROM production INNER JOIN engines ON production.engine = engines.variant where production.id = '".$id."'");
                $enginerow = mysqli_fetch_array($checkengine);
                $engine = $enginerow['name'];
            $checkfactory = mysqli_query($link, "SELECT factories.description FROM production INNER JOIN factories ON production.factory = factories.factory where production.id = '".$id."'");
                $factoryrow = mysqli_fetch_array($checkfactory);
                $factory = $factoryrow['description'];
                 
            echo "<tr><td>$serial</td><td>$number</td><td>$mark</td><td>$engine</td><td>$factory</td><td><form method=\"get\" action=\"details.php\"><input type=\"hidden\" name=\"id\" value=\"$id\"><input type=\"submit\" value=\"Click here for full details\"></form></td></tr>";      
            echo "</table>";
        }   
            else
            {
                echo "<h3><br/>Error for search key \"$search\"</h3>";
                echo "<p>Sorry, there is no record for that search key entered.</p>";
            }
    }
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
