<?php ob_start(); ?>
<!doctype html>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style/style.css">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Righteous|Montserrat" rel="stylesheet">
	<script src="script/scripts.js"></script>
	<title>HomeAway</title>
</head>
<body>
	<div class="head">
		
		<div class="logo"><a href="index.php" style="text-decoration:none;color:white;"><img id="logo_img" src="img/logo.png">HomeAway</a></div>
		<div class="menu">
			<ul>
				<li><a href="#home" id="1" class="active">Início</a></li>
				<li><a href="#services" id="2">Serviços</a></li>
				<li><a href="#hosped" id="3">Hospedagem</a></li>
				<li><a href="alojamento.php">Alojamentos</a></li>
				<li><a href="#contact" id="5">Contacto</a></li>
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
		<div class="bar" id="home"></div>
		<div  class="title">
			<div class="text_title">Ajudamos com Alojamento e Hospedagem</div>
			<div class="sub_title">Nós tratamos de tudo, de forma a que não que se preocupe com nada.</div>
		</div>
		<div class="bar" id="services"></div>
		<div  class="sirvice_desc">
			<div class="block_title">O que oferecemos</div>
			<div class="block_desc">Oferecemos uma grande variedade de serviços, dessa forma podemos encontrar uma solução à medida de cada cliente.</div>
			<div class="align">
			<div>
				<div class="service_block">
				<img src="img/clean.png">
				<h3>Limpeza e Lavandaria</h3>
				A nossa equipa de limpeza vai cuidar da sua propriedade.
				</div>
				<div class="service_block">
				<img src="img/manuten.png">
				<h3>Manutenção e apoio</h3>
				Coordenamos e asseguramos a manutenção da sua propriedade rápida e eficazmente. 
				</div>
				<div class="service_block">
				<img src="img/recep.png">
				<h3>Receção e acompanhamento</h3>
				Oferecemos um serviços de recepção 24 horas! Daremos as boas vindas a todos os hóspedes.
				</div>
			</div>
			<div>
				<div class="service_block">
				<img src="img/gest.png">
				<h3>Gestão de Reservas</h3>
				Gestão de calendários, comunicação com hóspedes e promoção do seu imóvel… Deixe tudo nas nossas mãos.
				</div>
				<div class="service_block">
				<img src="img/trans.png">
				<h3>Transfer de e para o aeroporto</h3>
				Temos ao dispor um serviço de transfer de e para o aeroporto.
				</div>
				<div class="service_block">
				<img src="img/cancel.png">
				<h3>Cancelamento Flexível</h3>
				Damos-lhe a liberdade de cancelar os nossos serviços a qualquer momento.
				</div>
			</div>
			</div>
		</div>
		<div class="bar" id="hosped"></div>
		<div class="hosped">
		<div class="block_title">Condições essenciais para hospedar</div>
			<div class="align">
				<div class="service_block">
				<img src="img/baseitem.png">
				<h3>Itens básicos</h3>
				Qualquer estadia requer utensílios como pratos, copos, talheres, vassoura, apanhador e balde do lixo.
				</div>
				<div class="service_block">
				<img src="img/bed.png">
				<h3>Camas confortáveis</h3>
				Uma noite bem dormida é fundamental para conseguir tirar partido das experiências do dia seguinte.
				</div>
				<div class="service_block">
				<img src="img/cart.png">
				<h3>Cozinha equipada</h3>
				É fundamental ter fogão, microondas e frigorífico. Uma cafeteira e chaleira são aconselháveis.
				</div>
				<div class="service_block">
				<img src="img/wifi.png">
				<h3>Wi-Fi</h3>
				Mais do que uma televisão, ter internet disponível é um dos requisitos mais procurados pelos nossos hóspedes.
				</div>
			</div>
				<div class="block_desc"><br>Antes de anunciar, o seu espaço deve estar preparado e reunir alguns requisitos simples mas essenciais para ter sucesso no mercado do Alojamento Local.</div>
		</div>
		<div class="bar" id="contact"></div>
		<div class="contact">
			<div class="block_title">Contactos</div>
			<div class="block_desc">Contacte-nos e deixe-nos ajudá-lo.</div>
			<div class="align">
			<div class="contact_form_small">
				<form method="post" action="contact.php">
					<label>Nome.</label>
					<input type="textbox" name="nome" placeholder="exemplo : Barnabas Dudda" maxlength="50">
					<label>Endereço de e-mail.</label>
					<input type="email" name="email" placeholder="exemplo : email@example.io" maxlength="254">
					<label>Envie-nos uma mensagem.</label>
					<textarea name="msg" maxlength="1000"></textarea>
					<input type="submit" value="Enviar">
				</form>
			</div>
			<div class="contact_info">
			<h3>Contacto</h3>
			Pode preencher o formulário, enviar um email para <b>info@HomeAway.com </b>ou ligue para (+351) 910 000 000.
			<h3>Morada</h3>
			Av. de França, 316 Edifício Capitólio, 4050-276 Porto.</div>
			</div>
		</div>
	</div>
	<div class="footer">
		© 2018 HomeAway. Todos os direitos reservados.  
	</div>
</body>
</html>