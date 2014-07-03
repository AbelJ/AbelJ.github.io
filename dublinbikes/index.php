<html>
	<head>
		<title>Dublin Bikes</title>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />

		<meta name="autor" content="Abel J. Mendivil de Pablo">
		<meta name="author" content="Abel Mendivil">
		
		<link rel="apple-touch-icon" href="./icon.png" />
		<link rel="shortcut icon" href="./icon.png" type="image/x-icon" />
	</head>
	
	<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">
		
		<?php
			function getPage($url){
				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch,CURLOPT_FRESH_CONNECT,TRUE);
				curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
				curl_setopt($ch,CURLOPT_REFERER,'http://www.dublinbikes.ie/');
				curl_setopt($ch,CURLOPT_TIMEOUT,10);
				$html=curl_exec($ch);
				if($html==false){
					$m=curl_error(($ch));
					error_log($m);
				}
				curl_close($ch);
				return $html;
			}
			
			function getColor($items) {
				$color = "black";
				if($items == 0) {
					$color = "red";
				} else if($items < 4) {
					$color = "orange";
				}
				
				return $color;
			}
			
			function paintBikes($stationId){
				$xml = new SimpleXMLElement(getPage("http://www.dublinbikes.ie/service/stationdetails/" . $stationId));
				
				echo "<br/>";
				echo "Bicis disponibles: ";
				echo "<span style='color:".getColor($xml->available[0])."'>" . $xml->available[0] . "</span>";
				echo "<br/>";
				echo "Espacios libres: ";
				echo "<span style='color:".getColor($xml->free[0])."'>" . $xml->free[0] . "</span>";
				echo "<br/>";
			}
		?>

		<b>Ranelagh Rd</b>
		<?php paintBikes(5);?>
		<br/>
		
		<b>Castillo (Dame St.)</b>
		<?php paintBikes(10);?>
		<br/>
		
		<b>Cine (Jervis St.)</b>
		<?php paintBikes(40);?>
		<br/>
		
		<b>Portobello</b>
		<?php paintBikes(34);?>
		<br/>
		
		<b>Parnell St.</b>
		<?php paintBikes(31);?>
		<br/>
		
		<b>Upper Baggot St.</b>
		<?php paintBikes(19);?>
		
		
		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
			try {
				var pageTracker = _gat._getTracker("UA-5505774-1");
				pageTracker._trackPageview();
			} catch(err) {}
		</script>
	</body>
</html>