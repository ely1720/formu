<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Hacer pedido</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      body {
        background-image: url("MFondo.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        min-height: 100vh;
      }
      .form-container {
        background-color: #a27100a8;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
      }
      .navbar {
        background-color: #794901cf !important;
        height: 70px;
        padding: 0 1rem;
        display: flex;
        align-items: center;
      }
      .img-logo img {
        height: 60px;
        width: auto;
      }
      .img-logo {
        display: flex;
        align-items: center;
        margin-right: 1rem;
      }
    </style>
  </head>

  <body>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <div class="img-logo">
        <img src="LOGOTIPO-PANQUES.png" alt="">
    </div>
    <a class="navbar-brand" href="#">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Panques y Mantecadas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Eventos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pedidos</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <!-- Formulario -->
    <div class="container py-5">
      <main>
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 form-container">
            <h4 class="mb-4 text-center text-white">Hacer pedido</h4>
            
            <form id="pedidoForm" action="procesar_pedido.php" method="POST">      <!--incluir FORM y METHOD para la comunicacion entre los archivos-->
              
              <div class="mb-3">
                <label class="form-label text-white">Productos solicitados:</label>
                <input type="text" class="form-control" name="productos" required>
              </div>

              <div class="mb-3">
                <label class="form-label text-white">Nombre:</label>
                <input type="text" class="form-control" name="nombre" required>
              </div>

              <div class="mb-3">
                <label class="form-label text-white">Día de entrega:</label>
                <select class="form-select" name="dia" required>
                  <option value="">Elige</option>
                  <option>Lunes</option>
                  <option>Sábado</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label text-white">Colonia (Progreso, Piaxtla, Puebla):</label>
                <select class="form-select" name="colonia" required>
                  <option value="">Elige colonia</option>
                  <option>Barrio Santa Cruz</option>
                  <option>Barrio San Isidro</option>
                  <option>Centro</option>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label text-white">Total del pedido:</label>
                <input type="number" step="0.01" class="form-control" name="total" required>
              </div>

              <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Enviar pedido</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
              </div>
              
            </form>

          </div>
        </div>
      </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  
//--------------------------CONEXION CON API DE WHATSAPP---------------------------------------------------------------------
<script>
document.getElementById("pedidoForm").addEventListener("submit", function(e) {
  e.preventDefault(); // Evita que el formulario se envíe de inmediato

  // Obtener los valores del formulario
  const productos = document.querySelector('input[name="productos"]').value;
  const nombre = document.querySelector('input[name="nombre"]').value;
  const dia = document.querySelector('select[name="dia"]').value;
  const colonia = document.querySelector('select[name="colonia"]').value;
  const total = document.querySelector('input[name="total"]').value;

  // Formato del mensaje para WhatsApp
  const mensaje = `*Nuevo pedido PANQUES* %0A
   Nombre: ${nombre}%0A
   Productos: ${productos}%0A
   Día de entrega: ${dia}%0A
   Colonia: ${colonia}%0A
   Total: $${total}`;

  // Número de WhatsApp al que se enviará (usa formato internacional, ej. +521 para México)
  const numero = "525638840877"; // <-- ESTE ES MI NÚMERO

  // URL para WhatsApp
  const url = `https://wa.me/${numero}?text=${mensaje}`; //forma la estructura del mensaje obtiene mi numero y el mensaje redactado

  // Enviar datos al servidor (base de datos)
  fetch(this.action, {   //"Envía todos los datos del formulario usando POST al archivo procesar_pedido.php”.
    method: this.method,
    body: new FormData(this)
  }).then(() => {            // se ejecuta cuando la petición al servidor fue exitosa.
    // Abrir WhatsApp después de guardar
    window.open(url, "_blank"); //abre la url del api whatsapp en una nueva pestaña
  }).catch(error => {
    alert("Error al procesar el pedido: " + error);
  });
});


/*El formulario se intercepta con JavaScript (submit).

fetch() envía los datos a procesar_pedido.php.

Si se guardan correctamente (.then()): abre WhatsApp con el mensaje listo.

Si ocurre un error (.catch()): muestra un alerta con el problema.
*/

</script>

  
  </body>
</html>
