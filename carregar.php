<?php
	require_once('conexao.php');
	$ponteiro = fopen('lista.txt', "r");
	$dominio = array();
	while (!feof($ponteiro)) {
		$linha = fgets($ponteiro, 4096);
		$arraylinha = explode('.br',$linha);
		//print_r($arraylinha);
		$dominio[] = (isset($arraylinha[0]))?trim($arraylinha[0].".br"):"";
		$dominio[] = (isset($arraylinha[1]))?trim($arraylinha[1].".br"):"";
		//$poslinha = strpos($linha, ".br");
		//$linha = substr($linha, 0, $poslinha).".br";
		//echo $linha."<br>";
	}
	$arraylimpo = array_filter($dominio);
	$contador = count($dominio);
	echo 'Quantidade: '.$contador;
	//print_r($dominio);
  	# Realiza a consulta na tabela
  	foreach ($arraylimpo as $key => $value) {
  		$query = "INSERT INTO dominios SET data = NOW(), dominio = '".$value."'";
  		$queryretor = $mysqli->query($query);
  	}

	fclose($ponteiro);
 ?>

