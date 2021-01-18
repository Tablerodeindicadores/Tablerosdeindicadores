<?php

	   // Se recuperan los parámetros
	   //$fecini=($_POST['fecini']);
	   //$fecfin=($_POST['fecfin']);
	   //$suc=($_POST['suc']);
	   $fecini="2020-10-10";
	   $fecfin="2020-10-10";
	   $suc="";
	
   	   require '../datos/opcnegadas.php';

	   $Chart = new Conecta_Datos(); 
	
	   //Se trae los datos
	   $consulta = $Chart -> Trae_Datos($fecini, $fecfin, $suc);

	   //genera la salida de los datos en formato json
       header('Content-type: application/json');
	   echo json_encode($consulta);

?>
