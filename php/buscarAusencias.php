<?php
include_once("app.php");
$app= new App();
$app->validateSesion();
App::print_init("Busqueda de ausencias");
App::nav_aula();
?>
    <div class="container">
        <form method="POST" action="listAusencias.php">
            <div class="form-group">
                <label for="seleccion_alum">Selecciona alumno:</label>
                <select class="form-control" name="seleccion_alum">
                    <option value=""> </option>
                    <!--<option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>-->
                    <?php
                    $result = $app->getStudent()->fetchAll();
                    foreach ($result as $fila){
                        echo "<option value=".$fila['id'].">".$fila['dni']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <div class="col-md-8">
                    <div class="form-group row">
                        <label for="dateA" class="col-md-1 control-label">Desde</label>
                        <div class="col-md-5">
                            <input type="date" class="form-control" name="dateA">
                        </div>
                        <label for="dateP" class="col-md-1 control-label">Hasta</label>
                        <div class="col-md-5">
                            <input type="date" class="form-control" name="dateP">
                        </div>
                        <!--<label for="dateA">Fecha Anterior</label>
                        <input id="dateA" name="dateA" type="date" autofocus="autofocus" required="required" class="form-control"/>
                        <label for="dateP">Fecha Posterior</label>
                        <input id="dateP" name="dateP" type="date" autofocus="autofocus" required="required" class="form-control"/>-->
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="seleccion_mod">Selecciona Modulo:</label>
                <select class="form-control" name="seleccion_mod">
                    <option value=""> </option>
                    <?php
                    $result = $app->getModulos()->fetchAll();
                    foreach ($result as $fila){
                        echo "<option value=".$fila['id'].">".$fila['nombre']."</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="submit" class="btn btn-primary"/>
        </form>
    </div>
<?php
App::print_footer();
?>