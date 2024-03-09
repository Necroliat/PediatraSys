<?php
/*// menu_lateral.php

function imprimirInicioDocumento() {
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Anton:regular" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Bitter:100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                background: linear-gradient(to right, #7789, #fff6);
            }

            #sidebar {
                height: 100%;
                position: fixed;
                top: 0;
                left: -20%;
                background-color: #f8f9fa;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
                width: 20%;
            }

            #sidebar.active {
                left: 0;
            }

            #content {
                width: 80%;
                transition: margin-left 0.5s;
                padding: 15px;
            }

            @media (max-width: 768px) {
                #sidebar {
                    width: 80%;
                }

                #content {
                    width: 100%;
                }

                #sidebar.active {
                    left: 0;
                }
            }

            .treeview-menu {
                display: none;
                list-style-type: none;
                padding-left: 20px;
            }

            .treeview-menu.active {
                display: block;
            }

            .treeview-menu li {
                padding-top: 5px;
                padding-bottom: 5px;
            }

            .treeview-menu li a {
                text-decoration: none;
            }
            /* Estilos para las tarjetas (card) */
           /* .card {
                display: flex;
                flex-direction: row;
                align-items: center; /* Centrar verticalmente el contenido en la tarjeta */
              /*  padding: 15px; /* Ajusta el espacio interno de la tarjeta según sea necesario */
              /*  margin-bottom: 10px; /* Ajusta el margen inferior entre tarjetas según sea necesario */
              /*  background: linear-gradient(to right, #7789, #e4e5dc); /* Fondo de la tarjeta */
               /* border-radius: 10px; /* Bordes redondeados para la tarjeta */
               /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave para la tarjeta */
           /* }
            
           /* .card-title {
                font-family: Arial Black;
                color: black;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            
            .card-icon {
                margin-right: 20px; /* Ajusta el margen entre el icono y el texto según sea necesario */
              /*  max-width: 50px; /* Ajusta el ancho máximo del icono según sea necesario */
           /* }*/
            

     /*   </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">';
}

function imprimirBotonActivacion() {
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>';
}

function imprimirMenuLateral() {
    echo '<div id="sidebar" class="sidebar-sticky">
            <ul class="nav flex-column">';
    
    // Agrega aquí tus elementos de menú como listas multinivel
    echo '<li><a href="#">Menú 1</a></li>';
    echo '<li><a href="#">Menú 2</a></li>';
    echo '<li class="treeview">
            <a href="#">Menú 3</a>
            <ul class="treeview-menu">
                <li><a href="#">Submenú 3.1</a></li>
                <li><a href="#">Submenú 3.2</a></li>
            </ul>
          </li>';

    // Agrega más elementos según sea necesario

    echo '</ul></div>';
}

function imprimirInicioContenidoPrincipal() {
    echo '<div id="content">';
}

function imprimirFinContenidoPrincipal() {
    echo '</div>';
}

function imprimirFinDocumento() {
    echo '<!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#sidebarCollapse").on("click", function () {
                $("#sidebar").toggleClass("active");
                $("#content").toggleClass("active");
            });

            $(".treeview > a").on("click", function (e) {
                e.preventDefault();
                $(this).parent().toggleClass("treeview-menu-active");
                $(this).next(".treeview-menu").toggleClass("active");
            });
        });
    </script>
    </body></html>';*/
/*}*/
?>

<!-- menu_lateral.php -->

<!-- Contenido del menú lateral -->
<!-- Contenido del menú lateral -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button type="button" id="sidebarCollapse" class="btn btn-info">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<ul class="nav flex-column">
    <li class="nav-item"><a class="nav-link" href="?opcion=menu-mant">Menú Mantenimientos</a></li>
    <li class="nav-item"><a class="nav-link" href="?opcion=menu-pacientes">Menú Pacientes</a></li>
    <!-- Otras opciones del menú -->
</ul>

<script>
    document.getElementById('sidebarCollapse').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('content').classList.toggle('active');
    });

    // Manejar clics en las opciones del menú lateral
    $(".nav-link").on("click", function (e) {
        e.preventDefault();
        var opcion = $(this).attr("href").replace("?opcion=", "");
        console.log("Opción del menú:", opcion);
        cargarContenido(opcion);
    });

    // Debug
    console.log("Debug: Estoy aquí en menu_lateral.php");
</script>

<?php
// Debug
echo 'Debug: Estoy aquí en menu_lateral.php';
// Resto del código de menu_lateral.php
?>

}*/
?>

