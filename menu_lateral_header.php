<!-- ▓▓▓▓▓▓▓▓▓▓╬══  MENU LATERAL CÓDIGO bootstrap header ══╬▓▓▓▓▓▓▓▓▓▓ -->
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS y Popper.js (Requeridos para el Offcanvas) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

<style>
.boton_bus {
			border: none;
			outline: none;
			height: 4vw;
			color: #fff;
			font-size: 1.6vw;
			background: linear-gradient(to right, #4a90e2, #63b8ff);
			cursor: pointer;
			border-radius: 60px;
			width: 60px;
			margin-top: 2vw;
			text-decoration: none;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			height: auto;


		}

		.boton_bus:active {
			background-color: #5bc0f7;
			scale: 1.5;
			cursor: pointer;

			transition: background-color 0.8s ease, box-shadow 0.8s ease, color 0.8s ease, font-weight 0.8s ease;
			/* Animaciones de 0.5 segundos */
			box-shadow: 0 0 5px rgba(91, 192, 247, 0.8), 0 0 10px red;
			/* Sombra inicial y sombra roja */
			font-size: 25px;
			color: white;
			/* Cambiar el color del texto */
			font-weight: bold;
			/* Cambiar a negritas */
			font-family: "Copperplate", Fantasy;
		}
    /* Estilo para el botón offcanvas */
.btn-offcanvas {
    /*float: left;*/
    margin: 0px;
   position:static;

    /*top: 12px; /* Ajusta la distancia desde la parte superior según tu preferencia */
   left: 10px; /* Ajusta la distancia desde la izquierda según tu preferencia */
    z-index: 1000; /* Asegura que esté por encima de otros elementos */
   
}
    .active-item {
        background-color: #6DC4F5;
        color: white;
        font-weight: bold;
        text-shadow: 2px 1px 2px #000000;
    }
    .offcanvas {
        background: linear-gradient(to right, #E8A9F7,#e4e5dc );
        border-radius: 2%;
        
    }

    
    .list-group-mine .list-group-item {
        color: white;
        text-shadow: 2px 1px 2px #000000;
        background: linear-gradient(to right,#e4e5dc ,#62c4f9 ); 
       /* background: linear-gradient(to right,  #45bac9db, #e4e5dc);*/
       border:1px solid gray;
    }

    .list-group-item.active {
    z-index: 2;
    color: white;
    font-weight: bold;
    text-shadow: 2px 1px 2px #000000;
    background: linear-gradient(to right, #08EFF5, #7FA2F5);
    border:solid 2px rgba(38,60,217,0.3) ;
    
}
    .list-group-mine .list-group-item:hover {
        background: linear-gradient(to right,  #7FA2F5, #08EFF5);
        color: white;
        font-weight: bold;
            /*font-family: "Copperplate", Fantasy;*/
       text-shadow: 2px 1px 2px #000000;
    }

    .list-group-mine .list-group-item:active {
        background-color: #421ADB;
        color: black;
        font-weight: bold;
            /*font-family: "Copperplate", Fantasy;*/
        text-shadow: 2px 1px 2px #000000;
    }

    .list-group-mine .list-group-item:focus {
        background-color: #6DC4F5;
        color: white;
        font-weight: bold;
            /*font-family: "Copperplate", Fantasy;*/
       text-shadow: 2px 1px 2px #000000;
    }

    .iconomenu {
        width: 32px;
        border-radius: 10px;
        padding: 5px;

    }
    

    .offcanvas-header .btn-close {
    padding: calc(var(--bs-offcanvas-padding-y) * .5) calc(var(--bs-offcanvas-padding-x) * .5);
    margin-top: calc(-.5 * var(--bs-offcanvas-padding-y));
    margin-right: calc(-.5 * var(--bs-offcanvas-padding-x));
    margin-bottom: calc(-.5 * var(--bs-offcanvas-padding-y));
}

.btn-close:hover {
    --bs-btn-close-color: #ffffff;
    --bs-btn-close-bg: url(IMAGENES/icons8-x-100.png);
    --bs-btn-close-opacity: 0.5;
    --bs-btn-close-hover-opacity: 0.75;
    --bs-btn-close-focus-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    --bs-btn-close-focus-opacity: 1;
    --bs-btn-close-disabled-opacity: 0.25;
    --bs-btn-close-white-filter: invert(1) grayscale(100%) brightness(200%);
    box-sizing: content-box;
    width: 1em;
    height: 1em;
    padding: 0.25em 0.25em;
    color:#e4e5dc;
    background: blue var(--bs-btn-close-bg) center/1em auto no-repeat;
    border: 0;
    border-radius: 0.375rem;
    opacity: var(--bs-btn-close-opacity);
}
</style>

<script>
    $(document).ready(function() {
    // Expande todos los acordeones al cargar la página
    $('.collapse').addClass('show');
});
   /* $(document).ready(function () {
        // Esperar a que el offcanvas se haya inicializado
        var offcanvasElement = $('#offcanvasExample');
        var offcanvasExample = new bootstrap.Offcanvas(offcanvasElement);

        // Mostrar el offcanvas automáticamente al cargar la página
        offcanvasExample.show();

        // Agregar la clase 'collapse show' a los acordeones cuando se muestra el offcanvas
        offcanvasElement.on('shown.bs.offcanvas', function () {
            $('.accordion').addClass('collapse show');
        });
    });*/
</script>

<!-- ▓▓▓▓▓▓▓▓▓▓╬══   fin de MENU LATERAL CÓDIGO bootstrap header ══╬▓▓▓▓▓▓▓▓▓▓ -->