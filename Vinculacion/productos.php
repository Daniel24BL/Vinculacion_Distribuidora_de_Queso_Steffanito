<?php

require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>  
    <link rel="icon" type="png" href="imagenes/Queso_Logo.png">
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>INICIO</title>
   <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald&display=swap" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <style>
        header{
            background: black;
        }
    </style> 
    <link href="css/styles.css"  height=50px width="20PX"rel="stylesheet" />
</head>
<body bgcolor="white">              
<header class="header">
    <div class="container">
    <figure class="logo">
            <img width='200'src="imagenes/logo.jpg" alt="Tutorships"/>          
        </figure>  
        <nav class="menu">
        <ul class ="nav justify-content-end align-items-center">
                <li class="nav-item"> 
                  <a class="nav-link active" aria-current="page" href="./productos.php" style="color: white">Productos</a>
                </li>                             

                <li class="nav-item"> 
                <a href="principal.php" class="nav-link active" aria-current="page" style="color: white"> Cerrar Sesion </a> </li>
             </ul>
        </nav>
         
       </div>
    </header>

    <div class="container1">
        <div id="contacto5" class="flex-center" align="center">  
            <div class="texto_contenido"> 
                <h1>Productos</h1>
                <p>Sección de productos</p> 
            </div>                           
        </div>   
    </div>
    
    <main>
        <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach($resultado as $row){ ?>
            <div class="col">
              <div class="card shadow-sm">
                <?php 
                
                $id = $row['id'];
                $imagen = "images/productos/".$id."/principales.jpg";

                if(!file_exists($imagen)){
                    $imagen = "images/no-photo.jpg";
                }
                ?>
                  <img src="<?php echo $imagen; ?>">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $row['nombre']; ?></h5>
                  <p class="card-text">$ <?php echo number_format($row['precio'], 2, '.', ','); ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>" class="btn btn-primary">Detalles</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>          
            </div>
        </div>
    </main>
    <footer class="py-3 my-4" style="background-color:rgb(2, 23, 5)">
    
    <p class="text-center text-muted">© 2022 Distribuidora de Queso "Steffanito"</p>
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>