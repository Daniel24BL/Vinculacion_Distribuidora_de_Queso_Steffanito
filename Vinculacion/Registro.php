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

   <div class="contenedor">
   <br> 
        <div class="registro">
            <center><h2>Regístrate <h1>&#129472;</h1></h2></center>
        </div>
		    <?php
		if (isset ($_POST ['ENVIAR']))
		{
			$NOM=$_POST ["nomape"];	
			$CED=$_POST ["ci"];
			$CELL=$_POST ["tel"];
			$EMAIL=$_POST ["emaill"];
			$CONTRA=$_POST ["pass"];
			$link =mysqli_connect("localhost","root");
			if (mysqli_connect_errno())
			{
				printf("Error De Conexion %5\n",mysqli_connect_errno);
				exit ();
			}
			mysqli_select_db ($link ,"tienda_online");
			$r=mysqli_query($link, "Insert into informacion(NOMBRES,CEDULA,TELEFONO,EMAIL,PASSWORD)values('$NOM','$CED','$CELL','$EMAIL','$CONTRA')");
			if (!$r)
				printf ("Error %5\n",mysqli_error($link));
			else
				 echo'<script type="text/javascript">
    alert("Datos Ingresados");
    window.location.href="Registro.php";
    </script>';	
			mysqli_close($link);
		}
		else
		{
	?>
        <form action="Registro.php" class="form" name="form" id="form" autocomplete="off" method="POST">
            <div class="form-control">
                <label for="names">Nombres y Apellidos</label>
                <input type="text" placeholder="Steffanito Steffanito" name="nomape" onkeypress="return letrass(event);" maxlength="50" required >
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
           
            <div class="form-control">
                <label for="username">Identificacion / C.I.:</label>
                <input type="text" placeholder="1314683927" name="ci" onkeypress="return numeros(event);" maxlength="10" required >
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>

            <div class="form-control">
                <label for="Tell">Telefono</label>
                <input type="text" placeholder="0999999999" name="tel" onkeypress="return numeros(event);" maxlength="10" required>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" placeholder="Steffanito@email.com" name="emaill" required>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="password">Contraseña</label>
                <input type="password" placeholder="db&&h345" name="pass" maxlength="30" required>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
      <div class="form-boton" >
        <input type="submit" name="ENVIAR" value="Enviar">
      </div>            
            <br>
            <center><p class="form_link">¿Ya Tienes una cuenta? <a href="InicioSesion.php">Ingresa aqui</a></p></center>
        </form>
				<?php
		}
	?>
    </div>

 <script src="formRegistro.js"></script>
 <br>

  </body>
</html>