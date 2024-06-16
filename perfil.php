<?php ob_start();
session_start();
include ("ligabd.php");
if(!isset($_SESSION["idu"])){
	echo'<center><h2 style="background-color:pink;color:black;border:1px solid maroon;margin:10px;border-radius:4px;padding:14px 16px;">So para utilizadores registados.</h2><a href="index.php">Voltar para inicio</a><center>';
	exit;
}
?>
<!doctype html>
<html lang="pt">
<head>
	<meta charset="utf-8">
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
				<li><a href="perfil.php?perfil" >Meu Perfil</a></li>
			<?php
				$existe="select * from utilizador where id_utilizador='".$_SESSION["idu"]."'";
				$faz_existe=mysqli_query($ligabd,$existe);
				$registos=mysqli_fetch_array($faz_existe);
				if($registos['tipo_utilizador']=='user'){
					echo '<li><a href="perfil.php?m_hosp" >Meus pedidos de hospedagem</a></li>';
					echo '<li><a href="perfil.php?alojamento" >Minhas reservas</a></li>';
				}else if($registos['tipo_utilizador']=='root'){
						echo '<li><a href="perfil.php?hosp" >Pedidos de hospedagem</a></li>';
						echo '<li><a href="perfil.php?contacte_nos" >"Contacte-nos"</a></li>';
						echo '<li><a href="perfil.php?reservas" >Reservas</a></li>';
						echo '<li><a href="perfil.php?comments" >Comentários</a></li>';
				};
			?>
			<li style="float:right;"><a href="sair.php">LogOut</a></li>
		</ul>
		</div>
	</div>
	<div class="content" style="overflow:scroll;">
		<div class="bar"></div>
		<?php
		if(isset($_POST["id"])){
			$id=$_POST["id"];
			$titulo=$_POST["titulo"];
			$price=$_POST["price"];
			$camas=$_POST["camas"];
			$tipo2=$_POST["tipo_2"];
			
			$update="UPDATE apartamento SET aprovado='1' ,titulo_apartamento='".$titulo."' ,preco_apartamento='".$price."' ,capacidade_apartamento='".$camas."' ,tipo_apartamento='".$tipo2."' WHERE id_apartamento='".$id."'";
				
			$filename = $_FILES["foto"]["name"];
			$filename2 = $_FILES["foto2"]["name"];
			$file_basename = substr($filename, 0, strripos($filename, '.'));
			$file_basename2 = substr($filename2, 0, strripos($filename2, '.')); // get file extention
			$file_ext = substr($filename, strripos($filename, '.'));
			$file_ext2 = substr($filename2, strripos($filename2, '.')); // get file name
			$filesize = $_FILES["foto"]["size"];
			$filesize2 = $_FILES["foto2"]["size"];
			$allowed_file_types = array('.png','.PNG','.jpg','.JPG','.jpeg','.JPEG');	

			if (in_array($file_ext,$allowed_file_types))
			{	
				// Rename file
				$newfilename = $id . $file_ext;
				$newfilename2 = $id."_1". $file_ext2;
				if (file_exists("img/" . $newfilename))
				{
					// file already exists error
					echo "You have already uploaded this file.";
				}
				else
				{		
					move_uploaded_file($_FILES["foto"]["tmp_name"], "img/" . $newfilename);
					move_uploaded_file($_FILES["foto2"]["tmp_name"], "img/" . $newfilename2);
					echo "File uploaded successfully.";		
					$faz_update=mysqli_query($ligabd,$update);
				}
			}
			elseif (empty($file_basename) or empty($file_basename))
			{	
				// file selection error
				echo "Please select a file to upload.";
			} 
			else
			{
				// file type error
				echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
				unlink($_FILES["foto"]["tmp_name"]);
			}
			header('Location: perfil.php?hosp');
			
		};
		if(isset($_GET["responder"])){
			$id=$_GET["responder"];
			$nome=$_GET["nome"];
			$email=$_GET["email"];
			$msg=$_GET["msg"];
			echo '<div class="block_title">Responde ao pedido.</div>';
			echo '<div class="contact_form_small" style="float:none;display:block;margin:auto;">
				<form method="post" action="mail.php">
					<input type="hidden" name="id" value="'.$id.'">
					<label>Nome.</label>
					<input type="textbox"  value="'.$nome.'" readonly>
					<label>Endereço de e-mail.</label>
					<input type="email" name="email" value="'.$email.'" readonly>
					<label>Mensagem.</label>
					<textarea readonly>'.$msg.'</textarea>
					<label>Resposta.</label>
					<textarea name="msg"></textarea>
					<input type="submit" value="Enviar">
				</form>
			</div>';	
		};
		if(isset($_GET["contactar"])){
			$id=$_GET["contactar"];
			$update="UPDATE apartamento SET `contactado`='1' WHERE id_apartamento='".$id."'";
			$faz_update=mysqli_query($ligabd,$update);
			header('Location: perfil.php?hosp');	
		};
		if(isset($_GET["cancelar"])){
			$id=$_GET["cancelar"];
			$table=$_GET["table"];
			$header=$_GET["header"];
			$update="UPDATE ".$table." SET `cancelado`='1' WHERE id_".$table."='".$id."'";
			$faz_update=mysqli_query($ligabd,$update);
			header('Location: perfil.php?'.$header);	
		};
		if(isset($_GET["aprovar"])){
			$id=$_GET["aprovar"];
			$table=$_GET["table"];
			$header=$_GET["header"];
			$update="UPDATE ".$table." SET `aprovado`='1' WHERE id_".$table."='".$id."'";
			$faz_update=mysqli_query($ligabd,$update);
			header('Location: perfil.php?'.$header);	
		};
		if(isset($_GET["perfil"])){
			echo '<div class="perfil">';
			echo '<img src="img/perfil_img.png">';
			echo '<h2>'.$registos["nome"].'</h2>';
			echo '<h3>'.$registos["email"].'</h3>';
			echo '</div>';
		};
		if(isset($_GET["comments"])){
			$existe="select * from comentario where aprovado='0' and cancelado='0'";
			$faz_existe=mysqli_query($ligabd,$existe);
			$num_registos_1=mysqli_num_rows($faz_existe);
			if($num_registos_1==0){
				echo '<div class="block_title">Ainda não tem comentários.</div>';
			}else{
				echo '<div class="block_title">Lista dos comentários.</div>';
				echo '<table class="perfil_table"><tr><th>ID</th><th>Nome</th><th>Comentário</th><th>Apartamento</th><th></th></tr>';
				for($i=0;$i<$num_registos_1;$i++){
					$registos_1=mysqli_fetch_array($faz_existe);
					echo '<tr>';
					echo '<td>'.$registos_1["id_comentario"].'</td>';
					echo '<td>'.$registos_1["nome"].'</td>';
					echo '<td>'.$registos_1["mensagem"].'</td>';
					echo '<td><a href="anuncio.php?id='.$registos_1["id_apartamento"].'">Apartamento</a></td>';
					echo '<td style="text-align:center;"><a href="perfil.php?aprovar='.$registos_1["id_comentario"].'&table=comentario&header=comments">Aprovar</a>|<a href="perfil.php?cancelar='.$registos_1["id_comentario"].'&table=comentario&header=comments">Cancelar</a></td>';
					echo '</tr>';
				}
				echo '</table>';
			}
		};
		/*if(isset($_GET["ajuda"])){
			$existe="select * from ajuda where cancelado ='0' and respondido='0' and email='".$registos["email"]."'";
			$faz_existe=mysqli_query($ligabd,$existe);
			$num_registos_1=mysqli_num_rows($faz_existe);
			if($num_registos_1==0){
				echo '<div class="block_title">Ainda não pediu ajuda.</div>';
				echo '<div class="block_desc">Se quiser pedir ajuda clica <a href="index.php#contact">aqui</a>.</div>';
			}else{
				echo '<div class="block_title">Lista dos pedidos que fez.</div>';
				echo '<div class="block_desc">Se quiser pedir ajuda clica <a href="index.php#contact">aqui</a>.</div>';
				echo '<table class="perfil_table"><tr><th>ID</th><th style="width:70%;">Mensagem</th><th>Data</th><th>Cancelar?</th></tr>';
				for($i=0;$i<$num_registos_1;$i++){
					$registos_1=mysqli_fetch_array($faz_existe);
					echo '<tr>';
					echo '<td>'.$registos_1["id"].'</td>';
					echo '<td>'.$registos_1["msg"].'</td>';
					echo '<td>'.$registos_1["data"].'</td>';
					echo '<td style="text-align:center;"><a href="perfil.php?cancelar='.$registos_1["id"].'&table=ajuda&header=ajuda">Sim</a></td>';
					echo '</tr>';
				}
				echo '</table>';
			}
		}*/
		if(isset($_GET["m_hosp"])){
			$existe="select * from apartamento where identificacao='".$registos["identificacao"]."'";
			$faz_existe=mysqli_query($ligabd,$existe);
			$num_registos_1=mysqli_num_rows($faz_existe);
			
			if($num_registos_1==0){
				echo '<div class="block_title">Ainda não fez proposta de hospedagem.</div>';
				echo '<div class="block_desc">Se quiser o fazer clica <a href="index.php#hosped">aqui</a>.</div>';
			}else{
				echo '
					<div class="block_title">Lista das proposta de hospedagem.</div>
					<div class="block_desc">Fazer novo pedido</div>
					<div class="contact_form_small" style="display:block;float: unset; width: 100%;">
					<form method="post" action="contact_hosped.php" class="forma">
					<input type="hidden" value="'.$registos["identificacao"].'" name="identificacao">
					<label>Categoria do imóvel.</label>
					<select name="ct">
						<option value="">---</option>
						<option value="T0">T0</option>
						<option value="T1">T1</option>
						<option value="T2">T2</option>
						<option value="T3">T3</option>
						<option value="T4">T4</option>
						<option value="T5">T5</option>
						<option value="T5+">T5+</option>
					</select>
					<label>Localização.</label>
					<select name="local">
						<option value="">---</option>';
							include("cidades.php");
							for($i=1;$i<481;$i++){
								echo '<option value="'.$cidades[$i].'">'.$cidades[$i].'</option>';	
							};
						echo '</select>
						<br>
						<input type="submit" value="Enviar">
					</form>
					</div>
					<div class="block_desc">Pedidos</div>
					<table class="perfil_table"><tr><th>ID</th><th>Estado</th><th>Categoria</th><th>Localização</th><th>Titulo</th><th>Preço</th><th>Capacidade</th><th>Tipologia</th><th>Data pedido</th><th></th></tr>';
				for($i=0;$i<$num_registos_1;$i++){
					$registos_1=mysqli_fetch_array($faz_existe);
					echo '<tr>';
					echo '<td>'.$registos_1["id_apartamento"].'</td>';
					if($registos_1["aprovado"]=='1'){
						echo '<td style="color:green;">Aprovado</td>';
					}elseif($registos_1["cancelado"]=='1'){
						echo '<td style="color:red;">Cancelado</td>';
					}else{
						echo '<td style="color:gray;">Em processamento</td>';
					}
					echo '<td>'.$registos_1["categoria_apartamento"].'</td>';
					echo '<td>'.$registos_1["cidade_apartamento"].'</td>';
					echo '<td>'.$registos_1["titulo_apartamento"].'</td>';
					echo '<td>'.$registos_1["preco_apartamento"].'</td>';
					echo '<td>'.$registos_1["capacidade_apartamento"].'</td>';
					echo '<td>'.$registos_1["tipo_apartamento"].'</td>';
					echo '<td>'.$registos_1["data_pedido"].'</td>';
					echo '<td style="text-align:center;"><a href="perfil.php?cancelar='.$registos_1["id_apartamento"].'&table=apartamento&header=m_hosp">Cancelar</a></td>';
					echo '</tr>';
				}
				echo '</table>';
			}
		}
		if(isset($_GET["alojamento"])){
			$today=date("Y-m-d");
			
			$existe="select * from reserva where cancelado='0' and aprovado='1' and identificacao='".$registos["identificacao"]."' and data_checkin>='".$today."'";
			$faz_existe=mysqli_query($ligabd,$existe);
			$num_registos_1=mysqli_num_rows($faz_existe);
			
			$existe_2="select * from reserva where cancelado='0' and aprovado='1' and identificacao='".$registos["identificacao"]."' and data_checkin<'".$today."'";
			$faz_existe_2=mysqli_query($ligabd,$existe_2);
			$num_registos_2=mysqli_num_rows($faz_existe_2);
			
			if($num_registos_1==0&&$num_registos_2==0){
				echo '<div class="block_title">Ainda não fez reservas.</div>';
				echo '<div class="block_desc">Se quiser fazer clica <a href="alojamento.php">aqui</a>.</div>';
			}else{
				echo '<div class="block_title">Lista das reservas.</div>';
				echo '<div class="block_desc">Se quiser fazer reserva clica <a href="alojamento.php">aqui</a>.</div>';
				echo '<br><div class="block_desc">Futuras reservas</div>';
				echo '<table class="perfil_table"><tr><th>ID</th><th>Identificação</th><th>Nome</th><th>Data Nascimento</th><th>Nacionalidade</th><th>Pais</th><th>Cidade</th><th>Telefone</th><th>Email</th><th>Mensagem</th><th>Como comunicar</th><th>Data pedido</th><th>Numero pessoas</th><th>Data checkin</th><th>Data checkout</th><th>Link</th><th></th></tr>';
				for($i=0;$i<$num_registos_1;$i++){
					$registos_1=mysqli_fetch_array($faz_existe);
					echo '<tr>';
					echo '<td>'.$registos_1["id_reserva"].'</td>';
					echo '<td>'.$registos_1["identificacao"].'</td>';
					echo '<td>'.$registos_1["nome"].'</td>';
					echo '<td>'.$registos_1["data_nascimento"].'</td>';
					echo '<td>'.$registos_1["nacionalidade"].'</td>';
					echo '<td>'.$registos_1["pais"].'</td>';
					echo '<td>'.$registos_1["cidade"].'</td>';
					echo '<td>'.$registos_1["telefone"].'</td>';
					echo '<td>'.$registos_1["email"].'</td>';
					echo '<td>'.$registos_1["mensagem"].'</td>';
					echo '<td>'.$registos_1["metodo_comunicacao"].'</td>';
					echo '<td>'.$registos_1["data_pedido"].'</td>';
					echo '<td>'.$registos_1["numero_pessoas"].'</td>';
					echo '<td>'.$registos_1["data_checkin"].'</td>';
					echo '<td>'.$registos_1["data_checkout"].'</td>';
					echo '<td><a href="anuncio.php?id='.$registos_1["id_apartamento"].'">Apartamento</a></td>';
					echo '<td style="text-align:center;"><a href="perfil.php?cancelar='.$registos_1["id_reserva"].'&table=reserva&header=alojamento">Cancelar</a></td>';
					echo '</tr>';
				}
				echo '</table>';
			
				//<<<<<<<<<<<<<<<<<<<<<<<<PASADAS<<<<<<<<<<<<<<<<<<<<<<
				echo '<br><div class="block_desc">Passadas reservas</div>';
				echo '<table class="perfil_table"><tr><th>ID</th><th>Identificação</th><th>Nome</th><th>Data Nascimento</th><th>Nacionalidade</th><th>Pais</th><th>Cidade</th><th>Telefone</th><th>Email</th><th>Mensagem</th><th>Como comunicar</th><th>Data pedido</th><th>Numero pessoas</th><th>Data checkin</th><th>Data checkout</th><th>Link</th><th></th></tr>';
				for($i=0;$i<$num_registos_2;$i++){
					$registos_2=mysqli_fetch_array($faz_existe_2);
					echo '<tr>';
					echo '<td>'.$registos_2["id_reserva"].'</td>';
					echo '<td>'.$registos_2["identificacao"].'</td>';
					echo '<td>'.$registos_2["nome"].'</td>';
					echo '<td>'.$registos_2["data_nascimento"].'</td>';
					echo '<td>'.$registos_2["nacionalidade"].'</td>';
					echo '<td>'.$registos_2["pais"].'</td>';
					echo '<td>'.$registos_2["cidade"].'</td>';
					echo '<td>'.$registos_2["telefone"].'</td>';
					echo '<td>'.$registos_2["email"].'</td>';
					echo '<td>'.$registos_2["mensagem"].'</td>';
					echo '<td>'.$registos_2["metodo_comunicacao"].'</td>';
					echo '<td>'.$registos_2["data_pedido"].'</td>';
					echo '<td>'.$registos_2["numero_pessoas"].'</td>';
					echo '<td>'.$registos_2["data_checkin"].'</td>';
					echo '<td>'.$registos_2["data_checkout"].'</td>';
					echo '<td><a href="anuncio.php?id='.$registos_2["id_apartamento"].'">Apartamento</a></td>';
					echo '<td style="text-align:center;"><a href="perfil.php?cancelar='.$registos_2["id_reserva"].'&table=reserva&header=alojamento">Cancelar</a></td>';
					echo '</tr>';
				}
				echo '</table>';
			}
		}
		if(isset($_GET["hosp"])){
			$existe="select * from apartamento where cancelado ='0'";
			$faz_existe=mysqli_query($ligabd,$existe);
			$num_registos_1=mysqli_num_rows($faz_existe);
			
			if($num_registos_1==0){
				echo '<div class="block_title">Não tem pedidos de hospedagem.</div>';
			}else{
				/*<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<NOVOS<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
				$existe="select * from apartamento where cancelado ='0' and aprovado='0' and contactado='0'";
				$faz_existe=mysqli_query($ligabd,$existe);
				$num_registos_1=mysqli_num_rows($faz_existe);
				echo '<div class="block_title">Lista dos pedidos de hospedagem.</div>';
				echo '<div class="block_desc">Novos</div>';
				echo '<table class="perfil_table" style="width:90%;"><tr><th>ID</th><th>Identificação</th><th>Data pedido</th><th>Categoria</th><th>Localização</th><th></th></tr>';
				for($i=0;$i<$num_registos_1;$i++){
					$registos_1=mysqli_fetch_array($faz_existe);
					echo '<tr>';
					echo '<td>'.$registos_1["id_apartamento"].'</td>';
					echo '<td>'.$registos_1["identificacao"].'</td>';
					echo '<td>'.$registos_1["data_pedido"].'</td>';
					echo '<td>'.$registos_1["categoria_apartamento"].'</td>';
					echo '<td>'.$registos_1["cidade_apartamento"].'</td>';
					echo '<td style="text-align:center;">
						<a href="perfil.php?cancelar='.$registos_1["id_apartamento"].'&table=apartamento&header=hosp">Cancelar</a>|<a href="perfil.php?contactar='.$registos_1["id_apartamento"].'">Contactar</a>
					</td>';
					echo '</tr>';
				}
				echo '</table>';
				/*<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<CONTACTADOS<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
				$existe="select * from apartamento where cancelado ='0' and aprovado='0' and contactado='1'";
				$faz_existe=mysqli_query($ligabd,$existe);
				$num_registos_1=mysqli_num_rows($faz_existe);
				echo '<div class="block_desc">Contactados</div>';
				echo '<table class="perfil_table" style="width:90%;"><tr><th>ID</th><th>Titulo do anuncio</th><th>Preço</th><th>Capacidade</th><th>Tipologia</th><th>Fotografias</th><th></th></tr>';
				for($i=0;$i<$num_registos_1;$i++){
					$registos_1=mysqli_fetch_array($faz_existe);
					echo '<form method="post" action="" enctype="multipart/form-data">
						  <input name="id" type="hidden" value="'.$registos_1["id_apartamento"].'"><tr>';
					echo '<td>'.$registos_1["id_apartamento"].'</td>';
					echo '<td><input name="titulo" type="textbox" value="'.$registos_1["titulo_apartamento"].'"></td>';
					echo '<td><input name="price" type="number" value="'.$registos_1["preco_apartamento"].'"></td>';
					echo '<td><input name="camas"type="number" value="'.$registos_1["capacidade_apartamento"].'"></td>';
					echo '<td><select name="tipo_2">';
					if($registos_1["tipo_apartamento"]=="Moradia"){
						echo '<option selected>Moradia</option>';
						echo '<option>Apartamento</option>';
					}else if($registos_1["tipo_apartamento"]=="Apartamento"){
						echo '<option>Moradia</option>';
						echo '<option selected>Apartamento</option>';
					}else{
						echo '<option>Moradia</option>';
						echo '<option>Apartamento</option>';
					};
					echo '</select></td>';
					echo '<td><input type="file" id="foto" name="foto" accept=".png"><br><br><input type="file" id="foto2" name="foto2" accept=".png"></td>';
					echo '<td style="text-align:center;">
						<a href="perfil.php?cancelar='.$registos_1["id_apartamento"].'&table=apartamento&header=hosp">Cancelar</a><br>
						<input type="submit" value="Aprovar">
					</td>';
					echo '</tr></form>';
				}
				echo '</table>';
			}
		}
		if(isset($_GET["contacte_nos"])){
			$existe="select * from ajuda where cancelado ='0' and respondido='0'";
			$faz_existe=mysqli_query($ligabd,$existe);
			$num_registos_1=mysqli_num_rows($faz_existe);
			if($num_registos_1==0){
				echo '<div class="block_title">Ainda não tem pedidos de ajuda.</div>';
			}else{
				echo '<div class="block_title">Lista dos pedidos de ajuda.</div>';
				echo '<table class="perfil_table"><tr><th>ID</th><th>Nome</th><th>Email</th><th>Mensagem</th><th>Data</th><th>Cancelar?</th></tr>';
				for($i=0;$i<$num_registos_1;$i++){
					$registos_1=mysqli_fetch_array($faz_existe);
					echo '<tr>';
					echo '<td>'.$registos_1["id_pedido"].'</td>';
					echo '<td>'.$registos_1["nome"].'</td>';
					echo '<td>'.$registos_1["email"].'</td>';
					echo '<td>'.$registos_1["mensagem"].'</td>';
					echo '<td>'.$registos_1["data_pedido"].'</td>';
					echo '<td style="text-align:center;">
					<a href="perfil.php?cancelar='.$registos_1["id_pedido"].'&table=ajuda&header=contacte_nos">Cancelar</a>|<a href="perfil.php?responder='.$registos_1["id_pedido"].'&email='.$registos_1["email"].'&nome='.$registos_1["nome"].'&msg='.$registos_1["mensagem"].'">Responder</a>
					
					</td>';
					echo '</tr>';
				}
				echo '</table>';
			}

		}
		if(isset($_GET["reservas"])){
			$existe="select * from reserva where cancelado='0' and aprovado='0'";
			$faz_existe=mysqli_query($ligabd,$existe);
			$num_registos_1=mysqli_num_rows($faz_existe);
			if($num_registos_1==0){
				echo '<div class="block_title">Ainda não tem reservas.</div>';
				
			}else{
				echo '<div class="block_title">Lista das reservas.</div>';
				echo '<table class="perfil_table"><tr><th>ID</th><th>Identificação</th><th>Nome</th><th>Data Nascimento</th><th>Nacionalidade</th><th>Pais</th><th>Cidade</th><th>Telefone</th><th>Email</th><th>Mensagem</th><th>Como comunicar</th><th>Data pedido</th><th>Numero pessoas</th><th>Data checkin</th><th>Data checkout</th><th>Link</th><th></th></tr>';
				for($i=0;$i<$num_registos_1;$i++){
					$registos_1=mysqli_fetch_array($faz_existe);
					echo '<tr>';
					echo '<td>'.$registos_1["id_reserva"].'</td>';
					echo '<td>'.$registos_1["identificacao"].'</td>';
					echo '<td>'.$registos_1["nome"].'</td>';
					echo '<td>'.$registos_1["data_nascimento"].'</td>';
					echo '<td>'.$registos_1["nacionalidade"].'</td>';
					echo '<td>'.$registos_1["pais"].'</td>';
					echo '<td>'.$registos_1["cidade"].'</td>';
					echo '<td>'.$registos_1["telefone"].'</td>';
					echo '<td>'.$registos_1["email"].'</td>';
					echo '<td>'.$registos_1["mensagem"].'</td>';
					echo '<td>'.$registos_1["metodo_comunicacao"].'</td>';
					echo '<td>'.$registos_1["data_pedido"].'</td>';
					echo '<td>'.$registos_1["numero_pessoas"].'</td>';
					echo '<td>'.$registos_1["data_checkin"].'</td>';
					echo '<td>'.$registos_1["data_checkout"].'</td>';
					echo '<td><a href="anuncio.php?id='.$registos_1["id_apartamento"].'">Apartamento</a></td>';
					echo '<td style="text-align:center;"><a href="perfil.php?cancelar='.$registos_1["id_reserva"].'&table=reserva&header=reservas">Cancelar</a>';
					echo '|<a href="perfil.php?aprovar='.$registos_1["id_reserva"].'&table=reserva&header=reservas">Aprovar</a></td>';
					echo '</tr>';
				}
				echo '</table>';
			}
		}
		?>
	</div>
	<div class="footer">
		© 2018 HomeAway. Todos os direitos reservados.  
	</div>	
</body>
</html>