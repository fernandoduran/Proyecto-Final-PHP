<?php
	session_start();

	include_once '../CLASES/Usuarios.php';
	$conexion = new mysqli('localhost', 'root', '', 'wok');

	$user = new Usuarios();

	/*
	 * Recogemos los inputs de los formularios en una variable. Para evitar los NOTICE
	 * comprobamos si el input esta vacío o no, en caso que si le ponemos valor null.
	*/
	$nombre = isset($_POST['inputNombre']) ? $_POST['inputNombre'] : null;
	$email = isset($_POST['inputMail']) ? $_POST['inputMail'] : null;
	$firma = isset($_POST['inputFirma']) ? $_POST['inputFirma'] : null;
	$oldPass = isset($_POST['inputOldPass']) ? $_POST['inputOldPass'] : null;
	$newPass = isset($_POST['inputPass']) ? $_POST['inputPass'] : null;
	$repPass = isset($_POST['inputRepPass']) ? $_POST['inputRepPass'] : null;

	/*
	 * Hacemos consulta de los datos del usuario con la sesion iniciado y almacenamos el resultado
	 * en sesiones que luega seran el value de los input.
	*/
	$query = $conexion -> query("SELECT Email, Firma, Tipo FROM usuario WHERE Login = '".$_SESSION['nick']."'");
	$filas = $query -> num_rows;

	if($filas > 0){

		while($row = $query -> fetch_array()){

			$user -> _setEmail($row[0]);
			$user -> _setFirma($row[1]);
			$user -> _setTipo($row[2]);

			$_SESSION['mail'] = $user -> getEmail();
			$_SESSION['firma'] = $user -> getFirma();
			$_SESSION['karma'] = $user -> getTipo();
		}
	}

	if(isset($_POST['submit'])){

		if($nombre != "" && $email != "" && $firma != "" && $oldPass != "" && $newPass != "" && $repPass != "" && $oldPass != $newPass && $oldPass != $repPass && $newPass == $repPass){

			$conexion -> query("UPDATE usuario SET Password = '".md5($newPass)."', Email = '$email', Nombre = '$nombre', Firma = '$firma' WHERE Login = '".$_SESSION['nick']."'") or trigger_error($conexion -> error."UPDATE usuario SET Password = '".md5($newPass)."', Email = '$email', Nombre = '$nombre', Firma = '$firma' WHERE Login = '".$_SESSION['nick']."'");
			$_SESSION['name'] = $nombre;
			$_SESSION['mail'] = $user -> getEmail();
			$_SESSION['firma'] = $user -> getFirma();
			$_SESSION['karma'] = $user -> getTipo();

			echo "<script type='text/javascript'>alert('Datos modificados con éxito')</script>";
		}

	}
?>