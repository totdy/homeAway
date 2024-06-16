<?php ob_start(); ?>
<!doctype html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style/style.css">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Righteous|Montserrat" rel="stylesheet">
	<title>HomeAway</title>
</head>
<body>
	<div class="head">
		
		<div class="logo"><a href="index.php" style="text-decoration:none;color:white;"><img id="logo_img" src="img/logo.png">HomeAway</a></div>
		<div class="menu">
				<ul>
		  <li><a href="index.php#home"  >Início</a></li>
		  <li><a href="index.php#services" >Serviços</a></li>
		  <li><a href="index.php#hosped" >Hospedagem</a></li>
		  <li><a href="alojamento.php" class="active">Alojamentos</a></li>
		  <li><a href="index.php#contact">Contacto</a></li>
		  <li class="dropdown" style="float:right;">
					<a href="login.php" class="dropbtn">Login</a>
					<div class="dropdown-content" <?php
													session_start();
													if(!isset($_SESSION["idu"])){
														echo'style="display:none"';
														
													}
													?>>
						<a href="perfil.php?perfil">Meu Perfil</a>
						<a href="sair.php">LogOut</a>
					</div>
				</li>
		</ul>
		</div>
	</div>
	<div class="content">
	<div class="bar"></div>
	<div class="anuncio">
	<?php
	include ("ligabd.php");
	$id=$_GET["id"];
	///////////////////ARRAY DATAS OCUPADAS////////////////////////
	$datas=[];
	$lista="select data_checkin,data_checkout,DAY(data_checkout),MONTH(data_checkout),YEAR(data_checkout) from reserva where cancelado='0' and id_apartamento='".$id."'";
	$faz_lista=mysqli_query($ligabd,$lista);
	$num_registos=mysqli_num_rows($faz_lista);
	for($k=0;$k<$num_registos;$k++){
		$array=mysqli_fetch_array($faz_lista);
		$period = new DatePeriod(
			new DateTime($array["data_checkin"]),
			new DateInterval('P1D'),
			new DateTime($array["data_checkout"])
		);
		foreach($period as $date){
			$datas[]=$date->format('Y-n-j');
		}
		$temp=$array["YEAR(data_checkout)"].'-'.$array["MONTH(data_checkout)"].'-'.$array["DAY(data_checkout)"];
		array_push($datas,$temp);
	}				
	/////////////////////////////////////////////////////
	
	$lista="select * from apartamento where id_apartamento='".$id."'and aprovado='1'";
    $faz_lista=mysqli_query($ligabd,$lista);
    $registos=mysqli_fetch_array($faz_lista); 
	
	/////////////////////////////////////////
	if(isset($_GET["dataci"])&&isset($_GET["dataco"])&&isset($_GET["npessoa"])){
		$dataci=$_GET["dataci"];
		$dataco=$_GET["dataco"];
		$np=$_GET["npessoa"];
		$resdat=[];
		$period = new DatePeriod(
			new DateTime('2019-'.$dataci),
			new DateInterval('P1D'),
			new DateTime('2019-'.$dataco)
		);
		foreach($period as $date){
			$resdat[]=$date->format('Y-n-j');
		}
		array_push($resdat,'2019-'.$dataco);
		$cc=0;
		for($t=0;$t<count($datas);$t++){
			for($f=0;$f<count($resdat);$f++){
				if($resdat[$f]==$datas[$t])$cc++;
			}
		}
		if(!$cc==0){
			echo '<h2 style="background-color:pink;color:black;border:1px solid maroon;margin:10px;border-radius:4px;padding:14px 16px;">As datas escolhidas estão ocupadas.  <a href="anuncio.php?id='.$id.'">Voltar</a></h2>
			';
		}else{
		$totall=intval($registos["preco_apartamento"])*count($resdat)+intval(count($resdat)*1.5)+10;
				
		echo '<div class="block_title">Pedido de Reserva.</div>';
		echo '<div class="contact_form_small" style="float:none;display:block;margin:auto;">
			<form method="post" action="reservar.php">
				<input type="hidden" name="np" value="'.$np.'">
				<input type="hidden" name="id" value="'.$id.'">
				<input type="hidden" name="dataci" value="2019-'.$dataci.'">
				<input type="hidden" name="dataco" value="2019-'.$dataco.'">
				<label>Nome.</label>
				<input type="textbox" name="nome" placeholder="exemplo : Barnabas Dudda">
				<label>Identificação.</label>
				<input type="textbox" name="identificacao" placeholder="exemplo : SP121023A">
				<label>Data de nascimento.</label>
				<input type="date" name="d_n" placeholder="exemplo : 2000-12-12">
				<label>Nacionalidade.</label>					
				<input type="textbox" name="nacion" placeholder="exemplo : Portugues">
				<label>País de residência.</label>
				<input type="textbox" name="p_r" placeholder="exemplo : Portugal">
				<label>Cidade de residência.</label>
				<input type="textbox" name="c_r" placeholder="exemplo : Porto">
				<label>Número de telefone.</label>
				<input type="number" name="tel" placeholder="exemplo : 910000000">
				<label>Endereço de e-mail.</label>
				<input type="textbox" name="email" placeholder="exemplo : email@example.io">
				<label>Envie-nos uma mensagem. Exponha as suas questões e indique as características mais relevantes da sua propriedade.</label>
				<textarea name="msg"></textarea>
				<label>Quando e como deseja ser contactado.</label>
				<select name="time">
					<option value="">---</option>
					<option value="Pelo e-mail">Pelo e-mail</option>
					<option value="Pelo telefone durante a manha">Pelo telefone durante a manhã</option>
					<option value="Pelo telefone durante a hora do almoco">Pelo telefone durante a hora do almoço</option>
					<option value="Pelo telefone durante a tarde">Pelo telefone durante a tarde</option>
					<option value="Pelo correio de pombo">Pelo correio de pombo</option>
				</select>
				<label>Nº de pessoas.</label>
				<input type="textbox" value="'.$np.'" readonly>
				<label>Data Check-in.</label>
				<input type="textbox" value="'.'2019-'.$dataci.'" readonly>
				<label>Data Check-out.</label>
				<input type="textbox" value="'.'2019-'.$dataco.'" readonly>
				<label>Valor total á pagar.</label>
				<div  class="total_pagar">
				<table>
				<tr><td>€'.$registos["preco_apartamento"].'x'.count($resdat).' noites</td><td>€'.$registos["preco_apartamento"]*count($resdat).'</td>
				<tr><td>Taxa de limpeza</td><td>€10</td></tr>
				<tr><td>Taxa de serviço</td><td>€'.count($resdat)*"1.5".'</td></tr>
				<tr><th>Total</th><th>€'.$totall.'</th></tr>
				</table>
				</div>
				<br><br>
				<input type="submit" value="Reservar">
			</form>
		</div>
	<div class="footer">
		© 2018 HomeAway. Todos os direitos reservados.  
	</div>';
		}
	exit;
		
	}
		
			echo '<div id="info_img">
				<img src="img/'.$registos['id_apartamento'].'.png">
				<img src="img/'.$registos['id_apartamento'].'_1.png" style="float:right;">
			</div>
			<div class="conteiner">
			<div class="block_title" style="background-color:#f44336;color:white;border-radius:5px;">'.$registos['titulo_apartamento'].'</div>
			<div class="contact_form_small">
			<h2>Pedido de Reserva.</h2>
				<form method="get" action="">
					<div class="datadiv">
					<label>Datas.</label>
					<input type="button"  id="chi" value="Check-in" onClick="show_calendar(1)"><img src="img/arrow.png"><input type="button" id="cho"  value="Check-out" onClick="show_calendar(2)">
					<input type="hidden" name="id" value="'.$id.'">
					<input type="hidden" name="dataci" id="dataci">
					<input type="hidden" name="dataco" id="dataco">
					<div class="calendar" id="calendar" style="display:none;"><div class="calendar_c" id="calendar_c">
						';
						for($m=0;$m<6;$m++){
							$data= mktime(0, 0, 0, date("m")+$m  , date("d"), date("Y"));
							echo '
							<table>
							<tr>
								<th style="color:white;background-color:#f44336;border-radius:5px;" colspan="7">'.date('F',$data).'</th>
							</tr>
							<tr>
								<th>2ª</th><th>3ª</th><th>4ª</th><th>5ª</th><th>6ª</th><th>Sá</th><th>Do</th>
							</tr>
							';
							$de= date('t',$data);
							$ds= date('N',$data);
							$d=1;							
							for($i=1;$i<=6;$i++){
								echo '<tr>';
								for($j=1;$j<=7;$j++){
									if($ds>$j&&$i==1){echo '<td></td>';}else{
										$mp1=$m+1;
										echo '<td><button class="calendar_bt" type="button" onClick=gebi("'.$mp1.'-'.$d.'") ';
										for($t=0;$t<count($datas);$t++){
											if(('2019-'.$mp1.'-'.$d)==$datas[$t])echo 'disabled';
										}
										
										echo ' >'.$d.'</button></td>';
										if($d==$de){
											break 2;
										}else{
											$d+=1;
										}
									}
								}
								echo '</tr>';
							}
							echo '
						</table>';
						}
						echo'
					</div></div>
					<label>Nº de Pessoas.</label>
					<input name ="npessoa" type="number" min="1" max="'.$registos['capacidade_apartamento'].'" value="1">
					</div>
					<input type="submit" value="Continuar">
				</form>
			</div>
			<div class="contact_info">
			<h2>Detalhes.</h2>
			<h3><div class="dot"></div>€'.$registos['preco_apartamento'].' por noite</h3>
			<h4><div class="dot"></div>'.$registos['tipo_apartamento'].' | '.$registos['categoria_apartamento'].'</h4>
			<h4><div class="dot"></div>'.$registos['capacidade_apartamento'].' Camas</h4>
			<h4><div class="dot"></div>'.$registos['cidade_apartamento'].'</h4>
			<div class="contact_form_small">
			<h2>Fazer comentário.</h2>
				<form method="post" action="">
					<label>Nome.</label>
					<input type="textbox" name="comment_n" placeholder="exemplo : Barnabas Dudda">
					<label>Envie-nos uma mensagem.</label>
					<textarea name="comment_m"></textarea>
					<input type="submit" value="Enviar">
				</form>
			</div>
			</div>
			<br><br><br><br><br><br><br><br>
			<h2>Comentários.</h2>';
			$lista="select * from comentario where id_apartamento='".$id."' and aprovado='1' order by id_comentario desc";
			$faz_lista=mysqli_query($ligabd,$lista);
			
			$num_registos=mysqli_num_rows($faz_lista);
			if($num_registos=='0'){
				echo '<h4>Ainda não tem comentarios</h4>';
			}else{
			if($num_registos<3){$l=$num_registos;}else{$l=3;};

			
			for($i=0;$i<$l;$i++){
			   
			   $registos=mysqli_fetch_array($faz_lista);	
				echo'<div class="comment"><img src="img/cmnt.png"><h4>'.$registos['nome'].'</h4><p>'.$registos['mensagem'].'</p></div>';
			}
			}
			echo'</div>';

			if(isset($_POST["comment_n"])){
				$nome = $_POST["comment_n"];
				$msg = $_POST["comment_m"];
	
				$insere_player="insert into comentario values (NULL,'".$id."','".$nome."','".$msg."','0','0')";
				$faz_insere_player=mysqli_query($ligabd,$insere_player)or die(mysqli_error());
			}
?>
</div>
	</div>
	<div class="footer">
		© 2018 HomeAway. Todos os direitos reservados.  
	</div>
	<script>
	var id;
	function show_calendar(e){
		
		if(document.getElementById("calendar").style.display=="none"){
			if(e=='1'){
				id='dataci';
			}else if(e=='2'){
				id='dataco';
			}
			document.getElementById("calendar").style.display="block";
		}else{
			document.getElementById("calendar").style.display="none";
		}
	}
	function gebi(e){
		document.getElementById(id).value=e;
		show_calendar();
		if(id=='dataci'){
			document.getElementById("chi").value="2019-"+e;
		}else if(id=='dataco'){
			document.getElementById("cho").value="2019-"+e;
		}
		
	}
</script>
</body>
</html>