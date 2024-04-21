<?php


require_once('./lib/db_utils.php');



$referrer = $_SERVER['HTTP_REFERER'];

if (!isset($_GET["id"])) {

  $mensaje = "Hay un error en la peticion: faltan parametros requeridos<br><a href=$referrer >VOLVER</a>";
  echo $mensaje;
  exit;
};


$id = ($_GET["id"]);




//query para traer las diferentes categorias y mostrarlas en el datalist ( igual q index)
$qCategory = "SELECT DISTINCT categoria FROM noticia ORDER BY categoria";
$resultCategory = consulta($qCategory);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/news-style.css">
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
            <a class="nav-link" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./login.php">Login</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <main>

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
          <h4> Estas viendo el detalle de noticia con Id: <?php echo $_GET['id'] ?> </h4>
        </div>
      </div>
    </div>
    <section class="news-detail">

      <?php
      //peticion query a la db de la info de la noticia concreta con el numero de id del enlace (llega x Get)
      $q = "SELECT noticia.*, usuarios.nombre 
      FROM noticia 
      INNER JOIN usuarios ON noticia.user_id = usuarios.id 
      WHERE noticia.id = $id";

      $result = consulta($q);
      $newsDetail = mysqli_fetch_array($result);

      $titulo = $newsDetail['titulo'];
      $texto = $newsDetail['texto'];
      $autor = $newsDetail['nombre'];
      $user_id = $newsDetail['user_id'];
      $categoria = $newsDetail['categoria'];
      $fecha = $newsDetail['fecha'];
      $imagen_url = $newsDetail['imagen_url'];

      ?>


      <div class="card-container">


        <div class="card" style="width: 35rem;">




          <img class="card-img-top" src="<?php echo $imagen_url; ?>" alt="Imagen de la noticia">
          <div class="card-body">
            <h4 class="card-title"><?php echo $titulo; ?></h4>

            <p class="card-text"><?php echo $texto; ?></p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Categoría:<?php echo $categoria; ?> </li>
            <li class="list-group-item">Publicada por: <span class="autor"><?php echo $autor ?></span></li>
            <li class="list-group-item">User Id: <span class="autor"><?php echo $user_id ?></span></li>
            <li class="list-group-item">Fecha publicación:<?php echo $fecha; ?> </li>

          </ul>
          <div class='card-footer'>
            <a class='btn btn-primary' href="index.php" target="_blank"> Home</a>
          </div>
        </div>
      </div>
    </section>


    <?php /*Solo cuando update llega x get se muestra el update form*/
    if (isset($_GET["update"])) { ?>

      <section id="updateNewsForm" class="container-sm">


        <h5> Actualizar Noticia</h5>

        <!--aqui empieza el form para añadir nuevas noticias--->

        <form class="form-floating mb-3" ction="update.php" method="POST">

          <div class="mb-3">
            <!--titulo-->
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" class="form-control" value="<?php echo $newsDetail['titulo'] ?>"><br>

            <!--categoria-->
            <label>Categoría: <input class="form-control" list="categorias" name="categoria" value="<?php echo $newsDetail['categoria'] ?>" /></label>
            <datalist id="categorias">
              <?php
              //aqui se va a generar una lista tipo select con las categorias que tenemos en las noticias
              $qCategory = "SELECT DISTINCT categoria FROM noticia ORDER BY categoria"; //busqueda categorias existentes en DB
              $resultCategory = consulta($qCategory); //consulta

              //bucle que recorre cada fila para pintar las categorias que existen
              while ($row = mysqli_fetch_array($resultCategory)) {

                $selected = "";
                if ($categoria == $row["categoria"]) $selected = "selected"
              ?>
                <option value="<?php echo $row["categoria"]; ?>" <?php echo $selected; ?>>
                  <?php echo $row["categoria"]; ?>
                </option>
              <?php  } ?>
            </datalist>

            <!--url de imagen-->
            <div class="mb-3">
              <label for="imagen_url">
                Imagen: </label>
              <input class="form-control" type="url" name="imagen_url" value="<?php echo $url_imagen ?>"><br>
            </div>
            <!--Contenido-->
            <div class="mb-3">
              <label for="texto">Contenido:</label>
              <textarea name="texto" id="texto" class="form-control"><?php echo $lorem ?></textarea>
            </div>
          </div>



          <!--datos del usuario autenticado creador de noticia que se reemplazan con las variables de sesión-->
          <div class="mb-3">
            <label for="user_name" class="col-form-label">Creado por:</label>
            <input class="form-control" type="text" name='user_name' value="Fernando" readonly>

            <label for="user_id" class="col-form-label">Id de usuario:</label>
            <input class="form-control" type="text" value="4" name="user_id" readonly>
          </div>


          <!--<input type="hidden" name="user_id" value="4" -->

          <!-- <label> //x si decido incluir imagen de archivo 
      Subir Imagen:<br>
      <input type="file" name="imagen-file" id="imagen-file">
    </label> -->

          <input type="submit" value="Actualizar" name="submit">


        </form>

      </section>

    <?php } ?>




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