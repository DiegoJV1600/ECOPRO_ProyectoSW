<?php
    include 'config/database.php';

    class Actividades
    {
        private $con;

        public function __construct()
        {
            $conexion = new Conexion();
            $this -> con = $conexion -> conectar();
        }

        public function CrearActividad($nombre, $descripcion, $objetivo, $fecha_inicial, $fecha_final, $proyecto)
        {
            try
            {
                $sql = "INSERT INTO Actividades(
                    Actividad_Nombre,
                    Actividad_Descripcion,
                    Actividad_Objetivo,
                    Actividad_FechaInicial,
                    Actividad_FechaFinal,
                    Actividad_Proyecto)
                VALUES(:nombre, :descripcion, :objetivo, :fecha_inicial, :fecha_final, :proyecto)";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $consulta -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $consulta -> bindParam(':objetivo', $objetivo, PDO::PARAM_STR);
                $consulta -> bindParam(':fecha_inicial', $fecha_inicial, PDO::PARAM_STR);
                $consulta -> bindParam(':fecha_final', $fecha_final, PDO::PARAM_STR);
                $consulta -> bindParam(':proyecto', $proyecto, PDO::PARAM_INT);
                $consulta -> execute();

                $respuesta = array('success' => true, 'message' => 'Actividad agregada con éxito.');
                echo json_encode($respuesta);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al agregar la actividad: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ObtenerActividades($proyecto)
        {
            try
            {
                $sql = "SELECT
                    a.Actividad_ID,
                    a.Actividad_Nombre,
                    a.Actividad_Descripcion,
                    a.Actividad_Objetivo,
                    a.Actividad_FechaInicial,
                    a.Actividad_FechaFinal,
                    p.Proyecto_Nombre AS Actividad_Proyecto
                FROM Actividades a
                LEFT JOIN Proyectos p ON a.Actividad_Proyecto = p.Proyecto_ID
                WHERE P.Proyecto_ID = :proyecto
                ORDER BY a.Actividad_Modificacion DESC";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':proyecto', $proyecto, PDO::PARAM_INT);
                $consulta -> execute();

                $actividades = $consulta -> fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($actividades);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al obtener actividades: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ConsultarActividad($proyecto, $nombre)
        {
            try
            {
                $sql = "SELECT
                    a.Actividad_ID,
                    a.Actividad_Nombre,
                    a.Actividad_Descripcion,
                    a.Actividad_Objetivo,
                    a.Actividad_FechaInicial,
                    a.Actividad_FechaFinal,
                    p.Proyecto_Nombre AS Actividad_Proyecto
                FROM Actividades a
                JOIN Proyectos p ON a.Actividad_Proyecto = p.Proyecto_ID
                WHERE p.Proyecto_ID = :proyecto AND a.Actividad_Nombre = :nombre";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':proyecto', $proyecto, PDO::PARAM_INT);
                $consulta -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $consulta -> execute();

                $actividad = $consulta -> fetch(PDO::FETCH_ASSOC);
                echo json_encode($actividad);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al buscar la actividad.' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ModificarActividad($id, $nombre, $descripcion, $objetivo, $fecha_inicial, $fecha_final)
        {
            try
            {   
                $this -> con -> beginTransaction();

                $sql = "UPDATE Actividades SET
                    Actividad_Nombre = :nombre,
                    Actividad_Descripcion = :descripcion,
                    Actividad_Objetivo = :objetivo,
                    Actividad_FechaInicial = :fecha_inicial,
                    Actividad_FechaFinal = :fecha_final
                WHERE Actividad_ID = :id";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':id', $id, PDO::PARAM_INT);
                $consulta -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $consulta -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $consulta -> bindParam(':objetivo', $objetivo, PDO::PARAM_STR);
                $consulta -> bindParam(':fecha_inicial', $fecha_inicial, PDO::PARAM_STR);
                $consulta -> bindParam(':fecha_final', $fecha_final, PDO::PARAM_STR);
                $consulta -> execute();

                $this -> con -> commit();
                
                echo json_encode(array('success' => true, 'message' => 'Actividad modificada con éxito.'));
            }
            catch(PDOException $e)
            {
                $this -> con -> rollBack();
                echo json_encode(array('success' => false, 'message' => 'Error al modificar la actividad: ' . $e -> getMessage()));
            }
        }

        public function EliminarActividad($id)
        {
            try
            {
                $this -> con -> beginTransaction();

                $sql = "DELETE FROM Actividades
                WHERE Actividad_ID = :id";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':id', $id, PDO::PARAM_INT);
                $consulta -> execute();

                $filas_afectadas = $consulta -> rowCount();

                if($filas_afectadas > 0)
                {
                    $this -> con -> commit();
                    echo json_encode(array('success' => true, 'message' => 'Actividad eliminada con éxito.'));
                }
                else 
                {
                    $this -> con -> rollBack();
                    echo json_encode(array('success' => false, 'message' => 'No se encontro la actividad.'));
                }
            }
            catch(PDOException $e)
            {
                $this -> con -> rollBack();
                echo json_encode(array('success' => false, 'message' => 'Error al eliminar la actividad: ' . $e -> getMessage()));
            }
        }
    }

    header('Content-Type: application/json');

    $actividadesAPI = new Actividades();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $datos = json_decode(file_get_contents("php://input"), true);

        if(isset($_GET['action']) && $_GET['action'] === 'crear_actividad')
        {
            $actividadesAPI -> CrearActividad(
                $datos['Actividad_Nombre'],
                $datos['Actividad_Descripcion'],
                $datos['Actividad_Objetivo'],
                $datos['Actividad_FechaInicial'],
                $datos['Actividad_FechaFinal'],
                $datos['Actividad_Proyecto']
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'PUT')
    {
        $datos = json_decode(file_get_contents("php://input"));

        if(isset($_GET['action']) && $_GET['action'] === 'modificar_actividad')
        {
            $actividadesAPI -> ModificarActividad(
                $datos -> Actividad_ID,
                $datos -> Actividad_Nombre,
                $datos -> Actividad_Descripcion,
                $datos -> Actividad_Objetivo,
                $datos -> Actividad_FechaInicial,
                $datos -> Actividad_FechaFinal
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
    {
        $datos = json_decode(file_get_contents("php://input"));

        if(isset($_GET['action']) && $_GET['action'] === 'eliminar_actividad')
        {
            $actividadesAPI -> EliminarActividad(
                $datos -> Actividad_ID
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']))
    {
        if($_GET['action'] === 'obtener_actividades')
        {
            $proyectoID = $_GET['proyecto_id'];
            $actividadesAPI -> ObtenerActividades($proyectoID);
        }
        else if($_GET['action'] === 'consultar_actividad')
        {
            $proyectoID = $_GET['proyecto_id'];
            $actividadNombre = $_GET['nombre_actividad'];
            $actividadesAPI -> ConsultarActividad($proyectoID, $actividadNombre);
        }
    }
?>