<?php
    include 'config/database.php';

    class Proyectos
    {
        private $con;

        public function __construct()
        {
            $conexion = new Conexion();
            $this -> con = $conexion -> conectar();
        }

        public function CrearProyecto($nombre, $descripcion, $objetivo, $fecha_inicial, $fecha_final, $responsable, $presupuesto)
        {
            try 
            {

                $sql = "INSERT INTO Proyectos(
                    Proyecto_Nombre, 
                    Proyecto_Descripcion, 
                    Proyecto_Objetivo, 
                    Proyecto_FechaInicial, 
                    Proyecto_FechaFinal,
                    Proyecto_Responsable, 
                    Proyecto_Presupuesto)
                VALUES(:nombre, :descripcion, :objetivo, :fecha_inicial, :fecha_final, :responsable, :presupuesto)";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $consulta -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $consulta -> bindParam(':objetivo', $objetivo, PDO::PARAM_STR);
                $consulta -> bindParam(':fecha_inicial', $fecha_inicial, PDO::PARAM_STR);
                $consulta -> bindParam(':fecha_final', $fecha_final, PDO::PARAM_STR);
                $consulta -> bindParam(':responsable', $responsable, PDO::PARAM_STR);
                $consulta -> bindParam(':presupuesto', $presupuesto, PDO::PARAM_STR);
                $consulta -> execute();

                $respuesta = array('success' => true, 'message' => 'Proyecto agregado con éxito.');
                echo json_encode($respuesta);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al agregar el proyecto: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ObtenerProyectos()
        {
            try 
            {
                $sql = "SELECT 
                    Proyecto_ID,
                    Proyecto_Nombre,
                    Proyecto_Descripcion,
                    Proyecto_Objetivo,
                    Proyecto_FechaInicial,
                    Proyecto_FechaFinal,
                    Proyecto_Responsable,
                    Proyecto_Presupuesto
                FROM Proyectos 
                ORDER BY Proyecto_Modificacion DESC";

                $consulta = $this -> con -> prepare($sql);
                $consulta -> execute();

                $proyectos = $consulta -> fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($proyectos);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al obtener proyectos: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ConsultarProyecto($id)
        {
            try
            {
                $sql = "SELECT
                    Proyecto_ID,
                    Proyecto_Nombre,
                    Proyecto_Descripcion,
                    Proyecto_Objetivo,
                    Proyecto_FechaInicial,
                    Proyecto_FechaFinal,
                    Proyecto_Responsable,
                    Proyecto_Presupuesto
                FROM Proyectos 
                WHERE Proyecto_ID = :id";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':id', $id, PDO::PARAM_INT);
                $consulta -> execute();

                $proyecto = $consulta -> fetch(PDO::FETCH_ASSOC);
                echo json_encode($proyecto);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al buscar el proyecto: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ModificarProyecto($id, $nombre, $descripcion, $objetivo, $fecha_inicial, $fecha_final, $responsable, $presupuesto)
        {
            try
            {
                $this -> con -> beginTransaction();
                
                $sql = "UPDATE Proyectos SET 
                    Proyecto_Nombre = :nombre, 
                    Proyecto_Descripcion = :descripcion, 
                    Proyecto_Objetivo = :objetivo, 
                    Proyecto_FechaInicial = :fecha_inicial, 
                    Proyecto_FechaFinal = :fecha_final, 
                    Proyecto_Responsable = :responsable, 
                    Proyecto_Presupuesto = :presupuesto
                WHERE Proyecto_ID = :id";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':id', $id, PDO::PARAM_INT);
                $consulta -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $consulta -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $consulta -> bindParam(':objetivo', $objetivo, PDO::PARAM_STR);
                $consulta -> bindParam(':fecha_inicial', $fecha_inicial, PDO::PARAM_STR);
                $consulta -> bindParam(':fecha_final', $fecha_final, PDO::PARAM_STR);
                $consulta -> bindParam(':responsable', $responsable, PDO::PARAM_STR);
                $consulta -> bindParam(':presupuesto', $presupuesto, PDO::PARAM_STR);
                $consulta -> execute();

                $this -> con -> commit();
                header('HTTP/1.1 200 OK');

                echo json_encode(array('success' => true, 'message' => 'Proyecto modificado con éxito.'));
            }
            catch(PDOException $e)
            {
                $this -> con -> rollBack();
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(array('success' => false, 'message' => 'Error al modificar el proyecto: ' . $e -> getMessage()));
            }
        }

        public function EliminarProyecto($id)
        {
            try
            {
                $this -> con -> beginTransaction();

                $sql = "DELETE FROM Proyectos
                WHERE Proyecto_ID = :id";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':id', $id, PDO::PARAM_INT);
                $consulta -> execute();

                $filas_afectadas = $consulta -> rowCount();

                if($filas_afectadas > 0)
                {
                    $this -> con -> commit();
                    echo json_encode(array('success' => true, 'message' => 'Proyecto eliminado con éxito.'));
                }
                else 
                {
                    $this -> con -> rollBack();
                    echo json_encode(array('success' => false, 'message' => 'No se encontro el proyecto.'));
                }
            }
            catch(PDOException $e)
            {
                $this -> con -> rollBack();
                echo json_encode(array('success' => false, 'message' => 'Error al eliminar el proyecto: ' . $e -> getMessage()));
            }
        }
    }

    header('Content-Type: application/json');

    $proyectosAPI = new Proyectos();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $datos = json_decode(file_get_contents("php://input"), true);

        if(isset($_GET['action']) && $_GET['action'] === 'crear_proyecto')
        {
            $proyectosAPI -> CrearProyecto(
                $datos['Proyecto_Nombre'], 
                $datos['Proyecto_Descripcion'], 
                $datos['Proyecto_Objetivo'], 
                $datos['Proyecto_FechaInicial'], 
                $datos['Proyecto_FechaFinal'],
                $datos['Proyecto_Responsable'], 
                $datos['Proyecto_Presupuesto']
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'PUT')
    {
        $datos = json_decode(file_get_contents("php://input"));

        if(isset($_GET['action']) && $_GET['action'] === 'modificar_proyecto')
        {
            $proyectosAPI -> ModificarProyecto(
                $datos -> Proyecto_ID,
                $datos -> Proyecto_Nombre,
                $datos -> Proyecto_Descripcion,
                $datos -> Proyecto_Objetivo,
                $datos -> Proyecto_FechaInicial,
                $datos -> Proyecto_FechaFinal,
                $datos -> Proyecto_Responsable,
                $datos -> Proyecto_Presupuesto
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
    {
        $datos = json_decode(file_get_contents("php://input"));

        if(isset($_GET['action']) && $_GET['action'] === 'eliminar_proyecto')
        {
            $proyectosAPI -> EliminarProyecto(
                $datos -> Proyecto_ID
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']))
    {
        if($_GET['action'] === 'obtener_proyectos')
        {
            $proyectosAPI -> ObtenerProyectos();
        }
        else if($_GET['action'] === 'consultar_proyecto')
        {
            $idProyecto = $_GET['id'];
            $proyectosAPI -> ConsultarProyecto($idProyecto);
        }
    }
?> 