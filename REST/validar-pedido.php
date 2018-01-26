<?php
	header("Content-Type: text/html;charset=utf-8");
	include_once '../CLASES/Bases.php';
	$baseElegida = isset($_POST['bases']) ? $_POST['bases'] : null;
	$ingreElegidos = isset($_POST['ingre']) ? $_POST['ingre'] : null;
	$fechaPedido = date('d/m/Y \a \l\a\s H:i:s');
	$usuario = $_SESSION['nick'];

	$base = new Bases();

	if(isset($_POST['pedir'])){

		$conexion = new mysqli('localhost', 'root', '', 'wok');
		$conexion -> set_charset("utf8");

		if($ingreElegidos != null){

			$ingredientes = "";
			$numIng = count($ingreElegidos);

			$cont = 0;

			foreach ($ingreElegidos as $key => $value) {
				
				if($cont != $numIng -1){

					$ingredientes .= $value.",";
				} else {

					$ingredientes .= $value.".";
				}

				$cont++;
			}


		$consulta = $conexion -> query("INSERT INTO pedidos (login, idBase, numIng, ingredientes, fechayhora) VALUES('$usuario', '$baseElegida', '$numIng', '$ingredientes', '$fechaPedido')") or trigger_error($conexion -> error."INSERT INTO pedidos (login, idBase, numIng, ingredientes, fechayhora) VALUES('$usuario', '$baseElegida', '$numIng', '$ingredientes', '$fechaPedido')");
		$conexion -> query("SET NAMES 'utf8'");
		$consultaPrecio = $conexion -> query("SELECT idBase, precio FROM bases WHERE idBase = $baseElegida");

		$fila = $consultaPrecio -> num_rows;

		if($fila > 0){

			while ($row = $consultaPrecio -> fetch_array()) {
				
				$base -> _setIdBase($row[0]);
				$base -> _setPrecio($row[1]);
			}
		}
		
		$precioBase =(float) $base -> getPrecio();

		$precioPedido = $precioBase + $numIng;
		echo "<script language='JavaScript'>
				alert('¡Gracias por tu pedido! El total son: $precioPedido €');
				window.location = 'mis-pedidos.php';
			</script>";

		}

	}
?>