<!DOCTYPE html>
<html lang="en">
<head>  
    <link rel="icon" type="png" href="imagenes/Queso_Logo.png">
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>CONTACTO</title>
   <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald&display=swap" rel="stylesheet">
   <style>
        header{
            background: black;
        }
    </style> 
   <link href="estilos.css"  height=50px width="20PX"rel="stylesheet" />
</head>
<body bgcolor="white">                     
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

    <div class="queso_img">
        <img src="imagenes/Queso_Derretido2.png"/>
    </div>
    <h1></h1>
  <?php
		if (isset ($_POST ['ENVIAR']))
		{
			$NOM=$_POST ["NOMBRE"];	
			$EMA=$_POST ["EMAIL"];
			$CELL=$_POST ["NTEl"];
			$MEN=$_POST ["MENSA"];
			$link =mysqli_connect("localhost","root");
			if (mysqli_connect_errno())
			{
				printf("Error De Conexion %5\n",mysqli_connect_errno);
				exit ();
			}
			mysqli_select_db ($link ,"tienda_online");
			$r=mysqli_query($link, "Insert into contactos(NOMBRE,CORREO,CELULAR,MENSAJE)values('$NOM','$EMA','$CELL','$MEN')");
			if (!$r)
				printf ("Error %5\n",mysqli_error($link));
			else
				 echo'<script type="text/javascript">
    alert("Datos Enviados");
    window.location.href="contacto.php";
    </script>';	
			mysqli_close($link);
		}
		else
		{
	?>
    <div class="container1">
        <div class="texto_contenido"> 
          <h1>En esta sección podrá ponerse en contacto con nosotros</h1>
        </div>
        <main class="content">          
           <form  action="#" method="POST" name="form" onsubmit="return validarcamvacion();">  
                <div class="form">                            
                    <h1>Contacto</h1>    <br>       
                    <div class="grupo">                
                        <label for=""> Nombre</label>
                        <input type="text" name="NOMBRE" id="nombre" PlaceHolder='Ingrese un nombre'  onkeypress="return letrass(event);" required ><span class="barra"></span> 
                    </div>
                    <div class="grupo">
                        <label for=""> E-Mail</label>
                        <input type="email" name="EMAIL" id="email" PlaceHolder='Ingrese su correo electrónico' required><span class="barra"></span>                   
                    </div>
                    <div class="grupo">                
                        <label for=""> Número telefónico</label>
                        <input type="text" name="NTEL" id="ntele" maxlength="10" PlaceHolder='Ingrese su número de contacto' onkeypress="return numeros(event);" required><span class="barra"></span> 
                    </div>
                    <div class="grupo">                
                        <label for=""> Mensaje</label>
                        <input type="text" name="MENSA" id="mensaje" PlaceHolder='Ingrese el mensaje' onkeypress="return letrass(event);" required><span class="barra"></span> 
                     <br>
                     <div class="form-boton" >
        <input type="submit" name="ENVIAR" value="Enviar">
      </div>                                                              
            </form> 
				<?php
		}
	?>			
        </main>       
      </div> 
      

<script src="form.js"></script>
  </body>
</html>