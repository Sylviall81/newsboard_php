<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/login-style.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="shortcut icon" href="./assets/img/logoipsum-286.svg" type="image/x-icon">
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