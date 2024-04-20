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
          <h4><?php echo $mensaje; ?></h4> <!---solo aparece cuando se modifica la noticia--->
          <h4> Detalle de noticia Id:  <?php echo $_GET['id'] ?> </h4>
        </div>
      </div>
    </div>
    <section class="news-detail">

    <div class="card-container">


		<div class="tarjeta">

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
			$url_image = $newsDetail['url_image'];


			?>


			<img src="<?php echo $url_image; ?>" alt="Imagen de la noticia">
			<div class="contenido">
				<h2><?php echo $titulo; ?></h2>
				<p>Publicada por: <span class="autor"><?php echo $autor?></span></p>
        <p>User Id: <span class="autor"><?php echo $user_id?></span></p>
				<p class="texto"><?php echo $texto; ?></p>
				<p class="fecha">Fecha de Publicación:<?php echo $fecha; ?> </p>
				<p class="categoria">Categoría: <?php echo $categoria; ?></p>
				<a href="index.php" target="_blank">Volver</a>
			</div>
		</div>
	</div>


	<?php
	if (isset($_GET["update"])) {
	?>
		<div class="form-container">

			<div class="formulario">
				<h2>Actualizar Noticia</h2>
				<form action="update.php" method="POST">

					<input type="hidden" id="id" name="id" value="<?php echo $id ?>" required>

					<label for="url_imagen">URL de la Imagen:</label>
					<input type="text" id="imagen-url" name="imagen-url" value="<?php echo $url_image ?>" required>

					<label for="titulo">Título:</label>
					<input type="text" id="titulo" value="<?php echo $titulo; ?>" name="titulo" required>

					<label for="autor">Autor:</label>
					<input type="text" value="<?php echo $autor ?>" id="autor" name="autor" required>

					<label for="texto">Contenido:</label>
					<textarea id="texto" name="texto" rows="4" required>"<?php echo $texto ?>" </textarea>


					<label for="fecha">Fecha:</label>
					<input type="text" id="fecha" value="<?php echo $fecha ?>" name="fecha" required>

					<label for="categoria">Categoría:</label>
					<input list="categorias" type="text" id="categoria" name="categoria" value="<?php echo $categoria; ?>">
					<datalist id="categorias">
						<?php

						// Bucle sobre las distintas categorías.
						while ($cat = mysqli_fetch_array($resultCategorias)) {
							$selected = "";
							if ($categoria == $cat["categoria"]) $selected = "selected";
						?>
							<option value="<?php echo $cat["categoria"]; ?>" <?php echo $selected; ?>>
								<?php echo $cat["categoria"]; ?>
							</option>
						<?php  } ?>
					</datalist>



					<input type="submit" value="Guardar Cambios">
				</form>
			</div>


		</div>
	<?php } ?>
     
    </section>

    <!-- Actualizar NOTICIAS-->
    <section id="updateNewsForm" class="container-sm">
      <h5> Actualizar Noticia</h5>

      <!--aqui empieza el form para añadir nuevas noticias--->

      <form class="form-floating mb-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <div class="mb-3">
          <!--titulo-->
          <label for="titulo">Título:</label>
          <input type="text" name="titulo" class="form-control" value="Titular de Noticia Local"><br>

          <!--categoria-->
          <label>Categoría: <input class="form-control" list="categorias" name="categoria" value="" /></label>
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

        <input type="submit" value="Enviar" name="submit">

        <?php

        $mensaje = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST" /*&& !(isset($_POST["email"]) && isset($_POST["password"]))*/) {

          $titulo = $_POST['titulo'];
          $user_id = $_POST['user_id'];
          $texto = $_POST['texto'];
          $categoria = $_POST['categoria'];
          $imagen_url = $_POST['imagen_url'];

          //echo $titulo." ".$texto." ".$categoria." ".$imagen_url." ".$user_id;


          $q = " INSERT INTO `noticia` (`id`, `user_id`,`fecha`, `titulo`,`texto`, `categoria`, `imagen_url`) VALUES (NULL,'$user_id',CURRENT_TIMESTAMP,'$titulo','$texto','$categoria','$imagen_url')";




          if (!consulta($q)) {

            $mensaje = "ERROR: no se ha subido la noticia <a href=index.php>'VOLVER'</a>";
            echo $mensaje;

            exit();
          } else {

            $mensaje = 'se ha añadido la noticia exitosamente.Hay ' . $nrows . ' noticias en la base de datos';

            echo $mensaje;
            exit();
          }
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