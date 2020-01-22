<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>UTI</title>
 
    <link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/bootstrap/easyui.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="css/proyecto.css">
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/locale/easyui-lang-es.js"></script>
</head>
<?php
 session_start();
 if( isset(  $_SESSION['usuario']) ==false)
 header("location: index.php") ;
?>
<body class="easyui-layout">
          
 
        <div data-options="region:'north'" style="height:60px"> 
        <img src="imagenes/uti-logo.jpg"   height="50px"  > </img>
         <div class="titulousuario">
          Usuario: <?php echo $_SESSION['usuario']; ?> 
          <a href="index.php"> Salir </a>
         </div> 

        </div>

        <div data-options="region:'south',split:true" style="height:50px;"></div>
       
        <div data-options="region:'west',split:true" title="Menu" style="width:200px;">
        
        <ul class="easyui-tree">
			<li>
				<span>Menu</span>
				<ul>
					<li>
						<span>Seguridad</span>
						<ul>
							<li>
								   <a  href="main.php?pag=listausuario">  Usuarios  </a> 
							</li>
							<li>
								   <a  href="main.php?pag=usuarios">  Usuarios2  </a> 
							</li>
							<li>
								<span>Rol de Usuario</span>
							</li>
							 
						</ul>
					</li>
				 l>
					</li>
					 
				</ul>
			</li>
		</ul>

        </div>
        <div data-options="region:'center' ">
		<?php
		if(  isset($_GET["pag"])){
			$page = $_GET["pag"];	
			$page = $page.".php";
			include ($page);
		}	
			?>
	
	
        </div>
 
 
</body>
</html>