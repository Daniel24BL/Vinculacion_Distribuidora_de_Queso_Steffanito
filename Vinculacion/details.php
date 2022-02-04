<?php

require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '') {
    echo 'Error al procesar la petición';
    exit;
} else {

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if ($token == $token_tmp) {

        $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
        $sql->execute([$id]);
        if ($sql->fetchColumn() > 0) {

            $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1 LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $descuento = $row['descuento'];
            $precio_desc = $precio - (($precio * $descuento) / 100);
            $dir_images = 'images/productos/'.$id.'/';

            $rutaImg = $dir_images.'principales.jpg';

            if(!file_exists($rutaImg)){
                $rutaImg = 'images/no-photo.jpg';
            }

            $imagenes = array();
            $dir = dir($dir_images);

            while(($archivo = $dir->read()) != false){
                if($archivo != 'principales.jpg' && (strpos($archivo, 'jpg') || strpos($archivo, 'jpeg'))){
                    $imagenes[] = $dir_images.$archivo;
                }
            }
            $dir->close();
        }
    } else {
        echo 'Error al procesar la petición';
        exit;
    }
}


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
        header {
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
                <a href="checkout2.php" class="nav-link active" aria-current="page" style="color: white"> Carrito </a> </li>
                 <span id="num_cart" class="badge bg-secondary""
			 </ul>
        </nav>
           
       </div>
    </header>

    <div class="container1">
        <div id="contacto5" class="flex-center" align="center">
            <div class="texto_contenido">
                <h1>Detalles</h1>
                <p>Datos acerca de su producto: </p>
            </div>
        </div>
    </div>
    <!--Contenido-->
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-1">
                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?php echo $rutaImg; ?>" class="d-block w-100">
                            </div>

                            <?php foreach ($imagenes as $img) { ?>
                                <div class="carousel-item">
                                    <img src="<?php echo $img; ?>" class="d-block w-100">
                                </div>
                            <?php } ?>
                            
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>



                </div>
                <div class="col-md-6 order-md-2">
                    <h2><?php echo $nombre; ?></h2>

                    <?php if($descuento >0) { ?>
                        <p><del><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></del></p>
                        <h2>
                            <?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?>
                            <small class="text-success"><?php echo $descuento; ?>% descuento</small>
                        </h2>

                        <?php } else { ?>

                    <h2><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></h2>

                     <?php } ?>       
                    <p class="lead">
                        <?php echo $descripcion; ?>
                    </p>

                    <div class="d-grid gap-3 col-10 mx-auto">
                        <button class="btn btn-outline-primary" type="button" onclick="addproducto(<?php echo $id; ?>, '<?php echo $token_tmp; ?>')">Agregar al carrito</button>
						
                    </div>
                </div>
            </div>

        </div>
    </main>
    <footer class="py-3 my-4" style="background-color:rgb(2, 23, 5)">
    <p class="text-center text-muted">© 2022 Distribuidora de Queso "Steffanito"</p>
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script> 
    function addproducto(id, token){
        let url = 'clases/carrito.php'
        let formData = new FormData()
        formData.append('id', id)
        formData.append('token', token)
        fetch(url,{
            method:'POST',
            body: formData,
            mode:'cors'
        }).then(response => response.json() )
        .then(data =>{
            if(data.ok){
                let elemento = document.getElementById("num_cart")
                elemento.innerHTML = data.numero
            }
        })
    }

    </script>
</body>

</html>