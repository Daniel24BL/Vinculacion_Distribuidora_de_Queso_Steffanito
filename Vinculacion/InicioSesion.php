<!DOCTYPE html>
<html lang="en">
<head>  
    <link rel="icon" type="png" href="imagenes/Queso_Logo.png">
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>INICIO</title>
   <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
   <link href="Acceder.css"  height=50px width="20PX"rel="stylesheet" />

</head>
<body>                     
    <header class="header"> 
    <div class="container">
        <nav class="menu">
            <ul class ="nav">
                <li> <a href="./contacto.php"> Contacto </a> </li>
				                <li> <a href="./nosotros.php"> Nosotros </a> </li>

							    <li> <a href="./Registro.php"> Registrate </a> </li>

								 <li> <a href="./InicioSesion.php"> Iniciar Sesion </a> </li>

				                <li> <a href="./principal.php"> Inicio </a> </li>                             
             </ul>
        </nav>
        <figure class="logo">
            <img  width='250'src="imagenes/logo.jpg" alt="Tutorships"/>          
        </figure>   
       </div>
    </header>
   <br>
	    <?php
		if (isset ($_POST ['ENVIAR']))
		{
			$CORR=$_POST ["correos"];	
			$PAS=$_POST ["contra"];
			$link=mysqli_connect("localhost","root");
			if(mysqli_connect_errno())
				{ 
				printf("Error de Conexion %5\n", mysqli_connect_errno);
				exit();
				}
			    mysqli_select_db($link,"tienda_online");
			    $Consulta="Select*from informacion where EMAIL='$CORR' AND PASSWORD='$PAS'";
			    $R=mysqli_query($link,$Consulta);
			    if ($R)
					if (mysqli_error($link))
						{
						echo "error";
						exit();
						}
					$row=mysqli_fetch_array($R);
					if(!empty($row))
						{
                        $emmail=$row["EMAIL"];
						$passss=$row["PASSWORD"];
						}
					if($CORR == $emmail && $PAS == $passss){
					header("location: productos.php");
					}
						
else
					{
    echo'<script type="text/javascript">
    alert("Email o Contraseña Incorrecta");
    window.location.href="InicioSesion.php";
    </script>';				
					}
				mysqli_close($link);   
			}
		else
			{
	?>
   <div class="contenedor">
   <br> 
        <div class="registro">
            <center><h2>Ingresar con Mi Cuenta <h1>&#129472;</h1></h2></center>
        </div>
        <form action="InicioSesion.php" class="formulario"  id="form" method="POST">
            
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" placeholder="Steffanito@email.com" id="email" name="correos" required />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="password">Contraseña</label>
                <input type="password" placeholder="db&&h345" id="password" maxlength="30" name="contra" required />
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
           
      <div class="form-boton" >
        <input type="submit" name="ENVIAR" value="Enviar">
      </div>             <br>
            
     
            <center><p class="form_link">¿No tienes una cuenta? <a href="Registro.php">Regístrate</a></p></center>

        </form>
		 <?php
		}
	?>
    </div>
 <script src="formInicioSesion.js"></script>
 <br>


  </body>
</html>