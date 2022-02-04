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
} else {
	header("Location: principal.php");
	exit;
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
<div class="row">
<div class="col-6">
<h4>Detalles de pago</h4>
    <div id="paypal-button-container"></div>

</div>
<div class="col-6">

<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th>Producto</th>
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
$nombre=$producto ['nombre'];
$precio=$producto ['precio'];
$descuento=$producto ['descuento'];
$precio_desc=$precio - (($precio * $descuento)/100);
$subtotal=$cantidad * $precio_desc;
$total += $subtotal;
?>
<tr>
<td> <?php echo $nombre; ?> </td>

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

</div>
</div>
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
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY; ?>"></script>

     <script>
        paypal.Buttons({
            style:{
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php echo $total; ?>
                        }
                    }]
                });
            },

            onApprove: function(data, actions){
				let URL='clases/captura.php'
                actions.order.capture().then(function (detalles){
									let url='clases/captura.php'

				return fetch(URL,{
					method: 'post',
headers: {
	'content-type': 'applicaction/json'
},	
body: JSON.stringify ({
	detalles: detalles
})	
				})
                });
            },

            onCancel: function(data){
                alert("Pago cancelado");
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>


  </body>
</html>