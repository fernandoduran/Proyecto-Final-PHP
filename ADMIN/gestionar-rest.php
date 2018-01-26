<?php
	
	/*
	 * Comprobamos que haya alguna sesión.
	 *
	 * Incluimos las clases Bases e ingredientes y creamos un nuevo objeto de cada una.
	*/
	session_start();

	if($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == ""){

		header("Location: ../index.php");
	}

	include_once '../CLASES/Bases.php';
	include_once '../CLASES/Ingredientes.php';

	//Objetos de las clases
	$ingrediente = new Ingredientes();
	$base = new Bases();

	/*
	 * Recogemos los inputs de los formularios en una variable. Para evitar los NOTICE
	 * comprobamos si el input esta vacío o no, en caso que si le ponemos valor null.
	*/
	$idBase = isset($_POST['idBase']) ? $_POST['idBase'] : null;
	$descripBase = isset($_POST['descripBase']) ? $_POST['descripBase'] : null;
	$precio = isset($_POST['precio']) ? $_POST['precio'] : null;
	$precioBase = (float) $precio; //Parseamos a float el precio
	$nombreIng = isset($_POST['nombreIng']) ? $_POST['nombreIng'] : null;
	$descripIngre = isset($_POST['descripIngre']) ? $_POST['descripIngre'] : null;

	/*
	 * Recogemos los select de los formularios en una variable. Para evitar los NOTICE
	 * comprobamos si el input esta vacío o no, en caso que si le ponemos valor null.
	*/

	$selectBase = isset($_POST['base']) ? $_POST['base'] : null;
	$selectIngre = isset($_POST['ingre']) ? $_POST['ingre'] : null;
	

	//Patrones para comprobar el contenido del input
	$patronIdBase = '/^[0-9]$/';
	$patronDescrip = "/^\w[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,100}$/";

	//Conexión a la BBDD ante de pulsar cualquier botón para establecer una única conexión
	$conexion = new mysqli('localhost', 'root', '', 'wok');

	/* comprobar la conexión */
	if ($conexion -> connect_errno) {

	    printf("Falló la conexión: %s\n", $conexion -> connect_error);
	    exit();
	}
/*------------------------------------------GESTION DE BASES-------------------------------*/
	//Modificar Base
	
	if (isset($_POST['modificaBase'])) {
		
		//Comprobamos que haya una base seleccionada (la opción Seleccione... tiene value 0)
		if($selectBase != 0){
			
			/* 
			 * Si todos los campos estan rellenados, se cumplen los formatos y la base seleccionada
			 * es igual a la introducida, actualizamos la BBDD. 
			 *
			 * En el siguiente caso se generará un error si la base escrita no es la misma que la 
			 * seleccionada.
			 *
			 * El siguiente error se mostrará si la descripción de la base no cumple el formato.
			*/
			if($idBase != "" && $idBase === $selectBase && $descripBase != "" && preg_match($patronDescrip, $descripBase) && $precioBase != "" && is_float($precioBase)){

				//Es necesario establecer utf2 porque con los ingred con acentos daba problemas
				$conexion -> set_charset("utf8");
				
				$conexion -> query("UPDATE bases SET descripcion = '$descripBase', precio = '$precio' WHERE idBase = '$selectBase'") or trigger_error($conexion -> error."UPDATE bases SET descripcion = '$descripBase', precio = '$precio' WHERE idBase = '$selectBase'");

				echo "<script type='text/javascript'>alert('Base $idBase modificada')</script>";

			} elseif ($idBase != "" && preg_match($patronIdBase, $idBase) &&  $idBase != $selectBase && $descripBase != "" && preg_match($patronDescrip, $descripBase) && $precioBase != "" && is_float($precioBase)){

				echo "<script type='text/javascript'>alert('El ID base no se corresponde con la base seleccionada')</script>";

			} elseif($idBase != "" && preg_match($patronIdBase, $idBase) &&  $idBase === $selectBase && $descripBase != "" && !preg_match($patronDescrip, $descripBase) && $precioBase != "" && is_float($precioBase)){

				echo "<script type='text/javascript'>alert('La descripción no cumple el formato')</script>";

			} else {

				echo "<script type='text/javascript'>alert('¡Algo ha ido mal!')</script>";

			}

		//Sino no se ha seleccionado ninguna base, se le informará.
		} else {


			echo "<script type='text/javascript'>alert('No se ha seleccionado ninguna base')</script>";
		}

	}

	//Eliminar base
	if(isset($_POST['eliminaBase'])){

		//Comprobamos que haya una base seleccionada (la opción Seleccione... tiene value 0)
		if($selectBase != 0){
			
			//Eliminamos de la BBDD la base seleccionada
			$conexion -> query("DELETE FROM bases WHERE idBase = $selectBase");
			echo "<script type='text/javascript'>alert('La base $idBase ha sido eliminada con éxito')</script>";

		//Sino no se ha seleccionado ninguna base, se le informará.
		} else {

			echo "<script type='text/javascript'>alert('No se ha seleccionado ninguna base')</script>";
		}
	}


	//Insertar base
	if(isset($_POST['insertaBase'])){

		//Comprobamos que no haya una base seleccionada (la opción Seleccione... tiene value 0)
		if($selectBase == 0){
			
			/* 
			 * Si todos los campos estan rellenados y se cumplen los formatos introducimos los datos en 
			 * la BBDD. 
			 *
			 * En el siguiente caso se generará un error si la base escrita no es la misma que la 
			 * seleccionada.
			 *
			 * El siguiente error se mostrará si la descripción de la base no cumple el formato.
			*/
			if($idBase != "" && preg_match($patronIdBase, $idBase) && $descripBase != "" && preg_match($patronDescrip, $descripBase) && $precioBase != "" && is_float($precioBase)){

				$conexion -> query("INSERT INTO bases VALUES ('$idBase', '$descripBase', '$precio')") or trigger_error($conexion -> error."UPDATE bases SET descripcion = '$descripBase', precio = '$precio' WHERE idBase = '$selectBase'");

				echo "<script type='text/javascript'>alert('Has insertado una nueva base')</script>";

			} elseif ($idBase != "" &&  !preg_match($patronIdBase, $idBase) && $descripBase != "" && preg_match($patronDescrip, $descripBase) && $precioBase != "" && is_float($precioBase)){

				echo "<script type='text/javascript'>alert('El ID base no cumple el formato')</script>";

			} elseif($idBase != "" && preg_match($patronIdBase, $idBase) && $descripBase != "" && !preg_match($patronDescrip, $descripBase) && $precioBase != "" && is_float($precioBase)){

				echo "<script type='text/javascript'>alert('La descripción no cumple el formato')</script>";

			} else {

				echo "<script type='text/javascript'>alert('¡Algo ha ido mal!')</script>";

			}

		//Sino se ha seleccionado alguna base, se le informará.
		} else {

			echo "<script type='text/javascript'>alert('Se ha seleccionado una base, no puedes insertar datos')</script>";
		}
	}

	/*------------------------------------------GESTION INGREDIENTES-------------------------------*/

	//Modificar ingrediente
	if(isset($_POST['modificaIngre'])){
		
		//Comprobamos que haya un ingrediente seleccionad (la opción Seleccione... tiene value 0)
		if($selectIngre != "0"){
			
			/* 
			 * Si todos los campos estan rellenados, se cumplen los formatos y el ingred seleccionado
			 * es igual al introducido, actualizamos la BBDD. 
			 *
			 * En el siguiente caso se generará un error si el ingred escrito no es el mismao que el 
			 * seleccionado.
			 *
			 * El siguiente error se mostrará si la descripción del ingrediente no cumple el formato.
			*/
			if($nombreIng != "" && $nombreIng === $selectIngre && $descripIngre != "" && preg_match($patronDescrip, $descripIngre)){

				//Es necesario establecer utf2 porque con los ingred con acentos daba problemas
				$conexion -> set_charset("utf8");

				$conexion -> query("UPDATE ingredientes SET nombreIng = '".$nombreIng."', descripcion = '".$descripIngre."' WHERE nombreIng = '".$selectIngre."'") or trigger_error($conexion -> error."UPDATE ingredientes SET descripcion = '$descripIngre' WHERE nombreIng = '".$selectIngre."'");

				echo "<script type='text/javascript'>alert('Ingrediente modificado')</script>";

			} elseif ($nombreIng != "" && $nombreIng != $selectIngre && $descripIngre != "" && preg_match($patronDescrip, $descripIngre)){

				echo "<script type='text/javascript'>alert('El nombre de ingrediente introducido no se corresponde con el seleccionado')</script>";

			} elseif($nombreIng != "" && $nombreIng === $selectIngre && $descripIngre != "" && !preg_match($patronDescrip, $descripIngre)){

				echo "<script type='text/javascript'>alert('La descripción no cumple el formato')</script>";

			} else {

				echo "<script type='text/javascript'>alert('¡Algo ha ido mal!')</script>";

			}

		//Sino no se ha seleccionado ningun ingrediente, se le informará.
		} else {

			echo "<script type='text/javascript'>alert('No se ha seleccionado ningun ingrediente')</script>";
		}
	}

	if(isset($_POST['eliminaIngre'])){
		
		//Comprobamos que haya un ingrediente seleccionad (la opción Seleccione... tiene value 0)
		if($selectIngre != ""){
			
			//Eliminamos de la BBDD el ingrediente seleccionado
			$conexion -> query("DELETE FROM ingredientes WHERE nombreIng = '".$selectIngre."'") or trigger_error($conexion-> error."DELETE FROM ingredientes WHERE nombreIng = $selectIngre");
			echo "<script type='text/javascript'>alert('El ingrediente ha sido eliminado con éxito')</script>";
		//Sino no se ha seleccionado ningun ingrediente, se le informará.
		} else {

			echo "<script type='text/javascript'>alert('No se ha seleccionado ningun ingrediente')</script>";
		}
	}

	if (isset($_POST['insertaIngre'])) {
		
		//Comprobamos que no haya un ingrediente seleccionad (la opción Seleccione... tiene value 0)
		if($selectIngre == 0){
			

			/* 
			 * Si todos los campos estan rellenados y se cumplen los formatos intorudimos los
			 * datos en la BBDD. 
			 *
			 * En el siguiente caso se generará un error si el ingred escrito no es el mismao que el 
			 * seleccionado.
			 *
			 * El siguiente error se mostrará si la descripción del ingrediente no cumple el formato.
			*/
			if($nombreIng != "" && $descripIngre != "" && preg_match($patronDescrip, $descripIngre)){

				$conexion -> query("INSERT INTO ingredientes VALUES ('$nombreIng', '$descripIngre')") or trigger_error($conexion -> error."INSERT INTO ingredientes VALUES ('$nombreIng', '$descripIngre')");

				echo "<script type='text/javascript'>alert('Ingrediente insertado')</script>";

			} elseif ($nombreIng != "" && $descripIngre != "" && preg_match($patronDescrip, $descripIngre)){

				echo "<script type='text/javascript'>alert('El nombre de ingrediente introducido no se corresponde con el seleccionado')</script>";

			} elseif($nombreIng != "" && $descripIngre != "" && !preg_match($patronDescrip, $descripIngre)){

				echo "<script type='text/javascript'>alert('La descripción no cumple el formato')</script>";

			} else {

				echo "<script type='text/javascript'>alert('¡Algo ha ido mal!')</script>";

			}

		//Sino se ha seleccionado algun ingrediente, se le informará.
		} else {

			echo "<script type='text/javascript'>alert('Se ha seleccionado un ingrediente')</script>";
		}

	}
?>