<?php
// db.php
require_once 'config.php';

function conectar_bd() {
    $conn_str = "host=" . DB_SERVER . " dbname=" . DB_NAME . " user=" . DB_USERNAME . " password=" . DB_PASSWORD;
    $conn = pg_connect($conn_str);
    if (!$conn) {
        die("Error en la conexión: " . pg_last_error());
    }
    return $conn;
}
?>

