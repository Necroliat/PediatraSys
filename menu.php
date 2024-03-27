<html>

<head>
  <title>Sis_Pediátrico</title>
  <link rel="icon" type="image/x-icon" href="IMAGENES/hospital2.ico">
  <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIS_Pediátrico</title>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Obtén todos los títulos de tarjetas
      var cardTitles = document.querySelectorAll('.card-title');

      // Agrega el evento hover a cada título de tarjeta
      cardTitles.forEach(function(cardTitle) {
        cardTitle.addEventListener('mouseenter', function() {
          // Encuentra la tarjeta padre de este título
          var card = this.closest('.card');

          // Aplica el efecto solo a la tarjeta encontrada
          if (card) {
            card.style.transform = 'scale(1.1)';
          }
        });

        cardTitle.addEventListener('mouseleave', function() {
          // Encuentra la tarjeta padre de este título
          var card = this.closest('.card');

          // Restablece la transformación solo a la tarjeta encontrada
          if (card) {
            card.style.transform = 'scale(1)';
          }
        });
      });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Obtén todos los títulos de tarjetas
      var cardTitles = document.querySelectorAll('.card-title');

      // Agrega el evento hover a cada título de tarjeta
      cardTitles.forEach(function(cardTitle) {
        cardTitle.addEventListener('mouseenter', function() {
          // Encuentra la tarjeta padre de este título
          var card = this.closest('.card');

          // Aplica el efecto solo a la tarjeta encontrada
          if (card) {
            card.style.transform = 'scale(1.1)';
            card.style.background = 'linear-gradient(to right,  #62c4f9, #e4e5dc)';
          }
        });

        cardTitle.addEventListener('mouseleave', function() {
          // Encuentra la tarjeta padre de este título
          var card = this.closest('.card');

          // Restablece la transformación solo a la tarjeta encontrada
          if (card) {
            card.style.transform = 'scale(1)';
            card.style.background = 'linear-gradient(to right, #e4e5dc, #62c4f9)';
          }
        });
      });
    });
  </script>
  <style>
    body {
      background: linear-gradient(to right, #E8A9F7, #e4e5dc);
    }

    fieldset {
      background: linear-gradient(to right, #e4e5dc, #62c4f9);
    }

    /* Estilos para las tarjetas (card) */
    .card {
      float: left;
      width: 150px;
      height: 150px;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.2);
      background: linear-gradient(to right, #e4e5dc, #62c4f9);
      text-align: center;
      margin-bottom: 30px;
      color: #444;
      margin: 10px;
      flex-direction: column;
      align-items: center;
    }

    .card:hover {
      transform: scale(1.1);
      background: linear-gradient(to right, #62c4f9, #e4e5dc);
      box-shadow: 2px 2px 4px #000000;
    }

    .card-description {
      text-align: center;
      display: none;
      font-size: small;
    }

    .card:hover .card-description {
      display: block;
      text-align: center;
      max-height: 2000px;

    }

    .card-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: 5px;
      margin: 0% 25% 0% 25%;
    }

    .card img {
      width: 32px;
      height: 32px;
      margin-top: 5px;
    }

    .card-title {
      font-size: 14px;
      font-weight: bold;
    }

    .botones-container {
      margin: 2px;
      padding: 2px;
      box-sizing: unset;
      width: 100%;
      float: left;
      text-align: center;

    }

    .boton {
      border: none;
      outline: none;
      height: 15px;
      color: #fff;
      font-size: 14px;
      background: linear-gradient(to right, #4a90e2, #63b8ff);
      cursor: pointer;
      border-radius: 2vw;
      width: 80px;
      margin-top: 2vw;
      text-decoration: none;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      height: auto;
      min-height: 20px;
    }

    .boton:hover {
      scale: 1.1;
      background: linear-gradient(to right, #63b8ff, #4a90e2);
      box-shadow: 2px 2px 4px #000000;
      margin-right: 10px;
      margin-left: 10px;
    }
  </style>
  <?php

  include("menu_lateral_header.php");

  ?>

</head>

<body>



  <?php

  //include("menu_lateral.php");

  ?>


  <div style="width:100%; padding: 6px; width: 100%; display: flex; flex-direction: column; align-items: center;">
    <h2 style="padding: 1%;text-align: center;text-transform: uppercase;font-family: bitter; color:black; padding: 15px; width: 100%; display: flex; flex-direction: column; align-items: center;">
      Menú Principal</h2>
    <img src="IMAGENES\Browser.256.png" class="" alt="crud" width="82px" heigth="82px">


    <a id="redireccionar" href="#" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
      <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">login</i>
      Login
    </a>
    <script>
      document.getElementById("redireccionar").addEventListener("click", function(event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del enlace
        window.top.location.href = "index.php"; // Redirige a menuadmin.php en la ventana principal
      });
    </script>
  </div>
  </div>

  <!-- <h2 style="padding: 5%;text-align: center;text-transform: uppercase;">Menú Principal Sistema de Pediatría</h2> -->



  <div class="card-container">
    <a href="menu-mant.php">
      <div class="card-wrapper">
        <div class="card">
          <div class="card-title">Mantenimientos</div>
          <img src="IMAGENES/Mantenimientos.png" class="card-icon" alt="Mantenimientos">
          <div class="card-description">
            <p>Realizar operaciones de mantenimiento sobre
              la base de datos.</p>
          </div>
        </div>
      </div>
    </a>
    <a href="menu-proces.php">
      <div class="card-wrapper">
        <div class="card">
          <div class="card-title">Procesos</div>
          <img src="IMAGENES/procesos.png" class="card-icon" alt="Procesos">
          <div class="card-description">
            <p>Ejecutar procesos que involucran procedimientos medicos.</p>
          </div>
        </div>
      </div>
    </a>
    <div class="card-wrapper">
      <div class="card">
        <div class="card-title">Consultas</div>
        <img src="IMAGENES/consultas.png" class="card-icon" alt="Consultas">
        <div class="card-description">
          <p>Realizar consultas personalizadas sobre la base de datos.</p>
        </div>
      </div>
    </div>

    <div class="card-wrapper">
      <div class="card">
        <div class="card-title">Reportes</div>
        <img src="IMAGENES/reportes.png" class="card-icon" alt="Reportes">
        <div class="card-description">
          <p>Generar reportes comunes</p>
        </div>
      </div>
    </div>
    <a href="backup/MainBackup.php">
    <div class="card-wrapper">
      <div class="card">
        <div class="card-title">backup</div>
        <img src="IMAGENES/backup-64.png" class="card-icon" alt="Reportes">
        <div class="card-description">
          <p>Generar y recuperar Backup de la base de datos</p>
        </div>
      </div>
    </div>
    </a>
  </div>


</body>

</html>