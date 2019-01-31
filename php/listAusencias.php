<?php
include_once("app.php");
$app= new App();
$app->validateSesion();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['id'])){
        $resultset = $app->getNombreStudent($_GET['id']);
        App::print_init("Faltas de ".$resultset->fetch()['nombre']);
        $result = $app->getFaltasDeUsuario($_GET['id']);
    }else{
        App::print_init("Faltas de asistencia");
        $result = $app->getFaltas();
    }
    App::nav_aula();


}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_alumno = $_POST['seleccion_alum'];
    $id_modulo = $_POST['seleccion_mod'];
    $fechaDesde = $_POST['dateA'];
    $fechaHasta = $_POST['dateP'];

    if(!empty($id_alumno)&&!empty($id_modulo)&&!empty($fechaDesde)&&!empty($fechaHasta)){
        App::print_init($app->getNombreStudent($id_alumno)->fetch()['nombre']);
        $result = $app->getFaltasPOST("id_alumno = '".$id_alumno."'","and id_modulo = '".$id_modulo."'","and date between '".$fechaDesde."'","and '".$fechaHasta."'");
    }elseif(!empty($id_alumno)&&!empty($id_modulo)&&!empty($fechaDesde)){
        App::print_init($app->getNombreStudent($id_alumno)->fetch()['nombre']);
        $result = $app->getFaltasPOST("id_alumno = '".$id_alumno."'","and id_modulo = '".$id_modulo."'","and date between '".$fechaDesde."'","and '".$fechaDesde."'");
    }elseif(!empty($id_alumno)&&!empty($id_modulo)&&!empty($fechaHasta)){
        App::print_init($app->getNombreStudent($id_alumno)->fetch()['nombre']);
        $result = $app->getFaltasPOST("id_alumno = '".$id_alumno."'","and id_modulo = '".$id_modulo."'","and date between '".$fechaHasta."'","and '".$fechaHasta."'");
    }elseif(!empty($id_alumno)&&!empty($fechaDesde)&&!empty($fechaHasta)){
        App::print_init($app->getNombreStudent($id_alumno)->fetch()['nombre']);
        $result = $app->getFaltasPOST("id_alumno = '".$id_alumno."'","and date between '".$fechaDesde."'","and '".$fechaHasta."'");
    }elseif(!empty($id_modulo)&&!empty($fechaDesde)&&!empty($fechaHasta)){
        App::print_init($app->getModuloPorID($id_modulo)->fetch()['nombre']);
        $result = $app->getFaltasPOST("id_modulo = '".$id_modulo."'","and date between '".$fechaDesde."'","and '".$fechaHasta."'");
    }elseif(!empty($id_alumno)&&!empty($id_modulo)){
        App::print_init($app->getNombreStudent($id_alumno)->fetch()['nombre']);
        $result = $app->getFaltasPOST("id_alumno = '".$id_alumno."'","and id_modulo = '".$id_modulo."'");
    }elseif(!empty($id_alumno)&&!empty($fechaDesde)){
        App::print_init($app->getNombreStudent($id_alumno)->fetch()['nombre']);
        $result = $app->getFaltasPOST("id_alumno = '".$id_alumno."'","and date between '".$fechaDesde."'","and '".$fechaDesde."'");
    }elseif(!empty($id_alumno)&&!empty($fechaHasta)){
        App::print_init($app->getNombreStudent($id_alumno)->fetch()['nombre']);
        $result = $app->getFaltasPOST("id_alumno = '".$id_alumno."'","and date between '".$fechaHasta."'","and '".$fechaHasta."'");
    }elseif(!empty($id_modulo)&&!empty($fechaDesde)){
        App::print_init($app->getModuloPorID($id_modulo)->fetch()['nombre']);
        $result = $app->getFaltasPOST("id_modulo = '".$id_modulo."'","and date between '".$fechaDesde."'","and '".$fechaDesde."'");
    }elseif(!empty($id_modulo)&&!empty($fechaHasta)){
        App::print_init($app->getModuloPorID($id_modulo)->fetch()['nombre']);
        $result = $app->getFaltasPOST("id_modulo = '".$id_modulo."'","and date between '".$fechaHasta."'","and '".$fechaHasta."'");
    }elseif(!empty($fechaDesde)&&!empty($fechaHasta)){
        App::print_init("Faltas de asistencia");
        $result = $app->getFaltasPOST("date between '".$fechaDesde."'","and '".$fechaHasta."'");
    }elseif(!empty($id_alumno)){
        App::print_init($app->getNombreStudent($id_alumno)->fetch()['nombre']);
        $result = $app->getFaltasPOST("id_alumno = '".$id_alumno."'");
    }elseif(!empty($id_modulo)){
        App::print_init($app->getModuloPorID($id_modulo)->fetch()['nombre']);
        $result = $app->getFaltasPOST("id_modulo = '".$id_modulo."'");
    }elseif(!empty($fechaDesde)){
        App::print_init("Faltas de asistencia");
        $result = $app->getFaltasPOST("date between '".$fechaDesde."'","and '".$fechaDesde."'");
    }elseif(!empty($fechaHasta)){
        App::print_init("Faltas de asistencia");
        $result = $app->getFaltasPOST("date between '".$fechaHasta."'","and '".$fechaHasta."'");
    }else{
        App::print_init("Faltas de asistencia");
        $result = $app->getFaltas();
    }
    App::nav_aula();
}
if(!$result){
    echo "<p>Error al conectar al servidor: ".$app->getDao()->error."</p>";
}else{
    $list= $result->fetchAll();
    if (count($list)==0){
        echo "<p>No hay alumnos</p>";
    }else{
        echo "<table class=\"table table-striped table-dark\">";
        echo "<thead>";
        echo "<tr>";
        for ($i = 0; $i<$result->columnCount();$i++){
            $namecolumn = $result->getColumnMeta($i);
            echo "<th>".strtoupper($namecolumn['name'])."</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($list as $fila){
            echo "<tr>";
            echo "<td>".$fila['id_alumno']."</td><td>".$fila['id_modulo']."</td><td>".$fila['date']."</td><td>".$fila['justificada']."</td><td>".$fila['descripcion']."</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
}

App::print_footer();

