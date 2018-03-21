<?php include "config.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Supermarine Spitfire Dastabase</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head> 
<body> 
<div id="main">
<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
     ?> 
     	<img src="images/supermarine.png" alt="logo" style="width:30%;height:30%;">
    	<h1>Supermarine Spitfire Database</h1><br />
     	<h2>Member's Area</h2>
	<p>User <code><?=$_SESSION['Username']?></code> using email address <code><?=$_SESSION['EmailAddress']?></code> logged in.</p><br/>
        <p><a href=search.php>Continue</a> or <a href=logout.php>Logout</a>.</p>

<?php
}

elseif(!empty($_POST['username']) && !empty($_POST['password']))
{
    $username = mysqli_real_escape_string($link, htmlspecialchars($_POST['username'] , ENT_QUOTES, "utf-8"));
    $password = md5(mysqli_real_escape_string($link, htmlspecialchars($_POST['password'] , ENT_QUOTES, "utf-8")));
    
    $checklogin = mysqli_query($link, "SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'"); 

    if(mysqli_num_rows($checklogin) == 1)
    {
        $row = mysqli_fetch_array($checklogin);
        $email = $row['EmailAddress'];

        $_SESSION['Username'] = $username;
        $_SESSION['EmailAddress'] = $email;
        $_SESSION['LoggedIn'] = session_id();

	echo "<img src=\"images/supermarine.png\" alt=\"logo\" style=\"width:30%;height:30%;\">";
    	echo "<h1>Supermarine Spitfire Database</h1><br />";
        echo "<h2>Success</h2>";
        echo "<p>We are now redirecting you to the member area.</p>";
        echo "<meta http-equiv='refresh' content='=2;index.php' />";
    }
    else
    {
	echo "<img src=\"images/supermarine.png\" alt=\"logo\" style=\"width:30%;height:30%;\">";
    	echo "<h1>Supermarine Spitfire Database</h1><br />";
        echo "<h2>Error</h2>";
        echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>.</p>";
    }
}
else
{
    	?>

     
		<img src="images/supermarine.png" alt="logo" style="width:30%;height:30%;">
    		<h1>Supermarine Spitfire Database</h1><br />
   		<h2>Member's Login</h2>

   	<p>Please login below or <a href="register.php">click here to register</a>.</p><br/>
	<form method="post" action="index.php" name="loginform" id="loginform">
	<fieldset>
        <label for="username">Username:</label><input type="text" name="username" id="username" /><br />
        <label for="password">Password:</label><input type="password" name="password" id="password" /><br />
        <input type="submit" name="login" id="login" value="Login" />
    	</fieldset>
    	</form>

   <?php
}
?>

</div>
</body>
</html>
