<?php ob_start(); ?>
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
		  <li><a href="index.php#home"  >Início</a></li>
		  <li><a href="index.php#services" >Serviços</a></li>
		  <li><a href="index.php#hosped" >Hospedagem</a></li>
		  <li><a href="alojamento.php" >Alojamentos</a></li>
		  <li><a href="index.php#contact">Contacto</a></li>
		  <li class="dropdown" style="float:right;">
					<a href="login.php" class="dropbtn active">Login</a>
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
	<?php
		include ("ligabd.php");
		if(isset($_POST["login"])){     
			$login=$_POST["login"];
			$pass=md5($_POST["pass"]);
			$existe="select * from utilizador where email='".$login."'";
			$faz_existe=mysqli_query($ligabd,$existe);
			$registos=mysqli_fetch_array($faz_existe);
			if($registos['pass']==$pass){
				session_start();
				$_SESSION["idu"]=$registos["id_utilizador"];
                                
				header('Location: perfil.php?perfil');
			}else{
				echo '<h2 style="background-color:pink;color:black;border:1px solid maroon;margin:10px;border-radius:4px;padding:14px 16px;">LogIn ou Password incorretos.</h2>';
			}
		};
		if(isset($_POST["nome"])){
            session_start();
			$name=$_POST["nome"];
			$identificacao=$_POST["ident"];
			$data_nasc=$_POST["d_n"];
			$nacion=$_POST["nacion"];
			$pais=$_POST["p_r"];
			$cidade=$_POST["c_r"];
			$tel=$_POST["tel"];
			$email=$_POST["email"];
			$pass=md5($_POST["pass_r"]);
			$existe="select * from utilizador where identificacao='".$identificacao."'";
			$faz_existe=mysqli_query($ligabd,$existe);
			$ja_existe=mysqli_num_rows($faz_existe);
			if($ja_existe==0){
				$insere_user="insert into utilizador values (NULL,'".$identificacao."','".$nome."','".$data_nasc."','".$nacion."','".$pais."','".$cidade."','".$tel."','".$email."','".$pass."','user')";
				
				$faz_insere_user=mysqli_query($ligabd,$insere_user);
				$faz_existe=mysqli_query($ligabd,$existe);
				$registos=mysqli_fetch_array($faz_existe);
				session_start();
				$_SESSION["idu"]=$registos["id_utilizador"];
				header('Location: perfil.php?perfil');
			}else{
				echo '<h2 style="background-color:pink;color:black;border:1px solid maroon;margin:10px;border-radius:4px;padding:14px 16px;">Utilizador ja esta registado.</h2>';
			};
		}
	?>
	<div class="contact" style="height:1000px;">
			<div class="block_title">Faz Login ou Registe-se</div>
			<div class="align">
			<div class="contact_form_small">
				<div class="block_desc">LogIn</div>
				<form method="post" action="">
					<label>LogIn.</label>
					<input type="textbox" name="login" placeholder="exemplo : email@example.io" maxlength="254">
					<label>Password.</label>
					<input type="password" name="pass" placeholder="exemplo : 12345" maxlength="32">
					<input type="submit" value="LogIn">
				</form>
			</div>
			<div class="contact_form_small" style="float:right;margin-left:40px;">
			<div class="block_desc">Registe-se</div>
			<form method="post" action="">
					<label>Identificação.</label>
					<input type="textbox" name="ident" placeholder="exemplo : SP121023A" maxlength="20">
					<label>Nome.</label>
					<input type="textbox" name="nome" placeholder="exemplo : Barnabas Dudda" maxlength="50">
					<label>Data de nascimento.</label>
					<input type="date" name="d_n" placeholder="exemplo : 2000-12-12" >
					<label>Nacionalidade.</label>
					<input type="textbox" name="nacion" placeholder="exemplo : Portugues" maxlength="30">
					<label>País de residência.</label>
					<input type="textbox" name="p_r" placeholder="exemplo : Portugal" maxlength="30">
					<label>Cidade de residência.</label>
					<input type="textbox" name="c_r" placeholder="exemplo : Porto" maxlength="30">
					<label>Número de telefone.</label>
					<input type="number" name="tel" placeholder="exemplo : 910000000" maxlength="9">
					<label>Endereço de e-mail.</label>
					<input type="textbox" name="email" placeholder="exemplo : email@example.io" maxlength="254">
					<label>Password.</label>
					<input type="password" name="pass_r" placeholder="exemplo : 12345" maxlength="32">

					<input type="submit" value="Registar">
				</form>
			</div>
		</div>
	</div>
	<div class="footer">
		© 2018 HomeAway. Todos os direitos reservados.  
	</div>
</body>
</html>