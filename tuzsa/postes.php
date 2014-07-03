<?php
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
		// remove the first part of the web
		$posicion = stripos($page, "Imprimir</a></td></tr></table>");
		$pageAux = substr($page, $posicion + 30 , strlen($page));
		// remove the last part
		$posicion = stripos($pageAux, "</form>");
		$pageAux = substr($pageAux, 0, $posicion);
		// remove the google map and the information about the line
		$posicion = stripos($pageAux, '<td valign="top" width="550">');
		$pageAux = substr($pageAux, 0, $posicion);
		$pageAux = $pageAux . "</tr></table>";

		// para luego poder hacerle cambios de estilo añado id's a las tablas
		$posicion = stripos($pageAux, '<table', 15);
		$pageAux = substr($pageAux, 0, $posicion) . "<table class='tablaCabecera'" . substr($pageAux, $posicion + 6, strlen($pageAux));
		$posicion = strripos($pageAux, '<table');
		$pageAux = substr($pageAux, 0, $posicion) . "<table class='tablaRecorrido'" . substr($pageAux, $posicion + 6, strlen($pageAux));

		// replace the links from relatives to absolutes
		$pageAux = str_replace("images/CirculoCab.gif", "http://www.tuzsa.es/images/CirculoCab.gif", $pageAux);
		$pageAux = str_replace("images/CirculoCadRojo.gif", "http://www.tuzsa.es/images/CirculoCadRojo.gif", $pageAux);

		return $pageAux;
	}
?>	

<?php
	$LINEASEL = $_GET['LINEASEL'];	
	//$LINEASEL = $_POST['LINEASEL'];
	$SENTIDOSEL = $_GET['SENTIDOSEL'];	
	//$SENTIDOSEL = $_POST['SENTIDOSEL'];
	
	if($LINEASEL){
		$html = getPage("http://www.tuzsa.es/tuzsa_frm_esquemaparadas.php?LINEASEL=" . $LINEASEL . "&SENTIDOSEL=" . $SENTIDOSEL);
		$html = getPortion($html);

		echo $html;
	}
?>