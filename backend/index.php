<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulario</title>
</head>

<body background="img/home.jpg">
  <!--<video src="img/video.mp4" id="vidFondo"></video>-->

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Buscador</h1>
    </div>
    <div class="colFiltros">
      <form action="index.php" method="GET" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Realiza una búsqueda personalizada</h5>
          </div>
		  
          <div class="filtroCiudad input-field">
            <label for="selectCiudad">Ciudad:</label>
				<select name="ciudad" id="selectCiudad">
				  <option value="" selected>Elige una ciudad</option>
				  
				  <?php
					$data=file_get_contents("data-1.json");
					$propiedades=json_decode($data,true);
					
					$ciudades = array();
					for($i=0; $i < count($propiedades); $i++)
					{	
						$ciudades[$i] = $propiedades[$i]["Ciudad"];
					}

					$ciudad = array_unique($ciudades);

					for($i=0; $i < count($ciudad); $i++)
					{	
						$arregloCiudad = $ciudad[$i];
						
						if($arregloCiudad != "" || $arregloCiudad!=null){
							echo '<option value='.str_replace(' ', '', $arregloCiudad).'>'.$arregloCiudad.'</option>';
						}						
					}
				  ?>
				  

              </select>
          </div>
          <div class="filtroTipo input-field">
            <label for="selecTipo">Tipo:</label><br>
            <select name="tipo" id="selectTipo">
              <option value="" selected>Elige un tipo</option>
			  
			  
			  <?php
					$data=file_get_contents("data-1.json");
					$propiedades=json_decode($data,true);
					
					$tipos = array();
					for($i=0; $i < count($propiedades); $i++)
					{	
						$tipos[$i] = $propiedades[$i]["Tipo"];
					}

					$tipo = array_unique($tipos);

					for($i=0; $i < count($tipo); $i++)
					{	
						$arregloTipos = $tipo[$i];
						
						if($arregloTipos != "" || $arregloTipos!= null){
							echo '<option value='.str_replace(' ', '', $arregloTipos).'>'.$arregloTipos.'</option>';
						}						
					}
					echo '<option value="Apartamento">Apartamento</option>';
				  ?>
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="submit" class="btn white" value="Buscar" id="submitButton" name="buscar">
          </div>
        </div>
      </form>
    </div>

    <div class="colContenido">
	<form method="GET" action="index.php">
		<div class="tituloContenido card">
			<h5>Resultados de la búsqueda:</h5>
			<div class="divider"></div>
			<button type="submit" name="todos" class="btn-flat waves-effect" id="mostrarTodos">Mostrar Todos</button>
      </div>
	</form> 
    <?php
				
	if(isset($_GET['todos'])){
		$data=file_get_contents("data-1.json");
		$propiedades=json_decode($data,true);
		
		for($i=0; $i < count($propiedades); $i++){
			$direccion=$propiedades[$i]["Direccion"];
			$ciudad=$propiedades[$i]["Ciudad"];
			$telefono=$propiedades[$i]["Telefono"];
			$codigo_postal=$propiedades[$i]["Codigo_Postal"];
			$tipo=$propiedades[$i]["Tipo"];
			$precio=$propiedades[$i]["Precio"];
			 
			echo 	"<div class='colContenido'>
						<div class='tituloContenido'>
							<div class='itemMostrado'>
								<img src='img/home.jpg'>
								<ul>
									<p><strong>Direccion: </strong>".$direccion."</p>
									<p><strong>Ciudad: </strong>".$ciudad."</p>
									<p><strong>Telefono: </strong>".$telefono."</p>
									<p><strong>Codigo Postal: </strong>".$codigo_postal."</p>
									<p><strong>Tipo: </strong>".$tipo."</p>
									<p><strong>Precio: </strong></p> <p class='precioTexto'>".$precio."</p>
								</ul>
							</div>
						</div>
					</div>";
			
		}
	}
	
	if(isset($_GET['buscar'])){
		$data=file_get_contents("data-1.json");
		$propiedades=json_decode($data,true);
		
		$filtro_ciudad=str_replace(' ', '', $_GET['ciudad']);
		$filtro_tipo=$_GET['tipo'];
		$precios=$_GET['precio'];
		
		$precios=explode(";",$precios);

		$precio_bajo=$precios[0];
		$precio_alto=$precios[1];
		
		for($i=0;$i<count($propiedades);$i++) {

			 $ciudad=$propiedades[$i]["Ciudad"];
			 $tipo=$propiedades[$i]["Tipo"];
			 $precio=$propiedades[$i]["Precio"];
			 $direccion=$propiedades[$i]["Direccion"];
			 $codigo_postal=$propiedades[$i]["Codigo_Postal"];
			 $telefono=$propiedades[$i]["Telefono"];
			 $precio=str_replace("$","",$precio);
			 
			 $datos_contenido = "<div class='colContenido'>
									<div class='tituloContenido'>
										<div class='itemMostrado'>
											<img src='img/home.jpg'>
											<ul>
												<p><strong>Direccion: </strong>".$direccion."</p>
												<p><strong>Ciudad: </strong>".$ciudad."</p>
												<p><strong>Telefono: </strong>".$telefono."</p>
												<p><strong>Codigo Postal: </strong>".$codigo_postal."</p>
												<p><strong>Tipo: </strong>".$tipo."</p>
												<p><strong>Precio: </strong></p> <p class='precioTexto'>$ ".$precio."</p>
											</ul>
										</div>
									</div>
								</div>"; 
			$ciudad_a_comparar = str_replace(' ', '', $ciudad);
			$tipo_a_comparar = str_replace(' ', '', $tipo);
			
			if($filtro_ciudad == "" && $filtro_tipo == ""){				 
				if($precio > $precio_bajo && $precio < $precio_alto)
				{
					echo $datos_contenido;	
				}
			}else{
				if($ciudad_a_comparar==$filtro_ciudad && $tipo_a_comparar==$filtro_tipo)
				{
					if($precio > $precio_bajo && $precio < $precio_alto)
					{
						echo $datos_contenido;	
					}							
				}					
				else if($ciudad_a_comparar==$filtro_ciudad && $filtro_tipo==null)
				{
					if($precio > $precio_bajo && $precio < $precio_alto)
					{
						echo $datos_contenido;	
					}							
				}
				else if($tipo_a_comparar==$filtro_tipo && $filtro_ciudad==null)
				{
					if($precio > $precio_bajo && $precio < $precio_alto)
					{
						echo $datos_contenido;	
					}							
				}				
				
			}			
		}   
  
	}




?>
</div>

  <script type="text/javascript" src="js/jquery-3.0.0.js"></script>
  <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
</body>
</html>