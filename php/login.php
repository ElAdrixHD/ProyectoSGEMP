<?php
include_once("app.php");
session_start();
App::print_init("Inicio Sesion");
?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-4 offset-4">
            <form method="POST" action="login.php">
            <div class="form-group">
                <label for="user">Usuario:</label>
                <input id="user" name="user" type="text" autofocus="autofocus" required="required" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input id="pass" name="pass" type="password" required="required" class="form-control"/>
            </div>
                <input type="submit" value="Iniciar Sesion" class="btn btn-primary"/>
                <p></p>
            </form>
        </div>
    </div>
</div>
<?php
$app = new App();
if ($app->isLogged()){
    echo "<script language=\"javascript\">window.location.href=\"aula.php\"</script>";
}else{
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $user=$_POST["user"];
        $pass=$_POST["pass"];
        if(empty($user)){
            echo "<div class=\"alert alert-warning\" role=\"alert\">
        <p>Debes introducir un nombre de usuario</p>
        </div>";
        }else if(empty($pass)){
            echo "<div class=\"alert alert-warning\" role=\"alert\">
        <p>Debes introducir una contraseña</p>
        </div>";
        }else{
            $app =new App();
            if(!$app->getDao()->isConnected()){
                echo "<p>".$app->getDao()->error."</p>";
            }elseif($app->getDao()->validateUser($user,$pass)){
                $app->saveSession($user);
                echo "<script language=\"javascript\">window.location.href=\"aula.php\"</script>";
            }else{
                echo "<div class=\"alert alert-danger\" role=\"alert\">
            <p>La conexion es incorrecta</p>
            </div>";
            }

        }
    }
}

App::print_footer();
?>