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
      width: 200px;
      height: 200px;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.2);
      background: linear-gradient(to right, #e4e5dc, #62c4f9);
      text-align: justify;
      margin-bottom: 30px;
      color: #444;
      margin: 10px;
      transition: transform 0.3s;
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .card img {
      width: 50px;
      height: 50px;
      margin-top: 10px;
    }

  card:hover {
    transform: scale(1.1);
}

    .card-title {
      font-size: 20px;
      font-weight: bold;
    }

    .card-description {
      display: none;
    }

    .card:hover .card-description {
      display: block;
      text-align: justify;
    }


    /* .card-container {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-gap: 10px;
      margin: 2% 20% 0% 20%;
    } */

    .card-container {
      display: grid;
      grid-template-columns: repeat(3, 30%);
      grid-gap: 10px;
      width: 60%;
      margin: 2% 20% 0% 20%;
    }

    .botones-container {
      margin: 2px;
      padding: 2px;
      box-sizing: unset;
      width: 100%;
      float: left;
      text-align: center;
      /*justify-content: center;*/
    }

    .boton {
			border: none;
			outline: none;
			height: 4vw;
			color: #fff;
			font-size: 14px;
			background: linear-gradient(to right, #4a90e2, #63b8ff);
			cursor: pointer;
			border-radius: 2vw;
			width: 110px;
			margin-top: 2vw;
			text-decoration: none;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			height: auto;
			min-height: 40px;
		}
    .boton:hover{
      scale: 1.1;
      background: linear-gradient(to right, #63b8ff,  #4a90e2);
      box-shadow:2px 2px 4px #000000;
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

  include("menu_lateral.php");

  ?>


  <div style="width:100%; padding: 6px; width: 100%; display: flex; flex-direction: column; align-items: center;">
    <h2 style="padding: 1%;text-align: center;text-transform: uppercase;font-family: bitter; color:black; padding: 15px; width: 100%; display: flex; flex-direction: column; align-items: center;">Menú Principal Sistema de Pediatría</h2>
    <img src="IMAGENES\Browser.256.png" class="" alt="crud" width="82px" heigth="82px">

    
    <a href="index.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
      <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">login</i> Login
    </a>
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
            <p>Esta opción te permite realizar operaciones de mantenimiento sobre
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
          <p>Esta opción te permite ejecutar procesos que involucran procedimientos medicos.</p>
        </div>
      </div>
    </div>
   </a>
    <div class="card-wrapper">
      <div class="card">
        <div class="card-title">Consultas</div>
        <img src="IMAGENES/consultas.png" class="card-icon" alt="Consultas">
        <div class="card-description">
          <p>Esta opción te permite realizar consultas personalizadas sobre la base de datos.</p>
        </div>
      </div>
    </div>
    
    <div class="card-wrapper">
      <div class="card">
        <div class="card-title">Reportes</div>
        <img src="IMAGENES/reportes.png" class="card-icon" alt="Reportes">
        <div class="card-description">
          <p>Esta opción te permite generar reportes gráficos o estadísticos sobre la base de
            datos.</p>
        </div>
      </div>
    </div>
  </div>


</body>

</html>