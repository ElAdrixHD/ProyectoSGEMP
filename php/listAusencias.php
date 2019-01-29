<?php
include_once("app.php");
$app= new App();
$app->validateSesion();
if(isset($_GET['id'])){
    $resultset = $app->getNombreStudent($_GET['id']);
    App::print_init("Faltas de ".$resultset->fetch()['nombre']);
    $result = $app->getFaltasDeUsuario($_GET['id']);
}else{
    App::print_init("Faltas de asistencia");
    $result = $app->getFaltas();
}
App::nav_aula();
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