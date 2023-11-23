<?php
    include 'config/database.php';

    class Informe
    {
        private $con;

        public function __construct()
        {
            $conexion = new Conexion();
            $this -> con = $conexion -> conectar();    
        }

        public function CrearInforme($titulo, $descripcion, $entrega, $actividad)
        {
            try
            {
                $sql = "INSERT INTO Informes(
                    Informe_Titulo,
                    Informe_Descripcion,
                    Informe_Entrega,
                    Informe_Actividad)
                VALUES(:titulo, :descripcion, :entrega, :actividad)";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $consulta -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $consulta -> bindParam(':entrega', $entrega, PDO::PARAM_STR);
                $consulta -> bindParam(':actividad', $actividad, PDO::PARAM_INT);
                $consulta -> execute();

                $respuesta = array('success' => true, 'message' => 'Informe agregado con éxito.');
                echo json_encode($respuesta);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al agregar el informe: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ObtenerInformes($actividad)
        {
            try
            {
                $sql = "SELECT
                    Informe_ID,
                    Informe_Titulo,
                    Informe_Descripcion,
                    Informe_Entrega
                FROM Informes
                WHERE Informe_Actividad = :actividad
                ORDER BY Informe_Modificacion DESC";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':actividad', $actividad, PDO::PARAM_INT);
                $consulta -> execute();

                $informes = $consulta -> fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($informes);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al obtener informes: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ConsultarInforme($actividad, $titulo)
        {
            try
            {
                $sql = "SELECT
                    Informe_ID,
                    Informe_Titulo,
                    Informe_Descripcion,
                    Informe_Entrega
                FROM Informes
                WHERE Informe_Actividad = :actividad AND Informe_Titulo = :titulo";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':actividad', $actividad, PDO::PARAM_INT);
                $consulta -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $consulta -> execute();

                $informe = $consulta -> fetch(PDO::FETCH_ASSOC);
                echo json_encode($informe);
            }
            catch(PDOException $e)
            {
                $respuesta = array('success' => false, 'message' => 'Error al buscar el informe: ' . $e -> getMessage());
                echo json_encode($respuesta);
            }
        }

        public function ModificarInforme($id, $titulo, $descripcion, $entrega)
        {
            try
            {
                $this -> con -> beginTransaction();

                $sql = "UPDATE Informes SET
                    Informe_Titulo = :titulo,
                    Informe_Descripcion = :descripcion,
                    Informe_Entrega = :entrega
                WHERE Informe_ID = :id";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':id', $id, PDO::PARAM_INT);
                $consulta -> bindParam(':titulo', $titulo, PDO::PARAM_STR);
                $consulta -> bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $consulta -> bindParam(':entrega', $entrega, PDO::PARAM_STR);
                $consulta -> execute();

                $this -> con -> commit();
                echo json_encode(array('success' => true, 'message' => 'Informe modificado con éxito.'));
            }
            catch(PDOException $e)
            {
                $this -> con -> rollBack();
                echo json_encode(array('success' => false, 'message' => 'Error al modificar el informe: ' . $e -> getMessage()));
            }
        }

        public function EliminarInforme($id)
        {
            try
            {
                $this -> con -> beginTransaction();

                $sql = "DELETE FROM Informes
                WHERE Informe_ID = :id";

                $consulta = $this -> con -> prepare($sql);

                $consulta -> bindParam(':id', $id, PDO::PARAM_INT);
                $consulta -> execute();

                $filas_afectadas = $consulta -> rowCount();

                if($filas_afectadas > 0)
                {
                    $this -> con -> commit();
                    echo json_encode(array('success' => true, 'message' => 'Informe eliminado con éxito.'));
                }
                else 
                {
                    $this -> con -> rollBack();
                    echo json_encode(array('success' => false, 'message' => 'No se encontro el informe.'));
                }
            }
            catch(PDOException $e)
            {
                $this -> con -> commit();
                echo json_encode(array('success' => false, 'message' => 'Error al eliminar el informe: ' . $e -> getMessage()));
            }
        }
    }

    header('Content-Type: application/json');

    $informesAPI = new Informe();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $datos = json_decode(file_get_contents("php://input"), true);

        if(isset($_GET['action']) && $_GET['action'] === 'crear_informe')
        {
            $informesAPI -> CrearInforme(
                $datos['Informe_Titulo'],
                $datos['Informe_Descripcion'],
                $datos['Informe_Entrega'],
                $datos['Informe_Actividad']
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'PUT')
    {
        $datos = json_decode(file_get_contents("php://input"));

        if(isset($_GET['action']) && $_GET['action'] === 'modificar_informe')
        {
            $informesAPI -> ModificarInforme(
                $datos -> Informe_ID,
                $datos -> Informe_Titulo,
                $datos -> Informe_Descripcion,
                $datos -> Informe_Entrega
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
    {
        $datos = json_decode(file_get_contents("php://input"));

        if(isset($_GET['action']) && $_GET['action'] === 'eliminar_informe')
        {
            $informesAPI -> EliminarInforme(
                $datos -> Informe_ID
            );
        }
    }
    else if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']))
    {
        if($_GET['action'] === 'obtener_informes')
        {
            $actividadID = $_GET['actividad_id'];
            $informesAPI -> ObtenerInformes($actividadID);
        }
        else if($_GET['action'] === 'consultar_informe')
        {
            $actividadID = $_GET['actividad_id'];
            $informeTitulo = $_GET['titulo_informe'];
            $informesAPI -> ConsultarInforme($actividadID, $informeTitulo);
        }
    }
?>