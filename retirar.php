<?php 
	require_once('conexao.php');
	$json = array();
	if($_POST['codigo']){
		require_once('conexao.php');
		$sql = "UPDATE dominios SET escolhido = 0 WHERE dominios_id = ".$_POST['codigo'];
		$result = $mysqli->query($sql);
		$sql = "SELECT * FROM dominios WHERE escolhido = 1 ORDER BY dominio";
		$result = $mysqli->query($sql);
		$json['dominios'] = array();
  		while($dados = $result->fetch_array(MYSQLI_ASSOC)){
  			$json['dominios'][] = array(
  				'codigo' => $dados['dominios_id'],
  				'escolhido' => $dados['escolhido'],
  				'data' => $dados['data'],
  				'dominio' => $dados['dominio']
			);
  		}
  		$json['sucesso'] = "Escolhido com Sucesso!";
		echo json_encode($json); 
	}
?>