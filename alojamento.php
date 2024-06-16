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
	<?php
	if($_GET){
		$categoria=$_GET['categoria'];
		$tipo=$_GET['tipo'];
		$local=$_GET['local'];
		$p_s=$_GET['preco_select'];
		$preco=$_GET['preco'];
	}else{
		$categoria='*';
		$tipo='*';
		$local='*';
		$p_s='1';
		$preco='0';
	}
	?>
	<div class="serch">
		<img src="img/serch.png">
		<form action="alojamento.php">
		<select name="categoria" onChange="this.form.submit()">
			<option value="*"<?php if($categoria=='*')echo' selected';?>>Categoria</option>
			<option value="T0"<?php if($categoria=='T0')echo' selected';?>>T0</option>
			<option value="T1"<?php if($categoria=='T1')echo' selected';?>>T1</option>
			<option value="T2"<?php if($categoria=='T2')echo' selected';?>>T2</option>
			<option value="T3"<?php if($categoria=='T3')echo' selected';?>>T3</option>
			<option value="T4"<?php if($categoria=='T4')echo' selected';?>>T4</option>
			<option value="T5"<?php if($categoria=='T5')echo' selected';?>>T5</option>
			<option value="T5+"<?php if($categoria=='T5+')echo' selected';?>>T5+</option>
		</select>
		<select name="tipo" onChange="this.form.submit()">
			<option value="*"<?php if($tipo=='*')echo' selected';?>>Tipo</option>
			<option value="Moradia"<?php if($tipo=='Moradia')echo' selected';?>>Moradia</option>
			<option value="Apartamento"<?php if($tipo=='Apartamento')echo' selected';?>>Apartamento</option>
		</select>
		<select name="local" onChange="this.form.submit()">
			<option value="*"<?php if($local=='*')echo' selected';?>>Localização</option>
		<?php 
		include("cidades.php");
		for($i=1;$i<481;$i++){
			if($local==$cidades[$i]){
				echo '<option value="'.$cidades[$i].'" selected>'.$cidades[$i].'</option>';
			}else{
				echo '<option value="'.$cidades[$i].'">'.$cidades[$i].'</option>';	
			}
		};
		?>
		</select>
		<select name="preco_select" onChange="this.form.submit()">
			<option value="1"<?php if($p_s=='1')echo' selected';?>>Preços maiores que</option>
			<option value="2"<?php if($p_s=='2')echo' selected';?>>Preços ate</option>
		</select>
		<input onChange="this.form.submit()" name="preco" type="number" min="1" value="<?php echo $preco;?>">
		</form>
	</div>
	<div class="cards" id="cards">
	<?php
		include("ligabd.php");
		$lista="select * from apartamento where aprovado='1'";
		
		if($categoria!='*'){
			$lista=$lista." and categoria_apartamento like '".$categoria."'";
		};
		if($tipo!='*'){
			$lista=$lista." and tipo_apartamento like '".$tipo."'";
		};
		if($local!='*'){
			$lista=$lista." and cidade_apartamento like '".$local."'";
		};
		if($p_s=='1'){
			$lista=$lista." and preco_apartamento > '".$preco."'";
		}else{
			$lista=$lista." and preco_apartamento < '".$preco."'";
		};
        $faz_lista=mysqli_query($ligabd,$lista);
        $num_registos=mysqli_num_rows($faz_lista);
		
		for($i=0;$i<$num_registos;$i++){
			$registos=mysqli_fetch_array($faz_lista);
			echo '<a href="anuncio.php?id='.$registos['id_apartamento'].'"><div class="card">';
			echo '<img src="img/'.$registos['id_apartamento'].'.png">';
			echo '<div class="card_desc">';
			echo '<h4>'.$registos['categoria_apartamento'].' <div class="dot"></div> '.$registos['tipo_apartamento'].'<div class="dot"></div>',$registos['capacidade_apartamento'].' Camas<div class="dot"></div>'.$registos['cidade_apartamento'].'</h4>'; 
			echo '<h2>'.$registos['titulo_apartamento'].'</h2>';
			echo '<h4>€'.$registos['preco_apartamento'].' por noite</h4>';
			echo '</div></div></a>';
			};
	?>
	</div>
	</div>
	<div class="footer">
		© 2018 HomeAway. Todos os direitos reservados. 
	</div>
	<script>
		var s = window.innerWidth;
		var c=530;
		for(i=s;i>1190;){
			c += 530;
			i=i-530
		};
		document.getElementById("cards").style.width = c+"px";	
		function serch(){
			var url;
			url="alojamento.php?categoria="+document.getElementById("categoria").value+"&tipo="+document.getElementById("tipo").value+"&local="+document.getElementById("local").value+"&preco_select="+document.getElementById("preco_select").value+"&preco="+document.getElementById("preco").value;
			window.location.assign(url);
		}
	</script>
</body>
</html>