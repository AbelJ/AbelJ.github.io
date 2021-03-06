<html>
	<head>
		<title>iMarcador</title>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />

		<meta name="autor" content="Abel J. Mendivil de Pablo">
		<meta name="author" content="Abel Mendivil">
		<meta name="Description" content="Web diseñada para iPhone 3g para consultar el resultado de los partidos de Primera y Segunda división">		
		<meta name="ROBOTS" content="index,follow">
		<meta name="Keywords" content="iphone, imarcador, abel, futbol, liga, resultados, marcador, marcadores, primera, segunda, division">

		<link rel="apple-touch-icon" href="./images/iMarcador.png" />
		<link rel="shortcut icon" href="./images/iMarcador.png" type="image/x-icon" />

		<link rel="stylesheet" href="../css/iphone.css" />
		<!-- TODO: sacar este style a un fichero... -->
		<style type="text/css">			
			.lblDivision {    		
	    	font-family: Helvetica;
	    	font-size: 21px;
				font-weight: bold;
				text-decoration: none;		
		</style>

		<script>
			function postLoad(){
				setTimeout(function(){window.scrollTo(0, 1);}, 100);

				if(document.getElementsByTagName("h6").length == 1){
					document.getElementsByTagName("h6")[0].className = "lblDivision";
				}else{
					alert('Ha ocurrido un error');
				}
			}
		</script>
	</head>
	<body onload="postLoad()">
		<div id="header">
  		<h1>iMarcador</h1>
		</div>
		
		<?php
			function lastIndexOf($instr, $sub_str) {
				if(strstr($instr,$sub_str)!="") {
			  	$auxStr = strrev($sub_str);
					return(strlen($instr)-strpos(strrev($instr),$auxStr));
				}
				return(-1);
			} 
		
			function getPage($url){
				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch,CURLOPT_FRESH_CONNECT,TRUE);
				curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
				curl_setopt($ch,CURLOPT_REFERER,'http://www.marca.com/');
				curl_setopt($ch,CURLOPT_TIMEOUT,10);
				$html=curl_exec($ch);
				if($html==false){
  					$m=curl_error(($ch));
  					error_log($m);
				}
				curl_close($ch);
				return $html;
			}
	
			function getPortion($page){
				$posicionInicial = stripos($page, '<div class="tabcontent"><h6>');
				$fragmentoAuxiliar = substr($page, $posicionInicial, strlen($page));
				$posicionFinal = stripos($fragmentoAuxiliar, '</div>');
				$posicionFinal = $posicionFinal + 6; // 6 es la longitud de </div>
			
				$pageAux = substr($page, $posicionInicial, $posicionFinal);
				$pageAux = substr($pageAux, 0, lastIndexOf($pageAux, "<tr") - 3) . substr($pageAux, lastIndexOf($pageAux, "</tr>"), strlen($pageAux));
								
				return $pageAux;
			}

			function metodoAlternativo($page){
				$xml = simplexml_load_string($data);
				foreach ($xml->mensaje as $mensaje)
  				echo $mensaje->texto.' ';
			}

			$division = $_GET['division'];
			if((! $division)||(($division != 1)&&($division != 2))){
				$division = 1;
			}
			
			$html=getPage('http://www.marca.com/futbol/'.$division.'adivision.html');	
			//$toShow = getPortion($html);
			metodoAlternativo($html);
			//echo $toShow;
		?>
		
		<table>
			<tr>
				<td colspan=3>
					<a href="./index2.php?division=1" class="button green">1ª división</a>
					<a href="./index2.php?division=2" class="button green">2ª división</a>
				</td>
			</tr>

			<tr>
				<td colspan=3 align="right">
					© <a href="http://www.abelmendivil.es">Abel J. Mendivil</a> 2008/09
				</td>
			</tr>
			
		</table>
		
	</body>
	
	<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
		var pageTracker = _gat._getTracker("UA-5505774-1");
		pageTracker._trackPageview();
	</script>
		
</html>