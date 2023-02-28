<?php session_start();

if(!isset($_SESSION["carrito"])){
    echo "<script>alert('Carrito vacio');</script>";
    echo "<script> setTimeout(\"location.href='index.php'\",1) </script>";
    ?>
    
    <?php
}else{
    if(isset($_REQUEST["vaciar"])){
        session_destroy();
        echo "<script>alert('La informacion del Carrito se envio con exito');</script>";
        echo "<script> setTimeout(\"location.href='index.php'\",1) </script>";
        
    }
    if(isset($_REQUEST["prod"])){
        $producto = $_REQUEST["prod"];
        unset($_SESSION["carrito"][$producto]);
        echo "<script>alert('$producto Eliminado del Carrito');</script>";
        echo "<script> setTimeout(\"location.href='carrito.php'\",1) </script>";
    }
    /*if(isset($_REQUEST["correo"])){
        $destino = $_POST["correo"];
        var_dump($destino);
    }*/
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>TextilExport</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/jumbotron/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

    </style>

    
  </head>
  <body>
    
<main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <a href="index.php" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="img/textil.svg" alt="logo" width="50" height="50" class="me-2" viewBox="0 0 118 94">
        <span class="fs-4">TextilExport</span>
      </a>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3 ">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Tienda de productos textiles y artículos promocionales.</h1>
        <p class="col-md-8 fs-4">Contamos con variedad de productos de acuerdo a tus gustos y necesidades como prendas de vestir, complementos, accesorios, tazas, termos,
          entre otros articulos de uso cotidiano.
        </p>
      </div>
    </div>

    <div class="row align-items-md-stretch">

      <div class="col-md-12">
        <div class="h-100 p-5 text-bg-dark rounded-3 ">
          <center>
            <h1>Productos Seleccionados <i class="fa-solid fa-cart-flatbed"></i></h1>
          </center>
        </div>
      </div>

    </div>

    <div class="row align-items-md-stretchS py-4">

    <div class="table-responsive">
        <table class="table align-middle" style="margin-top:20px;">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Accion</th>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach($_SESSION["carrito"] as $productos2 => $product2){     
                        /*foreach ($product2 as $valor1 => $valor2) {*/ 
                            //var_dump($_SESSION["carrito"]);  
                            $total += $product2["cantidad"]* $product2["Precio"];                   
                    ?>
                    <tr>
                        <td><?=$productos2?></td>               
                        <td><?=$product2["producto"]?></td>
                        <td>$<?=$product2["Precio"]?></td>
                        <td><?=$product2["cantidad"]?></td>
                        <td>
                            <a type="submit" class="btn btn-danger  m-2" href="carrito.php?prod=<?=$productos2?>"><i class="fa-solid fa-delete-left"></i> Eliminar Producto</a>
                        </td>
                    </tr>
                    <?php
                        }                   
                    ?>
                </tbody>
        </table>
        <div class="m-2">
            <h2>El monto total es de $<?=$total?></h2>
        </div>
        <a type="submit" class="btn btn-danger  m-2" href="carrito.php?vaciar=true"><i class="fa-solid fa-cart-arrow-down"></i> Vaciar Carrito</a>
        <!--target="_blank"-->
        <a href="fpdf-tutoriales-master/PruebaV.php"  class="btn btn-danger m-2"><i class="fa-solid fa-file-pdf"></i> Generar PDF</a>
        <hr>

        <div class="m-2"><h5>(Generar el PFD antes de solitar la cotizacion.)</h5></div>

        <div class="m-2">
            <form action="Correo.php" method="POST">
                <label for="correo" class="form-label m-2"><h2>Correo Electronico</h2></label>
                <input type="email" class="form-control m-2" id="correo" name="correo" placeholder="name@example.com">
                <button type="submit" class="btn btn-danger m-2"><i class="fa-regular fa-paper-plane" name="EnviarCorreo" value="email"></i> Enviar Cotizacion</button>
            </form>
        </div>
     
    </div>
   
    </div>
    
    <footer class="pt-3 mt-4 text-muted border-top">
      Marco Gerardo Serrano Lopez SL182556
    </footer>
  </div>
</main>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
<?php
}
?>