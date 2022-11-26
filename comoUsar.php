<!DOCTYPE html>
<html lang="pt-br">
  <head>
     <meta charset="utf-8">
    <title>Como Usar - Tutorial</title>
	 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body> 
  	<?php include 'header.php';?> 
	<br>
	
	
	<div id='site-pc' style=' display:none;'>
	<video width='1400px' controls style=' margin:auto; display: block;'>
				<source src='videobom.mp4' >
				<object>
					<embed src='videobom.mp4'  >  		
				 </object>
			</video>
			
			</div>
			<div id='site-mobile'  style=' display:none;'>
			<video width='380' controls style=' margin:auto; display: block; '>
				<source src='cllsite.mp4' >
				<object>
					<embed src='cllsite.mp4'  >  		
				 </object>
			</video>
			</div>
	
<script>
	var sitepc = document.getElementById('site-pc');
	var sitemobile = document.getElementById('site-mobile');
		var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
		if(w >800){
			sitepc.style.display = 'block';
		} else {
			sitemobile.style.display = 'block';
		}</script>
 
  </body>
</html>