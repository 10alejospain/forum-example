<?php


/*
Se crea una sesion y a continuacion, si los credenciales estan en la BD se verifica 
la sesion como apta para pasar a la zona de usuarios

*/
    session_start();

    // Cambiar por los credenciales correctos para la BD
    $DATABASE_HOST = 'xxxxxxx';
    $DATABASE_USER = 'xxxxxxx';
    $DATABASE_PASS = 'xxxxxxx';
    $DATABASE_NAME = 'xxxxxxx';

    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( mysqli_connect_errno() ) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    //Eliminar posibles intentos de inyeccion de codigo
    $clean_email = htmlspecialchars(stripslashes(trim($_POST['email'])));
    

    if ( !isset($clean_email, $_POST['password']) ) {
        exit('Rellene los campos obligatorios');
    }//Se comprueba el email despues de limpiarlo con una expresion regular que garantiza que es una direccion de correo válida
    if (!preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/', $clean_email)) {
        exit("Correo invalido");
    }


    if ($stmt = $con->prepare('SELECT id, pass FROM registrados WHERE email = ?')) {

        //Limpiar email para sql
        $clean_email = $con->real_escape_string($clean_email);

        $stmt->bind_param('s', $clean_email);
        $stmt->execute();
        
        $stmt->store_result();
        if ($stmt->num_rows > 0) {// Si existe el usuario

            $stmt->bind_result($id, $password);
            $stmt->fetch();

            //Verificar contraseña
            if (password_verify($_POST['password'], $password)) {
                
                // Crear sesion
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $clean_email;
                $_SESSION['id'] = $id;

                header('Location: /blog/inicio.php');//Aqui comienza la sesion


            } else {
                // Contraseña incorrecta
                echo 'Usuario o contraseña invalidos';
            }
        } else {
            // Correo no existente en la DB
            echo 'Usuario o contraseña invalidos';
        }
        $stmt->close();
    }
    $con->close();

?>