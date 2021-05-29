<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> Вот это да </title>
	<style>
	body {
	background-color: #3d365e;
	}
	#canvas{
	display:block;
	margin:auto;
	box-shadow:2px 2px 21px black;
	}
	#health{
	text-align:center;
	color:white;
	font-family: Helvetica;
	font-style: italic;
	font-size:50px;
	text-shadow:2px 3px 2px black;
	margin-top: -10px;
	margin-bottom: 5px;
	}
	.list{
		margin:auto;
		width:250px;
		
	}
	
	ol li {
		
		font-family:helvetica;
		font-size:25px;
		color:white;
		text-shadow:2px 3px 2px black;
	}
	.res{
		color:#f27777;
	}
	.again{
	
	color:#d4fcd6;
	font-family: Helvetica;
	font-style: italic;
	font-size:60px;
	text-shadow:2px 3px 2px black;
	text-decoration:none;
	margin:-20px;
	
	}
	.dr1{
		width:400px;
		height:400px;
		display:block;
		float:left;
		margin-top:50px;
		margin-left:180px;
		
	}
	.dr2{
		width:400px;
		height:400px;
		display:block;
		float:right;
		margin-top:50px;
		margin-right:220px;
		
		
	}
	
	</style>
</head>
<body>
<?php

if (isset($_GET['score'])){
	$res = $_GET['score'];
	echo ('<h1 id="health">Ваш счет - <span class="res">' . $res . '</span></h1>');
}
$con = 'mysql::host=127.0.0.1;dbname=results';
$ress = new PDO ($con, 'root', 'root');
$add = 'INSERT INTO `score` (result) VALUES (:vvv)';
$query = $ress->prepare($add);
$query->execute(['vvv'=>$res]);
?>
<br>
<h1 id="health">Лучшие результаты: </h1>
<hr>
<img class="dr1" src="img/7.png">
<img class="dr2" src="img/6.png">
<div class="list">
<ol>
<?php
$show = $ress->query('SELECT * FROM `score` ORDER BY `result` DESC LIMIT 10 ');
$show->setFetchMode(PDO::FETCH_ASSOC);

while ($final = $show->fetch()){
echo '<li>Score - <span class="res">' . $final['result'] . '</span></li><br>';
}


?>





</ol>
</div>
<div class="list">
<a class="again" href="index.php">Еще раз! </a>
</div>
</body>
</html>