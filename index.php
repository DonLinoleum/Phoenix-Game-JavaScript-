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
	.res{
		color:#f27777;
	}
	.dr1{
		width:200px;
		height:200px;
		display:block;
		float:left;
		margin-top:300px;
		margin-left:0px;
		
	}
	.dr2{
		width:200px;
		height:200px;
		display:block;
		float:right;
		margin-top:300px;
		margin-right:0px;
		
		
	}
	.dr2:hover{
		transform: rotate(220deg);
	}
	.dr1:hover{
		transform: rotate(220deg);
	}
	#ax1{
		width:150px;
		height:150px;
		display:block;
		float:right;
		margin-left: -150px;
		margin-top: 50px;
		transition-property: transform;
		transition-duration:5s
		
	}
	#ax2{
		width:150px;
		height:150px;
		display:block;
		float:left;
		
		margin-right:-150px;
		margin-top: 50px;
		transition-property: transform;
		transition-duration:5s
	}
	
	
	</style>
</head>

<body >

<h1 id="health"> Health </h1>
<img id="ax1" src="img/10.png">
<img id="ax2" src="img/10.png">
<img class="dr1" src="img/4.png">
<img class="dr2" src="img/5.png">
<script>
var axe1 = document.getElementById('ax1');
var axe2 = document.getElementById('ax2')
setInterval(Shield,5000);
setInterval(Shield2,10000);
var x =40;
var x2 = -40;

function Shield (){
axe1.style.transform = 'rotate(' + x + 'deg)';
axe2.style.transform = 'rotate(' + x2+ 'deg)';
}
function Shield2 (){
axe1.style.transform = 'rotate(' + x2 + 'deg)';
axe2.style.transform = 'rotate(' + x+ 'deg)';
}
</script>

<canvas id="canvas" width="1000" height="600"></canvas>

<script>

var ctx = document.getElementById("canvas");
var cvs = ctx.getContext ("2d");
var heal = document.getElementById("health");

var fon = new Image();
var bird = new Image();
var arrow = new Image();
var fireball = new Image();
var end = new Image();
var axe = new Image ();

fon.src = "img/fon.jpg";
bird.src = "img/1.png";
arrow.src = "img/arrow.png";
fireball.src = "img/2.png";
end.src = "img/3.png";
axe.src = "img/8.png";

var xPos = 50;
var yPos = 50;
var xPos2 = 1350;
var yPos2 = 1350;
var size1 = 30;
var size2 = 30;
var rot = 0;

var grav = 2;
var zdorovje = 100;
var score = 0;
var speedX = 9;

// Счетчик очков
setInterval (function(){
		score = score + 10;
	}, 1000);


document.addEventListener("keydown", Move);

// Движение при нажатии любой клавиши
function Move(){
	yPos = yPos - 20;
}

// Массив с топорами
var axes = [];
axes[0] = {
	x:950,
	y:50
}

//Массив со стрелами 
var arrows = [];
arrows[0] ={
	x : 900,
	y:250
} 

function Main(){
	cvs.drawImage (fon,0,0,1000,600);
	cvs.drawImage (bird,xPos,yPos, 150,150);
	cvs.drawImage(fireball, xPos2,yPos2,size1,size2);
	// огонь при попадании
	function fire(){
			size1 = size1+1;
			size2 = size2 + 1;
			xPos2 = xPos2 - 0.5;
			
			setTimeout(fireStop,400);
			
			}
			
	function fireStop(){
		clearInterval(fireID);
		size1 = 30;
		size2 = 30;
		xPos2 = 1550;
		yPos2 = 1550;
	}
	// здоровье равно 0
	function gameEnd(){
		alert("О нет! Феникс погиб.....Надо попробовать еще раз!");
		clearInterval(end);
		document.location.href = "result.php?score=" + score;
	}
	
	// Гравитация 
	yPos = yPos + grav;
	if (yPos >= 480){
		yPos = 480;
	}
	else if (yPos <= -50){
		yPos = -50;
		}
	// Если score = 200, увеличиваем скорость стрел 
	heal.innerHTML = "Health : <span class='res'>" + zdorovje + "</span>, Score : <span class='res'>" + score + '</span>';
	if (score>=200){
		speedX = 11;
		}
	
	// Если score = 350 появляются топоры 
	if (score>=350){
	for (var i = 0; i<axes.length; i++){
	
		
		cvs.drawImage(axe,axes[i].x,axes[i].y,100,100);
		axes[i].x = axes[i].x - 5;
		
		
		
		
		if (axes[i].x == 200){
			axes.push({
			x:900,
			y: Math.floor(Math.random()*100*6-50)
			})
		}
	// Коллизия с топорами 
	if (xPos+60 >= axes[i].x && xPos-60 <= axes[i].x
	&& axes[i].y >= yPos-60 && axes[i].y <= yPos+80) 
	{
		zdorovje = zdorovje - 10;
		axes[i].x = -200;
		xPos2 = xPos+45;
		yPos2 = yPos+55;
		fireID = setInterval(fire, 2);
		}
		
		
	}
	}
	// Рисуем стрелы 
	for (var i = 0 ; i<arrows.length; i++){
		cvs.drawImage(arrow,arrows[i].x,arrows[i].y, 100,100);
		arrows[i].x = arrows[i].x - speedX; 
		
	if (arrows[i].x <= 600 && arrows[i].x >= 592  ){
		arrows.push({
			x:900,
			y:Math.floor (Math.random()*100*6-50)
			});
	}
	// Коллизия со стрелами 
	if (xPos+60 >= arrows[i].x && xPos-60 <= arrows[i].x
	&& arrows[i].y >= yPos-60 && arrows[i].y <= yPos+80) 
	{
		zdorovje = zdorovje - 10;
		arrows[i].x = -200;
		xPos2 = xPos+45;
		yPos2 = yPos+55;
		fireID = setInterval(fire, 2);
		}
	// Здоровье 0, конец игры. 
		if (zdorovje <= 0){
		cvs.drawImage(end,xPos,yPos,150,150);
		end = setInterval(gameEnd,1000);
		
		
		
		}
	}
		requestAnimationFrame(Main);
}



window.onload = Main;


</script>
<footer>
<p>Вот так все и было! </p>
</footer>
</body>
</html>
