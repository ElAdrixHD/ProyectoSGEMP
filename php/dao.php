<?php
define("DATABASE","aula");
define("DSN","mysql:host=localhost;dbname=".DATABASE);
define("USER","www-data");
define("PASSWORD","password");
define("TABLE_USER","user");
define("COLUMN_USER","user");
define("COLUMN_PASS","password");
define("TABLE_STUDENT", "alumno");
define("TABLE_FALTAS", "falta");
define("COLUMN_ID_ALUMNO", "id_alumno");
define("COLUMN_ID", "id");
    class Dao{
        private $conn;
        public $error;

        function __construct(){
            try{
                $this->conn=new PDO(DSN,USER,PASSWORD);
            }catch(PDOException $e){
                //Gestionamos el catch
                $this->error="Error en la conexion: ".$e.getMessage();
            }
        }

        function isConnected(){
            return isset($this->conn);
        }

        public function validateUser($user, $pass)
        {
            $sql="SELECT * FROM ".TABLE_USER." WHERE ".COLUMN_USER."='".$user."' AND ".COLUMN_PASS."= sha1('".$pass."')";
            $statement = $this->conn->query($sql);
            if($statement->rowCount()==1){
                return true;
            }
            return false;
        }

        public function getStudent()
        {
            try{
                $sql="SELECT * FROM ".TABLE_STUDENT;
                $resultset = $this->conn->query($sql);
                return $resultset;
            }catch (PDOException $e){
                $this->error = $e->getMessage();
        }
        }

        public function getNombreStudent($id)
        {
            try {
                $sql = "SELECT nombre FROM " . TABLE_STUDENT . " WHERE ".COLUMN_ID." = ?";
                $statement=$this->conn->prepare($sql);
                $statement->execute(array($id));
                return $statement;
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
            }
        }

        public function getFaltasDeUsuario($id)
        {
            try{

                $sql="SELECT * FROM ".TABLE_FALTAS." WHERE ".COLUMN_ID_ALUMNO." = :id_alumno";
                $statement=$this->conn->prepare($sql);
                $statement->bindParam(":id_alumno",$id);
                $statement->execute();
                return $statement;


                /*
                 $sql="SELECT * FROM ".TABLE_FALTAS." WHERE ".COLUMN_ID_ALUMNO." = :id_alumno";
                 $statement=$this->conn->prepare($sql);
                 $statement->execute(array(":id_alumno"=>$id));
                 return $statement;
                 */

                /*
                 $sql="SELECT * FROM ".TABLE_FALTAS." WHERE ".COLUMN_ID_ALUMNO." = ?";
                 $statement=$this->conn->prepare($sql);
                 $statement->execute(array($id));
                 return $statement;
                */

            }catch (PDOException $e){
                $this->error = $e->getMessage();
            }
        }

        public function getFaltas()
        {
            try{
                $sql="SELECT * FROM ".TABLE_FALTAS;
                $resultset = $this->conn->query($sql);
                return $resultset;
            }catch (PDOException $e){
                $this->error = $e->getMessage();
            }
        }
    }
?>