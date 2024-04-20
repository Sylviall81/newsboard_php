<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/login-style.css">
  <title>News Board PHP</title>
</head>

<body>

  <header>
    <div class="p-5 bg-primary text-white text-center">
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
            <a class="nav-link active" href="./login.php">Login</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>


  <main>

    <div class='login-form-container'>


      <form action='index.php' method="POST">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">Tranquil@, no te enviaremos spam ni compartiremos tu información con nadie.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1">
        </div>

        <button type="submit" class="btn btn-primary">Log In</button>
      </form>

    </div>






  </main>


  <footer>

  </footer>












  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>