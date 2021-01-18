<?php

session_start();

if(!empty($_SESSION['active']))
{
	header('location: logout.php');
}else
{
	if(!empty($_POST))
	{
		if(empty($_POST['username']) || empty($_POST['password']))
		{
			$alert = 'Ingrese su usuario y su contraseña';
        }else
        {
           require_once("config/odbc.php");
           require_once("config/const.php");

           $usuario = $_POST['username'];
           $password = $_POST['password'];

           $cnn = new conexion(tserver);
           $cnn->conectar();
   
           $sql = "SELECT * FROM usuario where usuario = '$usuario' ";
           $result = $cnn->query($sql);
  
           if ($cnn->num_rows>0) 
           {
              //$row = $cnn->fetch_row();
              $password_bd = $cnn->result('password');
              $pass_c = $password;

              if (trim($password_bd) == trim($pass_c)) 
              {
                 $_SESSION['active'] = true;
                 $_SESSION['idUser'] = $cnn->result('idusuario');
                 $_SESSION['nombre'] = $cnn->result('nombre');
                 $_SESSION['user']   = $cnn->result('usuario');
                 $_SESSION['tipo']   = $cnn->result('tipo');

                 header("location: principal.php");
              } else
              {
                $alert = 'El usuario o la clave son incorrectos';
                session_destroy();
              }
              $cnn->cerrar();
           }
        }
    }
}
  	
?>	


<!DOCTYPE html>
<html lang="es">
<head>
	<title>Indicadores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">	
</head>

<body>
<div class="login">
  <div class="login-triangle"></div>
  
  <h2 class="login-header">Entrada</h2>

  <form class="login-container" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <p><input type="text" name="username" placeholder="Usuario"></p>
    <p><input type="password" name="password" placeholder="Password"></p>
    <p><input type="submit" value="Entrar"></p>
  </form>
</div>
</body>
</html>
