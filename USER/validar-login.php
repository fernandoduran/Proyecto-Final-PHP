<?php
/**
	* @author Fernando Duran Ruiz
	*/

	/* 
	 * Incluimos el archivo de la clase Usuario.
	 *
	 * Las sentencias de control if son para evitar los Notice de Undefined index.
	*/
	include_once '../CLASES/Usuarios.php';
	
	if(!isset($_SESSION)){
		session_start();
	}

	if(isset($_POST['inputNick'])){
		$nick = $_POST['inputNick'];
	} else {
		$nick = "";
	}

	if(isset($_POST['inputPass'])){
		$pass = $_POST['inputPass'];
	} else {
		$pass = "";
	}
	
	//Objeto de la clase Usuario
	$usuario = new Usuarios();

	//Establecemos conexión con la BBDD
	$conexion = new mysqli('localhost', 'root', '', 'wok');

	//Si se ha pulsado el botón enviar...
	if(isset($_POST['submit'])){

		//Ejecutamos la consulta con comprobación de errores SQL.
		$consulta = $conexion -> query("SELECT LOGIN, PASSWORD, NOMBRE, TIPO FROM usuario WHERE LOGIN ='".$nick."'") or trigger_error($conexion -> error."SELECT LOGIN, PASSWORD, NOMBRE FROM usuarios WHERE LOGIN ='".$nick."'");

		//Guardamos en una variable el número de filas devueltas
		$filas = $consulta -> num_rows;
		
		/*
		 * Si el número de filas devueltas es mayor que 0, hacemos las siguientes comprobaciones:
		 *
		 *		1.- Que el usuario introducido sea igual al devuelto en la consulta y que la contraseña coincida. Sino coincide
		 *			informamos al usuario y aumentamos la sesión de intentos.
		 *		2.- Si ya ha aparecido el captcha porque los intentos fallidos son superiores a 3, comprobamos que tanto el usuario
		 *			como la contraseña y el captcha tengan los valores correctos. Si es asi, creamos las sesiones de nombre y nick y
		 *			redirigimos al usuario a la pagina de inicio.
		 *		3.- Si todo va bien a la primera, creamos las sesiones de nombre y nick y redirigimos al usuario a la pagina de inicio.
		*/
		if($filas > 0){

			while($row = $consulta -> fetch_array()){

				$usuario -> _setLogin($row[0]);
				$usuario -> _setPassword($row[1]);
				$usuario -> _setNombre($row[2]);
				$usuario -> _setTipo($row[3]);
				
				if ($nick == $usuario -> getLogin() && md5($pass) != $usuario -> getPassword()) {
				
					echo "<script type='text/javascript'>alert('La contraseña no es correcta.');</script>";
					$_SESSION['intentos']++;
			
				} 

				if($_SESSION['intentos']>=3){
					if($nick == $usuario -> getLogin() && md5($pass) == $usuario -> getPassword() && $_POST['inputCaptxa'] == $_SESSION['captxa']) {

						$_SESSION['nick'] = $usuario -> getLogin();
						$_SESSION['name'] = $usuario -> getNombre();
						$_SESSION['tipo'] = $usuario -> getTIpo();
						header("Location: ../index.php");

					} 
				}
				

				if($nick == $usuario -> getLogin() && md5($pass) == $usuario -> getPassword()){

					$_SESSION['nick'] = $usuario -> getLogin();
					$_SESSION['name'] = $usuario -> getNombre();
					$_SESSION['tipo'] = $usuario -> getTIpo();
					$_SESSION['sesioniniciada'];
					header("Location: ../index.php");
				}
			}
			//En caso de que no se devuelva ninguna fila, informamos de que dicho usuario no existe.
		} else {
			echo "<script type='text/javascript'>alert('El usuario no existe.');</script>";
					$_SESSION['intentos']++;
		}
	} 
?>