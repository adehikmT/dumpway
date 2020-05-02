<?php 
require 'fungsi.php';

if($_FILES){
	$ex=uplodau();
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="" enctype="multipart/form-data">
  <input type="file" name="audio">
  <button type="submit">ok</button>
  </form>
</body>
</html>