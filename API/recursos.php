<?php
    include 'config/database.php';

    class Recursos
    {
        private $con;

        public function __construct()
        {   
            $conexion = new Conexion();
            $this -> con = $conexion -> conectar();
        }

        public function CrearRecurso($nombre, $descripcion, $cantidad, $actividad)
        {
            try
            {
                $sql = "INSERT INTO Recursos(
                    Recurso_Nombre,
                    Recurso_Descripcion,
                    Recurso_Cantidad,
                    Recurso_Actividad)
                VALUES(:nombre, :descripcion, :cantidad, :actividad)";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $consulta -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $consulta -> bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
                $consulta -> bindParam(':actividad', $actividad, PDO::PARAM_INT);
                $consulta -> execute();

                $respuesta = array('success' => true, 'message' => 'Recurso agregado con éxito.');
                echo json_encode($respuesta);
            }
            catch(PDOException $e)
            {   
                $respuesta = array('success' => false, 'message' => 'Error al agregar el recurso.' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ObtenerRecursos($actividad)
        {
            try
            {
                $sql = "SELECT
                    Recurso_ID,
                    Recurso_Nombre,
                    Recurso_Descripcion,
                    Recurso_Cantidad
                FROM Recursos
                WHERE Recurso_Actividad = :actividad
                ORDER BY Recurso_Modificacion DESC";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':actividad', $actividad, PDO::PARAM_INT);
                $consulta -> execute();

                $recursos = $consulta -> fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($recursos);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al obtener recursos: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ConsultarRecurso($id)
        {
            try
            {
                $sql = "SELECT
                    Recurso_ID,
                    Recurso_Nombre,
                    Recurso_Descripcion,
                    Recurso_Cantidad
                FROM Recursos 
                WHERE Recurso_ID = :id";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':id', $id, PDO::PARAM_INT);
                $consulta -> execute();

                $recurso = $consulta -> fetch(PDO::FETCH_ASSOC);
                echo json_encode($recurso);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al buscar el recurso: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ModificarRecurso($id, $nombre, $descripcion, $cantidad)
        {
            try
            {
                $this -> con -> beginTransaction();

                $sql = "UPDATE Recursos SET
                    Recurso_Nombre = :nombre,
                    Recurso_Descripcion = :descripcion,
                    Recurso_Cantidad = :cantidad
                WHERE Recurso_ID = :id";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':id', $id, PDO::PARAM_INT);
                $consulta -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $consulta -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $consulta -> bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
                $consulta -> execute();

                $this -> con -> commit();
                echo json_encode(array('success' => true, 'message' => 'Recurso modificado con éxito.'));
            }
            catch(PDOException $e)
            {
                $this -> con -> rollBack();
                echo json_encode(array('success' => false, 'message' => 'Error al modificar el recurso: ' . $e -> getMessage()));
            }
        }

        public function EliminarRecurso($id)
        {
            try
            {
                $this -> con -> beginTransaction();

                $sql = "DELETE FROM Recursos
                WHERE Recurso_ID = :id";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':id', $id, PDO::PARAM_INT);
                $consulta -> execute();

                $filas_afectadas = $consulta -> rowCount();

                if($filas_afectadas > 0)
                {
                    $this -> con -> commit();
                    echo json_encode(array('success' => true, 'message' => 'Recurso eliminado con éxito.'));
                }
                else 
                {
                    $this -> con -> rollBack();
                    echo json_encode(array('success' => false, 'message' => 'No se encontro el recurso.'));
                }
            }
            catch(PDOException $e)
            {
                $this -> con -> rollBack();
                echo json_encode(array('success' => false, 'message' => 'Error al eliminar el recurso: ' . $e -> getMessage()));
            }
        }
    }

    header('Content-Type: application/json');

    $recursosAPI = new Recursos();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $datos = json_decode(file_get_contents("php://input"), true);

        if(isset($_GET['action']) && $_GET['action'] === 'crear_recurso')
        {
            $recursosAPI -> CrearRecurso(
                $datos['Recurso_Nombre'],
                $datos['Recurso_Descripcion'],
                $datos['Recurso_Cantidad'],
                $datos['Recurso_Actividad']
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'PUT')
    {
        $datos = json_decode(file_get_contents("php://input"));

        if(isset($_GET['action']) && $_GET['action'] === 'modificar_recurso')
        {
            $recursosAPI -> ModificarRecurso(
                $datos -> Recurso_ID,
                $datos -> Recurso_Nombre,
                $datos -> Recurso_Descripcion,
                $datos -> Recurso_Cantidad
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
    {
        $datos = json_decode(file_get_contents("php://input"));

        if(isset($_GET['action']) && $_GET['action'] === 'eliminar_recurso')
        {
            $recursosAPI -> EliminarRecurso(
                $datos -> Recurso_ID
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']))
    {
        if($_GET['action'] === 'obtener_recursos')
        {
            $actividadID = $_GET['actividad_id'];
            $recursosAPI -> ObtenerRecursos($actividadID);
        }
        else if($_GET['action'] === 'consultar_recurso')
        {
            $recursoID = $_GET['recurso_id'];
            $recursosAPI -> ConsultarRecurso($recursoID);
        }
    }
?>