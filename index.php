<?php

  //Verifica se foi realizado a busca de alguma cidade
  if(isset($_GET['buscar'])){

  	$codigoCidade = $_GET['cidade'];

  }else{

    //Caso não tenha sido, é atribuido por padrão o código de pesquisa da cidade de caruaru
  	$codigoCidade = "455852";


  }

  	$url = "https://api.hgbrasil.com/weather?woeid=".$codigoCidade."&key=110c5339";

    //Buscando informações da cidade na APi através do curl
  	$ch = curl_init($url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	$previsao = json_decode(curl_exec($ch));

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<title></title>
	</head>
	<body>
		<form action="" method="GET" class="form-cidade">
			<select name="cidade" class="cidade">
				<option onselect>Selecionar cidade</option>
				<option value="455852">Caruaru</option>
				<option value="455950">Garanhuns</option>
				<option value="456398">Paulista </option>
				<option value="455980">Petrolina</option>
				<option value="455824">Recife</option>
				<option value="461334">Tamandaré</option>
			</select>
			<button class="butao-bsucar" name="buscar" type="submit"><span class="sr-only">Buscar</span></button>
		</form>
	<div class="exibePrevisao">
        <!--Carrega informações do dia atual -->
			<p class="localidade">
				<span class="localidade-cidade"><?php echo $previsao->results->city; ?></span>
				
				<span class="localidade-uf"></span>
			</p>
		<div class="card-tempo">
			<p class="card-tempo-hoje"><?php echo $previsao->results->date; ?></p>
			<div class="card-tempo-bloco">
				<p class="card-tempo-temperatura"><span class="card-tempo-temperatura-temp"><?php echo $previsao->results->temp; ?>º</span></p>
				<p class="card-tempo-condicao"><?php echo $previsao->results->description; ?></p>
			</div>
		    <div class="card-tempo-caracteristicas">
				<p class="card-tempo-caracteristica card-tempo-caracteristicas-umidade">
					<span class="card-tempo-caracteristica-label">Umidade:</span>
					<span class="card-tempo-caracteristica-valor card-tempo-caracteristicas-umidade-valor"><?php echo $previsao->results->humidity; ?>%</span>
				</p>
				<p class="card-tempo-caracteristica card-tempo-caracteristicas-sensacao">
					<span class="card-tempo-caracteristica-label">Previsão pôr do sol: </span>
					<span class="card-tempo-caracteristica-valor card-tempo-caracteristicas-sensacao-valor"><?php echo $previsao->results->sunset; ?></span>
				</p>
				<p class="card-tempo-caracteristica card-tempo-caracteristicas-vento">
					<span class="card-tempo-caracteristica-label">Vento: </span>
					<span class="card-tempo-caracteristica-valor card-tempo-caracteristicas-vento-valor"><?php echo $previsao->results->wind_speedy; ?></span>
				</p>
		    </div>
		</div>
		<div class="card-tempo-semana">
            <!--Carrega previsões dos próximos dias da semana -->
			<?php foreach($previsao->results->forecast as $previsaoSemana): ?>
				<div class="card-tempo-semana-dia semana-dia-1">
					<p class="card-tempo-semana-dia-data"><?php echo $previsaoSemana->date; ?></p>
					<div class="card-tempo-semana-temp-max">
						<span id="desc" class="card-tempo-semana-temp-max-val"><?php echo $previsaoSemana->description; ?>º</span>
					</div>
					<div class="card-tempo-semana-temp-max">
						<span class="sr-only">Max:</span>
						<span class="card-tempo-semana-temp-max-val"><?php echo $previsaoSemana->max; ?></span>º
					</div>
					<div class="card-tempo-semana-temp-min">
						<span class="sr-only">Min:</span>
						<span class="card-tempo-semana-temp-min-val"><?php echo $previsaoSemana->min; ?></span>º
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>   
	</body>
</html>