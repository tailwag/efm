<html>
<head>
<title>~Essex File Server~</title>
<style>
	@import 'https://fonts.googleapis.com/css?family=Oswald';
	body {
		background-color: #333333;
		font-family: 'Oswald', sans-serif;
	}
	div.list {
		margin-left: 30px;
		margin-right: auto;
	}
	h1,b,p {
		color: #EEEEEE;
	}
	a {
		color: #FFFFFF;
		text-decoration: none;
	}
	a:hover {
		text-decoration: underline;
	}
	img.folder {
		height: 22px;
		margin: 0px;
	}
	img.logo {
		max-width: 400px;
	}
</style>
</head>
<body>

<h1>essex file manager</h1>
<!--<img class="logo" src="logo.png">-->
<br>

<!-- Protected Area -->
<!-- <a href="Protected">Protected Area</a> -->
<!-- <br><br> -->
<!-- END -->


<?php
// Sets sirectory
if (isset($_GET['dir'])) {
	$travcheck = explode("/", $_GET['dir']);
	if ($travcheck[0] == "..") {
		$dir = "./";
	}
	else {	
		$dir = $_GET['dir'];
	}
}
else {
	$dir = '.';
}


// Echoes current working directory
if ($dir != '.') {
	$diray = explode('/', $dir);
	$slashcount = -1;
	foreach ($diray as $useless) {
		++$slashcount;
	}

	echo "<b>".$diray[$slashcount]."</b>\n";
	echo "<br><br>\n";
}



//Create array from all files in directory
$files = scandir($dir);
echo "<table>\n";
foreach ($files as $file) {
if ($file != "index.php" && $file != ".index.php.swp" && $file != "." && $file != ".index.php.swo" &&
	$file != ".." && $file != ".folder.png" && $file != ".file.png" && $file != ".htaccess" && 
	$file != ".htpasswd" && $file != "Protected" && $file != ".well-known" && $file != "404.png" && 
	$file != "403.png" && $file != "404.html" && $file != "403.html") { 
	
	$isDir = scandir($dir."/".$file);
	if ($isDir == FALSE) {
		// display image for file
		echo "<tr><td>\n";
		echo "<img class=\"folder\" src=\".file.png\">\n";
		
		// create array based on file name separated by .
		$filetype = explode(".", $file);

		//counts number of entries in array, to get last one (file ext)
		$num = -1;
		foreach ($filetype as $dong) {
			++$num;
		}
		$fpath = $dir."/".$file;
		$fisize = filesize($fpath) / 1024 / 1024;
		$fsize = number_format((float)$fisize, 3, '.', '');
		echo "</td><td>\n";
		echo "<a href=\"".$dir."/".$file."\">".$file."</a>\n";
		echo "</td><td>\n";
		echo "<p>&nbsp&nbsp ".$fsize." MB</p>\n";
		echo "</td></tr>\n\n";
	}
	else {
		echo "<tr><td>\n";
		echo "<img class=\"folder\" src=\".folder.png\">\n";
		echo "</td><td>\n";
		echo "<a href=\"index.php?dir=".$dir."/".$file."\">".$file."</a>\n";
		echo "</td></tr>\n\n";
	}
}
}

echo "</table>\n";
?>

</body>
</html>

