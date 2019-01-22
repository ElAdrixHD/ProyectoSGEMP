<?php
include_once("app.php");
$app= new App();
session_start();
$app->validateSesion();
App::print_init("Gestion de aulas");
App::nav_aula();
//1º SQL es erronea
$resultset = $app->getStudent();
if(!$resultset){
    echo "<p>Error al conectar al servidor: ".$app->getDao()->error."</p>";
}else{
$list= $resultset->fetchAll();
//print_r($list);
if (count($list)==0){
    echo "<p>No hay alumnos</p>";
}else{
    echo "<table class=\"table table-striped table-dark\">";
    echo "<thead>";
    echo "<tr>";
    for ($i = 0; $i<$resultset->columnCount();$i++){
        $namecolumn = $resultset->getColumnMeta($i);
        echo "<th>".strtoupper($namecolumn['name'])."</th>";
    }
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($list as $fila){
        echo "<tr>";
        echo "<td><a href='listAusencias.php?id=".$fila['id']."'/>".$fila['id']."</td><td>".$fila['dni']."</td><td>".$fila['nombre']."</td><td>".$fila['correo']."</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
}
//2º SQL es correcta
?>

<?php
App::print_footer();
?>