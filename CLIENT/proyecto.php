<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoProyectos</title>
    
    <link rel="stylesheet" href="CSS/proyecto.css">
</head>
<body>
    <nav>
        <h1>| <i class="fa-solid fa-globe"></i> |</h1>
        <h2>Eco_Proyectos</h2>
        <a href="index.php"><i class="fa-solid fa-globe"></i> Inicio</a>
        <a id="nombreProyectoNav" href="#"><i class="fa-regular fa-folder-open"></i> <span></span></a>
    </nav>

    <main>
        <header class="actividades">
            <div class="proyectoNombre">
                <h1 id="nombreProyecto"></h1>
            </div>
            <div class="btngroup">
                <button id="editarProyectoButton"><i class="fa-solid fa-pen"></i></button>
                <button id="eliminarProyectoButton"><i class="fa-solid fa-trash"></i></button>
            </div>
        </header>

        <div class="container">
            <div class="detallesProyecto">
                <article class="detallesP">
                    <h4>Descripción del proyecto:</h4>
                    <p id="descripcionProyecto"></p>
                </article>
                <article class="detallesP">
                    <h4>Objetivo del proyecto:</h4>
                    <p id="objetivoProyecto"></p>
                </article>
                <article class="detallesP">
                    <h4>Responsable del proyecto:</h4>
                    <p id="responsableProyecto"></p>
                </article>
                <article class="detallesP">
                    <h4>Presupuesto del proyecto:</h4>
                    <p id="presupuestoProyecto"></p>
                </article>
                <article class="detallesPF">
                    <div class="ini">
                        <h5>Fecha de inicio:</h5>
                        <p id="fechaInicioProyecto"></p>
                    </div>
                    <div class="fin">
                        <h5>Fecha de finalización:</h5>
                        <p id="fechaFinalProyecto"></p>
                    </div>
                </article>
            </div>
            
            <div class="actividadesProyecto">
                <div class="container-buscar">
                    <div class="buscar-container">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="buscar-input" placeholder="Buscar actividad...">
                    </div>
                    <button id="nueva-actividad-button"><i class="fa-solid fa-plus"></i> Agregar Actividad</button>
                </div>
                <div id="actividades-container"></div>
            </div>
        </div>
    </main>

    <div id="editarProyecto" style="display: none;">
        <div class="content-editar-proyecto">
            <div><a href="" id="cerrarEdicion"><i class="fa-solid fa-xmark"></i></a></div>
            <div class="form-editar">
                <h2>Editar Proyecto</h2>
                <form action="">
                    <p class="block">
                        <label for="nombreProyecto">Nombre: </label>
                        <input type="text" id="nombreProyectoE" name="nombreProyecto" autocomplete="off" required>
                    </p>
                    <p>
                        <label for="descripcionProyecto">Descripción: </label>
                        <textarea name="descripcionProyecto" id="descripcionProyectoE" autocomplete="off" required></textarea>
                    </p>
                    <p>
                        <label for="objetivoProyecto">Objetivo: </label>
                        <textarea name="objetivoProyecto" id="objetivoProyectoE" autocomplete="off" required></textarea>
                    </p>
                    <p>
                        <label for="responsableProyecto">Responsable: </label>
                        <input type="text" name="responsableProyecto" id="responsableProyectoE" autocomplete="off" required>
                    </p>
                    <p>
                        <label for="presupuestoProyecto">Presupuesto: </label>
                        <input type="text" name="presupuestoProyecto" id="presupuestoProyectoE" autocomplete="off" required>
                    </p>
                    <p>
                        <label for="fechaInicialProyecto">Inicio: </label>
                        <input type="text" name="fechaInicioProyecto" id="fechaInicioProyectoE" autocomplete="off" required>
                    </p>
                    <p>
                        <label for="fechaFinalProyecto">Finalización: </label>
                        <input type="text" name="fechaFinalProyecto" id="fechaFinalProyectoE" autocomplete="off">
                    </p>
                    <p class="block">
                        <button id="editarProyectoBtn" type="button"><i class="fa-solid fa-floppy-disk"></i> Guardar Cambios</button>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <div id="eliminarProyecto" style="display: none;">
        <div class="content-eliminar-proyecto">
            <div><a href="#" id="cerrarEliminacion"><i class="fa-solid fa-xmark"></i></a></div>
            <div class="elimP">
                <h2>Eliminar Proyecto</h2>
                <div class="elimnacionP">
                    <p>¿Está seguro que desea eliminar el proyecto?</p>
                    <div class="btn-group">
                        <button id="cancelarEliminacion">Cancelar</button>
                        <button id="eliminarProyectoBtn"><i class="fa-solid fa-trash"></i> Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="nuevaActividad" style="display: none;">
        <div class="content-crear-actividad">
            <div><a href="#" id="cerrarActividad"><i class="fa-solid fa-xmark"></i></a></div>
            <div class="form-nueva-actividad">
                <h2>Nueva Actividad</h2>
                <form action="">
                    <p>
                        <label for="nombreActividad">Nombre: </label>
                        <input type="text" id="nombreActividad" name="nombreActividad" autocomplete="off" required>
                    </p>
                    <p>
                        <label for="descripcionActividad">Descripción: </label>
                        <textarea type="text" id="descripcionActividad" autocomplete="off" required></textarea>
                    </p>
                    <p>
                        <label for="objetivo">Objetivo: </label>
                        <textarea name="objetivoActividad" id="objetivoActividad" autocomplete="off" required></textarea>
                    </p>
                    <div class="fechasActividad">
                        <p>
                            <label for="fechaInicialActividad">Inicio: </label>
                            <input type="text" name="fechaInicioActividad" id="fechaInicioActividad" autocomplete="off" required>
                        </p>
                        <p>
                            <label for="fechaFinalActividad">Finalización: </label>
                            <input type="text" name="fechaFinalActividad" id="fechaFinalActividad" autocomplete="off">
                        </p>
                    </div>
                    <p>
                        <button id="crearActividadBtn" type="submit">Agregar Actividad</button>
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
        $(document).ready(function() {
            function DetallesProyecto(idProyecto) {
                $.ajax({
                    url: `https://localhost/ServiciosWeb/EcoPro/API/proyectos.php?action=consultar_proyecto&id=${idProyecto}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function(proyecto) {
                        MostrarDetallesProyecto(proyecto);
                        ActualizarProyectoNav(proyecto.Proyecto_Nombre, proyecto.Proyecto_ID);
                        ObtenerActividades(idProyecto);
                        LlenarFormularioEdicion(proyecto);
                    },
                    error: function(error) {
                        console.error('Error al obtener los detalles del proyecto: ', error);
                    }
                });
            }

            function MostrarDetallesProyecto(proyecto) {
                $('#nombreProyecto').text(proyecto.Proyecto_Nombre);
                $('#descripcionProyecto').text(proyecto.Proyecto_Descripcion);
                $('#objetivoProyecto').text(proyecto.Proyecto_Objetivo);
                $('#responsableProyecto').text(proyecto.Proyecto_Responsable);
                $('#presupuestoProyecto').text(proyecto.Proyecto_Presupuesto);
                $('#fechaInicioProyecto').text(proyecto.Proyecto_FechaInicial);
                $('#fechaFinalProyecto').text(proyecto.Proyecto_FechaFinal);
            }

            function ActualizarProyectoNav(nombreProyecto, idProyecto) {
                const enlaceProyecto = $('#nombreProyectoNav');
                enlaceProyecto.attr('href', `proyecto.php?id=${idProyecto}`);
                enlaceProyecto.find('span').text(nombreProyecto);
            }

            function ObtenerActividades(idProyecto) {
                $.ajax({
                    url: `https://localhost/ServiciosWeb/EcoPro/API/actividades.php?action=obtener_actividades&proyecto_id=${idProyecto}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function(actividades) {
                        MostrarActividades(actividades);
                        BuscarActividad(actividades);
                    },
                    error: function(error) {
                        console.error('Error al obtener las actividades: ', error);
                    }
                });
            }

            function MostrarActividades(actividades) {
                const actividadesContainer = $('#actividades-container');
                actividadesContainer.empty();

                actividades.forEach(actividad => {
                    const card = $('<div>').addClass('card');
                    const nombre = $('<h3>').addClass('card-text').text(actividad.Actividad_Nombre);
                    const descripcion = $('<p>').addClass('card-text').text(actividad.Actividad_Descripcion);

                    card.click(function() {
                        const proyectoID = ObtenerIDProyecto();
                        const proyectoNombre = ObtenerNombreProyecto();

                        window.location.href = `actividad.php?id=${actividad.Actividad_ID}&proyectoID=${proyectoID}&proyectoNombre=${proyectoNombre}`;
                    });

                    card.append(nombre, descripcion);
                    actividadesContainer.append(card);
                });
            }

            function ObtenerIDProyecto() {
                const urlParam = new URLSearchParams(window.location.search);
                const idProyecto = urlParam.get('id');

                return idProyecto;
            }

            function ObtenerNombreProyecto() {
                var nombreProyectoElemento = document.getElementById('nombreProyecto');
                var nombreProyecto = nombreProyectoElemento.textContent || nombreProyectoElemento.innerText;

                return nombreProyecto;
            }

            function BuscarActividad(actividades) {
                const actividadesContainer = $('#actividades-container');

                $('#buscar-input').on('input', function() {
                    const filtro = $(this).val().toLowerCase();

                    const actividadesFiltradas = actividades.filter(actividad => {
                        return actividad.Actividad_Nombre.toLowerCase().startsWith(filtro);
                    });

                    MostrarActividades(actividadesFiltradas);
                });

                MostrarActividades(actividades);
            }

            function EditarProyecto(idProyecto, nombre, descripcion, objetivo, fechaInicio, fechaFinal, responsable, presupuesto) {
                const datosProyecto = {
                    Proyecto_ID: idProyecto,
                    Proyecto_Nombre: nombre,
                    Proyecto_Descripcion: descripcion,
                    Proyecto_Objetivo: objetivo,
                    Proyecto_Responsable: responsable,
                    Proyecto_FechaInicial: fechaInicio,
                    Proyecto_FechaFinal: fechaFinal,
                    Proyecto_Presupuesto: presupuesto,
                };

                $.ajax({
                    url: 'https://localhost/ServiciosWeb/EcoPro/API/proyectos.php?action=modificar_proyecto',
                    method: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify(datosProyecto),
                    success: function(respuesta) {
                        console.log(respuesta);

                        Swal.fire({
                            icon: "success",
                            title: "Se han guardado los cambios.",
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

                        $("#editarProyecto").fadeOut("slow");

                        DetallesProyecto(idProyecto);
                    },
                    error: function(error) {
                        console.error('Error al guardar los cambios: ', error);
                    }
                });
            }

            function LlenarFormularioEdicion(proyecto) {
                $('#nombreProyectoE').val(proyecto.Proyecto_Nombre);
                $('#descripcionProyectoE').val(proyecto.Proyecto_Descripcion);
                $('#objetivoProyectoE').val(proyecto.Proyecto_Objetivo);
                $('#responsableProyectoE').val(proyecto.Proyecto_Responsable);
                $('#presupuestoProyectoE').val(proyecto.Proyecto_Presupuesto);
                $('#fechaInicioProyectoE').val(proyecto.Proyecto_FechaInicial);
                $('#fechaFinalProyectoE').val(proyecto.Proyecto_FechaFinal);
            }

            function EliminarProyecto(idProyecto) {
                $.ajax({
                    url: 'https://localhost/ServiciosWeb/EcoPro/API/proyectos.php?action=eliminar_proyecto',
                    method: 'DELETE',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify({ Proyecto_ID: idProyecto}),
                    success: function(respuesta) {
                        console.log(respuesta);

                        Swal.fire({
                            icon: "success",
                            title: "Se ha eliminado el proyecto.",
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

                        $("#eliminarProyecto").fadeOut("slow", function() {
                            window.location.href = 'index.php';
                        })
                    },
                    error: function (error) {
                        console.error('Error al eliminar el proyecto: ', error);
                    }
                });
            }

            function CrearActividad(nombre, descripcion, objetivo, fechaInicio, fechaFinal, idProyecto) {
                $.ajax({
                    url: 'https://localhost/ServiciosWeb/EcoPro/API/actividades.php?action=crear_actividad',
                    method: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify( {
                        Actividad_Nombre: nombre,
                        Actividad_Descripcion: descripcion,
                        Actividad_Objetivo: objetivo,
                        Actividad_FechaInicial: fechaInicio,
                        Actividad_FechaFinal: fechaFinal,
                        Actividad_Proyecto: idProyecto
                    }),
                    success: function(respuesta) {
                        console.log(respuesta);

                        Swal.fire({
                            icon: "success",
                            title: "Actividad agregada.",
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

                        const modalActNew = document.getElementById('nuevaActividad');
                        modalActNew.style.display = 'none';
                        ObtenerActividades(idProyecto);
                    },
                    error: function(error) {
                        console.error('Error al agregar el proyecto: ', error);
                    }
                });
            }

            function LimpiarFormNueva() {
                $('#nombreActividad').val('');
                $('#descripcionActividad').val('');
                $('#objetivoActividad').val('');
                $('#fechaInicioActividad').val('');
                $('#fechaFinalActividad').val('');
            }

            $('#crearActividadBtn').on('click', function(e) {
                e.preventDefault();

                const urlParam = new URLSearchParams(window.location.search);
                const idProyecto = urlParam.get('id');

                const nombre = $('#nombreActividad').val();
                const descripcion = $('#descripcionActividad').val();
                const objetivo = $('#objetivoActividad').val();
                const fechaInicio = $('#fechaInicioActividad').val();
                const fechaFinal = $('#fechaFinalActividad').val();

                CrearActividad(nombre, descripcion, objetivo, fechaInicio, fechaFinal, idProyecto);

                LimpiarFormNueva();
            })

            $("#editarProyectoBtn").on('click', function(e) {
                e.preventDefault();

                const urlParam = new URLSearchParams(window.location.search);
                const idProyecto = urlParam.get('id');

                const nombre = $('#nombreProyectoE').val();
                const descripcion = $('#descripcionProyectoE').val();
                const objetivo = $('#objetivoProyectoE').val();
                const fechaInicio = $('#fechaInicioProyectoE').val();
                const fechaFinal = $('#fechaFinalProyectoE').val();
                const responsable = $('#responsableProyectoE').val();
                const presupuesto = $('#presupuestoProyectoE').val();

                EditarProyecto(idProyecto, nombre, descripcion, objetivo, fechaInicio, fechaFinal, responsable, presupuesto);
            });

            $("#eliminarProyectoBtn").on('click', function() {
                const urlParametro = new URLSearchParams(window.location.search);
                const idproyecto = urlParametro.get('id');

                EliminarProyecto(idproyecto);
            });

            $("#cancelarEliminacion").on('click', function() {
                $("#eliminarProyecto").fadeOut("slow");
            })

            $("#editarProyectoButton").on('click', function() {
                $("#editarProyecto").fadeIn("slow");
            });

            $("#cerrarEdicion").on('click', function() {
                $("#editarProyecto").fadeOut("slow");
            });

            $("#eliminarProyectoButton").on('click', function() {
                $("#eliminarProyecto").fadeIn("slow");
            });

            $("#cerrarEliminacion").on('click', function() {
                $("#eliminarProyecto").fadeOut("slow");
            });

            $("#nueva-actividad-button").on('click', function() {
                $("#nuevaActividad").fadeIn("slow");
            });

            $("#cerrarActividad").on('click', function() {
                $("#nuevaActividad").fadeOut("slow");
                LimpiarFormNueva();
            })

            const urlParams = new URLSearchParams(window.location.search);
            const proyectoID = urlParams.get('id');

            DetallesProyecto(proyectoID);
            ObtenerActividades(proyectoID);
        });
    </script>
</body>
</html>