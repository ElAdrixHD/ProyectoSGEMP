<?php
include_once("app.php");
$app= new App();
$app->validateSesion();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['id'])){
        $resultset = $app->getNombreStudent($_GET['id']);
        App::print_init("Faltas de ".$resultset->fetch()['nombre']);
        $resultGET = $app->getFaltasDeUsuario($_GET['id']);
    }else{
        App::print_init("Faltas de asistencia");
        $resultGET = $app->getFaltas();
    }
    App::nav_aula();
    App::mostrarTabla($resultGET);

}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_alumno = $_POST['seleccion_alum'];
    $id_modulo = $_POST['seleccion_mod'];
    $fechaDesde = $_POST['dateA'];
    $fechaHasta = $_POST['dateP'];

    echo "<p>".$id_alumno."</p>";
    echo "<p>".$id_modulo."</p>";
    echo "<p>".$fechaDesde."</p>";
    echo "<p>".$fechaHasta."</p>";

    if(isset($id_alumno)){

    }elseif(isset($id_alumno,$id_modulo)){

    }elseif(isset($id_alumno,$fechaDesde)){

    }elseif(isset($id_alumno,$fechaHasta)){

    }elseif(isset($id_alumno,$id_modulo,$fechaDesde)){

    }elseif(isset($id_alumno,$id_modulo,$fechaHasta)){

    }elseif(isset($id_alumno,$fechaDesde,$fechaHasta)){

    }elseif(isset($id_alumno,$id_modulo,$fechaDesde,$fechaHasta)){

    }elseif(isset($id_modulo)){

    }elseif(isset($id_modulo,$fechaDesde)){

    }elseif(isset($id_modulo,$fechaHasta)){

    }elseif(isset($id_modulo,$fechaDesde,$fechaHasta)){

    }elseif(isset($fechaDesde)){

    }elseif(isset($fechaDesde,$fechaHasta)){

    }elseif(isset($fechaHasta)){

    }else{

    }

}

App::print_footer();

