<?php
//crea la secion y cierra todo y lo destruye para salir a la pagina dicha abajo
session_start();
session_unset();
session_destroy();
header("Location: ../index.php");