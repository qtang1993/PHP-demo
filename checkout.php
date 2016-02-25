<?php
	session_start();
	$name = $_SESSION['username'];
	$pw = $_SESSION['pw'];
	$str = explode("&&",trim($_COOKIE[$name]));
	$str[1] = 0;
	$str = array($str[0],$str[1]);
	$str = implode("&&", $str);
	setcookie($name, $str);
?>
<html>
<head>
<title>check out page</title>
</head>
<style>
h1.center{
	text-align:center;
}

.right{
	text-align:right;
}

</style>
<body>
<?php
  echo "<br/><h1 class=\"center\">Check out</h1><br/><br/>";
?>
<p align = "right">
<form action = "login.php"
	  method = "POST">
	  <div class=right >
	  <input type="submit" name="logout" value="Log out"><br/>
	  </div>
</form>
<table border = "1" width="100%">
	<th>Item</th>
	<th>Image</th>
	<th>Price</th>
<?php
	$temp = trim($_COOKIE[$name]);
	$items = explode("&&", $temp);
	if (count($items) > 2){
		for ($i = 2; $i < count($items); $i++){
			
  			$p = explode("&", $items[$i]);
	
?>
	<tr align = "center">

	<td><?php echo $p[0]; ?></td>
	<td><?php echo "<img src=$p[1] alt=\"lip1\" width=\"100\" height=\"100\">" ;?> </td>
	<td><?php echo $p[2]; ?> </td>

	
<?php
	}
}

?>
</body>
</html>
