<?php
print "<?xml version=\"1.0\"?>\n<!DOCTYPE html PUBLIC \"-//WAPFORUM//DTD XHTML Mobile 1.0//EN\" \"http://www.wapforum.org/DTD/xhtml-mobile10.dtd\">";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><title>HEADERS</title></head>
	<body >
	<?php 
	echo var_dump($_SERVER);
	echo 'Linea telefonica?' . $_SERVER['HTTP_X_UP_CALLING_LINE_ID'];
	$bla = $_SERVER['REMOTE_ADDR'];
	echo "<li>REMOTE_ADDR = $bla</li>";
	foreach($_SERVER as $h=>$v)
		if(ereg('HTTP_(.+)',$h,$hp))
			echo "<li>$h = $v</li>\n";
	?>
	</body>
</html>



