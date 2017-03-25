<div style="width: 1174px; margin: 0 auto;">
	<div class="camposbusca" style="width: 100%; padding: 0px 15px;">
		<input type="text" id="buscar" name="busca">
		<a href="#" style="" id="buscarbotao" title="busca dominio">Buscar Dominio</a>	
	</div>
	<div style="float: left; width: 40%; padding: 0px 15px;">
		<h3>Buscar</h3>
		<table>
			<thead>
				<tr>
					<th style="border: 2px solid #000;">Dominios</th>
					<th style="border: 2px solid #000;">Opção</th>
				</tr>
			</thead>
			<tbody id="mostradomino">
				
			</tbody>
		</table>	
	</div>
	<div style="float: left;width: 40%; padding: 0px 15px;">
		<?php 
			require_once('conexao.php');
			$sql = "SELECT * FROM dominios WHERE escolhido = 1";
			$result = $mysqli->query($sql);
		?>
		<h3>Escolhidos</h3>
		<table class="table">
			<thead>
				<tr>
					<th style="border: 2px solid #000;">Dominios</th>
					<th style="border: 2px solid #000;">Data Cadastro</th>
					<th style="border: 2px solid #000;"></th>
					<th style="border: 2px solid #000;"></th>
				</tr>
			</thead>
			<tbody id="escolhidos">
				<?php if($result->num_rows){ ?>
					<?php while($dados = $result->fetch_array(MYSQLI_ASSOC)){ ?>
						<tr>
							<td><?php echo $dados['dominio'] ?></td>
							<td style="text-align: right;"><?php echo $dados['data'] ?></td>
							<td><a href="#" style="color:red;" onClick="naoqueroesse(<?php echo $dados['dominios_id'] ?>);" title="">Não Quero!</a></td>
							<td><a href="https://registro.br/cgi-bin/nicbr/documento?fqdn=<?php echo $dados['dominio'] ?>" target="_blank" style="color:#5cc773;" title="">Registrar</a></td>
						</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<script src="jquery-3.2.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="script.js" type="text/javascript" charset="utf-8"></script>