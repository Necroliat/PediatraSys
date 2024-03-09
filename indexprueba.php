<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto 2.0</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden; /* Evita la barra de desplazamiento horizontal */
        }

        #sidebar {
            width: 20%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        #content {
            width: 80%;
            margin-left: 20%;
            padding: 15px;
            transition: margin-left 0.5s;
        }

        @media (max-width: 768px) {
            #sidebar {
                width: 80%;
            }

            #content {
                width: 100%;
                margin-left: 0;
            }
        }

        #toggle-btn {
            position: fixed;
            top: 20px;
            left: 10px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="sidebar">
        <?php include 'menu_lateral.php'; ?>
    </div>
    <div id="content">
        <div id="dynamic-content"></div>
    </div>
    <div id="toggle-btn">&#9665;</div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#sidebarCollapse").on("click", function () {
                $("#sidebar").toggleClass("active");
                $("#content").toggleClass("active");
            });

            // Cargar contenido inicial
            cargarContenido("menu-mant");

            // Manejar clics en las opciones del menú lateral
            $(".nav-link").on("click", function (e) {
                e.preventDefault();
                var opcion = $(this).attr("href").replace("?opcion=", "");
                cargarContenido(opcion);
            });

            function cargarContenido(opcion) {
                $.ajax({
                    type: "GET",
                    url: opcion + ".php",  // Modifica la URL para cargar el archivo correspondiente
                    success: function (data) {
                        $("#dynamic-content").html(data);
                    },
                    error: function () {
                        $("#dynamic-content").html("Error al cargar el contenido.");
                    }
                });
            }
        });
    </script>
</body>
</html>
