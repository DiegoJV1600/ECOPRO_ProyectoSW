<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoProyectos</title>
    
    <link rel="stylesheet" href="CSS/actividad.css">
</head>
<body>
    <nav>
        <h1>| <i class="fa-solid fa-globe"></i> |</h1>
        <h2>Eco_Proyectos</h2>
        <a href="index.php"><i class="fa-solid fa-globe"></i> Inicio</a>
        <a id="nombreProyectoNav" href="#"><i class="fa-regular fa-folder-open"></i> <span></span></a>
        <a id="nombreActividadNav" href="#"><i class="fa-regular fa-folder-open"></i> <span></span></a>
    </nav>

    <main>
        <header class="actividades">
            <div class="actividadNombre">
                <h1 id="nombreActividad"></h1>
            </div>
            <div class="btngroup">
                <button id="editarActividadButton"><i class="fa-solid fa-pen"></i></button>
                <button id="eliminarActividadButton"><i class="fa-solid fa-trash"></i></button>
            </div>
        </header>

        <div class="container">
            <div class="tablasActividad">
                <div class="container-participantes">
                    <h2><i class="fa-solid fa-user"></i> Participantes</h2>
                    <div class="container-buscar-participante">
                        <div class="buscar-nuevo-participante">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" id="buscar-input-participante" placeholder="Buscar participante...">
                        </div>
                        <button id="nuevo-participante-button"><i class="fa-solid fa-plus"></i> Agregar Participante</button>
                    </div>
                    <table id="tabla-participantes">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>N° Telefónico</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="participantes-tabla"></tbody>
                    </table>
                </div>
            </div>
            <div class="detallesActividad">
                <article class="detallesA">
                    <h4>Descripción de la actividad:</h4>
                    <p id="descripcionActividad"></p>
                </article>
                <article class="detallesA">
                    <h4>Objetivo de la actividad:</h4>
                    <p id="objetivoActividad"></p>
                </article>
                <article class="detallesAF">
                    <div class="ini">
                        <h5>Fecha de inicio:</h5>
                        <p id="fechaInicioActividad"></p>
                    </div>
                    <div class="fin">
                        <h5>Fecha de finalización:</h5>
                        <p id="fechaFinalActividad"></p>
                    </div>
                </article>
            </div>
        </div>
    </main>

    <div id="editarActividad" style="display: none;">
        <div class="content-editar-actividad">
            <div><a href="#" id="cerrarEdicionA"><i class="fa-solid fa-xmark"></i></a></div>
            <div class="form-editar-actividad">
                <h2>Editar Actividad</h2>
                <form action="">
                    <p>
                        <label for="nombreActividad">Nombre: </label>
                        <input type="text" id="nombreActividadE" name="nombreActividad" autocomplete="off" required>
                    </p>
                    <p>
                        <label for="descripcionActividad">Descripción: </label>
                        <textarea type="text" id="descripcionActividadE" autocomplete="off" required></textarea>
                    </p>
                    <p>
                        <label for="objetivo">Objetivo: </label>
                        <textarea name="objetivoActividad" id="objetivoActividadE" autocomplete="off" required></textarea>
                    </p>
                    <div class="fechasActividad">
                        <p>
                            <label for="fechaInicialActividad">Inicio: </label>
                            <input type="text" name="fechaInicioActividad" id="fechaInicioActividadE" autocomplete="off" required>
                        </p>
                        <p>
                            <label for="fechaFinalActividad">Finalización: </label>
                            <input type="text" name="fechaFinalActividad" id="fechaFinalActividadE" autocomplete="off">
                        </p>
                    </div>
                    <p>
                        <button id="editarActividadBtn" type="button"><i class="fa-solid fa-floppy-disk"></i> Guardar Cambios</button>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <div id="eliminarActividad" style="display: none;">
        <div class="content-eliminar-actividad">
            <div><a href="#" id="cerrarEliminacionA"><i class="fa-solid fa-xmark"></i></a></div>
            <div class="elimP">
                <h2>Eliminar Proyecto</h2>
                <div class="elimnacionA">
                    <p>¿Está seguro que desea eliminar la actividad?</p>
                    <div class="btn-group">
                        <button id="cancelarEliminacionA">Cancelar</button>
                        <button id="eliminarActividadBtn"><i class="fa-solid fa-trash"></i> Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="crearParticipante" style="display: none;">
        <div class="content-nuevo-participante">
            <div><a href="#" id="cerrarNuevoP"><i class="fa-solid fa-xmark"></i></a></div>
            <div class="form-nuevo-participante">
                <h2>Nuevo Participante</h2>
                <form action="">
                    <div class="datosParticipanteNuevo">
                        <div class="nomrol">
                            <p>
                                <label for="nombreParticipante">Nombre: </label>
                                <input type="text" id="nombreParticipante" autocomplete="off" required>
                            </p>
                            <p>
                                <label for="rolParticipante">Rol: </label>
                                <input type="text" id="rolParticipante" autocomplete="off" required>
                            </p>
                        </div>
                        <div class="contacto">
                            <p>
                                <label for="celularParticipante">N° Telefónico: </label>
                                <input type="text" id="celularParticipante" autocomplete="off" required>
                            </p>
                            <p>
                                <label for="correoParticipante">Correo: </label>
                                <input type="text" id="correoParticipante" autocomplete="off" required>
                            </p>
                        </div>
                    </div>
                    <div class="crearP">
                        <button id="crearParticipanteBtn" type="submit">Agregar participante</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editarParticipante" style="display: none;">
        <div class="content-editar-participante">
            <div><a href="#" id="cerrarEditarP"><i class="fa-solid fa-xmark"></i></a></div>
            <div class="form-editar-participante">
                <h2>Editar Participante</h2>
                <form action="">
                    <div class="datosParticipanteNuevo">
                        <div class="nomrol">
                            <p>
                                <label for="nombreParticipante">Nombre: </label>
                                <input type="text" id="nombreParticipanteE" autocomplete="off" required>
                            </p>
                            <p>
                                <label for="rolParticipante">Rol: </label>
                                <input type="text" id="rolParticipanteE" autocomplete="off" required>
                            </p>
                        </div>
                        <div class="contacto">
                            <p>
                                <label for="celularParticipante">N° Telefónico: </label>
                                <input type="text" id="celularParticipanteE" autocomplete="off" required>
                            </p>
                            <p>
                                <label for="correoParticipante">Correo: </label>
                                <input type="text" id="correoParticipanteE" autocomplete="off" required>
                            </p>
                        </div>
                    </div>
                    <div class="crearP">
                        <button id="editarParticipanteBtn" type="button"><i class="fa-solid fa-floppy-disk"></i> Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="eliminarParticipante" style="display: none;">
        <div class="content-eliminar-participante">
            <div><a href="#" id="cerrarEliminacionP"><i class="fa-solid fa-xmark"></i></a></div>
            <div class="elimP">
                <h2>Eliminar Proyecto</h2>
                <div class="elimnacionA">
                    <p>¿Está seguro que desea eliminar el participante?</p>
                    <div class="btn-group">
                        <button id="cancelarEliminacionP">Cancelar</button>
                        <button id="eliminarParticipanteBtn"><i class="fa-solid fa-trash"></i> Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            function DetallesActividad(idActividad) {
                $.ajax({
                    url: `https://localhost/ServiciosWeb/EcoPro/API/actividades.php?action=consultar_actividad&id=${idActividad}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function(actividad) {
                        MostrarDetallesActividad(actividad);
                        ActualizarActividadNav(actividad.Actividad_Nombre, actividad.Actividad_ID);
                        LlenarFormularioEA(actividad);
                    },
                    error: function(error) {
                        console.error('Error al obtener los detalles de la actividad: ', error);
                    }
                });
            }

            function MostrarDetallesActividad(actividad) {
                $('#nombreActividad').text(actividad.Actividad_Nombre);
                $('#descripcionActividad').text(actividad.Actividad_Descripcion);
                $('#objetivoActividad').text(actividad.Actividad_Objetivo);
                $('#fechaInicioActividad').text(actividad.Actividad_FechaInicial);
                $('#fechaFinalActividad').text(actividad.Actividad_FechaFinal);
            }

            function LlenarFormularioEA(actividad) {
                $('#nombreActividadE').val(actividad.Actividad_Nombre);
                $('#descripcionActividadE').val(actividad.Actividad_Descripcion);
                $('#objetivoActividadE').val(actividad.Actividad_Objetivo);
                $('#fechaInicioActividadE').val(actividad.Actividad_FechaInicial);
                $('#fechaFinalActividadE').val(actividad.Actividad_FechaFinal);
            }

            function EditarActividad(idActividad, nombre, descripcion, objetivo, fechaInicio, fechaFinal) {
                const datosActividad = {
                    Actividad_ID: idActividad,
                    Actividad_Nombre: nombre,
                    Actividad_Descripcion: descripcion,
                    Actividad_Objetivo: objetivo,
                    Actividad_FechaInicial: fechaInicio,
                    Actividad_FechaFinal: fechaFinal,
                };

                $.ajax({
                    url: 'https://localhost/ServiciosWeb/EcoPro/API/actividades.php?action=modificar_actividad',
                    method: 'PUT',
                    dataType: 'json',
                    data: JSON.stringify(datosActividad),
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

                        $("#editarActividad").fadeOut("slow");

                        DetallesActividad(idActividad);
                    },
                    error: function(error) {
                        console.error('Error al guardar los cambios: ', error);
                    }
                });
            }

            function EliminarActividad(idActividad) {
                $.ajax({
                    url: 'https://localhost/ServiciosWeb/EcoPro/API/actividades.php?action=eliminar_actividad',
                    method: 'DELETE',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify({ Actividad_ID: idActividad }),
                    success: function(respuesta) {
                        console.log(respuesta);

                        Swal.fire({
                            icon: "success",
                            title: "Se ha eliminado la actividad.",
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

                        const urlParam = new URLSearchParams(window.location.search);
                        const idproyecto = urlParam.get('proyectoID');

                        $("#eliminarActividad").fadeOut("slow", function() {
                            window.location.href = `proyecto.php?id=${idproyecto}`;
                        });
                    },
                    error: function (error) {
                        console.error('Error al eliminar la actividad: ', error);
                    }
                });
            }

            function ActualizarActividadNav(nombreActividad, idActividad) {
                const enlaceActividad = $('#nombreActividadNav');
                const urlParams = new URLSearchParams(window.location.search);
                const idProyecto = urlParams.get('proyectoID');
                const nombreProyecto = urlParams.get('proyectoNombre');

                enlaceActividad.attr('href', `actividad.php?id=${idActividad}&proyectoID=${idProyecto}&proyectoNombre=${nombreProyecto}`);
                enlaceActividad.find('span').text(nombreActividad);
            }

            function ActualizarProyectoNav() {
                const enlaceProyecto = $('#nombreProyectoNav');
                const urlParams = new URLSearchParams(window.location.search);
                const idProyecto = urlParams.get('proyectoID');
                const nombreProyecto = urlParams.get('proyectoNombre');

                enlaceProyecto.attr('href', `proyecto.php?id=${idProyecto}`);
                enlaceProyecto.find('span').text(nombreProyecto);
            }

            function ObtenerParticipantes(idActividad) {
                $.ajax({
                    url: `https://localhost/ServiciosWeb/EcoPro/API/participantes.php?action=obtener_participantes&actividad_id=${idActividad}`,
                    method: 'GET', 
                    dataType: 'json',
                    success: function(participantes) {
                        MostrarParticipantes(participantes);
                        BuscarParticipantes(participantes);
                    },
                    error: function(error) {
                        console.error('Error al obtener los participantes: ', error);
                    }
                });
            }

            function MostrarParticipantes(participantes) {
                const participantesTabla = $('#participantes-tabla');
                participantesTabla.empty();

                participantes.forEach(participante => {
                    const fila = $('<tr>');
                    const nombre = $('<td>').text(participante.Participante_Nombre);
                    const rol = $('<td>').text(participante.Participante_Rol);
                    const celular = $('<td>').text(participante.Participante_Celular);
                    const correo = $('<td>').text(participante.Participante_Correo);

                    fila.append(nombre, rol, celular, correo);

                    const editarBtn = $('<button>').html('<i class="fas fa-edit"></i>');
                    editarBtn.addClass('icon-btn');
                    editarBtn.attr('data-id-participante', participante.Participante_ID);
                    editarBtn.on('click', function() {
                        const idParticipante = $(this).data('id-participante');
                        MostrarModalEdicion(participante);
                    });

                    const eliminarBtn = $('<button>').html('<i class="fas fa-trash"></i>');
                    eliminarBtn.addClass('icon-btn');
                    eliminarBtn.attr('data-id-participante', participante.Participante_ID);
                    eliminarBtn.on('click', function() {
                        const idParticipante = $(this).data('id-participante');
                        MostrarModalEliminacion(idParticipante);
                    });


                    const accion = $('<td>').append(editarBtn, eliminarBtn);

                    fila.append(accion);
                    participantesTabla.append(fila);
                })
            }

            function BuscarParticipantes(participantes) {
                const participantesTabla = $('#participantes-tabla');

                $('#buscar-input-participante').on('input', function () {
                    const filtro = $(this).val().toLowerCase();

                    const participantesFiltrados = participantes.filter(participante => {
                        return participante.Participante_Nombre.toLowerCase().includes(filtro);
                    });

                    MostrarParticipantes(participantesFiltrados);
                });

                MostrarParticipantes(participantes);
            }

            function CrearParticipante(nombre, rol, celular, correo, idActividad) {
                $.ajax({
                    url: 'https://localhost/ServiciosWeb/EcoPro/API/participantes.php?action=crear_participante',
                    method: 'POST',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify( {
                        Participante_Nombre: nombre,
                        Participante_Rol: rol,
                        Participante_Celular: celular,
                        Participante_Correo: correo,
                        Participante_Actividad: idActividad
                    }),
                    success: function(respuesta) {
                        console.log(respuesta);

                        Swal.fire({
                            icon: "success",
                            title: "Participante agregado.",
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

                        const modalParNew = document.getElementById('crearParticipante');
                        modalParNew.style.display = 'none';
                        ObtenerParticipantes(idActividad);
                    },
                    error: function(error) {
                        console.error('Error al agregar el proyecto: ', error);
                    }
                });
            }

            function EditarParticipante(idParticipante, nombre, rol, celular, correo) {
                const datosParticipante = {
                    Participante_ID: idParticipante,
                    Participante_Nombre: nombre,
                    Participante_Rol: rol,
                    Participante_Celular: celular,
                    Participante_Correo: correo,
                };

                $.ajax({
                    url: 'https://localhost/ServiciosWeb/EcoPro/API/participantes.php?action=modificar_participante',
                    method: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify(datosParticipante),
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

                        $("#editarParticipante").fadeOut("slow");
                    },
                    error: function(error) {
                        console.error('Error al guardar los cambios: ', error);
                    }
                });
            }

            function EliminarParticipante(idParticipante) {
                $.ajax({
                    url: 'https://localhost/ServiciosWeb/EcoPro/API/participantes.php?action=eliminar_participante',
                    method: 'DELETE',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify({ Participante_ID: idParticipante }),
                    success: function(respuesta) {
                        console.log(respuesta);

                        Swal.fire({
                            icon: "success",
                            title: "Se ha eliminado el participante.",
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

                        const urlParams = new URLSearchParams(window.location.search);
                        const idActividad = urlParams.get('id')
                        const idProyecto = urlParams.get('proyectoID');
                        const nombreProyecto = urlParams.get('proyectoNombre');

                        $("#eliminarParticipante").fadeOut("slow", function() {
                            window.location.href = `actividad.php?id=${idActividad}&proyectoID=${idProyecto}&proyectoNombre=${nombreProyecto}`;
                        })
                    },
                    error: function (error) {
                        console.error('Error al eliminar el participante: ', error);
                    }
                });
            }

            function MostrarModalEdicion(participante) {
                $("#editarParticipante").fadeIn("slow");

                const nombreInput = $('#nombreParticipanteE');
                const rolInput = $('#rolParticipanteE');
                const celularInput = $('#celularParticipanteE');
                const correoInput = $('#correoParticipanteE');

                nombreInput.val(participante.Participante_Nombre);
                rolInput.val(participante.Participante_Rol);
                celularInput.val(participante.Participante_Celular);
                correoInput.val(participante.Participante_Correo);

                $('#editarParticipanteBtn').on('click', function() {
                    const idParticipante = participante.Participante_ID;
                    const nombre = nombreInput.val();
                    const rol = rolInput.val();
                    const celular = celularInput.val();
                    const correo = correoInput.val();

                    EditarParticipante(idParticipante, nombre, rol, celular, correo);
                });
            }


            function MostrarModalEliminacion(idParticipante) {
                $("#eliminarParticipante").fadeIn("slow");
            }

            $('#crearParticipanteBtn').on('click', function(e) {
                e.preventDefault();

                const urlParam = new URLSearchParams(window.location.search);
                const idActividad = urlParam.get('id');

                const nombre = $('#nombreParticipante').val();
                const rol = $('#rolParticipante').val();
                const celular = $('#celularParticipante').val();
                const correo = $('#correoParticipante').val();

                CrearParticipante(nombre, rol, celular, correo, idActividad);

                LimpiarFormParticipantes();
            })

            function LimpiarFormParticipantes() {
                $('#nombreParticipante').val('');
                $('#rolParticipante').val('');
                $('#celularParticipante').val('');
                $('#correoParticipante').val('');
            }

            $("#eliminarActividadBtn").on('click', function() {
                const urlParametro = new URLSearchParams(window.location.search);
                const idactividad = urlParametro.get('id');

                EliminarActividad(idactividad);
            });

            $("#editarActividadBtn").on('click', function(e) {
                e.preventDefault();

                const urlParam = new URLSearchParams(window.location.search);
                const idActividad = urlParam.get('id');

                const nombre = $('#nombreActividadE').val();
                const descripcion = $('#descripcionActividadE').val();
                const objetivo = $('#objetivoActividadE').val();
                const fechaInicio = $('#fechaInicioActividadE').val();
                const fechaFinal = $('#fechaFinalActividadE').val();

                EditarActividad(idActividad, nombre, descripcion, objetivo, fechaInicio, fechaFinal);
            });

            function MostrarModalEliminacion(idParticipante) {
                $("#eliminarParticipanteBtn").attr('data-id-participante', idParticipante);
                $("#eliminarParticipante").fadeIn("slow");
            }

            $("#eliminarParticipanteBtn").on('click', function() {
                const idParticipante = $(this).attr('data-id-participante');
                EliminarParticipante(idParticipante);
            });

            $("#cancelarEliminacionP").on('click', function() {
                $("#eliminarParticipante").fadeOut("slow");
            });

            $("#cancelarEliminacionA").on('click', function() {
                $("#eliminarActividad").fadeOut("slow");
            });

            $("#editarActividadButton").on('click', function() {
                $("#editarActividad").fadeIn("slow");
            });

            $("#cerrarEdicionA").on('click', function() {
                $("#editarActividad").fadeOut("slow");
            });

            $("#eliminarActividadButton").on('click', function() {
                $("#eliminarActividad").fadeIn("slow");
            });

            $("#cerrarEliminacionA").on('click', function() {
                $("#eliminarActividad").fadeOut("slow");
            });

            $("#cerrarEditarP").on('click', function() {
                $("#editarParticipante").fadeOut("slow");
            });

            $("#cerrarEliminacionP").on('click', function() {
                $("#eliminarParticipante").fadeOut("slow");
            });

            $("#nuevo-participante-button").on('click', function() {
                $("#crearParticipante").fadeIn("slow");
            });

            $("#cerrarNuevoP").on('click', function() {
                $("#crearParticipante").fadeOut("slow");
                LimpiarFormParticipantes();
            });

            ActualizarProyectoNav();

            const urlParams = new URLSearchParams(window.location.search);
            const actividadID = urlParams.get('id');

            DetallesActividad(actividadID);
            ObtenerParticipantes(actividadID);
        });
    </script>
</body>
</html>