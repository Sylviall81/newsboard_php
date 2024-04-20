<?php


require_once('./lib/db_utils.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/index-style.css">
  <title>News Board PHP</title>
</head>

<body>
  <header>
    <div class="p-5 bg-primary text-white text-center">
    <img src="./assets//img/logoipsum-286.svg" class="bi" width="20%" ></img>
      <h1>Bienvenid@ al News Board</h1>
      <h3>Crea, actualiza y comparte noticias y posts con otros usuarios</h3>
      <p id="fecha-actual"></p>
    </div>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <div class="container-fluid">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./login.php">Login</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <main>

    <?php
    //pedimos todas las noticias
    $query = "SELECT * FROM noticia";
    //las contamos
    $nrows = contar_filas($query);
    ?>

    <h5>Tu newsboard contiene <?php echo $nrows ?> noticias </h5>


    <div class='table-container'>

      <table class="table table-hover">
        <thead id="top">
          <tr>
            <th colspan="2">Imagen</th>
            <th><a href="index.php?columna=id">Id </a></th>
            <th><a href="index.php?columna=titulo"> Título </a></th>
            <th><a href="index.php?columna=autor">Autor/a </a></th>
            <th><a href="index.php?columna=categoria">Categoria </a></th>
            <th><a href="index.php?columna=fecha">Fecha </a></th>
            <th colspan="2"><a href="index.php?columna=texto">Contenido</a></th>
          </tr>
        </thead>
        <tbody>
          <?php

          //consulta JOIN de dos tablas que trae la info de la noticia y del usuario que la crea

          $q = "SELECT noticia.*, usuarios.nombre, usuarios.email FROM `noticia` INNER JOIN `usuarios` ON noticia.user_id = usuarios.id ORDER BY noticia.fecha DESC;";
          $result = consulta($q);
          while ($row = mysqli_fetch_array($result)) { ?>



            <tr>
              <td><img src="https://res.cloudinary.com/dsesprxhl/image/upload/v1713624281/Web%20Grafic%20Tools/icons/news-placeholder_wmubzt.jpg" alt='imagen noticia' width='200px'></td>
              <td><?php echo $row['id']; ?></td>
              <td><strong><?php echo $row["titulo"]; ?></strong></td>
              <td><?php echo $row["autor"]; ?></td>
              <td><?php echo $row["user_id"]; ?></td>
              <td><?php echo $row["categoria"]; ?></td>
              <td><?php echo $row["fecha"]; ?></td>
              <td><?php //echo $row["texto"];	
                  $strFinal = substr($row["texto"], 0, 100); //corta la noticia en 100 caract 
                  echo $strFinal;
                  if ($strFinal < $row["texto"]) {
                    echo " ... ";
                  }

                  ?>


              </td>
              <td colspan="3">

                <?php
                echo "<br><b><a href='noticia.php?id=" . $row['id'] . "'> Ver Noticia</a></b><br>";


                if (isset($_SESSION['user'])) {

                  echo " <br><b><a href='noticia.php?id=" . $row['id'] . "&modificar=true'> Ver Noticia y actualizar -></a></b><br>"; ?>

                  <form action="eliminar.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="imagen-file" value="<?php echo $row['imagen-file']; ?>">

                    <input style="background-color: red;" type="submit" value="Eliminar">
                  </form>

                <?php } ?>


              </td>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          que hay aqui
        </tfoot>
      </table>
    </div>
  </main>

  <footer class="dark d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
        <img src="./assets//img/logoipsum-286.svg" class="bi" width="200px" ></img>
      </a>
      <span class="text-muted">© 2024 Company, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
      <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
      <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
    </ul>
  </footer>
  

  
  
  
  



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>