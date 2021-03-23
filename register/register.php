<!DOCTYPE html>

<?php

    /*
    En este ejemplo se presupone que existen dos tablas dentro de la misma BD, una con usuarios inscritos y 
    otra para los registrados en el foro

    Primero se comprueba que el usuario esta previamente inscrito en el programa y a continuacion que no se haya registrado ya
    
    Por ultimo se registra el usuario guardando su contraseña de manera segura
    
    */

    

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Eliminar posibles intentos de inyeccion de codigo
    $clean_email = htmlspecialchars(stripslashes(trim($_POST['email'])));  

        
    // Cambiar por los credenciales correctos para la BD
    $DATABASE_HOST = 'xxxxxxx';
    $DATABASE_USER = 'xxxxxxx';
    $DATABASE_PASS = 'xxxxxxx';
    $DATABASE_NAME = 'xxxxxxx';

    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {

        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    
    if (!isset($clean_email, $_POST['password'])) {

        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>ERROR!</strong> Completa los campos del formulario 1
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        
            //Se comprueba el email despues de limpiarlo con una expresion regular que garantiza que es una direccion de correo válida
        if (!preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/', $clean_email)) {
            exit("Correo invalido");
        }
    }
    
    elseif (empty($_POST['password']) || empty($clean_email)) {
        
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>ERROR!</strong> Completa los campos del formulario 2
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else {
        if ($stmt = $con->prepare('SELECT id FROM inscritos WHERE correo = ?')) {
            //Correo limpio para sql
            $clean_email = $con->real_escape_string($clean_email);

            $stmt->bind_param('s', $clean_email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                
                if ($stmt2 = $con->prepare('SELECT id FROM registrados WHERE email = ?')) {
                    $stmt2->bind_param('s', $clean_email);
                    $stmt2->execute();
                    $stmt2->store_result();

                    if ($stmt2->num_rows > 0) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>ERROR</strong> Ya se registro una cuenta con este correo
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    else {
                        //REGISTRO

                            if ($stmt = $con->prepare('INSERT INTO registrados (email, pass) VALUES (?, ?)')) {
                                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                $stmt->bind_param('ss', $clean_email, $password);
                                $stmt->execute();


                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>CUENTA CREADA</strong> Le avisaremos cuando el blog esté activo
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                            } else {
                                echo 'ERROR AL REGISTRAR LA CUENTA!';
                            }
                             
                    }
                }

            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>ERROR</strong> El usuario no esta inscrito o uso un correo diferente en su inscripcion
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        } else {
            echo 'Could not prepare statement!';
        }
        $con->close();
    }
    
}

?>

<html>
    <head>
        <meta charset='utf-8'>
        <title>Register Page</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='/styles/main.css'>
    
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        
    </head>
    <body>
        <div class="register">
            <form method="POST" enctype="multipart/form-data" action="register.php">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email utilizado en la inscripcion</label>
                  <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Contraseña (minimo 5 caracteres)</label>
                  <input type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-warning">Registrarse</button>
              </form>
        </div>
    </body>
</html>