<?php

require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;


$lista_carrito = array();
if ($productos != null){
  foreach ($productos as $clave => $cantidad){
   $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad as cantidad FROM productos WHERE id=? AND activo=1");
$sql->execute([$clave]);
$lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
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
<main>
<div class="container">
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th>Producto</th>
<th>Precio</th>
<th>Subtotal</th>
<th></th>
</tr>
</thead>
<tbody>
<?php if($lista_carrito == null){
echo '<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>';
}else {
$total=0;
foreach($lista_carrito as $producto){
$_id=$producto ['id'];
$nombre=$producto ['nombre'];
$precio=$producto ['precio'];
$descuento=$producto ['descuento'];
$precio_desc=$precio - (($precio * $descuento)/100);
$subtotal=$precio_desc;
$total += $subtotal;
?>
<tr>
<td> <?php echo $nombre; ?> </td>
<td><?php echo MONEDA . number_format($precio_desc,2,'.','.'); ?> </td>

<td>
<div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . 
number_format($subtotal,2,'.','.'); ?></div>
</td>

</tr>
<?php } ?>
<tr>
<td colspan="3"> </td>
<td colspan="2"> 
<p class="h3" id="total"> <?php echo MONEDA. number_format($total,2,'.','.'); ?> </P>
</td>

</tr>
</tbody>
<?php } ?>

</table>
</div>
<?php if($lista_carrito != null){ ?>

<div class="row">
<div class="col-md-5 offset-md-7 d-grid gap-2">
<a href="pago.php" class="btn btn-primary btn-lg" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)"> Realizar pago </a>
</div>
</div>
<?php } ?>
</div>
</main>
	<script> 
    function actualizaCantidad(cantidad, id){
        let url = 'clases/actualizar_carrito.php'
        let formData = new FormData()
		        formData.append('action', 'agregar')

        formData.append('id', id)
        formData.append('cantidad', cantidad)
        fetch(url,{
            method:'POST',
            body: formData,
            mode:'cors'
        }).then(response => response.json() )
        .then(data =>{
            if(data.ok){
              
				
				   let divsubtotal = document.getElementById('subtotal_'+id)
                divsubtotal.innerHTML = data.sub
				
				let total=0.00
				let list=document.getElementsByName('subtotal[]')
				
				for (let i =0; i< list.length; i++){
				total+=parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
				}
				total=new Intl.NumberFormat('en-US', {
				minimumFractionDigits: 2
				}).format(total)
				document.getElementById('total').innerHTML='<?php echo MONEDA; ?> ' + total
            }
        })
    }

    </script>
    


  </body>
</html>