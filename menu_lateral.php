<!-- ▓▓▓▓▓▓▓▓▓▓╬══  MENU LATERAL CÓDIGO ══╬▓▓▓▓▓▓▓▓▓▓ -->
<a class="btn btn-primary btn-offcanvas boton_bus" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
    aria-controls="offcanvasExample">
    <i class="material-icons">menu</i>
</a>


<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menú General</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>



            <div class="list-group list-group-mine">


                <!-- Elementos  acordeón 1 -->
                <div class="list-group-item list-group-item-action">
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#submenu_Mantenimientos"
                        data-bs-parent="#submenu-container" style="text-decoration:none"
                        class="list-group-item list-group-item-action">
                        <i class="material-icons">tabs</i>Mantenimientos</a>
                    <div class="collapse" id="submenu_Mantenimientos" data-bs-parent="#submenu-container">
                        <a href="mant-Agregaruser.php" class="list-group-item list-group-item-action"> <i
                                class="material-icons">account_circle</i> Usuarios</a>
                        <a href="menu-mant.php" class="list-group-item list-group-item-action"
                            style="text-align: right;"><i class="material-icons">menu</i> Menu Mant</a>
                        <!-- Elementos  acordeón 1.2 -->
                        <div class="list-group-item list-group-item-action">
                            <a href="menu-pacientes.php" data-bs-toggle="collapse" data-bs-target="#submenu_paciente"
                                data-bs-parent="#submenu-container" style="text-decoration:none"
                                class="list-group-item list-group-item-action"> <i
                                    class="material-icons">personal_injury</i> Pacientes</a>
                            <div class="collapse" id="submenu_paciente" data-bs-parent="#submenu-container">
                                <a href="menu-pacientes.php" class="list-group-item list-group-item-action"
                                    style="text-align: right;"><i class="material-icons">menu</i> Menu Pacientes</a>

                                <a href="paciente.php" class="list-group-item list-group-item-action"><i
                                        class="material-icons">group</i> Pacientes</a>
                                <a href="MANT-pacientevacuna.php" class="list-group-item list-group-item-action"><i
                                        class="material-icons">vaccines</i> Vacunas-Pacientes</a>
                                <a href="mant_paciente_historiaClinica.php"
                                    class="list-group-item list-group-item-action"><i class="material-icons">healing</i>
                                    Padecimientos-Pacientes</a>
                                <a href="mant_padres_pacientes.php" class="list-group-item list-group-item-action"><span
                                        class="material-symbols-outlined">
                                        diversity_4
                                    </span>
                                    Padres-Pacientes</a>

                            </div>


                        </div>
                        <div class="list-group-item list-group-item-action">
                            <a href="menu-pacientes.php" data-bs-toggle="collapse" data-bs-target="#submenu_paciente"
                                data-bs-parent="#submenu-container" style="text-decoration:none"
                                class="list-group-item list-group-item-action"> <span class="material-symbols-outlined">
                                    stethoscope
                                </span> Médicos</a>
                            <div class="collapse" id="submenu_paciente" data-bs-parent="#submenu-container">
                                <a href="menu-medico.php" class="list-group-item list-group-item-action"
                                    style="text-align: right;"><i class="material-icons">menu</i> Menu Médico</a>

                                <a href="mant_medico.php" class="list-group-item list-group-item-action"><span
                                        class="material-symbols-outlined">
                                        stethoscope_check
                                    </span> Medico</a>

                                <a href="mant_trabajosmedicos.php" class="list-group-item list-group-item-action"><span
                                        class="material-symbols-outlined">
                                        clinical_notes
                                    </span>Trabajos Médicos</a>

                                <a href="mant_especialidad.php" class="list-group-item list-group-item-action"><span
                                        class="material-symbols-outlined">
                                        groups
                                    </span>
                                    Especialidad</a>

                                <a href="mant_horario.php" class="list-group-item list-group-item-action"><span
                                        class="material-symbols-outlined">
                                        calendar_month
                                    </span>
                                    Horario-Médico</a>
                            </div>
                        </div>

                        <a href="mant_seguro.php" class="list-group-item list-group-item-action"><i
                                class="material-icons">medical_information</i> Seguros</a>

                        <a href="mant-centromedico.php" class="list-group-item list-group-item-action"><span
                                class="material-symbols-outlined">home_health</span> Centro Médico</a>

                        <a href="mant_medicamentos.php" class="list-group-item list-group-item-action"> <i
                                class="material-icons">local_pharmacy</i> Medicamentos</a>

                        <a href="mant_vacunas.php" class="list-group-item list-group-item-action">
                            <span class="material-symbols-outlined">syringe</span> Vacunas</a>

                        <a href="mant_padecimientos_comunes.php" class="list-group-item list-group-item-action">
                            <span class="material-symbols-outlined">sick</span> Padecimientos</a>

                        <a href="mant_laboratorio.php" class="list-group-item list-group-item-action">
                            <span class="material-symbols-outlined">biotech</span> Laboratorios</a>
                    </div>

                </div>
                <!-- Elementos  acordeón 2 -->
                <div class="list-group-item list-group-item-action">
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#submenu_procesos"
                        data-bs-parent="#submenu-container" style="text-decoration:none"
                        class="list-group-item list-group-item-action">Procesos</a>
                    <div class="collapse" id="submenu_procesos" data-bs-parent="#submenu-container">
                        <a href="proces_citas" class="list-group-item list-group-item-action">Citas</a>
                        <a href="#" class="list-group-item list-group-item-action">Subitem 2</a>
                    </div>

                </div>
                <!-- Elementos  acordeón 3 -->
                <div class="list-group-item list-group-item-action">
                    <a href="#" data-bs-toggle="collapse" data-bs-target="#submenu_procesos"
                        data-bs-parent="#submenu-container" style="text-decoration:none"
                        class="list-group-item list-group-item-action"> <i class="material-icons">analytics</i>
                        Consultas y Reportes</a>
                    <div class="collapse" id="submenu_procesos" data-bs-parent="#submenu-container">
                        <a href="#" class="list-group-item list-group-item-action">Subitem 1</a>
                        <a href="#" class="list-group-item list-group-item-action">Subitem 2</a>
                    </div>

                </div>
                <a href="index.php" class="list-group-item list-group-item-action"> <i class="material-icons">logout</i>
                    Volver al Login</a>
            </div>
        </div>

    </div>

    <!-- <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Dropdown button
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div> -->
</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function getCurrentPage() {
            var pathArray = window.location.pathname.split('/');
            var currentPage = pathArray.pop();
            return currentPage;
        }

        function isElementInsideAccordion(element) {
            // Verificar si el elemento padre del elemento dado es un acordeón de Bootstrap
            return element.closest('.accordion');
        }

        function showAccordionForElement(element) {
            // Mostrar el acordeón asociado al elemento
            var accordion = element.closest('.accordion');
            if (accordion) {
                var accordionId = accordion.id;
                var accordionInstance = new bootstrap.Collapse(document.getElementById(accordionId));
                accordionInstance.show();
            }
        }

        function focusOrOpenAccordion() {
            var currentPage = getCurrentPage();
            var listGroupItems = document.querySelectorAll('.list-group-item-action');

            listGroupItems.forEach(function (item) {
                var href = item.getAttribute('href');
                if (href && href.endsWith(currentPage)) {
                    item.focus();
                    item.classList.add('active');

                    if (isElementInsideAccordion(item)) {
                        showAccordionForElement(item);
                    }
                }
            });
        }

        focusOrOpenAccordion();
    });
</script>
<script>
    //abre el offcanvas de forma automática
    /*document.addEventListener("DOMContentLoaded", function() {
         function openAllAccordions() {
             var accordions = document.querySelectorAll('.accordion');
             accordions.forEach(function(accordion) {
                 var accordionInstance = new bootstrap.Collapse(accordion);
                 accordionInstance.show();
             });
         }
        
         // Esperar a que el offcanvas se haya inicializado
         var offcanvasExample = new bootstrap.Offcanvas(document.getElementById('offcanvasExample'));
         offcanvasExample._element.addEventListener('shown.bs.offcanvas', function() {
             // Esperar un breve momento para asegurar que el offcanvas se haya mostrado completamente
             setTimeout(function() {
                 openAllAccordions();
             }, 100);
         });

         // Mostrar el offcanvas automáticamente al cargar la página
         offcanvasExample.show();
     });*/
</script>


<!-- ▓▓▓▓▓▓▓▓▓▓╬══ FIN CÓDIGO MENU LATERAL ══╬▓▓▓▓▓▓▓▓▓▓ -->