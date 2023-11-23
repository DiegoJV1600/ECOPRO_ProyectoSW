<?php
    include 'config/database.php';

    class Participantes
    {
        private $con;

        public function __construct()
        {
            $conexion = new Conexion();
            $this -> con = $conexion -> conectar();
        }

        public function CrearParticipante($nombre, $rol, $celular, $correo, $actividad, $proyecto)
        {
            try
            {
                $sql = "INSERT INTO Participantes(
                    Participante_Nombre,
                    Participante_Rol,
                    Participante_Celular,
                    Participante_Correo,
                    Participante_Actividad,
                    Participante_Proyecto)
                VALUES(:nombre, :rol, :celular, :correo, :actividad, :proyecto)";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $consulta -> bindParam(':rol', $rol, PDO::PARAM_STR);
                $consulta -> bindParam(':celular', $celular, PDO::PARAM_STR);
                $consulta -> bindParam(':correo', $correo, PDO::PARAM_STR);
                $consulta -> bindParam(':actividad', $actividad, PDO::PARAM_INT);
                $consulta -> bindParam(':proyecto', $proyecto, PDO::PARAM_INT);
                $consulta -> execute();

                $respuesta = array('success' => true, 'message' => 'Participante agregado con éxito.');
                echo json_encode($respuesta);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al agregar el participante: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ObtenerParticipantesProyecto($proyecto)
        {
            try
            {
                $sql = "SELECT
                    pa.Participante_ID,
                    pa.Participante_Nombre,
                    pa.Participante_Rol,
                    pa.Participante_Celular,
                    pa.Participante_Correo,
                    a.Actividad_Nombre AS Participante_Actividad
                FROM Participantes pa
                LEFT JOIN Actividades a ON pa.Participante_Actividad = Actividad_ID
                LEFT JOIN Proyectos p ON pa.Participante_Proyecto = Proyecto_ID
                WHERE p.Proyecto_ID = :proyecto
                ORDER BY pa.Participante_Modificacion DESC";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':proyecto', $proyecto, PDO::PARAM_INT);
                $consulta -> execute();

                $participantes = $consulta -> fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($participantes);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al obtener participantes: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ConsultarParticipanteProyecto($proyecto, $nombre)
        {
            try
            {
                $sql = "SELECT
                    pa.Participante_ID,
                    pa.Participante_Nombre,
                    pa.Participante_Rol,
                    pa.Participante_Celular,
                    pa.Participante_Correo,
                    a.Actividad_Nombre AS Participante_Actividad
                FROM Participantes pa
                JOIN Actividades a ON pa.Participante_Actividad = Actividad_ID
                JOIN Proyectos p ON pa.Participante_Proyecto = Proyecto_ID
                WHERE p.Proyecto_ID = :proyecto AND pa.Participante_Nombre = :nombre";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':proyecto', $proyecto, PDO::PARAM_INT);
                $consulta -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $consulta -> execute();

                $participante = $consulta -> fetch(PDO::FETCH_ASSOC);
                echo json_encode($participante);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al buscar el participante: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ObtenerParticipantesActividad($actividad)
        {
            try
            {
                $sql = "SELECT
                    Participante_ID,
                    Participante_Nombre,
                    Participante_Rol,
                    Participante_Celular,
                    Participante_Correo
                FROM Participantes
                WHERE Participante_Actividad = :actividad
                ORDER BY Participante_Modificacion DESC";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':actividad', $actividad, PDO::PARAM_INT);
                $consulta -> execute();

                $participantes = $consulta -> fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($participantes);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al obtener participantes: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ConsultarParticipanteActividad($actividad, $nombre)
        {
            try
            {
                $sql = "SELECT
                    Participante_ID,
                    Participante_Nombre,
                    Participante_Rol,
                    Participante_Celular,
                    Participante_Correo
                FROM Participantes
                WHERE Participante_Actividad = :actividad AND Participante_Nombre = :nombre";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':actividad', $actividad, PDO::PARAM_INT);
                $consulta -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $consulta -> execute();

                $participante = $consulta -> fetch(PDO::FETCH_ASSOC);
                echo json_encode($participante);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al buscar el participante: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ModificarParticipante($id, $nombre, $rol, $celular, $correo)
        {
            try
            {
                $this -> con -> beginTransaction();

                $sql = "UPDATE Participantes SET
                    Participante_Nombre = :nombre,
                    Participante_Rol = :rol,
                    Participante_Celular = :celular,
                    Participante_Correo = :correo
                WHERE Participante_ID = :id";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':id', $id, PDO::PARAM_INT);
                $consulta -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $consulta -> bindParam(':rol', $rol, PDO::PARAM_STR);
                $consulta -> bindParam(':celular', $celular, PDO::PARAM_STR);
                $consulta -> bindParam(':correo', $correo, PDO::PARAM_STR);
                $consulta -> execute();

                $this -> con -> commit();
                return array('success' => true, 'message' => 'Participante modificado con éxito.');
            }
            catch(PDOException $e)
            {
                $this -> con -> rollBack();
                return array('success' => false, 'message' => 'Error al modificar el participante: ' . $e -> getMessage());
            }
        }

        public function EliminarParticipante($id)
        {
            try
            {
                $this -> con -> beginTransaction();

                $sql = "DELETE FROM Participantes
                WHERE Participante_ID = :id";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':id', $id, PDO::PARAM_INT);
                $consulta -> execute();

                $filas_afectadas = $consulta -> rowCount();

                if($filas_afectadas > 0)
                {
                    $this -> con -> commit();
                    return array('success' => true, 'message' => 'Participante eliminado con éxito.');
                }
                else 
                {
                    $this -> con -> rollBack();
                    return array('success' => false, 'message' => 'No se encontro el participante.');
                }
            }
            catch(PDOException $e)
            {
                $this -> con -> commit();
                return array('success' => false, 'message' => 'Error al eliminar el participante: ' . $e -> getMessage());
            }
        }
    }

    header('Content-Type: application/json');

    $participantesAPI = new Participantes();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $datos = json_decode(file_get_contents("php://input"), true);

        if(isset($_GET['action']) && $_GET['action'] === 'crear_participante')
        {
            $participantesAPI -> CrearParticipante(
                $datos['Participante_Nombre'],
                $datos['Participante_Rol'],
                $datos['Participante_Celular'],
                $datos['Participante_Correo'],
                $datos['Participante_Actividad'],
                $datos['Participante_Proyecto']
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'PUT')
    {
        $datos = json_decode(file_get_contents("php://input"));

        if(isset($_GET['action']) && $_GET['action'] === 'modificar_participante')
        {
            $participantesAPI -> ModificarParticipante(
                $datos -> Participante_ID,
                $datos -> Participante_Nombre,
                $datos -> Participante_Rol,
                $datos -> Participante_Celular,
                $datos -> Participante_Correo
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
    {
        $datos = json_decode(file_get_contents("php://input"));

        if(isset($_GET['action']) && $_GET['action'] === 'eliminar_participante')
        {
            $participantesAPI -> EliminarParticipante(
                $datos -> Participante_ID
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']))
    {
        if($_GET['action'] === 'obtener_participantes_proyecto')
        {
            $proyectoID = $_GET['proyecto_id'];
            $participantesAPI -> ObtenerParticipantesProyecto($proyectoID);
        }
        else if($_GET['action'] === 'obtener_participantes_actividad')
        {
            $actividadID = $_GET['actividad_id'];
            $participantesAPI -> ObtenerParticipantesActividad($actividadID);
        }
        else if($_GET['action'] === 'consultar_participante_proyecto')
        {
            $proyectoID = $_GET['proyecto_id'];
            $participanteNombre = $_GET['nombre_participante'];
            $participantesAPI -> ConsultarParticipanteProyecto($proyectoID, $participanteNombre);
        }
        else if($_GET['action'] === 'consultar_participante_actividad')
        {
            $actividadID = $_GET['actividad_id'];
            $participanteNombre = $_GET['nombre_participante'];
            $participantesAPI -> ConsultarParticipanteActividad($actividadID, $participanteNombre);
        }
    }
?>