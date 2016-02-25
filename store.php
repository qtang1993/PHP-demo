<?php 
	session_start();

	$name = $_SESSION['username'];
	$pw = $_SESSION['pw'];
	$num = 0;
	#setcookie($name,0,time()-1);
	if (!isset($_COOKIE[$name])){
		setcookie($name,$pw."&&".$num);
		#echo "no item";
	}else if (isset($_POST['add'])){
		$item = $_POST['add'];
		$str = explode("&&",$_COOKIE[$name]);
		$num = $str[1] + 1;
		$str[1] = $num;
		array_push($str,$item);
		$str = implode("&&", $str);
		setcookie($name,$str);
	}else{
		$str = explode("&&",$_COOKIE[$name]);
		$num = $str[1];
	}
	#echo $_COOKIE["number"];
	echo "<br/><h1>Welcome to the online store, $name </h1><br/>";
	echo "<p class=\"right\">Number of items in the cart: ".$num." </p><br/>";
	
	$file = fopen("store.txt", "r");
  	
  		#direct to store
  
?>
<html>
<head>
<title>Welcome to the online store php</title>
</head>
<style>
p.right{
	text-align:right;
}
</style>
<body> 
	<form action = "login.php" 
		  method="POST" >
		  <p class="right"><input type="submit" name="logout" value="Log out"></p><br/>
	</form>
<table border = "1" width="100%">
	<th>Item</th>
	<th>Image</th>
	<th>Price</th>
	<th> </th>
<?php
	while (!feof($file)){
?>
	<tr align = "center">
	<td>
<?php
	$data = trim(fgets($file));
  	$p = explode("&", $data);
  	echo $p[0];
?> 
	</td>
	<td><?php echo "<img src=$p[1] alt=\"lip1\" width=\"100\" height=\"100\">" ?> </td>
	<td><?php echo $p[2] ?> </td>
	<td>
	<form action = "" 
		  method="POST" >
		  <input type="hidden" name="add" value = "<?php echo $data?>">
		  <input type="submit" name="submit" value="Add to cart">
	</form>
	</td>
	
<?php
	}

?>
	<tr align = "center">
	<td></td>
	<td></td>
	<td></td>
	<td><br/>
	<form action = "checkout.php" 
		  method="POST" >
		  <input type="submit" name="check" value="Check out"><br/><br/>
	</form>
	</td>
	</tr>
	
</table>
</body>
</html>

