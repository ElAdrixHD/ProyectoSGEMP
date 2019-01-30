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

    if(!!empty($id_alumno)&&!empty($id_modulo)&&!empty($fechaDesde)&&!empty($fechaHasta)){
        echo "1,2,3,4";
    }elseif(!empty($id_alumno)&&!empty($id_modulo)&&!empty($fechaDesde)){
        echo "1,2,3";
    }elseif(!empty($id_alumno)&&!empty($id_modulo)&&!empty($fechaHasta)){
        echo "1,2,4";
    }elseif(!empty($id_alumno)&&!empty($fechaDesde)&&!empty($fechaHasta)){
        echo "1,3,4";
    }elseif(!empty($id_modulo)&&!empty($fechaDesde)&&!empty($fechaHasta)){
        echo "2,3,4";
    }elseif(!empty($id_alumno)&&!empty($id_modulo)){
        echo "1,2";
    }elseif(!empty($id_alumno)&&!empty($fechaDesde)){
        echo "1,3";
    }elseif(!empty($id_alumno)&&!empty($fechaHasta)){
        echo "1,4";
    }elseif(!empty($id_modulo)&&!empty($fechaDesde)){
        echo "2,3";
    }elseif(!empty($id_modulo)&&!empty($fechaHasta)){
        echo "2,4";
    }elseif(!empty($fechaDesde)&&!empty($fechaHasta)){
        echo "3,4";
    }elseif(!empty($id_alumno)){
        echo "1";
    }elseif(!empty($id_modulo)){
        echo "2";
    }elseif(!empty($fechaDesde)){
        echo "3";
    }elseif(!empty($fechaHasta)){
        echo "4";
    }else{
        echo "0";
    }
}

App::print_footer();

