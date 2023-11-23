<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoProyectos</title>
    
    <link rel="stylesheet" href="CSS/main.css">
</head>
<body>
    <nav>
        <h1>| <i class="fa-solid fa-globe"></i> |</h1>
        <h2>Eco_Proyectos</h2>
        <a href="index.php"><i class="fa-solid fa-globe"></i> Inicio</a>
    </nav>

    <main>
        <div class="container-buscar">
            <div class="buscar-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="buscar-input" placeholder="Buscar proyecto...">
            </div>
            <button id="nuevo-proyecto-button"><i class="fa-solid fa-plus"></i> Agregar proyecto</button>
        </div>
        <div id="proyectos-container"></div>
    </main>

    <div id="nuevoProyecto" style="display: none;">
        <div class="content-crear-proyecto">
            <div><a href="#" id="cerrar"><i class="fa-solid fa-xmark"></i></a></div>
            <div class="form-nuevo">
                <h2>Nuevo Proyecto</h2>
                <form action="">
                    <p class="block">
                        <label for="nombreProyecto">Nombre: </label>
                        <input type="text" id="nombreProyecto" name="nombreProyecto" autocomplete="off" required>
                    </p>
                    <p>
                        <label for="descripcionProyecto">Descripción: </label>
                        <textarea name="descripcionProyecto" id="descripcionProyecto" autocomplete="off" required></textarea>
                    </p>
                    <p>
                        <label for="objetivoProyecto">Objetivo: </label>
                        <textarea name="objetivoProyecto" id="objetivoProyecto" autocomplete="off" required></textarea>
                    </p>
                    <p>
                        <label for="responsableProyecto">Responsable: </label>
                        <input type="text" name="responsableProyecto" id="responsableProyecto" autocomplete="off" required>
                    </p>
                    <p>
                        <label for="presupuestoProyecto">Presupuesto: </label>
                        <input type="text" name="presupuestoProyecto" id="presupuestoProyecto" autocomplete="off" required>
                    </p>
                    <p>
                        <label for="fechaInicialProyecto">Inicio: </label>
                        <input type="text" name="fechaInicioProyecto" id="fechaInicioProyecto" autocomplete="off" required>
                    </p>
                    <p>
                        <label for="fechaFinalProyecto">Finalización: </label>
                        <input type="text" name="fechaFinalProyecto" id="fechaFinalProyecto" autocomplete="off">
                    </p>
                    <p class="block">
                        <button id="crearProyectoBtn" type="submit">Agregar proyecto</button>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            function ObtenerProyectos() {
                $.ajax({
                    url: 'https://localhost/ServiciosWeb/EcoPro/API/proyectos.php?action=obtener_proyectos',
                    method: 'GET',
                    dataType: 'json',
                    success: function(proyectos) {
                        BuscarProyecto(proyectos);
                    },
                    error: function(error) {
                        console.error('Error al obtener proyectos: ', error);
                    }
                });
            }

            function BuscarProyecto(proyectos) {
                const proyectosContainer = $('#proyectos-container');

                $('#buscar-input').on('input', function() {
                    const filtro = $(this).val().toLowerCase();

                    const proyectosFiltrados = proyectos.filter(proyecto => {
                        return proyecto.Proyecto_Nombre.toLowerCase().startsWith(filtro);
                    });

                    MostrarProyectos(proyectosFiltrados);
                });

                MostrarProyectos(proyectos);
            }

            function MostrarProyectos(proyectos) {
                const proyectosContainer = $('#proyectos-container');
                proyectosContainer.empty();

                proyectos.forEach(proyecto => {
                    const card = $('<div>').addClass('card');
                    const nombre = $('<h3>').addClass('card-text').text(proyecto.Proyecto_Nombre);
                    const descripcion = $('<p>').addClass('card-text').text(proyecto.Proyecto_Descripcion);

                    card.click(function() {
                        window.location.href = 'proyecto.php?id=' + proyecto.Proyecto_ID;
                    });

                    card.append(nombre, descripcion);
                    proyectosContainer.append(card);
                });
            }

            function CrearProyecto(nombre, descripcion, objetivo, fechaInicio, fechaFinal, responsable, presupuesto) {
                $.ajax({
                    url: 'https://localhost/ServiciosWeb/EcoPro/API/proyectos.php?action=crear_proyecto',
                    method: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify( {
                        Proyecto_Nombre: nombre,
                        Proyecto_Descripcion: descripcion,
                        Proyecto_Objetivo: objetivo,
                        Proyecto_FechaInicial: fechaInicio,
                        Proyecto_FechaFinal: fechaFinal,
                        Proyecto_Responsable: responsable,
                        Proyecto_Presupuesto: presupuesto
                    }),
                    success: function(respuesta) {
                        console.log(respuesta);

                        Swal.fire({
                            icon: "success",
                            title: "Proyecto agregado.",
                            showConfirmButton: false,
                            timer: 2000,
                            customClass: {
                                container: 'my-swal-container',
                                title: 'my-swal-title',
                                popup: 'my-swal-popup',
                                icon: 'my-swal-icon',
                            },
                            background: '#1E2529',
                            iconColor: '#BDE6FB'
                        });

                        const modalProNew = document.getElementById('nuevoProyecto');
                        modalProNew.style.display = 'none';
                        ObtenerProyectos();
                    },
                    error: function(error) {
                        console.error('Error al agregar el proyecto: ', error);
                    }
                });
            }

            function LimpiarFormNuevo() {
                $('#nombreProyecto').val('');
                $('#descripcionProyecto').val('');
                $('#objetivoProyecto').val('');
                $('#fechaInicioProyecto').val('');
                $('#fechaFinalProyecto').val('');
                $('#responsableProyecto').val('');
                $('#presupuestoProyecto').val('');
            }

            ObtenerProyectos();

            $('#crearProyectoBtn').on('click', function(e) {
                e.preventDefault();

                const nombre = $('#nombreProyecto').val();
                const descripcion = $('#descripcionProyecto').val();
                const objetivo = $('#objetivoProyecto').val();
                const fechaInicio = $('#fechaInicioProyecto').val();
                const fechaFinal = $('#fechaFinalProyecto').val();
                const responsable = $('#responsableProyecto').val();
                const presupuesto = $('#presupuestoProyecto').val();

                CrearProyecto(nombre, descripcion, objetivo, fechaInicio, fechaFinal, responsable, presupuesto);

                LimpiarFormNuevo();
            });

            $("#nuevo-proyecto-button").on('click', function() {
                $("#nuevoProyecto").fadeIn("slow");
            });

            $("#cerrar").on('click', function() {
                $("#nuevoProyecto").fadeOut("slow");
                LimpiarFormNuevo();
            });
        });
    </script>
</body>
</html>