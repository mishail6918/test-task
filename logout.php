<?php
setcookie("login", "", time() - 3600*24*30*12, "/");
setcookie("password", "", time() - 3600*24*30*12, "/",null,null,true); // httponly !!!

// Переадресовываем браузер на страницу проверки нашего скрипта
header("Location: /"); exit;

?>