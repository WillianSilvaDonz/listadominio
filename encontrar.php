<?php 
	$json = array();
	if($_POST['buscar']){
		require_once('conexao.php');
		$sql = "SELECT * FROM dominios WHERE dominio LIKE '".$_POST['buscar']."' ORDER BY dominio";
		$result = $mysqli->query($sql);
  		while($dados = $result->fetch_array(MYSQLI_ASSOC)){
  			$json['dominios'][] = array(
  				'codigo' => $dados['dominios_id'],
  				'escolhido' => $dados['escolhido'],
  				'dominio' => $dados['dominio']
			);
  		}
		echo json_encode($json);
	}else{
		$json['error'] = "Campo busca é obrigatório";
		echo json_encode($json);
	}
?>