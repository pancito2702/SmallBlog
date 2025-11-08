<?php

session_start();

session_unset();

session_destroy();

header("location: ../paginas/index.php");
exit();