<html>

<head>
  <title>Sis_Pediátrico</title>
  <link rel="icon" type="image/x-icon" href="IMAGENES/hospital2.ico">
  <!-- <link rel="stylesheet" type="text/css" href="css/estilo-paciente.css"> -->
 
  
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- <link rel="stylesheet" type="text/css" href="css/estilo-paciente.css"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://kit.fontawesome.com/726ca5cfb3.js" crossorigin="anonymous"></script>
  <meta charset="UTF-8">
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

    fieldset {
      font-size: medium;
    }

    * {
      font-size: medium;
    }

    fieldset {
      border: 1px solid #ddd;
      border-radius: 2vw;
      background: linear-gradient(to right, #e4e5dc, #45bac9db);
      padding: 1vw;
      box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
      margin-bottom: 10px;


    }

    .divisor {
    /*   display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-column-gap: 10px;
      grid-row-gap: 10px; */
     
    }

    fieldset fieldset legend {
      font-size: 14px;
      text-transform: uppercase;
      padding-left: 10%;
      padding-right: 10%;
      background-color: transparent;
    }

    legend {
      font-weight: bold;
      font-size: 18px;
      text-transform: uppercase;
      font-weight: bold;
      margin-bottom: 1vw;
      background: linear-gradient(to right, #e4e5dc, #45bac9db);
      border: solid 1px #45bac9db;
      border-radius: 10px;
      width: 100%;
    }
  </style>
  <style>
    fieldset {
      border: 1px solid #ddd;
      border-radius: 2vw;
      background: linear-gradient(to right, #e4e5dc, #45bac9db);
      padding: 1vw;
      box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
      margin-left: 7%;
      margin-right: 7%;
    }

    .divisor {
  /* Agregar grid */
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-column-gap: 5px;
  grid-auto-rows:200px;
}

.botones {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-auto-rows: 60px; /* Definir una altura fija para cada fila */
  grid-column-gap: 5px;
  grid-row-gap: 10px;
}

.botones button {
  width: 100%;
  /* Mantener el alto constante */

  height: 60px; /* Ajusta el valor según sea necesario */
}

.descripcion {
  display: none;
}

/* Mostrar la descripción solo cuando se pasa el mouse sobre el botón */
.botones button:hover+.descripcion {
  display: block;
}

  </style>
</head>

<body>

  <fieldset id="Pacientes">
    <legend>Pacientes</legend>
    <div class="divisor">
      <div class="botones">
        <a href="consultas/consulta_paciente_p.php"><button onmouseover="mostrarInformacion('info1')" onmouseout="ocultarInformacion('info1')"><i class="fa-solid fa-hospital-user"></i> Consulta Paciente General</button></a>
        <button onmouseover="mostrarInformacion('info2')" onmouseout="ocultarInformacion('info2')"><i class="fa-solid fa-syringe"></i> Consulta Vacunas Paciente</button>
        <button onmouseover="mostrarInformacion('info3')" onmouseout="ocultarInformacion('info3')"><span class="material-symbols-outlined">diagnosis</span> Historia clínica paciente</button>
        <a href="consultas/consulta_padrespacientesP.php"><button onmouseover="mostrarInformacion('info4')" onmouseout="ocultarInformacion('info4')"><i class="fa-solid fa-people-roof"></i> Consulta Padres Pacientes</button></a>
      </div>
      <div class="contenido">
        <fieldset>
          <legend>INFORMACIÓN ADICIONAL</legend>
          <p id="infoBotonPacientes"></p>
        </fieldset>
      </div>
    </div>
  </fieldset>

  <script>
    // Objeto que mapea el ID de la descripción con su contenido para Pacientes
    var descripcionesPacientes = {
      info1: "Información: Esta consulta proporciona información general sobre el paciente.",
      info2: "Información: Esta consulta muestra las vacunas administradas al paciente.",
      info3: "Información: Esta consulta presenta la historia clínica del paciente.",
      info4: "Información: Esta consulta muestra información sobre los padres del paciente."
    };

    // Función para mostrar la información del botón de Pacientes
    function mostrarInformacion(id) {
      document.getElementById("infoBotonPacientes").textContent = descripcionesPacientes[id];
    }

    // Función para ocultar la información del botón de Pacientes
    function ocultarInformacion(id) {
      document.getElementById("infoBotonPacientes").textContent = "";
    }
  </script>


  <fieldset id="Médicos">
    <legend>MÉDICOS</legend>
    <div class="divisor">
      <div class="botones">
       <a href="consultas/consulta_medicoP.php"> <button onmouseover="mostrarInformacionMedico('infoMedico1')" onmouseout="ocultarInformacionMedico('infoMedico1')"><i class="fa-solid fa-user-doctor"></i> Médico General</button></a>
       <a href="consultas/consulta_trabajomedicoP.php"><button onmouseover="mostrarInformacionMedico('infoMedico2')" onmouseout="ocultarInformacionMedico('infoMedico2')"><i class="fa-solid fa-book-medical"></i> Trabajo/actividad Médico/a</button></a>
       <a href="consultas/consulta_especialidadP.php"><button onmouseover="mostrarInformacionMedico('infoMedico3')" onmouseout="ocultarInformacionMedico('infoMedico3')"><i class="fa-solid fa-staff-snake"></i> Especialidad Médico</button></a>
        <button onmouseover="mostrarInformacionMedico('infoMedico4')" onmouseout="ocultarInformacionMedico('infoMedico4')"><i class="fa-solid fa-calendar-days"></i> Horario Médico</button>
        <button onmouseover="mostrarInformacionMedico('infoMedico5')" onmouseout="ocultarInformacionMedico('infoMedico5')"><i class="fa-solid fa-address-book"></i> Directorio Médico</button>
      
      </div>
      <div class="contenido">
        <fieldset>
          <legend>Información ADICIONAL</legend>
          <p id="infoBotonMedicos"></p>
        </fieldset>
      </div>
    </div>
  </fieldset>

  <script>
    // Objeto que mapea el ID de la descripción con su contenido para Médicos
    var descripcionesMedicos = {
      infoMedico1: "Información: Esta consulta proporciona información general sobre el médico.",
      infoMedico2: "Información: Esta consulta muestra el trabajo y las actividades del médico.",
      infoMedico3: "Información: Esta consulta muestra la especialidad del médico.",
      infoMedico4: "Información: Esta consulta muestra el horario del médico.",
      infoMedico5: "Información: Esta consulta muestra el directorio de médicos disponibles."
    };

    // Función para mostrar la información del botón de Médicos
    function mostrarInformacionMedico(id) {
      document.getElementById("infoBotonMedicos").textContent = descripcionesMedicos[id];
    }

    // Función para ocultar la información del botón de Médicos
    function ocultarInformacionMedico(id) {
      document.getElementById("infoBotonMedicos").textContent = "";
    }
  </script>


  <fieldset id="Catálogos datos médicos" style=" height: 400px;">
    <legend>Catálogos datos médicos</legend>
    <div class="divisor">
      <div class="botones">
        <a href="consultas/consulta_segurosP.php"><button onmouseover="mostrarInformacionCatalogo('infoCatalogo1')" onmouseout="ocultarInformacionCatalogo('infoCatalogo1')"><i class="fa-solid fa-id-card-clip"></i> Seguros Médicos</button></a>
        <a href="consultas/consulta_usuarioP.php"><button onmouseover="mostrarInformacionCatalogo('infoCatalogo2')" onmouseout="ocultarInformacionCatalogo('infoCatalogo2')"><i class="material-icons">account_circle</i> Consulta Usuarios</button></a>
        <a href="consultas/consulta_centromedicoP.php"><button onmouseover="mostrarInformacionCatalogo('infoCatalogo3')" onmouseout="ocultarInformacionCatalogo('infoCatalogo3')"><i class="fa-solid fa-hospital"></i> Centro Médico</button></a>
        <a href="consultas/consulta_medicamentoP.php"> <button onmouseover="mostrarInformacionCatalogo('infoCatalogo4')" onmouseout="ocultarInformacionCatalogo('infoCatalogo4')"><i class="fa-solid fa-capsules"></i> Consulta Medicamentos</button></a>
        <a href="consultas/consulta_vacunasP.php"><button onmouseover="mostrarInformacionCatalogo('infoCatalogo5')" onmouseout="ocultarInformacionCatalogo('infoCatalogo5')"><i class="material-icons">vaccines</i> Consulta Vacunas</button></a>
        <a href="consultas/consulta_padecimientosP.php"><button onmouseover="mostrarInformacionCatalogo('infoCatalogo6')" onmouseout="ocultarInformacionCatalogo('infoCatalogo6')"><i class="fa-solid fa-head-side-cough"></i> Consulta Padecimientos</button></a>
        <a href="consultas/consulta_laboratorioP.php"><button onmouseover="mostrarInformacionCatalogo('infoCatalogo7')" onmouseout="ocultarInformacionCatalogo('infoCatalogo7')"><i class="fa-solid fa-flask-vial"></i> Consulta Laboratorio</button></a>
      </div>
      <div class="contenido">
        <fieldset>
          <legend>INFORMACIÓN ADICIONAL</legend>
          <p id="infoBotonCatalogo"></p>
        </fieldset>
      </div>
    </div>
  </fieldset>

  <script>
    // Objeto que mapea el ID de la descripción con su contenido para Catálogos datos médicos
    var descripcionesCatalogos = {
      infoCatalogo1: "Información: Esta consulta muestra los seguros médicos disponibles.",
      infoCatalogo2: "Información: Esta consulta permite consultar usuarios.",
      infoCatalogo3: "Información: Esta consulta muestra el centro médico.",
      infoCatalogo4: "Información: Esta consulta muestra los medicamentos disponibles.",
      infoCatalogo5: "Información: Esta consulta muestra las vacunas disponibles.",
      infoCatalogo6: "Información: Esta consulta muestra los padecimientos disponibles.",
      infoCatalogo7: "Información: Esta consulta muestra los laboratorios disponibles."
    };

    // Función para mostrar la información del botón de Catálogos datos médicos
    function mostrarInformacionCatalogo(id) {
      document.getElementById("infoBotonCatalogo").textContent = descripcionesCatalogos[id];
    }

    // Función para ocultar la información del botón de Catálogos datos médicos
    function ocultarInformacionCatalogo(id) {
      document.getElementById("infoBotonCatalogo").textContent = "";
    }
  </script>


  <fieldset id="Procesos">
    <legend>Procesos</legend>
    <div class="divisor">
      <div class="botones">
      <a href="consultas/Consulta_Consulta_pacientepormedicoP.php"><button onmouseover="mostrarInformacionProceso('infoProceso1')" onmouseout="ocultarInformacionProceso('infoProceso1')"><i class="fa-solid fa-house-chimney-medical"></i> Consultas Médicas</button></a>
      <a href="consultas/Consulta_recetasmedicasP.php"><button onmouseover="mostrarInformacionProceso('infoProceso2')" onmouseout="ocultarInformacionProceso('infoProceso2')"><i class="fa-solid fa-prescription"></i> Consulta Recetas Médicas</button></a>
        <a href="consultas/Consulta_certificadosmedicosP.php"><button onmouseover="mostrarInformacionProceso('infoProceso3')" onmouseout="ocultarInformacionProceso('infoProceso3')"><i class="fa-solid fa-file-medical"></i> Consulta Certificados Médicos</button></a>
        <a href="consultas/consulta_referimientosP.php"><button onmouseover="mostrarInformacionProceso('infoProceso4')" onmouseout="ocultarInformacionProceso('infoProceso4')"><i class="fa-solid fa-file-lines"></i><i class="fa-solid fa-receipt"></i>&nbsp; Referimientos Médicos</button></a>
      </div>
      <div class="contenido">
        <fieldset>
          <legend>INFORMACIÓN ADICIONAL</legend>
          <p id="infoBotonProcesos"></p> 
        </fieldset>
      </div>
    </div>
  </fieldset>

  <script>
    // Objeto que mapea el ID de la descripción con su contenido para Procesos
    var descripcionesProcesos = {
      infoProceso1: "Información: Esta consulta muestra los procesos de consultas médicas.",
      infoProceso2: "Información: Esta consulta permite consultar recetas médicas.",
      infoProceso3: "Información: Esta consulta permite consultar certificados médicos.",
      infoProceso4: "Información: Esta consulta permite consultar referimientos médicos realizados."
    };

    // Función para mostrar la información del botón de Procesos
    function mostrarInformacionProceso(id) {
      document.getElementById("infoBotonProcesos").textContent = descripcionesProcesos[id];
    }

    // Función para ocultar la información del botón de Procesos
    function ocultarInformacionProceso(id) {
      document.getElementById("infoBotonProcesos").textContent = "";
    }
  </script>

 

</body>

</html>