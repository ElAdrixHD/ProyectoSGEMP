<?php
include("dao.php");
class App{
  private $dao;

  function __construct(){
    $this->dao=new Dao();
  }
    static function print_init($tilte="Página SGEMP"){
        echo "<!DOCTYPE html>
    <html lang=\"es\">  
      <head>    
        <title>$tilte</title>    
        <meta charset=\"UTF-8\">
        <meta name=\"title\" content=\"$tilte\">
        <meta name=\"description\" content=\"$tilte\">    
        <link rel=\"stylesheet\" href=\"../css/bootstrap.css\"/>
        <link rel=\"stylesheet\" href=\"../css/aula.css\"/>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
        <script type='text/javascript' src='../js/bootstrap.js'></script>
      </head>  
      <body>    
        <header>
          <h1 class='text-center'>$tilte</h1>      
        </header>";
    }

    static function nav_aula(){
      echo"<nav class=\"navbar navbar-expand-lg navbar-light bg-light\">

  <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
    <ul class=\"navbar-nav mr-auto\">
      <li class=\"nav-item active\">
        <a class=\"nav-link\" href=\"aula.php\">Listado Alumnos</a>
      </li>
      <li class=\"nav-item dropdown\">
        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
          Gestion de ausencias
        </a>
        <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
          <a class=\"dropdown-item\" href=\"#\">Añadir</a>
          <a class=\"dropdown-item\" href=\"buscarAusencias.php\">Buscar</a>
        </div>
      </li>
      <li class=\"nav-item active\">
        <a class=\"nav-link\" href=\"logout.php\">Cerrar Sesion</a>
      </li>
    </ul>
  </div>
</nav>";
    }
    
    static function print_footer(){
        echo "<footer>
          <h4>Adrian Muñoz Mudarra</h4>
        </footer>
      </body>  
    </html>";
    }

    function getDao(){
      return $this->dao;
    }

    public function saveSession($user)
    {
        $_SESSION['user']=$user;
    }

    public function validateSesion()
    {
        session_start();
        if(!$this->isLogged())
            $this->showLogin();
    }

    public function isLogged()
    {
        return isset($_SESSION['user']);
    }

    private function showLogin()
    {
        header('Location: login.php');
    }

    public function invalidateSession()
    {
        session_start();
        if($this->isLogged()){
            unset($_SESSION['user']);
            session_destroy();
        }
        $this->showLogin();
    }

    public function getStudent()
    {
        return $this->getDao()->getStudent();
    }

    public function getNombreStudent($id)
    {
        return $this->getDao()->getNombreStudent($id);
    }

    public function getFaltasDeUsuario($get)
    {
        return $this->getDao()->getFaltasDeUsuario($get);
    }

    public function getFaltas()
    {
        return $this->getDao()->getFaltas();
    }

    public function getModulos()
    {
        return $this->getDao()->getModulos();
    }
    public function getModuloPorID($id)
    {
        return $this->getDao()->getModuloPorID($id);
    }

    public function getFaltasPOST($id_al = "", $id_mod = "", $fechaD = "", $fechaH = "")
    {
        return $this->getDao()->getFaltasPOST($id_al,$id_mod,$fechaD,$fechaH);
    }
}
?>