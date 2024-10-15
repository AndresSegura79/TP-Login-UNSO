<?php
session_start();

?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Formulario de Registro</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

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
    </style>

  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <h2>Formulario de Registro</h2>
      <p class="lead">Por favor, complete los campos requeridos para crear una cuenta.</p>
    </div>

    <div class="row g-5">
      <div class="col-md-12">
        <h4 class="mb-3">Información Personal</h4>
        <form class="needs-validation" novalidate>
          <div class="row g-3">
            <!-- Nombre -->
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="firstName" placeholder="Ingrese su nombre" required>
              <div class="invalid-feedback">
                El nombre es requerido.
              </div>
            </div>

            <!-- Apellido -->
            <div class="col-sm-6">
              <label for="lastName" class="form-label">Apellido</label>
              <input type="text" class="form-control" id="lastName" placeholder="Ingrese su apellido" required>
              <div class="invalid-feedback">
                El apellido es requerido.
              </div>
            </div>

            <!-- Usuario -->
            <div class="col-12">
              <label for="username" class="form-label">Usuario</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" placeholder="Elija un nombre de usuario" required>
                <div class="invalid-feedback">
                  El usuario es requerido.
                </div>
              </div>
            </div>

            <!-- Email -->
            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
              <div class="invalid-feedback">
                Por favor, ingrese una dirección de email válida.
              </div>
            </div>

            <!-- Contraseña -->
            <div class="col-12">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" placeholder="Ingrese su contraseña" required>
              <div class="invalid-feedback">
                La contraseña es requerida.
              </div>
            </div>

            <!-- Fecha de Nacimiento -->
            <div class="col-12">
              <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
              <input type="date" class="form-control" id="birthdate" required>
              <div class="invalid-feedback">
                La fecha de nacimiento es requerida.
              </div>
            </div>
          </div>

          <hr class="my-4">

          <!-- Botón Registrarse -->
          <button class="w-100 btn btn-primary btn-lg" type="submit">Registrarse</button>
        </form>

       
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2021–2024 Nombre de la Compañía</p>
  </footer>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="form-validation.js"></script>

</body>
</html>
