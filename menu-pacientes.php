 <html>

 <head>
   <title>Sis_Pediátrico</title>
   <link rel="icon" type="image/x-icon" href="IMAGENES/hospital2.ico">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link href="https://fonts.googleapis.com/css?family=Anton:regular" rel="stylesheet" />
   <link href="https://fonts.googleapis.com/css?family=Bitter:100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic" rel="stylesheet" />
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
 <?php

  //include("menu_lateral.php");

  ?>

 <body style="background: linear-gradient(to right, #E8A9F7,#e4e5dc ); ">
   <div style="width:100%; padding: 6px; width: 100%; display: flex; flex-direction: column; align-items: center;">
     <h2 style="padding: 1%;text-align: center;text-transform: uppercase;font-family: bitter; color:black; padding: 15px; width: 100%; display: flex; flex-direction: column; align-items: center;">Procedimientos de los Pacientes</h2>
     <img src="IMAGENES\pacienteColor.png" class="" alt="crud">
   </div>
   <div class="botones-container" style="margin-top:0%;">



    <!--  <a href="menu-mant.php" id="btnatras" class="btn btn-primary boton" style="width: 120px; font-size:small;vertical-align: baseline; font-weight:bold;">
       <i class="material-icons" style="font-size:small;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">arrow_back</i> Atras
     </a>

     <a href="menu.php" id="btnatras" class="btn btn-primary boton" style="width: 120px; font-size:small;vertical-align: baseline; font-weight:bold;">
       <i class="material-icons" style="font-size:small;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">menu</i> Menú Principal
     </a> -->
     <!-- <a id="redireccionar" href="#" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;font-size:small;">
       <i class="material-icons" style="font-size:small;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">login</i> Login

       <script>
         document.getElementById("redireccionar").addEventListener("click", function(event) {
           event.preventDefault(); // Evita el comportamiento predeterminado del enlace
           window.top.location.href = "index.php"; // Redirige a menuadmin.php en la ventana principal
         });
       </script>

     </a> -->
     

     <div class="card-container">

    


       <a href="paciente.php">
         <div class="card-wrapper">
           <div class="card" style="background: linear-gradient(to right,#e4e5dc ,#62c4f9 ); ">
             <div class="card-title" style="font-family: Anton; color:black;">Pacientes</div>
             <img src="IMAGENES\revisionsalud.png" class="card-icon" alt="Mantenimientos">
             <div class="card-description">Registrar datos generales del niño/a</div>
           </div>
         </div>
       </a>


       <a href="MANT-pacientevacuna.php">
       <div class="card-wrapper">
         <div class="card" style="background: linear-gradient(to right,#e4e5dc ,#62c4f9 ); ">
           <div class="card-title" style="font-family: Anton; color:black;">Vacunas</div>
           <img src="IMAGENES\vacunacion.png" class="card-icon" alt="Mantenimientos">
           <div class="card-description">Registrar datos de las vacunas para un paciente ya existente del niño/a</div>
         </div>
       </div>
     </a>

     <a href="mant_paciente_historiaClinica.php">
       <div class="card-wrapper">
         <div class="card" style="background: linear-gradient(to right,#e4e5dc ,#62c4f9 ); ">
           <div class="card-title" style="font-family: Anton; color:black;">Padecimientos</div>
           <img src="IMAGENES/historia2.png" class="card-icon" alt="Procesos">
           <div class="card-description">Insertar padecimientos/condición médica vigentes en el paciente/s</div>
         </div>
       </div>
     </a>

     <a href="mant_padres_pacientes.php">
       <div class="card-wrapper">
         <div class="card" style="background: linear-gradient(to right,#e4e5dc ,#62c4f9 ); ">
           <div class="card-title" style="font-family: Anton; color:black;">Padres</div>
           <img src="IMAGENES\\familia.png" class="card-icon" alt="Procesos">
           <div class="card-description">Registrar los Padres de los paciente/s</div>
         </div>
       </div>
     </a>

     <a href="mant_localizadorp.php">
       <div class="card-wrapper">
         <div class="card" style="background: linear-gradient(to right,#e4e5dc ,#62c4f9 ); ">
           <div class="card-title" style="font-family: Anton; color:black;">localizador Padres</div>
           <img src="IMAGENES/contacto96.png" class="card-icon" alt="Procesos">
           <div class="card-description"> Agregar Teléfonos los Padres de paciente/s</div>
         </div>
       </div>
     </a>
     </div>
   </div>

   <div class="card-container">





     


   </div>



 </body>

 </html>