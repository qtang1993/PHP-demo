<?php  	
  $check = false;
  $registered = false;
  $un = "";
  $pw = "";
  if (isset($_POST['login']) || isset($_POST['register'])){
  	$un = $_POST['username'];
  	$pw = $_POST['password'];
  	#check if the user already signed up

  	$file = fopen("buyer.txt", "r");
  	while (!feof($file)){
		$data = trim(fgets($file));
  		$p = explode(":", $data);
  		if ( strcmp($un, $p[0]) == 0 && strcmp($pw, $p[1])== 0){
  			$check = true;
  			if (isset($_POST['login'])){
  				session_start();
  				$_SESSION['username'] = $un;
  				$_SESSION['pw'] = $pw;
  				#direct to store
  				header("Location: store.php");
  			}
  			if (isset($_POST['register'])){
  				$registered = true;
  			}
  			break;
  		}
  	}
  	fclose($file);	
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>login page</title>
</head>
<style>
.center{
	text-align:center;
}
</style>
<body>
<h1 align ="center">Online Market</h1>
<h2 align = "center">Log in to continue</h2>
<div class = "center">
<?php 
	  if (!$check && isset($_POST['login']))
  		echo "You have not registered!";
  	  if ($registered && isset($_POST['register']))
  		echo "You have registered! Please login";
  	  if (!$registered && isset($_POST['register'])){
  	    $file = fopen("buyer.txt", "a");
  	    $str = "\n".$un.":".$pw;
  	    fwrite($file,$str);
  	    fclose($file);
  	  	echo "Successfully registered!";
  	  }
?>
</div>
<form action = ""
	  method = "POST">
	  <div class="center">
	  <input type="text" name="username" size="30" maxlength="30" placeholder="username">
	  <br/><br/>
	  <input type="text" name="password" size="30" maxlenght="30" placeholder="password">
	  <br/><br/>
	  <input type="submit" name = "login" value = "Login">
	  <input type="submit" name = "register" value = "Register">
	  </div>
</form>
</body>
</html>