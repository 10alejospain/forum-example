<?php

    //Si se redirige al usuario aquí se cierra la sesion que estuviese abierta

    session_start();
    session_destroy();

    header('Location: index.html');
?>