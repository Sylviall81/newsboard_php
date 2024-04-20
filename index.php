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
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="shortcut icon" href="./assets/img/logoipsum-286.svg" type="image/x-icon">
  <title>News Board PHP</title>
</head>

<body>
  <header>
    <div class="p-5 bg-primary text-white text-center">
      <img src="./assets//img/logoipsum-286.svg" class="bi" width="20%"></img>
      <h1>Bienvenid@ al News Board</h1>
      <h3>Crea, actualiza y comparte noticias y posts con otros usuarios</h3>
      <p id="fecha-actual"></p>
    </div>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <div class="container-fluid">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="#">Home</a>
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
    $query = "SELECT noticia.*, usuarios.nombre, usuarios.email FROM `noticia` INNER JOIN `usuarios` ON noticia.user_id = usuarios.id ORDER BY noticia.fecha DESC;";
    //las contamos
    $nrows = contar_filas($query);
    ?>

    <div class='alert-container'>
      <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
      </svg>

      <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:">
          <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
          <h4> Tienes <?php echo $nrows ?> noticias en tu tablero </h4>
        </div>
      </div>
    </div>
    <section class="news-deshaboard">
      <div class='table-container'>

        <table class="table table-hover">
          <thead id="top">
            <tr>
              <th><a href="index.php?columna=id">Id de Noticia </a></th>
              <th colspan="2">Imagen</th>
              <th><a href="index.php?columna=titulo"> Título </a></th>
              <th><a href="index.php?columna=autor">Autor/a </a></th>
              <th colspan="2"><a href="index.php?columna=texto">Contenido</a></th>
              <th><a href="index.php?columna=categoria">Categoría</a></th>
              <th><a href="index.php?columna=fecha">Fecha </a></th>

            </tr>
          </thead>
          <tbody>
            <?php

            //consulta JOIN de dos tablas que trae la info de la noticia y del usuario que la crea

            //$q = "SELECT noticia.*, usuarios.nombre, usuarios.email FROM `noticia` INNER JOIN `usuarios` ON noticia.user_id = usuarios.id ORDER BY noticia.fecha DESC;";
            $result = consulta($query);
            while ($row = mysqli_fetch_array($result)) {
              //print_r ($row); 
            ?>

              <tr>
                <td><?php echo $row['id']; ?></td>
                <td colspan="2"><img src="<?php echo $row['imagen_url'] ?>" alt='imagen noticia' width='120px'></td>

                <td><strong><?php echo $row["titulo"]; ?></strong></td>
                <td><?php echo $row["nombre"]; /*nombre del usuario o autor*/ ?></td>
                <td colspan="2"><?php //echo $row["texto"];Esto es para traerlo todo
                                $strFinal = substr($row["texto"], 0, 100); //corta la noticia en 100 caract 
                                echo $strFinal;
                                if ($strFinal < $row["texto"]) {
                                  echo " ... ";
                                }
                                ?></td>
                <td><?php echo $row["categoria"]; ?></td>
                <td><?php echo $row["fecha"]; ?></td>
                <td colspan="3">
                  <?php
                  //enviamos id de noticia traido de la tabla x Get en url para q nos lleve al clickar
                  echo "<br><b><a href='news_detail.php?id=" . $row['id'] . "'> Ver Noticia</a></b><br>";

                  if (isset($_SESSION['user'])) {

                    echo " <br><b><a href='news_detail.php?id=" . $row['id'] . "&modificar=true'> Ver Noticia y actualizar -></a></b><br>"; ?>

                    <form action="delete.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                      <input style="background-color: red;" type="submit" value="Eliminar">
                    </form>

                  <?php } ?>

                </td>
              </tr>
            <?php } ?>

          </tbody>
          <tfoot class="table-dark">
            <tr>
              <td colspan='100%'> <a href="#">Páginas</a></td>
            </tr>
          </tfoot>

        </table>
      </div>
    </section>

    <!--AÑADIR NUEVAS NOTICIAS-->
    <section id="addNewsForm" class="container-sm">
      <h5> Nueva Noticia</h5>

      <!--aqui empieza el form para añadir nuevas noticias--->

      <form class="form-floating mb-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <div class="mb-3">
          <label for="titulo">
            Título:</label>
             <input type="text" name="titulo" class="form-control" id="floatingInput" value="Titular de Noticia Local"><br>
        </div>

        <div class="mb-3">
          <label for="texto">Contenido:</label>
          <textarea name="texto" id="texto" class="form-control" id="floatingTextarea"><?php echo $lorem ?></textarea>
        </div>

        <div class="mb-3">
          <label for="imagen_url">
            Imagen: </label>
            <input class="form-control" id="floatingInput" type="url" name="imagen_url" value="<?php echo $imagen_url ?>"><br>
        </div>

        <div class="mb-3">

          <label>Categoría: <input list="categorias" name="categoria" value="" /></label>
          <datalist id="categorias">
            <?php
            //aqui se va a generar una lista tipo select con las categorias que tenemos en las noticias
            $qCategory = "SELECT DISTINCT categoria FROM noticia ORDER BY categoria"; //busqueda categorias existentes en DB
            $resultCategory = consulta($qCategory); //consulta

            //bucle que recorre cada fila para pintar las categorias que existen
            while ($row = mysqli_fetch_array($resultCategory)) { ?>
              <option value="<?php echo $row['categoria']; ?>"><?php echo $row['categoria'] ?></option>
            <?php } ?>

          </datalist>
        </div>

        <!--datos del usuario autenticado que se reemplazan con las variables de sesión-->
        <div class="mb-3 row">
        <label for="user_name" class="col-sm-2 col-form-label">Creado por:</label>
        <input class="form-control" type="text" name='user_name' value="Fernando" aria-label="Disabled input example" disabled readonly>
        </div>
        <div class="mb-3 row">
        <label for="user_id" class="col-sm-2 col-form-label">Id de usuario:</label>
        <input class="form-control" type="text" value="4" name="user_id" aria-label="Disabled input example" disabled readonly>
        </div>

        <!--<input type="hidden" name="user_id" value="4" -->

        <!-- <label> //x si decido incluir imagen de archivo 
            Subir Imagen:<br>
            <input type="file" name="imagen-file" id="imagen-file">
          </label> -->

        <input type="submit" value="Enviar" name="submit">

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST" /*&& !(isset($_POST["email"]) && isset($_POST["password"]))*/) {

          $titulo = $_POST['titulo'];
          $user_id = $_POST['user_id'];
          $texto = $_POST['texto'];
          $categoria = $_POST['categoria'];
          $imagen_url = $_POST['imagen_url'];


          $q = " INSERT INTO `noticia` (`id`, `user_id`,`fecha`, `titulo`,`texto`, `categoria`, `imagen_url`) VALUES (NULL,'$user_id',CURRENT_TIMESTAMP,'$titulo','$texto','$categoria','$imagen_url')";

          if (consulta($q)) {

            //refresca la consulta y actualiza ¿?
            $refresh_query = consulta($query); // Fetch the updated result set
            $nrows = contar_filas($refresh_query);

            echo 'se ha añadido la noticia exitosamente.Hay ' . $nrows . 'en la base de datos';
          } else {
            echo 'error al añadir el registro';
          };
        };
        ?>

      </form>

    </section>
  </main>

  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="#" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
        <img src="./assets//img/logoipsum-286.svg" class="bi" width="200px"></img>
      </a>
      <span class="text-muted">© 2024 Company, Inc</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
            <use xlink:href="#twitter"></use>
          </svg></a></li>
      <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
            <use xlink:href="#instagram"></use>
          </svg></a></li>
      <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
            <use xlink:href="#facebook"></use>
          </svg></a></li>
    </ul>
  </footer>









  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>