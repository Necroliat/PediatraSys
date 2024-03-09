 



<html>

<head>
  <title>Sis_Pediátrico</title>
    <link rel="icon" type="image/x-icon" href="IMAGENES/hospital2.ico">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Anton:regular" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Bitter:100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic" rel="stylesheet" />
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    // Obtén todos los títulos de tarjetas
    var cardTitles = document.querySelectorAll('.card-title');

    // Agrega el evento hover a cada título de tarjeta
    cardTitles.forEach(function (cardTitle) {
        cardTitle.addEventListener('mouseenter', function () {
            // Encuentra la tarjeta padre de este título
            var card = this.closest('.card');

            // Aplica el efecto solo a la tarjeta encontrada
            if (card) {
                card.style.transform = 'scale(1.1)';
            }
        });

        cardTitle.addEventListener('mouseleave', function () {
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
p{text-align:justify ;}
/* Estilos para las tarjetas (card) */
.card {
	float: left;
    width: 200px;
    height: 200px;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.2);
	background: linear-gradient(to right, #e4e5dc, #62c4f9);
	text-align: center;
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
      /* Ajusta el tamaño del icono según sea necesario */
      height: 50px;
      margin-top: 10px;
      /* Espaciado entre el icono y el texto */
    }

    /*.card:hover {
    transform: scale(1.1);
}*/

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

    .card-container {
 
 display: flex;
 justify-content: space-around; /* Ajusta según tus necesidades de espaciado */
 /*display: flex;
 flex-direction: column;*/
 display: grid;
   grid-template-columns: repeat(3, 30%);
   grid-template-rows: repeat(3, 1fr);
   /* "1fr" representa una fracción del espacio disponible */
   grid-gap: 6px 10px;
 width: 60%;
 margin:2% 20% 0% 20%;
}
</style>

  <?php

include("menu_lateral_header.php");

?>


</head>
<?php

  include("menu_lateral.php");

  ?>

<body style="background: linear-gradient(to right, #E8A9F7,#e4e5dc ); ">
  <div style="width:100%; padding: 6px; width: 100%; display: flex; flex-direction: column; align-items: center;">
    <h2 style="padding: 1%;text-align: center;text-transform: uppercase;font-family: bitter; color:black; padding: 15px; width: 100%; display: flex; flex-direction: column; align-items: center;">Mantenimientos de los doctores/médicos</h2>
    <img src="IMAGENES\\menu-medico-2.png" class="" alt="crud" width="92px" height="92px">
  </div>

  <div class="card-container">
  <a href="mant_medico.php">
  <div class="card-wrapper">
    <div class="card" style="background: linear-gradient(to right,#e4e5dc ,#62c4f9 ); ">
      <div class="card-title" style="font-family: Anton; color:black;">Médico</div>
      <img src="IMAGENES\doctor-64.png" class="card-icon" alt="Mantenimientos">
      <div class="card-description">Registrar datos generales médico.</div>
    </div>
  </div>
  </a>

  <a href="mant_trabajosmedicos.php">
  <div class="card-wrapper">
    <div class="card" style="background: linear-gradient(to right,#e4e5dc ,#62c4f9 ); ">
      <div class="card-title" style="font-family: Anton; color:black;">Trabajos Medicos</div>
      <img src="IMAGENES\trabajo_medico.png" class="card-icon" alt="Mantenimientos">
      <div class="card-description">Registrar procedimientos y trabajos realizados por los doctores</div>
    </div>
  </div>
  </a>

  <a href="mant_especialidad.php">
  <div class="card-wrapper">
  <div class="card" style="background: linear-gradient(to right,#e4e5dc ,#62c4f9 ); ">
      <div class="card-title" style="font-family: Anton; color:black;">Especialidad</div>
    <img src="IMAGENES\especilidad.png" class="card-icon" alt="Procesos">
    <div class="card-description">Insertar especialidad de los doctores/médicos</div>
  </div>
  </div>
</a>
<a href="mant_horario">
  <div class="card-wrapper">
  <div class="card" style="background: linear-gradient(to right,#e4e5dc ,#62c4f9 ); ">
      <div class="card-title" style="font-family: Anton; color:black;">Horario</div>
    <img src="IMAGENES\horario-medico.png" class="card-icon" alt="Procesos">
    <div class="card-description">📆 Insertar horario de los doctores/médicos 🗓️</div>
  </div>
  </div>
</a>
  
<a href="mant_localizadorm.php">
  <div class="card-wrapper">
    <div class="card" style="background: linear-gradient(to right,#e4e5dc ,#62c4f9 ); ">
      <div class="card-title" style="font-family: Anton; color:black;">Localizador DE Medico</div>
      <img src="IMAGENES\doctor-64.png" class="card-icon" alt="Mantenimientos">
      <div class="card-description">Registrar datos generales médico.</div>
    </div>
  </div>
  </a>
  <!-- <div class="card">
    <div class="card-title">Subproceso #3</div>
    <img src="IMAGENES/none.png" class="card-icon" alt="Procesos">
    <div class="card-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget ullamcorper sapien. Integer a nisi dapibus, dignissim leo sed, porta justo. Fusce ut volutpat est, ac lacinia est. In hac habitasse platea dictumst. Nunc non ligula non mi placerat tristique. Sed id elit non elit aliquet fringilla. Vivamus in dui vitae metus semper eleifend. Quisque ullamcorper ligula vel neque vulputate eleifend.</div>
  </div> -->

</div>


  <div class="botones-container">
  <a href="menu-mant.php" class="claseboton">← Atrás</a>
    <a href="index.php" class="claseboton">Login</a>
    <a href="menu.php" class="claseboton">Menú Principal</a>
    
  </div>
<script>

</script>
</body>

</html>