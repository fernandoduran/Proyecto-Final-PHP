<?php
/**
 * @author Fernando Duran Ruiz
*/
	include_once '../CLASES/Usuarios.php';
	
	/*
	 * Recogemos los inputs de los formularios en una variable. Para evitar los NOTICE
	 * comprobamos si el input esta vacío o no, en caso que si le ponemos valor null.
	*/	
	$nick = isset($_POST['inputNick']) ? $_POST['inputNick'] : null;
	$pass = isset($_POST['inputPass']) ? $_POST['inputPass'] : null;
	$rep_pass = isset($_POST['inputRepPass']) ? $_POST['inputRepPass'] : null;
	$name = isset($_POST['inputNombre']) ? $_POST['inputNombre'] :null;
	$mail = isset($_POST['inputMail']) ? $_POST['inputMail'] :null;
	$firma = isset($_POST['inputFirma']) ? $_POST['inputFirma'] : null;

	$user = new Usuarios();//Objeto clase Usuarios

	if(isset($_POST['submit'])){

		/*
		 * Con los datos introducidos comprobamos que el usuario no existe, que las contraseñas
		 * coincidan. Como los campos son required y tienen un patrón no es necesario hacer más
		 * comprobaciones.
		*/
		$conexion = new mysqli('localhost', 'root', '', 'wok');

		$consultaLogin = $conexion -> query("SELECT Login FROM usuario WHERE Login ='".$nick."'");

		while ($row = $consultaLogin -> fetch_array()) {
			
			$user -> _setLogin($row[0]);

			if($nick == $user -> getLogin()){

				echo "<script type='text/javascript'>alert('¡Ya existe un usuario con este nick!');</script>";

			}

		}
		
		if ($pass != $rep_pass){

				echo "<script type='text/javascript'>alert('¡Las contraseñas no coinciden!');</script>";


			} else {
				$conexion -> query("INSERT INTO usuario (Login, Password, Email, Nombre, Firma, Tipo) VALUES ('$nick', '".md5($pass)."', '$mail', '$name', '$firma', '1')");
				echo "<script type='text/javascript'>alert('¡Gracias por registrate!');</script>";
			}
	}
?>